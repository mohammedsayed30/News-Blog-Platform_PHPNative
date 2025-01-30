<?php

/**
 * Validate input data against specified rules and handle errors.
 *
 * This function validates attributes based on a set of rules, generates error messages
 * for any violations, and can redirect or return an API response depending on the specified behavior.
 * If validation passes, it returns the sanitized input data.
 *
 * @param array $attributes An associative array where keys are input field names and values are validation rules.
 *                          Example: ['email' => 'required|email', 'password' => 'required|string'].
 * @param array|null $trans (Optional) An associative array for custom attribute names in error messages.
 *                          Example: ['email' => 'Email Address'].
 * @param string $http_header Determines the response type in case of validation errors:
 *                            'redirect' for web redirects or 'api' for JSON API responses.
 * @param string|null $back (Optional) URL to redirect back to in case of validation errors. If null, uses the referer.
 *
 * @return array|void Returns an array of sanitized input data if validation passes. Otherwise, handles errors via
 *                    redirect or JSON API response and halts further execution.
 *
 * @throws Exception If an unexpected condition occurs during validation.
 */

if(!function_exists('validation')){
    function validation(array $attributes,array $trans=null,$http_header='redirect',$back=null){
        //to hold the errors 
        $validations = [];
        //to holds the values of the request (what you enterd in  the post request )
        $old = [];
        
        //start loop to extract attributes
        foreach($attributes as $attribute=>$rules)
        {
        /*to retrieve the value of the input key specified by $attribute 
        (e.g., the name of an input field).*/
            $value=request($attribute);
            //but what we enterd for a specific attribute
            $old[$attribute]=$value;  
            // if($attribute=='icon'){
            //     var_dump(getimagesize($value['tmp_name']));
            // }
            global $validations;// to store validation error messages.
            $attribute_validate=[]; //to store one error each time
            $final_attr = isset($trans[$attribute])?$trans[$attribute]:$attribute;
            foreach(explode('|',$rules) as $rule){
                //this check if the user not enter  any values for this field
                if($rule=='required' && (is_null($value) || empty($value) || (isset($value['tmp_name']) && empty($value['tmp_name']))))
                {
                    $attribute_validate[]=str_replace(':attribute',$final_attr,trans('validation.required'));
                }
                //this check for the value of email is wrong 
                if($rule=='email' && !filter_var($value,FILTER_VALIDATE_EMAIL))
                {
        //FILTER_VALIDATE_EMAIL isfilter to determine if the input value is a valid email address.
                    //this array  errors that we got
                    $attribute_validate[]=str_replace(':attribute',$final_attr,trans('validation.email'));
                }
                //this check if the user not enter  any values except numbers
                elseif($rule=='integer' && !filter_var($value,FILTER_VALIDATE_INT))
                {
                    $attribute_validate[]=str_replace(':attribute',$final_attr,trans('validation.integer'));
                }
                elseif($rule=='string' && is_numeric($value))
                {
                    $attribute_validate[]=str_replace(':attribute',$final_attr,trans('validation.string'));
                }
                elseif($rule=='numeric' && !is_numeric($value))
                {
                    $attribute_validate[]=str_replace(':attribute',$final_attr,trans('validation.numeric'));
                }
                elseif($rule=='image' && isset($value['tmp_name']) &&(!empty($value['tmp_name']) && getimagesize($value['tmp_name']) === false ))
                {
                    $attribute_validate[]=str_replace(':attribute',$final_attr,trans('validation.image'));
                }
                elseif(preg_match('/^unique:/i',$rule)){
                    $ex_rule=explode(':',$rule);
                    if(count($ex_rule) > 1 && isset($ex_rule[1])){
                        //extract the table&column names 
                        $get_unique_info = explode(',',$ex_rule[1]);
                        //this conatin the table name
                        $table = $get_unique_info[0];
                        //to check if there is a column name or not
                        if(isset($get_unique_info[1])){
                            $column = $get_unique_info[1];
                        }else{
                            $column = $attribute;
                        }
                        if(isset($get_unique_info[2])){
                            $sql="where ".$column."='".$value."' and id != '".$get_unique_info[2]."'";
                        }else{
                            $sql="where ".$column."='".$value."'";
                        }
                        //select the values of these table and column
                        $check_unique_db =db_first($table,$sql);
                        if(!empty($check_unique_db)){
                            $attribute_validate[]=str_replace(':attribute',$final_attr,trans('validation.unique'));
                        }
                    }
                }
                //exist rule
                elseif(preg_match('/^exist:/i',$rule)){
                    $ex_rule=explode(':',$rule);
                    if(count($ex_rule) > 1 && isset($ex_rule[1])){
                        //extract the table&column names 
                        $get_unique_info = explode(',',$ex_rule[1]);
                        //this conatin the table name
                        $table = $get_unique_info[0];
                        //to check if there is a column name or not
                        if(isset($get_unique_info[1])){
                            $column = $get_unique_info[1];
                        }else{
                            $column = $attribute;
                        }
                        if(isset($get_unique_info[1])){
                            $sql="where ".$column."='".$value."'";
                        }else{
                            $sql="where id ='".$value."'";
                        }
                        //select the values of these table and column
                        $check_exist_db =db_first($table,$sql);
                        if(empty($check_exist_db)){
                            $attribute_validate[]=str_replace(':attribute',$final_attr,trans('validation.unique'));
                        }
                    }
                }
                //in
                elseif(preg_match('/^in:/i',$rule)){
                    $ex_rule=explode(':',$rule);
                    if(count($ex_rule)> 1 && isset($ex_rule[1])){
                        $ex_in= explode(',',$ex_rule[1]);
                        if(!empty($ex_in) && is_array($ex_in) && !in_array($value,$ex_in)){
                            //this mean that value not secure
                            $attribute_validate[]=str_replace(':attribute',$final_attr,trans('validation.in'));
                        }
                    }
                }
               
                                                
            }
            if(!empty($attribute_validate) && is_array($attribute_validate) && count($attribute_validate) > 0){
                //this to add all errors that we got
                $validations[$attribute]=$attribute_validate;
                //to store all attributes in session
            }
        }
        //end loop to extract attributes
        //if true this mean there is errors
        //instanceof Countable to ensure that $validations is contable
        if(is_array($validations) && count($validations) > 0 ){ 
            if($http_header == 'redirect'){
                //make session as we want to save the errors when we got redirect
                session('errors',json_encode($validations));
                //make session as we want to save the values when we got redirect 
                session('old',json_encode($old));
                if(!is_null($back)){
                    redirect($back);
                }else{
                    back();
                } 
            }elseif($http_header == 'api'){

                //there is no session as there is no redirect here
                //unicode for to make undersandable by people
                response($validations,422);
            }
        }else{ //this mean there is no errors
            return $old; //return what we enterd in the post form
        }
    }
}

