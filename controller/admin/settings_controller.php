<?php
$url= explode('plugin',$_SERVER['SCRIPT_FILENAME']);
require_once dirname($url[0])  . '/wp-load.php';
require_once(MY_PLUGIN_PATH . 'model/admin/settings.php');
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