<?php


/**
 * Retrieves a value from the request or file upload.
 * 
 * This function fetches data from either the `$_FILES` superglobal for file 
 * uploads or the `$_REQUEST` superglobal for regular request parameters.
 *
 * @param string|null $request The key to retrieve from the request or file upload. Defaults to null.
 * @return mixed Returns the file upload information if the key exists in
 * `$_FILES`, the value from `$_REQUEST` if it exists, or null if not found.
 */

if(!function_exists('request')){
    function request(string $request=null){
// Check if a file upload with the specified key exists in the $_FILES superglobal.
        if(isset($_FILES[$request]) && !empty($_FILES[$request])){
//Return the file upload information (e.g., file name, type, size, etc.).
            return $_FILES[$request];
        }
// Otherwise, check if the key exists in the $_REQUEST superglobal.
//then : Return the request value or null if not found.
        return isset($_REQUEST[$request])?$_REQUEST[$request]:null;
    }
}