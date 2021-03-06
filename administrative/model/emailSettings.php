<?php

class EmailSettings
{

    function __construct()
    {

    }
    function setAddress($Address, $setFrom, $fromName="wordpress") {
        if(!empty($fromName)){
            update_option('fromName',$fromName);
        }
        if ($setFrom) {
            if (empty($Address) || $Address == ' ') {
                update_option('fromAddress', 'wordpress');
            } else {
                update_option('fromAddress', $Address);
            }
        } else {
            if (empty($Address) || $Address == ' ') {
                update_option('toAddress', get_option('admin_email'));
            } else {
                update_option('toAddress', $Address);
            }
        }
    }

    function setCopyAddress($type, $address) {
        $header = $type . $address;
        update_option('copyAddress', $header);
    }

    function setAttachment($status) {
        update_option('attachment', $status);
    }

    function setAttachmentOptions($type, $size) {
        update_option('attachmentType', $type);
        update_option('attachmentSize', $size);
    }
    function setMessageBody($message){
        if( empty($message)){
            update_option('messageBody', '[senderMessage]');
        } else{
            update_option('messageBody', $message);
        }
    }

    function getAttachmentInitialMsg() {
        $type = get_option('attachmentType');
        $size = get_option('attachmentSize');
        switch ($type) {
            case 'docs':
                return $fileTypeMsg = 'Attach a Documents(max size: ' . $size . 'MB)';
                break;
            case 'photo':
                return $fileTypeMsg = 'Attach  a Photo(max size: ' . $size . 'MB)';
                break;
            case 'zip':
                return $fileTypeMsg = 'Attach a Zip file(max size: ' . $size . 'MB)';
            case 'none':
                return $fileTypeMsg = 'Attach a File(max size: ' . $size . 'MB)';
                break;
            default:
                return $fileTypeMsg = 'Chose a File(max size: ' . $size . 'MB)';
        }
    }

    function getAttachmentExtension() {
        $type = get_option('attachmentType');
        switch ($type) {
            case 'docs':
                return $extension = "pdf|docx|pptx|doc|txt";
                break;
            case 'photo':
                return $extension = "jpg|jpeg|bmp|gif|png";
                break;
            case 'zip':
                return $extension = "zip";
                break;
            case 'none':
                break;
        }
    }
    function getAttachmentSizeLimit() {
        $size = get_option('attachmentSize');
        switch ($size) {
            case 1:
                return 1048576;
                break;
            case 2:
                return 2097152;
                break;
            case 25:
                return 26214400;
                break;
            case 64:
                return 67108864;
                break;
        }
    }

    function setReCatcha($switch, $keys) {
        if ($switch == 'true') {
            update_option('reCaptchaEnabled', TRUE);
            foreach ($keys as $key => $value) {
                self::setReCaptchaKeys($key, $value);
            }
        } else {
            update_option('reCaptchaEnabled', FALSE);
        }
    }

    function setReCaptchaKeys($keyType, $value) {
        if (get_option('reCaptchaEnabled'))
            update_option($keyType, $value);
    }

    function setReCaptchaAttributes($theme, $type, $size) {
        $config = [
            'theme' => $theme,
            'type' => $type,
            'size' => $size
        ];
        update_option('reCaptchaConfig', $config);

    }



}