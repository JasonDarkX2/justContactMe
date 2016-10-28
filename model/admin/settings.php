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
        echo '<span class="successmsg"> Settings Saved</span>';
    }
    
    function setAddress($Address,$setFrom){
        if($setFrom){
                   if(empty($Address)|| $Address==' '){
            update_option('fromAddress', 'wordpress');
        }else{
            update_option('fromAddress', $Address);
        }
        }else{
        if(empty($Address)|| $Address==' '){
            update_option('toAddress', get_option('admin_email'));
        }else{
            update_option('toAddress', $Address);
        }
        }
        
    } 
}