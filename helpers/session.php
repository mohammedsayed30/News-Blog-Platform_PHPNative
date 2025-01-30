<?php
/**
 *  sessions are used to store information (variables) that can be accessed across 
 * multiple pages. 
 * A session allows you to persist data (like user authentication) without
 *   needing to pass it explicitly between requests (such as in URLs or forms).
 * 
 */
/****************************************************************************************** ********
 *                                                         Function Defintions
*****************************************************************************************************/

/**
 * Retrieves or sets a session variable.
 *
 * If the `$value` parameter is provided, this function sets the session variable with the given key and value.
 * If the `$value` is not provided, it retrieves the session value for the specified key.
 * The session value is encrypted when set and decrypted when retrieved.
 *
 * @param string $key The session variable name.
 * @param mixed $value (Optional) The value to set for the session variable. If not provided, the function retrieves the session value.
 * 
 * @return mixed The decrypted session value if the session variable exists; an empty string otherwise.
 */

if(!function_exists('session')){
    function session(string $key,mixed $value=null){
        if(!is_null($value)){
            $_SESSION[$key]=encrypt($value);  //set the value of this session
        }
        return isset($_SESSION[$key])?decrypt($_SESSION[$key]):'';
    }
}

/**
 * Checks if a session variable exists.
 *
 * This function checks if a session variable with the given key is set and exists.
 *
 * @param string $key The session variable name to check for existence.
 * 
 * @return bool Returns `true` if the session variable exists, otherwise `false`.
 */

if(!function_exists('session_has')){
    function session_has(string $key):mixed{
        return isset($_SESSION[$key]);
    }
}

/**
 * Sets a session variable and returns its value, then deletes it.
 *
 * This function sets a session variable with the provided key and value. If a value is passed, 
 * it is encrypted and stored in the session. It then returns the stored value (after decrypting it) 
 * and deletes the session variable, effectively making it "flash" (temporary).
 *
 * @param string $key The session variable name.
 * @param mixed $value The value to store in the session (optional). If null, the function will just return the session value.
 * 
 * @return mixed The decrypted value of the session variable, or an empty string if not set.
 */

if(!function_exists('session_flash')){
    function session_flash(string $key,mixed $value=null):mixed{
        if(!is_null($value)){
            $_SESSION[$key]=$value;
        }
        $session=isset($_SESSION[$key])?decrypt($_SESSION[$key]):'';// Get the decrypted session value
        session_forget($key);  // Delete the session variable
        return $session;  // Return the session value
    }
}

/**
 * Deletes a session variable.
 *
 * This function removes the specified session variable from the session data, 
 * effectively "forgetting" it. If the session variable does not exist, 
 * no action is performed.
 *
 * @param string $key The session variable name to be deleted.
 * 
 * @return void This function does not return any value.
 */

if(!function_exists('session_forget')){
    function session_forget(string $key){
        if(isset($_SESSION[$key])){
            unset($_SESSION[$key]);  //delete the  session
        }
    }
}

/**
 * Destroys all session data.
 *
 * This function destroys the current session and all associated session data, 
 * effectively removing all session variables. It will end the session and delete 
 * the session cookie if applicable.
 * 
 * Note: After calling this function, the session will be destroyed, and the 
 * user will have to start a new session if required.
 * 
 * @return void This function does not return any value.
 */
if(!function_exists('session_delete_all')){
    function session_delete_all(){
        session_destroy();  //delete all  sessions
    }
}