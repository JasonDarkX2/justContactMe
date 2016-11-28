<?php
require_once dirname(dirname(__FILE__)) . '/model/email.php';
$robotCheck=false;
if(get_option('reCaptchaEnabled')){
$url= 'https://www.google.com/recaptcha/api/siteverify?'
    . 'secret=' .  get_option('secretKey')
        . '&response=' .
            $_POST['g-recaptcha-response'] 
         .'&remoteip=' . 'nope';
$capchaResponse=file_get_contents($url);
$data= json_decode($capchaResponse);
$robotCheck=$data->{'sucess'};
}
if($robotCheck!=TRUE){
$mail= new Email();

$to=get_option('toAddress');
$name =preg_replace('/[^A-Za-z0-9\-]/', '',$_POST['cname']);
$email = $_POST['email'];
$message = $_POST['message'];
$subject=preg_replace('/[^A-Za-z0-9\-]/', '',$_POST['subject']);
$headers=array( );
$copyAdddress=get_option('copyAddress');
if(isset($copyAddress)){
    array_push($copyAdddress .'\r\n');
    
}
if(get_option('attachment')){
   $mailAttachment=array($_POST['mailAttachment']);
   if(filesize($mailAttachment)>attachmentSizeLimit){
       $sendOk=false;
       $errorMsg= 'label id="success" class="failedmsg"> Unable to send,attached file was was larger than '.  get_opption('attachmentSize')/ (1024*1024) . 'MB</label>'; 
   }
   $file_parts = pathinfo($mailAttachment);
   if(!preg_match($file_parts['extension'], extensions)){
       $sendOk=false;
       $errorMsg= 'label id="success" class="failedmsg"> invalid file type, only attach .'. str_replace('|',', .' , extension) .' files</label>'; 
   }
}
$mail->createEmail($to,$name,$email,$subject,$message, $headers,$mailAttachment);
if($mail->sendmail()==TRUE){
    echo  '<label id="success" class="successmsg"> Message Successfully Sent</label>';
}
else{
      echo  '<label id="success" class="failedmsg"> Unable to Sent Message, please try again later</label>';
}
}else{
      echo  '<label id="success" class="successmsg">Robot in diguise eh? Please complete  Captcha vertification</label>';
}
?>


