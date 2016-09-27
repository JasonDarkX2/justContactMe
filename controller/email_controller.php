<?php

require_once dirname(dirname(__FILE__)) . '/model/email.php';
$mail= new Email();
$to=get_option('admin_email');
$name =preg_replace('/[^A-Za-z0-9\-]/', '',$_POST['cname']);
$email = $_POST['email'];
$message = $_POST['message'];
$subject=preg_replace('/[^A-Za-z0-9\-]/', '',$_POST['subject']);
$headers=array('placeholder');
$mail->createEmail($to,$name,$email,$subject,$message, $headers);
if($mail->sendmail()){
    echo "sent";
}
else{
    echo "failed";
}
?>


