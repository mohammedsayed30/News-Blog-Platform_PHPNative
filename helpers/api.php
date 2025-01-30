<?php
/**
 * Sends a JSON response to the client with the specified status code.
 *
 * This function sets the `Content-Type` header to `application/json`, sets the 
 * appropriate HTTP status code, and returns the provided data in JSON format. 
 * If no data is provided, only the status code is returned.
 *
 * @param array|null $data The data to be encoded as JSON. If null or empty, no data is returned.
 * @param int $status The HTTP status code to be sent with the response. Default is 200 (OK).
 * 
 * @return void This function does not return any value; it outputs the JSON response directly.
 */
if(!function_exists('response')){
    function response(array|null $data,int $status=200 ){
        /**
         * This sets the response header to tell the client (browser or API client) 
         * that the response is in JSON format with UTF-8 encoding.
         */
        header('Content-Type:  application/json; charset:utf-8');
        /**
         * This sets the HTTP status code for the response. The default value
         *  is 200 (OK),  but you can pass any valid HTTP status code 
         * (e.g., 404 for Not Found, 500 for Internal Server Error).
         */
        http_response_code($status);
        if(!empty($data)){
            /**
             * it converts the data to JSON format using json_encode().
             */
            echo json_encode($data,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        }
    }
}
?>