<?php

$url= explode('plugin',$_SERVER['SCRIPT_FILENAME']);
require_once dirname($url[0])  . '/wp-load.php';
Class Email{
  static  $email;
  static $messageTags;
    function __construct() {
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
        self::$messageTags['[senderMessage]']=$message;
        self::$messageTags['[senderName]']=self::$email['name'];
        self::$messageTags['[senderEmail]']=self::$email['from'];
         self::$messageTags['[senderSubject]']=self::$email['subject'];
         self::$messageTags['[timeStamp]']=$date->format(' l\, F d\, Y g:ia');
         self::$messageTags['[sentFrom]']=$_SERVER['HTTP_REFERER'];
   $messageWrap=get_option('messageBody');
   foreach(self::$messageTags as $i =>$v){
       $messageWrap=str_replace($i, $v, $messageWrap);
   }
   return $messageWrap;
    }
    
}
