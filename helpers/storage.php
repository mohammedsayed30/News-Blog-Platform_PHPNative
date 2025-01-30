<?php
/**
 * hints:
 * If you do not use move_uploaded_file() (or any equivalent mechanism) 
 * to move the uploaded file from its temporary location, 
 * the file will not be automatically moved to a default location instead:
 * Uploaded files are stored in a temporary directory 
 * (as defined by the upload_tmp_dir directive in php.ini or the system's default temporary directory).
*  The file remains there until the PHP script finishes executing.
* Once the PHP script execution ends, the temporary file is automatically deleted
* by PHP to free up system resources.This ensures that unnecessary files don’t
*  accumulate on the server.
 */

/**
 * Serves a file for download from the server.
 *
 * This function checks if the specified file exists at the given path and 
 * if so, sends appropriate headers to the browser to prompt the user to 
 * download the file. It also ensures the file's metadata is communicated 
 * to the browser, such as content type, size, and cache control.
 * 
 * If the file does not exist, an error message is displayed to the user.
 * 
 * @param string $path The file path to the file that should be served for download.
 * 
 * @return void This function does not return any value. It sends the file directly to the browser for download.
 */
if(!function_exists('storage')){
    function storage($path){
        /**
         * HTTP headers are used to make the web server  provide additional information to the client (such as the browser) 
         * about the server's response. You can use header() to perform a variety of tasks, 
         * such as redirecting the user to another page,
         *  controlling cache settings, or defining content types.
         */
        if(file_exists($path)){
            //to let the browser know what i will store
            header('Content-Description: file from server');
            //the type of content 
            header('Content-Type: attachment; filename'.basename($path));
            //the time that this file will be exist
            header('Expiers: 0');
            //to validate that file is exist
            header('Cach-Control: must-revalidate');
            //this file is public
            header('Parma: public');
            //the size of this file
            header('Content-Length:' .filesize($path));
            //read the file
            readfile($path);
        }
        else
        {
            ?>
            <h1>This File Not Exist</h1>
            <?php
        }
        exit;
    }
}

/**
 * Deletes a file from the server.
 *
 * This function attempts to delete a file located at the specified path. 
 * The path is constructed by concatenating the base storage path (configured in the application) 
 * with the given relative file path. If the file exists, it is deleted, and the function returns `true`.
 * If the file does not exist, the function returns `false`.
 * 
 * @param string $to_path The relative path to the file that should be deleted.
 * 
 * @return bool Returns `true` if the file was successfully deleted, or `false` if the file does not exist.
 */

if(!function_exists('delete_file')){
    function delete_file($to_path){
        $path=rtrim(config('files.storage_files_path'),'/').'/'.ltrim($to_path,'/');
        if(file_exists($path)){
            return unlink($path);//to delete this file
        }
        return false;//if this file not exist return false
    }
}

/**
 * Generates the URL to access a file stored in the storage directory.
 *
 * This function constructs a URL to a file in the storage directory, 
 * based on the given relative file path. If the path is not provided, 
 * it returns an empty string. If the path is provided, the function 
 * appends it to the base URL, leading to the file's accessible location.
 *
 * @param string|null $path The relative file path in the storage directory.
 *                          If not provided, an empty string is returned.
 * 
 * @return string Returns the generated URL if a valid path is provided, 
 *                otherwise an empty string.
 */

if(!function_exists('storage_url')){
    function storage_url($path=null){
        return !empty($path)?php_url('storage/files/'.$path):'';
    }
}

/**
 * Removes a specified folder if it exists.
 *
 * This function attempts to delete a folder at the specified path. 
 * It verifies if the path is a directory before attempting to remove it. 
 * If the folder is successfully removed, the function returns true; otherwise, it returns false.
 *
 * @param string $path The path to the folder to be removed.
 * 
 * @return bool Returns true if the folder is successfully removed, false otherwise.
 */

if(!function_exists('remove_folder')){
    function remove_folder($path){
        if(is_dir($path)){
            return rmdir($path);//rmdir  built in function to delete this folder
        }
        return false;
    }
}

/**
 * Stores an uploaded file to a specified location.
 *
 * This function handles file uploads by moving the temporary file from the `$_FILES` array 
 * to the specified storage path. It creates the necessary directories if they do not exist. 
 * The function returns the relative path of the stored file on success or false on failure.
 *
 * @param array $from The uploaded file details from the `$_FILES` array, which should include a 'tmp_name' key.
 * @param string $to The destination path (relative) where the file should be stored.
 * 
 * @return string|bool Returns the relative path of the stored file on success or false on failure.
 */

if(!function_exists('store_file')){
    function store_file(array $from,string $to):string|bool{
        if(isset($from['tmp_name'])){
            $to_path = '/'.ltrim($to,'/');
            /*to store the files in 'storage/files*/
            $path = config('files.storage_files_path').$to_path;
            $ex_path = explode('/',$path);
            $end_file = end($ex_path);  //to get the file not the directory
            //to get the path without any files to create the directory if not exist
            $check_path = str_replace($end_file,'',$path); 
            if(!empty($check_path)){
                /*creat this directory if it not exist*/
                /*if you try to create a directory at path a/b/c and neither a nor b exists yet, 
                setting $recursive to true will create both a and b before creating c.*/ 
                mkdir($check_path,0777,true);
            }
            /**
             * move_uploaded_file() is a built-in PHP function. It is part of PHP's core functionality and 
             * is specifically designed to handle the secure movement of uploaded files 
             * from the temporary directory to a designated location on the server.
             */
            move_uploaded_file($from['tmp_name'],$path);
            return $to;
        }
        return false;
    }
}


/**
 * Extracts file extension and generates a hashed file name for an uploaded file.
 *
 * This function processes the provided file information to extract the file extension 
 * and generate a unique hashed file name. It returns an array containing the original 
 * file name, the hashed file name, and the file extension.
 *
 * @param array $file_name The uploaded file details, including the 'name' key for the file name.
 * 
 * @return array Returns an associative array with:
 * - `name`: The original file name (string).
 * - `hash_name`: The hashed file name (string) for storing the file.
 * - `ext`: The file extension (string).
 */

 
if(!function_exists('file_ext')){
    function file_ext(array $file_name):array{
        if(!empty($file_name['name'])){
            $fext = explode('.',$file_name['name']);
            $file_ext = end($fext);
            $hash_name = md5(10).rand(000,999).'.'.$file_ext;
            return[
                "name"=>$file_name['name'],
                "hash_name"=>$hash_name,
                "ext"=>$file_ext,
            ];
        }else{
            return[
                "name"=>'',
                "hash_name"=>'',
                "ext"=>'',
            ]; 
        }
    }
}