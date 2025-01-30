<?php
/**
 * Hashes a password using the BCRYPT algorithm.
 *
 * This function takes a plain text password and returns its hashed version using the BCRYPT algorithm,
 * which is a strong and widely used hashing algorithm for securely storing passwords.
 *
 * @param string $password The plain text password to be hashed.
 * 
 * @return string The hashed version of the password.
 */ 

if(!function_exists('bcrypt')){
    function bcrypt(string $password):string{
        //hashed the password using  password_hash with PASSWORD_BCRYPT Algorithm
        return password_hash($password, PASSWORD_BCRYPT);
    }
}
/**
 * Verifies if a plain text password matches a hashed password.
 *
 * This function compares a plain text password with a hashed password using
 * the `password_verify()` function. It returns `true` if the password matches
 * the hash, and `false` otherwise.
 *
 * @param string $password The plain text password to be verified.
 * @param string $hash The hashed password to compare the plain text password against.
 * 
 * @return bool `true` if the password matches the hash, `false` otherwise.
 */
if(!function_exists('hash_check')){
    function hash_check(string $password,string $hash):bool{
        // compares a plain text password with a hashed password
         return password_verify($password, $hash);
    }
}