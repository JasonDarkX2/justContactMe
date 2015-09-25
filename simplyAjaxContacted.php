<?php
/*
Plugin Name: Simply AJAX Contacted
Plugin URI: http://www.jasondarkx2.com
Description: Simply an AJAX Contact form 
Author:JasonDarkX2
version: x.xx
Author URI:http://www.jasondarkx2.com 
*/ 


class SimplyAjaxContacted{
    function init(){  
        add_shortcode('AjaxContactForm',array(__CLASS__,'contactView'));
    }
    static  function add_scripts($hook){
         wp_enqueue_style('sac-style', plugins_url('_inc/SimplyAjaxContacted.css', __FILE__));
         wp_enqueue_script('sac-script', plugins_url('_inc/SimplyAjaxContacted.js', __FILE__), array('jquery'));
         wp_enqueue_script('sac-script', 'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js', array('jquery'));
    }
    

    
     function contactView(){
      add_action('wp_footer', array(__CLASS__, 'add_scripts'));
ob_start();
     include (plugin_dir_path(__FILE__) .'/view/contactForm.php');
     $output=ob_get_contents();;
     ob_end_clean();
     return $output;
 }
}
 add_action( 'wp_loaded',SimplyAjaxContacted::init());

