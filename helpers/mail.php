<?php
/**
 * Sends an email to a list of recipients using the specified subject and message.
 *
 * This function uses the PHP `mail()` function to send emails. 
 * It supports SMTP configuration when specified in the application's 
 * configuration settings.
 *
 * @param array $mails An array of email addresses. The first email in the array will be used as the recipient.
 * @param string $subject The subject of the email.
 * @param string $message The body of the email, which will be sent as HTML content.
 * @return bool Returns true if the mail was successfully accepted for delivery, false otherwise.
 */
if(!function_exists('send_mail')){
    function send_mail(array $mails, array $subject, array $message):bool{
        
        if(config('mail.protocol') == 'smtp'){
            // Set SMTP server and port for mailhog
            ini_set('SMTP', config('mail.smtp_domain'));
            ini_set('smtp_port', config('mail.smtp_port')); 
        }
        $headers = 'MIME-Version: 1.0'."\r\n";
        $headers .= 'Content-type: text/html;charset=UTF-8'."\r\n";
        $headers .= 'From: '.config('mail.FROM_ADDRESS')."\r\n";
       /*The mail() function sends an email using the default email 
       configuration of the server*/
       var_dump($mails);
       for($i=0;$i<count($mails);$i++){
           return mail($mails[$i],$subject[$i],$message[$i],$headers);
       }
    }
}


