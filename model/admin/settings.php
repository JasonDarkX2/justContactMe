<?php

//$url= explode('plugin',$_SERVER['SCRIPT_FILENAME']);
//require_once dirname($url[0])  . '/wp-load.php';
class AdminSettings{
    function __construct() {
        
    }
    function  setCopyAddress($type, $address){
        $header= $type . $address;
        update_option('copyAddress',$header);
    }
     function setAttachment($status){
         update_option('attachment',$status);
     }
     function setAttachmentOptions($type,$size){
         update_option('attachmentType',$type);
         update_option('attachmentSize',$size);
     }
     function getAttachmentInitialMsg(){
         $type=get_option('attachmentType');
         $size= get_option('attachmentSize');
         switch($type){
             case 'docs':
                  return $fileTypeMsg= 'Attach Documents(max size: ' . $size . 'MB)'; 
                 break;
              case 'photo':
                 return $fileTypeMsg= 'Attach  Photo(max size: ' . $size . 'MB)';
                 break;
              case 'zip':
                 return $fileTypeMsg= 'Attach Zip file(max size: ' . $size . 'MB)'; 
             case 'none':
                  return $fileTypeMsg= 'Chose a File(max size: ' .$size .'MB)';
         break;
          default:
          return $fileTypeMsg= 'Chose a File(max size: ' .$size .'MB)';
         }
     }
     function getAttachmentExtension(){
         $type= get_option('attachmentType');
         switch($type){
             case 'docs':
                 return $extension="pdf|docx|pptx|doc|txt"; 
                 break;
             case 'photo':
                 break;
             case 'zip':
                 break;
             case 'none':
                 break;
     }
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