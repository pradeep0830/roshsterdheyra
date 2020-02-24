<?php
function mail_test()
{
 $email = '1117pradeep@gmail.com';//The email address the cron job will reach when successful.
 $subject = 'Test Cron Job Email';
 $body = 'Hello, this is a test email from a cron job: /cron.php.';
 $domain = explode('www.',$_SERVER['SERVER_NAME']);
 $headers = 'From: Server <noreply@'.$domain[1].'>\n';
 $headers .= 'Reply-to: noreply@'.$domain[1].'\n';
 $headers .= 'Content-Type: text/plain; charset=iso-8859-1\n';
 mail($email,$subject,$body,$headers);
}

mail_test();
?>