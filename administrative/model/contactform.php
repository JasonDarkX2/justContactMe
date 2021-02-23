<?php


 class ContactFormSettings{
     function __construct()
     {

     }
     function setTheme($theme) {
         update_option('formTheme', $theme);
     }

     function setCustomCSS($CSS) {
         $CSSFile = plugin_dir_path(dirname(dirname(__FILE__))) . '_inc/justContactMe.css';
         $fileContent = file_get_contents($CSSFile);
         $CSS=stripslashes($CSS);
         $content = "\r\n/*CustomCSS*/\r\n" . $CSS . "\r\n/*end CustomCSS*/";
         $fileContent = preg_replace("/\/\*CustomCSS\*\/(.*)end CustomCSS\*\//s", ' ', $fileContent) . $content;
         file_put_contents($CSSFile, $fileContent);
         update_option('customCss', $CSS);
     }

 }