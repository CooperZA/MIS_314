<?php
// generate mail
class MailHelper
{
    public static function GenerateEmail($email, $body, $sub = "Thank You For Shopping With Us!"){
        $fromEmail = "cooperz@wwu.edu";

        mail($email, $sub, $body, $fromEmail);
    }
}
?>