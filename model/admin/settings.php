<?php

$url= explode('plugin',$_SERVER['SCRIPT_FILENAME']);
require_once dirname($url[0])  . '/wp-load.php';
class AdminSettings{
    function __construct() {
        
    }
    function setReCatcha($switch, $keys){
        if($switch=='true'){
            update_option('reCaptchaEnabled',TRUE);
            foreach($keys as $key=> $value){
                self::setReCaptchaKeys($key,$value);
            }
            
        }else{
            update_option('reCaptchaEnabled',FALSE);
        }
        
    }
    function setReCaptchaKeys($keyType, $value){
        if(get_option('reCaptchaEnabled'))
        update_option($keyType, $value); 
    }
    function setReCaptchaAttributes($theme, $type, $size){
        $config= [
            'theme' => $theme,
         'type'=> $type,
            'size' =>$size
            
        ];
        update_option('reCaptchaConfig', $config);
        echo "saved";
    } 
}