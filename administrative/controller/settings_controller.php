<?php
$url= explode('plugin',$_SERVER['SCRIPT_FILENAME']);
require_once dirname($url[0])  . '/wp-load.php';
if(MY_PLUGIN_PATH !=NULL){
require_once( MY_PLUGIN_PATH . 'administrative/model/settings.php');
require_once( MY_PLUGIN_PATH  . 'model/email.php');
}else{
    require_once( $_POST['plugindir'] . 'model/settings.php');
    require_once( $_POST['plugindir'] . 'model/email.php');
}
$AdminSettings= new AdminSettings();
$iserror=FALSE;
if(isset($_GET['sendTest']) || isset($_GET['attachTest'])){
    $mail= new Email();

$to=get_option('toAddress');
$name ="Test Mail";
$email = get_option('admin_email');
$message = "Simply a Test mail";
$subject="Test  mail from jcm Plugin" ;
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
}


