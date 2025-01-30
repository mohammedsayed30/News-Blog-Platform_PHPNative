<?php
/**
 * encrypt used to encrypt data
 * this used to encrypt a plain text to cipher text using AES
 * @param string $value
 * @return string $cipher_text
 */

if(!function_exists('encrypt')){
    function encrypt(string $value):string{
        $cipher_algo = config('session.encryption_mode');//define the algorithm 
        $key = config('session.encryption_key');//set the secert key
        $iv_len = openssl_cipher_iv_length($cipher_algo);//get the length of iv
        /**to get the random value of intials vector anf this will generated each time */
        $iv = openssl_random_pseudo_bytes($iv_len);
        //$options = 0; // to be base 64
        $options = OPENSSL_RAW_DATA;//to make the encrypted message be string of bytes
        $cipher_text_raw = openssl_encrypt($value,$cipher_algo,$key,$options,$iv);//encryption
        /*to increase the length of the encrypted value */
        $hmac = hash_hmac('sha256',$cipher_text_raw, $key, true);
        /*convert this to base64 encoded */ 
        $cipher_text = base64_encode($iv.$hmac.$cipher_text_raw);
        return $cipher_text;
    }
}

/**
 * decrypt used to decrypt data
 * this used to encrypt a plain text to cipher text using AES
 * @param string $cipher_text
 * @return string $plain_text
 */

 if(!function_exists('decrypt')){
    function decrypt(string $cipher_text):string{
        $cipher_algo = config('session.encryption_mode');//define the algorithm 
        $key = config('session.encryption_key');//set the secert key
        $converted = base64_decode($cipher_text);
        $iv_len = openssl_cipher_iv_length($cipher_algo);//get the length of iv
        $iv = substr($converted,0,$iv_len);//get the iv value
        $hmac = substr($converted,$iv_len,32);//get the hmac value
        /* get the required cipher text that you want to decrypted */
        $cipher_text_raw = substr($converted, $iv_len+32); 
        //$options = 0; // to be base 64
        $options = OPENSSL_RAW_DATA;//to make the encrypted message be string of bytes
        $plain_text = openssl_decrypt($cipher_text_raw,$cipher_algo,$key,$options,$iv);//encryption
        $calmac =  hash_hmac('sha256',$cipher_text_raw, $key, true); 
        if($hmac == $calmac){//to check if there is no timing atack
            //if true this mean no attack if no this mean thers is an attack
            return $plain_text;
        }
        return "";
    }
}