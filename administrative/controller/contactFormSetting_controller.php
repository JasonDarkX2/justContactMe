<?php
$url= explode('plugin',$_SERVER['SCRIPT_FILENAME']);
require_once dirname($url[0])  . '/wp-load.php';
if(MY_PLUGIN_PATH !=NULL) {
    require_once(MY_PLUGIN_PATH . 'administrative/model/contactForm.php');
}else {
    require_once($_POST['plugindir'] . 'model/contactForm.php');
}
    $EmailSettings = new ContactFormSettings();
    $iserror = FALSE;


if(isset($_POST['formTheme'])){
     $EmailSettings->setTheme($_POST['formTheme']);
}
$customCSS=$_POST['customCSS'];
if(isset($customCSS)&&!ctype_space($customCSS)){
    if(strcmp($customCSS,get_option('customCss'))!==0)
         $EmailSettings->setCustomCSS($customCSS);
}else{
    $css= get_option('customCss');
    if(!empty($css))
         $EmailSettings->setCustomCss(NULL);
}
if($iserror==FALSE){
    echo '<span class="successmsg"> Settings Saved</span>';
}
else{
    echo '<span class="error blink"> An Error has occurred</span>';
}