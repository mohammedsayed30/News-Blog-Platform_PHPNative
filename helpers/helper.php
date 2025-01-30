<?php

/**
 * Retrieves a specific configuration value from a configuration file.
 *
 * This function takes a key in the form of `file.property` (e.g., `database.host`) and
 * returns the corresponding value from the appropriate configuration file. The configuration
 * files are expected to be located in the `config` directory, with the file name being the
 * first part of the key (before the dot) and the property being the second part of the key (after the dot).
 *
 * @param string $key The configuration key, in the format `file.property`.
 * 
 * @return mixed The value of the specified configuration property, or `null` if the key is not found.
 */

if(!function_exists('config')){
    function config(string $key){
        $config = explode('.', $key);//to make the file in index0 and property in index 1
        if(count($config)>0){
            $result = include base_path('config/'.$config[0].".php");//return the file
            return $result[$config[1]];//return the property from this file
        }
        return null;
    }
}

/**
 * Returns the absolute path to a file or directory relative to the project’s base directory.
 *
 * This function appends the specified `$path` to the current working directory's parent directory,
 * effectively returning an absolute path that can be used to reference files or directories within
 * the project structure.
 *
 * @param string $path The relative path to be appended to the base directory.
 * 
 * @return string The absolute path formed by combining the current working directory and the provided `$path`.
 */

if(!function_exists('base_path')){
    function base_path(string $path)
    {
       //get the current working directory's parent directory,
       return getcwd() . "/../". $path;
    }
}

/**
 * Returns the absolute path to a file or directory within the public directory.
 *
 * This function appends the specified `$path` to the current working directory,
 * effectively returning the absolute path to a resource in the public directory.
 *
 * @param string $path The relative path to be appended to the public directory.
 * 
 * @return string The absolute path formed by combining the current working directory and the provided `$path`.
 */

if(!function_exists('public_path')){
    function public_path($path)
    {
        //get the current working directory's parent directory,
        return getcwd() . "/" . $path;
    }
}
