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

if($_GET['sendTest']=="True" || $_GET['attachTest']=="True"){
    $mail= new Email();

$to=get_option('admin_email');
$name ="Test Mail";
$email = get_option('admin_email');
$message = "Simply a Test mail";
$subject="Test  mail from SAC Plugin" ;
$headers=array('placeholder');
$attachments=NULL;
if( isset($_GET['attachTest'])){
    $file=plugin_dir_path( __FILE__ ) .'testfile/testfile.txt';
    $attachments=array($file);
}
$mail->createEmail($to,$name,$email,$subject,$message, $headers,$attachments);
if($mail->sendmail()){
    if(isset($attachments)){
         echo'<span class="successmsg"> Attachment test mail sent suceeded</span>';
    }else{
    echo'<span class="successmsg">test mail sent suceeded</span>';
    }
}else{
    $iserror=TRUE;
    echo '<span class="error">test mail sent failed</span>';
    $log=$mail->createLogEntry(true);
}
}else{

If(filter_var($_POST['toAddress'], FILTER_VALIDATE_EMAIL)){
    $AdminSettings->setAddress($_POST['toAddress'],FALSE);
}else{
    echo'<span class="error">Not a valid To Address</span>';
    die();
}

$fromAddress= $_POST['fromAddress'];
$fromName= $_POST['fromName'];
If(filter_var($fromAddress, FILTER_VALIDATE_EMAIL) ||$_SERVER['HTTP_HOST']=='localhost' ){
 $AdminSettings->setAddress($fromAddress,TRUE,$fromName);  
}else{
        echo '<span class="error">Not a valid from  Address</span>';
    die();
}

if(isset($_POST['copyAddress'])&& !empty($_POST['copyAddress'])){
   $string= explode(':', $_POST['copyAddress']);
   $copyAction= substr($string[0],0,3) .':';

   if(preg_match("/[BCbc][cC]*:/", $copyAction)==1){ 
       $AdminSettings->setCopyAddress($copyAction, $string[1]);
   }else{
       echo '<span class="error">Please use proper format for Cc/Bcc address, for exampe: Cc:emailAddress</span>';  
       die();
   }
}
 
   if(isset($_POST['formTheme'])){
       $AdminSettings->setTheme($_POST['formTheme']);
   }
   $customCSS=$_POST['customCSS'];
   if(isset($customCSS)&&!ctype_space($customCSS)){
       if(strcmp($customCSS,get_option('customCss'))!==0)
            $AdminSettings->setCustomCSS($customCSS);
   }else{
       $css= get_option('customCss');
       if(!empty($css))
    $AdminSettings->setCustomCss(NULL);   
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
$AdminSettings->setMessageBody($_POST['messageBody']);
}

if(isset($_POST['whitelist']) || isset($_POST['blacklist'])){
    $AdminSettings->setWhiteListContact($_POST['whiteList']);
    $AdminSettings->setBlackListContact($_POST['blacklist']);
}

if($iserror==FALSE){
    echo '<span class="successmsg"> Settings Saved</span>';
}