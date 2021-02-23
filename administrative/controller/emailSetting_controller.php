<?php
$url= explode('plugin',$_SERVER['SCRIPT_FILENAME']);
require_once dirname($url[0])  . '/wp-load.php';
if(MY_PLUGIN_PATH !=NULL){
    require_once( MY_PLUGIN_PATH . 'administrative/model/emailSettings.php');
    require_once( MY_PLUGIN_PATH  . 'model/email.php');
}else{
    require_once( $_POST['plugindir'] . 'model/settings.php');
    require_once( $_POST['plugindir'] . 'model/email.php');
}
$EmailSettings= new EmailSettings();
$iserror=FALSE;

If(filter_var($_POST['toAddress'], FILTER_VALIDATE_EMAIL)){
    $EmailSettings->setAddress($_POST['toAddress'],FALSE);
}else{
    echo'<span class="error">Not a valid To Address</span>';
    die();
}

$fromAddress= $_POST['fromAddress'];
$fromName= $_POST['fromName'];
If(filter_var($fromAddress, FILTER_VALIDATE_EMAIL) ||$_SERVER['HTTP_HOST']=='localhost' ){
    $EmailSettings->setAddress($fromAddress,TRUE,$fromName);
}else{
    echo '<span class="error">Not a valid from  Address</span>';
    die();
}

if(isset($_POST['copyAddress'])&& !empty($_POST['copyAddress'])){
    $string= explode(':', $_POST['copyAddress']);
    $copyAction= substr($string[0],0,3) .':';

    if(preg_match("/[BCbc][cC]*:/", $copyAction)==1){
        $EmailSettings->setCopyAddress($copyAction, $string[1]);
    }else{
        echo '<span class="error">Please use proper format for Cc/Bcc address, for exampe: Cc:emailAddress</span>';
        die();
    }
}

if($_POST['attachment']==='true'){
    $EmailSettings->setAttachment(TRUE);
    $EmailSettings->setAttachmentOptions($_POST['fileType'], $_POST['fileSize']);
}else{
    $EmailSettings->setAttachment(FALSE);
}

$EmailSettings->setMessageBody($_POST['messageBody']);

if($iserror==FALSE){
    echo '<span class="successmsg"> Settings Saved</span>';
}