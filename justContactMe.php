<?php
/*
  Plugin Name: Just Contact Me
  Plugin URI: http://www.jasondarkx2.com
  Description: Simply an AJAX Contact form plugin
  Author:JasonDarkX2
  version: x.xx
  Author URI:http://www.jasondarkx2.com
 */
?>
<?php
require_once( plugin_dir_path(__FILE__) . 'model/admin/settings.php');
class JustContactMe{

    static $settings;
    static $messageTags;
    function init() {
        self::$settings = new AdminSettings();
       self::$messageTags=array('[senderMessage]', '[senderName]','[senderEmail]','[senderSubject]','[timeStamp]','[sentFrom]');
        add_shortcode('ContactForm', array($this, 'contactFormView'));
        add_action('admin_menu', array(__CLASS__, 'createAdminMenu'));
        define('MY_PLUGIN_PATH', plugin_dir_path(__FILE__));
        define('attachmentSizeLimit',self::$settings->getAttachmentSizeLimit());
        define('fileExtension',self::$settings->getAttachmentExtension());
        if(is_admin()) {
            add_action('admin_enqueue_scripts', array(__CLASS__, 'addAdminScripts'));
        }
               if ($from = get_option('fromAddress') != NULL) {
                  add_filter( 'wp_mail_from', function( $email ) {
	return get_option('fromAddress');
});
        }
        $fromName =get_option('formName');
        if($fromName!=NULL){
                add_filter('wp_mail_from_name',$fromName);
        }
    }

    static function registerSettings() {
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
           register_setting('jcm-setting', 'mailLog');
           register_setting('jcm-setting', 'errorLog');
          $bodymsg=get_option('messageBody');
          if(empty($bodymsg)){
              update_option('messageBody','[senderMessage]');
          }
           
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
         array_pop($newLog);
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
    }

    static function createAdminMenu() {
        add_options_page('justContactMeSettings', 'Just Contact Me', 'manage_options', 'jcmMenu', array(__CLASS__, 'adminView'));
        //call register settings function
        add_action('admin_init', array(__CLASS__, 'registerSettings'));
    }

    static function add_scripts($hook) {
        wp_enqueue_style('jcm-style', plugins_url('_inc/justContactMe.css', __FILE__));
        SimplyAjaxContacted::addValidateScripts();
        $controllers = array('emailController' => plugins_url('controller/email_controller.php', __FILE__),
            'extensions' => fileExtension,
            'sizeLimit' =>attachmentSizeLimit);
        wp_enqueue_script('jcm-script', plugins_url('_inc/aimplyAjaxContacted.js', __FILE__));
        wp_localize_script('jcm-script', 'controller', $controllers);
    }

    static function addMinifiedScripts($hook) {
        wp_enqueue_style('jcm-style', plugins_url('_inc/min/simplyAjaxContacted.min.css', __FILE__));

        SimplyAjaxContacted::addValidateScripts();
        $controllers = array('emailController' => plugins_url('controller/email_controller.php', __FILE__),
            'extensions' => fileExtension,
            'sizeLimit' => attachmentSizeLimit);
        wp_enqueue_script('jcm-script', plugins_url('_inc/min/simplyAjaxContacted.min.js', __FILE__));
        wp_localize_script('jcm-script', 'controller', $controllers);
    }

    static function addAdminScripts($hook) {
        if ($hook != 'settings_page_jcmMenu') {
            return;
        }
        wp_enqueue_style('jcm-style', plugins_url('_inc/justContactMe.css', __FILE__));
        wp_enqueue_style('jcmAdmin-style', plugins_url('_inc/admin/jcmAdmin.css', __FILE__));
        $controllers = array('settingsController' => plugins_url('controller/admin/settings_controller.php', __FILE__));
        wp_enqueue_script('jcmAdmin-script', plugins_url('_inc/admin/jcmAdmin.js', __FILE__));
        wp_localize_script('jcmAdmin-script', 'controller', $controllers);
        wp_enqueue_script('jcm-validate', plugins_url('_inc/jqueryValidate/jquery.validate.min.js',__FILE__));
    }

     static  function addValidateScripts(){
        $handle = 'jquery.validate.min.js';
        $list = 'enqueued';
        if (wp_script_is( $handle, $list )) {
            return;
        } else {
            wp_enqueue_script('jcm-validate', plugins_url('_inc/jqueryValidate/jquery.validate.min.js',__FILE__));
            wp_enqueue_script('jcm-validatex', plugins_url('_inc/jqueryValidate/additional-methods.min.js',__FILE__));
        }

    }

    function adminView() {
        Define('inimsg', self::$settings->getAttachmentInitialMsg());
        include (plugin_dir_path(__FILE__) . 'view/admin/adminPage.php');
    }

    function contactFormView() {
        Define('inimsg', self::$settings->getAttachmentInitialMsg());
        add_action('wp_head', 'recaptchaScript');
        add_action('wp_footer', array(__CLASS__, 'addMinifiedScripts'));
        ob_start();
        include (plugin_dir_path(__FILE__) . '/view/contactForm.php');
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

}
(new JustContactMe)->init();
