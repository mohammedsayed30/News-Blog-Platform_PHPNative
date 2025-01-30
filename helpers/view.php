<?php

/**
 * Loads and displays a view file, optionally passing variables to it.
 *
 * This function attempts to locate a view file by converting the given path into a valid file path.
 * If the view file exists, it is included, and the variables are passed to the view engine. If the file does not exist,
 * a default 404 error page is loaded instead.
 *
 * @param string $path The path to the view file (without the `.php` extension).
 *                     The path is relative to the base view directory configured in the system.
 *
 * @param array|null $vars An associative array of variables to pass to the view.
 *                         If no variables are provided, the default is `null`.
 *
 * @return void
 */

if (!function_exists('view')){
    function view(string $path,array $vars=null){
        //get the final path
        $file = config('views.path').'/'.str_replace('.','/',$path).'.php';
        if(file_exists($file)){
            $view =$file; //if exist included and it will executed ofcourse
        }else{ //if not display an error message
            $view=config('views.path').'/404.php';
        }
        view_engine($view,$vars);
    }
}

/**
 * Processes and renders a view file with the provided variables.
 *
 * This function processes the view file by replacing custom view syntax with PHP code, such as `{{ ... }}`
 * for output and `@if`, `@foreach`, etc., for control structures. The processed view file is then saved temporarily
 * and included for rendering. This allows for dynamic content rendering using PHP variables.
 *
 * @param string $view The path to the view file to render. This path should be relative to the application's base
 *                     directory and should include the `.php` file extension.
 *
 * @param array|null $vars An associative array of variables to pass to the view file. If no variables are provided,
 *                         the default is `null`.
 *
 * @return void
 */

if (!function_exists('view_engine')){
    function view_engine(string $view,array $vars=null){

        if(!is_null($vars) && is_array($vars)){
            foreach($vars as $key=>$value){
                ${$key} = $value;
            }
        }

        //to display the content of the file and controle the diplaying the content
        $file = file_get_contents($view);

        //this to be a uniqu name
        $hash_name = md5($view);
        $save_to_storage = base_path('storage/views/'.$hash_name.'.php');
        //all the follwing just for enhance the code and some modification for the new copy
        $file=str_replace('{{','<?php echo ',$file);
        $file=str_replace('}}',' ; ?> ',$file);        
        $file=str_replace('@php','<?php echo ',$file);
        $file=str_replace('@endphp',' ;?> ',$file);
        //if statement
        $file = preg_replace('/@if\((.*?)\)+/i','<?php if($1)): ?>',$file);
        $file = preg_replace('/@elseif\((.*?)\)+/i','<?php elseif($1)): ?>',$file);
        $file = preg_replace('/@else/i','<?php else: ?>',$file);
        $file = preg_replace('/@endif/i','<?php endif; ?>',$file);      
        //foreach
        $file = preg_replace('/@foreach\((.*?) as (.*?)\)+/i','<?php foreach($1 as $2): ?>',$file);
        $file = preg_replace('/@endforeach/i','<?php endforeach; ?>',$file);

        //include the file content to test file (copy the file into test file)
        file_put_contents($save_to_storage,$file);
        
        include $save_to_storage;
    }
}
