<?php
/*
  Plugin Name: Just Contact Me
  Plugin URI: http://www.jasondarkx2.com
  Description: Simply an AJAX Contact form plugin
  Author:JasonDarkX2
  version: x.xx
  Author URI:http://www.jasondarkx2.com
 */

require_once( plugin_dir_path(__FILE__) . 'administrative/model/settings.php');
require_once( plugin_dir_path(__FILE__) . '/administrative/scripts.php');
define('MY_PLUGIN_PATH',plugin_dir_path(__FILE__) );
define('messageTags',array(
    '[senderMessage]',
    '[senderName]',
    '[senderEmail]',
    '[senderSubject]',
    '[timeStamp]',
    '[sentFrom]',
));
class JustContactMe
{
    function init()
    {

        //register our settings
        register_setting('jcm-setting', 'reCaptchaEnabled');
        register_setting('jcm-setting', 'secretKey');
        register_setting('jcm-setting', 'siteKey');
        register_setting('jcm-sertting', 'reCaptchaConfig');
        register_setting('jcm-setting', 'toAddress');
        register_setting('jcm-setting', 'fromAddress');
        register_setting('jcm-setting', ' ccbc-addresses');
        register_setting('jcm-setting', ' attachment');
        register_setting('jcm-setting', ' attachmentType');
        register_setting('jcm-setting', ' attachmentSize');
        register_setting('jcm-setting', 'formTheme');
        register_setting('jcm-setting', 'formName');
        register_setting('jcm-setting', 'customCSS');
        register_setting('jcm-setting', 'messageBody');
        register_setting('jcm-setting', 'whiteListLog');
        register_setting('jcm-setting', 'blackListLog');
        register_setting('jcm-setting', 'blackListMessage');
        register_setting('jcm-setting', 'mailLog');
        register_setting('jcm-setting', 'errorLog');
        $bodymsg = get_option('messageBody');

        //setting initial config setting for first launch of plugin
        $config = [
            'theme' => 'light',
            'type' => 'image',
            'size' => 'normal'
        ];
        $con = get_option('reCaptchaConfig');
        if (empty($con) == TRUE) {
            update_option('reCaptchaConfig', $config);
        }
        $to = get_option('toAddress');
        $from = get_option('FromAddress');
        if (empty($to) && empty($from)) {
            update_option('toAddress', get_option('admin_email'));
            update_option('fromAddress', 'wordpress');
        }
        $newLog= Array();

        if(empty(get_option('whiteListLog'))){
            update_option('whiteListLog',$newLog);
        }
        if(empty(get_option('blackListLog'))){
            update_option('blackListLog',$newLog);
        }
        if(empty(get_option('errorLog'))){
            update_option('errorLog',$newLog);
        }
        if(empty(get_option('mailLog'))){
            update_option('mailLog',$newLog);
        }

        add_action('admin_menu', 'createAdminMenu');
        add_shortcode('JustContactMe', 'contactFormView');
        if (is_admin()) {
            add_action('admin_enqueue_scripts', 'addAdminScripts');
        }

    }

}
function addFrontEndScripts()
{
    $controllers = array('emailController' => plugins_url('controller/email_controller.php', __FILE__),
        'extensions' => get_option('attachmentType'),
        'sizeLimit' => get_option('attachmentSize'));

    wp_enqueue_script('jcm-js', plugins_url('_inc/min/justContactMe.min.js', __FILE__));
    wp_localize_script('jcm-js', 'controller', $controllers);
    wp_enqueue_script('jcm-validate', plugins_url('_inc/jqueryValidate/jquery.validate.min.js', __FILE__));
    wp_enqueue_style('jcmAdmin-css', plugins_url('_inc/min/justContactMe.min.css', __FILE__));
}

    function contactFormView()
    {
        add_action('wp_head', 'recaptchaScript');
        add_action('wp_footer','addFrontEndScripts');
        ob_start();
        include(plugin_dir_path(__FILE__) . '/view/contactForm.php');
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }


(new JustContactMe)->init();