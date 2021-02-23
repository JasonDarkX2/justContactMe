<?php
$url= explode('plugin',$_SERVER['SCRIPT_FILENAME']);
require_once dirname($url[0])  . '/wp-load.php';
require_once( MY_PLUGIN_PATH . 'administrative/model/maillog.php');

$isError=FALSE;
if(isset($_GET['clearMailLog'])){
    clearMailLog();
    echo"Log cleared";
}

if(isset($_GET['clearSenderLog'])){
    clearSenderLog();
    echo"Sender List cleared";
}

if(isset($_GET['clearBlacklist'])){
    clearBlacklist();
    echo"blacklist cleared";
}

if(isset($_POST['whitelist']) || isset($_POST['blacklist'])){
if(!isset($_POST['whitelist'])){
    setWhiteListContact(array());
}else {
    setWhiteListContact($_POST['whitelist']);
}
    if(!isset($_POST['blacklist'])){
        setBlackListContact(array());
    }else {
            setBlackListContact($_POST['blacklist']);
    }
    }

if(isset($_POST['blacklistDom'])){
    setDomainBlackList($_POST['blacklistDom']);
}else{
    setDomainBlackList(array());
}

if(isset($_POST['blackListMsg'])){
    setBlackListMsg($_POST['blackListMsg']);
}


if($isError==FALSE){
    echo '<span class="successmsg"> Settings Saved</span>';
}
else{
    echo '<span class="error blink"> An Error has occurred</span>';
}