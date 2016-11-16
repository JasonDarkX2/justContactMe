<?php
$url= explode('plugin',$_SERVER['SCRIPT_FILENAME']);
require_once dirname($url[0])  . '/wp-load.php';
if(MY_PLUGIN_PATH !=NULL){
require_once( MY_PLUGIN_PATH . 'model/admin/settings.php');
require_once( MY_PLUGIN_PATH  . 'model/email.php');
}else{
    require_once( $_POST['plugindir'] . 'model/admin/settings.php');
    require_once( $_POST['plugindir'] . 'model/email.php');
}
$AdminSettings= new AdminSettings();
If(filter_var($_POST['toAddress'], FILTER_VALIDATE_EMAIL)){
    $AdminSettings->setAddress($_POST['toAddress'],FALSE);
}else{
    echo'<span class="error">Not a valid To Address</span>';
    die();
}
$fromAddress= $_POST['fromAddress'];
If(filter_var($fromAddress, FILTER_VALIDATE_EMAIL) ||$_SERVER['HTTP_HOST']=='localhost' ){
 $AdminSettings->setAddress($fromAddress,TRUE);  
}else{
        echo '<span class="error">Not a valid from  Address</span>';
    die();
}
if(isset($_POST['copyAddress'])){
   $string= explode(':', $_POST['copyAddress']);
   $copyAction= substr($string[0],0,3) .':';

   if(preg_match("/[BCbc][cC]*:/", $copyAction)==1){ 
       $AdminSettings->setCopyAddress($copyAction, $string[1]);
   }else{
       echo 'span class="error">Please use proper format for Cc/Bcc address, for exampe: Cc:emailAddress</span>';  
       die();
   }
   
}
if($_POST['attachment']==='true'){
    $AdminSettings->setAttachment(TRUE);
    $AdminSettings->setAttachmentOptions($_POST['fileType'], $_POST['fileSize']);
}else{
    $AdminSettings->setAttachment(FALSE);
}
if($_POST['reCaptchaEnabled']=='true'){
    $keys=[
        "siteKey" => $_POST['siteKey'],
        "secretKey" => $_POST['secretKey']
    ];
    $AdminSettings->setReCatcha(TRUE, $keys);
}  else {
    $AdminSettings->setReCatcha(FALSE,NULL);
}
if(empty($_POST['confId'])==FALSE){
    $theme=$_POST[$_POST['confId'][0]];
    $type=$_POST[$_POST['confId'][1]];
    $size=$_POST[$_POST['confId'][2]];
    $AdminSettings->setReCaptchaAttributes($theme, $type, $size);
}
if($_POST['sendTest']=="true"){
    $mail= new Email();

$to=get_option('admin_email');
$name ="Test Mail";
$email = get_option('admin_email');
$message = "Simply a Test mail";
$subject="Test  mail from SAC Plugin" ;
$headers=array('placeholder');
$mail->createEmail($to,$name,$email,$subject,$message, $headers);
if($mail->sendmail()){
    echo" Test mail sent suceeded";
}else{
    echo" Test mail sent failed";
}
};