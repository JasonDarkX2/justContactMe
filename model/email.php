<?php

$url= explode('plugin',$_SERVER['SCRIPT_FILENAME']);
require_once dirname($url[0])  . '/wp-load.php';
Class Email{
  static  $email;
    function __construct() {
      $email= array('to','from','name','subject', 'header','message'.'headers');
           
    }
    
    function createEmail($to,$name,$from,$subject,$message, $extraHeaders,$attachments=NULL){
        $headerIndex=array();
         self::$email['name']=$name;
        self::$email['to']=$to;
      self::$email['from']=$from;
      array_push($headerIndex,"From:$name<" . self::$email['from']  . ">\r\n");
      array_push($headerIndex,"Reply-To:<$from>" . "\r\n");
      array_push($headerIndex, "Recived:from<$name>" . "\r\n");
      self::$email['subject']=$subject;
      self::$email['message']=self::messageParser($message);
      
      if(COUNT($extraHeaders)>0){
      foreach($extraHeaders as $x){
          array_push($headerIndex, $x);
      }
      }
      self::$email['headers']=$headerIndex;
      self::$email['attachments']=$attachments;
    }
    
    function sendmail(){
        
        $status=wp_mail( self::$email['to'], self::$email['subject'], self::$email['message'], self::$email['headers'], self::$email['attachments'] );
        
    return $status;
        
    }
    function messageParser($message){
        $date= new DateTime();
   $messageTags=array('[senderMessage]' =>$message,
                                      '[senderName]'=>self::$email['name'],
                                       '[senderEmail]'=>self::$email['from'],
                                        '[senderSubject]'=>self::$email['subject'],
                                        '[timeStamp]' => $date->format(' l\, F d\, Y g:ia'),
                                        '[sentFrom]' => $_SERVER['HTTP_REFERER']
                            );
   $messageWrap=get_option('messageBody');
   foreach($messageTags as $i =>$v){
       $messageWrap=str_replace($i, $v, $messageWrap);
   }
   return $messageWrap;
    }
    
}
