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
$subject="Test  mail from SAC PLugin" ;
$headers=array('placeholder');
$mail->createEmail($to,$name,$email,$subject,$message, $headers);
if($mail->sendmail()){
    echo" Test mail sent suceeded";
}else{
    echo" Test mail sent failed";
}
};