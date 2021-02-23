<?php

class AdminSettings {

    function __construct() {
        
    }







function getFormPreview(){
    ob_start();
       include (plugin_dir_path(dirname(dirname(__FILE__))) . 'view/contactForm.php');
       $output = ob_get_contents();
        ob_end_clean();
       echo strip_tags($output,'<label><br><input><span><textarea><div>');
}
    




}