/**
 * Retrieve the previously submitted value for a specific request field.
 *
 * This function fetches and returns the old input value stored in the session for a given request field. 
 * It is typically used to repopulate form fields after validation errors.
 *
 * @param string $request The name of the request field to retrieve the old value for.
 *                        Example: 'email' to retrieve the old value of the 'email' input field.
 *
 * @return mixed Returns the old value for the specified field if it exists, or an empty string if not found.
 */

if(!function_exists('old')){
    function old($request){
        $old_values = (array) json_decode(session('old'),true);
        //var_dump($old_values[$request]);
        if(is_array($old_values) && count($old_values) > 0){
            return $old_values[$request];
        }
        else{
            return '';
        }
    }
    
}

/**
 * Clears the stored validation errors from the session.
 *
 * This function removes the validation error messages stored in the session, typically after they have been displayed
 * to the user or after the form has been successfully processed.
 *
 * @return void This function does not return any value.
 */


if(!function_exists('end_errors')){
    function end_errors(){
        session_flash('errors');
    }
}

/**
 * Retrieves validation errors from the session.
 *
 * This function retrieves validation error messages from the session. It can return either a specific error based on
 * the provided offset or all remaining errors. After retrieving an error, it removes it from the session and updates
 * the session with any remaining errors.
 *
 * @param string|null $offset The key for a specific error message to retrieve. If null, all errors will be returned.
 * 
 * @return array|string Returns an array of error messages if there are multiple errors, or a string (or an empty array)
 *         if a specific error message is retrieved based on the offset. Returns an empty array if no errors are found.
 */
if(!function_exists('any_errors')){
    function any_errors($offest=null){
        session('errors');
        //to get all sessions errors
        $array=(array) json_decode(session('errors'));
        //check if there is an offest(to return a particular value) or not
        if(isset($array[$offest])){
            $text = $array[$offest];
            unset($array[$offest]);// Remove the retrieved error from the array
            session_flash('errors'); // Clear the existing session(not necessary)
            if(!empty($array)){
                // Update the session with remaining errors
                session('errors',json_encode($array)); 
            }
            return is_array($text)?$text:[];
        }elseif(!empty($array) && count($array) > 0){
            return $array;
        }else{
            return [];
        } 
    }
}

/**
 * Retrieves all validation error messages from the session.
 *
 * This function gathers all the error messages stored in the session, flattening any nested error arrays into a single
 * array of error messages. It calls the `any_errors` function to retrieve errors, then compiles all individual error
 * messages into a single list.
 *
 * @return array Returns an array containing all validation error messages.
 */
if(!function_exists('all_errors')){

    function all_errors(){
        $all_errors=[];
        foreach(any_errors() as $errors){
            foreach($errors as $error){
                $all_errors[]=$error;
            }
        }
        return $all_errors;
    }
    
}

/**
 * Retrieves and formats a specific validation error message as an HTML unordered list.
 *
 * This function retrieves validation errors for a specific offset (key) from the session and formats them into an HTML
 * unordered list. Each error message is wrapped in an `<li>` tag. If no errors are found for the given offset, the function 
 * returns null.
 *
 * @param string|int $offset The key (or offset) to retrieve specific error messages for. 
 *                           Typically, this is a field name or identifier for the validation errors.
 *
 * @return string|null Returns a string containing the formatted HTML list of errors if there are any, 
 *                     or null if no errors are found.
 */

if(!function_exists('get_error')){
    
    function get_error($offest){
        $error='<ul>';
        foreach(any_errors($offest) as $error_string){
            if(is_string($error_string)){
                $error.='<li>'.$error_string.'</li>';
            }
        }
        $error.='<ul>';
        return !empty($error)?$error:null;
    }
    
}

/**
 * Sanitize input data by trimming, removing slashes, and converting special characters.
 *
 * This function is used to clean user input to ensure it's safe for use
 * by removing unnecessary whitespace, escaping special characters, and
 * preventing XSS (Cross-Site Scripting) attacks.
 *
 * @param string $data The input data to be sanitized.
 * @return string The sanitized input data.
 */

if(!function_exists('test_input')){
     function test_input($data){
        $data=trim($data);
        $data=stripslashes($data);
        /*to convert any special characters into html entities -->to not
        execute  any  scripts from outside */ 
        $data=htmlspecialchars($data);
        return  $data;
     }
}


  


