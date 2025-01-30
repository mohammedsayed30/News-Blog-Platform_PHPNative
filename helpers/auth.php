<?php
/**
 * Retrieves the authenticated admin session data.
 *
 * This function checks if there is a session key `admin` indicating that an admin
 * user is logged in. If the session exists, the function decodes the session data
 * from JSON format and returns it as an associative array. If no session exists,
 * the function returns `null`.
 *
 * @return array|null The decoded session data as an associative array if the admin is authenticated, or `null` if no authentication data exists.
 */
if(!function_exists('auth')){
    function auth(){
        if(session_has('admin')){
            return json_decode(session('admin'),true);
        }else{
            return null;
        }
    }
}

/**
 * Logs out the current admin user by removing the 'admin' session.
 *
 * This function calls the `session_forget()` method to delete the session data
 * associated with the `admin` key, effectively logging out the admin user and
 * clearing their authentication data from the session.
 *
 * @return void This function does not return any value; it performs the session deletion.
 */

if(!function_exists('logout')){
    function logout(){
        session_forget('admin');
    }
}