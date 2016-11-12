<?php

$url= explode('plugin',$_SERVER['SCRIPT_FILENAME']);
require_once dirname($url[0])  . '/wp-load.php';
Class Email{
  static  $email;
    function __construct() {
      $email= array('to','from','subject', 'header','message'.'headers');
           
    }
    
    function createEmail($to,$name,$from,$subject,$message, $extraHeaders,$attachments){
        $headerIndex=array();
        self::$email['to']=$to;
      self::$email['from']="From:$name<$from>" . "\r\n";
      array_push($headerIndex,self::$email['from']);
      array_push($headerIndex,"Reply-To:<$from>" . "\r\n");
      array_push($headerIndex, "Recived:from<$name>" . "\r\n");
      self::$email['subject']=$subject;
      self::$email['message']=$message;
      
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
    
}
