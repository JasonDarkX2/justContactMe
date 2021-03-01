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
      $relayAddress= get_option('fromAddress');
      $relayName= $name;
      array_push($headerIndex,"From:$relayName<" . $relayAddress  . ">\r\n");
      array_push($headerIndex,"Reply-To:<$from>" . "\r\n");
      array_push($headerIndex, "Received:from<$name>" . "\r\n");
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
    function createLogEntry( $isError){
        $date= new DateTime();
        $mailLog=get_option('mailLog');
        $status=($isError==TRUE)  ?  'Send Failed'  : ' Send Success';

            $logEntry[self::$email['from']] = Array(
                'sender' => self::$email['name'],
                'address' => self::$email['from'],
                'status' => $status,
                'attempts' => 1,
                'isError' => $isError,
                'date' => array($date->format('m/d/Y'))
            );

            if (empty($mailLog)) {
                update_option('mailLog', $logEntry);
            }
             elseif(!array_key_exists(self::$email['from'],$mailLog)){
                $mailLog[self::$email['from']]=Array(
                    'sender' => self::$email['name'],
                    'address' => self::$email['from'],
                    'status' => $status,
                    'attempts' => 1,
                    'isError' => $isError,
                    'date' => array($date->format('m/d/Y'))
                );
                update_option('mailLog', $mailLog);

                }
        if(array_key_exists(self::$email['from'],$mailLog)==True){
            //date_add($date, date_interval_create_from_date_string('1 day'));
                if(end($mailLog[self::$email['from']]['date']) == $date->format('m/d/Y')){
                    if($mailLog[self::$email['from']]['status']!=$status){
                        $mailLog[self::$email['from']]['status']=$status;
                        update_option('mailLog', $mailLog);

                    }
                    $mailLog[self::$email['from']]['attempts']++;
                    update_option('mailLog', $mailLog);
                }
                else{
                    $mailLog[self::$email['from']]['attempts']++;
                    array_push($mailLog[self::$email['from']]['date'],$date->format('m/d/Y'));
                    update_option('mailLog', $mailLog);
                }
            }




          $whiteList=get_option('whiteListLog');

          if(!array_key_exists(self::$email['from'], $whiteList)){
              $whiteList[self::$email['from']] = self::$email['name'];
              update_option('whiteListLog',$whiteList);
          }
        return $logEntry;
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
   return stripslashes($messageWrap);
    }

    function blackListCheck($email){
        $ok=true;
        $ok=(array_key_exists($email,get_option('blackListLog')) ? false: true);

        $domain=get_option('blackListDomain');
         foreach( $domain as $d){
             if (preg_match("/$d/",$email)){
                 $ok=false;
                 break;
             }
         }
        return $ok;
    }
    
   }