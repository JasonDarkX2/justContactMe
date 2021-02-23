<?php
$url= explode('plugin',$_SERVER['SCRIPT_FILENAME']);
require_once dirname($url[0])  . '/wp-load.php';
$iserror=FALSE;
if(MY_PLUGIN_PATH !=NULL){
    require_once( MY_PLUGIN_PATH . 'administrative/model/emailSettings.php');
    require_once( MY_PLUGIN_PATH  . 'model/email.php');
}else{
    require_once( $_POST['plugindir'] . 'model/settings.php');
    require_once( $_POST['plugindir'] . 'model/email.php');
}
$EmailSettings= new EmailSettings();
if(isset($_POST['reCaptchaEnabled'])&& $_POST['reCaptchaEnabled']=='true'){
    $keys=[
        "siteKey" => $_POST['siteKey'],
        "secretKey" => $_POST['secretKey']
    ];
    $EmailSettings->setReCatcha(TRUE, $keys);
}  else {
    $EmailSettings->setReCatcha(FALSE,NULL);
}
    $theme=( isset($_POST['theme']) ) ? $_POST['theme'] : ' ' ;
    $type=( isset($_POST['type']) ) ? $_POST['type'] : '';
    $size= ( isset($_POST['size']) ) ? $_POST['size'] :' ';
    $EmailSettings->setReCaptchaAttributes($theme, $type, $size);

if($iserror==FALSE){
    echo '<span class="successmsg"> Settings Saved</span>';
}