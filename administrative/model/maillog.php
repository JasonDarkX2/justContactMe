<?php

function clearMailLog(){
    $newLog= Array();
    update_option('mailLog',$newLog);
}

function clearSenderLog(){
    $newLog= Array();
    update_option('whiteListLog',$newLog);
}

function clearBlackList(){
    $newLog= Array();
    update_option('blackListLog',$newLog);
}


function setWhiteListContact($list){
    if (!empty($list)) {
        $whiteList = array();
        foreach ($list as $contact) {
            $result = preg_split("~:~", $contact);
            $whiteList[$result[1]] = $result[0];
            update_option('whiteListLog', $whiteList);

        }
    }
    else{
        update_option('whiteListLog', $list);
    }
}

function setBlackListContact($list) {

    if (!empty($list)) {
        $blackList = array();
        foreach ($list as $contact) {
            $result = preg_split("~:~", $contact);
            $blackList[$result[1]] = $result[0];
            update_option('blackListLog', $blackList);

        }
    }
    else{
        update_option('blackListLog', $list);

    }
}

function setDomainBlackList($list){
    update_option('blackListDomain', $list);
}

function setBlackListMsg($message){
    update_option('blackListMessage', $message);
}