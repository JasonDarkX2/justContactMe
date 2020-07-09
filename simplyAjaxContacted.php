<?php
/*
  Plugin Name: Simply AJAX Contacted
  Plugin URI: http://www.jasondarkx2.com
  Description: Simply an AJAX Contact form
  Author:JasonDarkX2
  version: x.xx
  Author URI:http://www.jasondarkx2.com
 */
?>
<?php
require_once( plugin_dir_path(__FILE__) . 'model/admin/settings.php');
class SimplyAjaxContacted {

    static $settings;
    static $messageTags;
    function init() {
        self::$settings = new AdminSettings();
       self::$messageTags=array('[senderMessage]', '[senderName]','[senderEmail]','[senderSubject]','[timeStamp]','[sentFrom]');
        add_shortcode('AjaxContactForm', array($this, 'contactFormView'));
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
        register_setting('sac-setting', 'reCaptchaEnabled');
        register_setting('sac-setting', 'secretKey');
        register_setting('sac-setting', 'siteKey');
        register_setting('sac-sertting', 'reCaptchaConfig');
        register_setting('sac-setting', 'toAddress');
        register_setting('sac-setting', 'fromAddress');
        register_setting('sac-setting', ' ccbc-addresses');
        register_setting('sac-setting', ' attachment');
        register_setting('sac-setting', ' attachmentType');
        register_setting('sac-setting', ' attachmentSize');
        register_setting('sac-setting', 'formTheme');
         register_setting('sac-setting', 'formName');
        register_setting('sac-setting', 'customCSS');
          register_setting('sac-setting', 'messageBody');
           register_setting('sac-setting', 'whiteListLog');
           register_setting('sac-setting', 'blackListLog');
           register_setting('sac-setting', 'mailLog');
           register_setting('sac-setting', 'errorLog');
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
        add_options_page('SimplyAjaxContacted Settings', 'SimplyAjaxContacted', 'manage_options', 'sacMenu', array(__CLASS__, 'adminView'));
        //call register settings function
        add_action('admin_init', array(__CLASS__, 'registerSettings'));
    }

    static function add_scripts($hook) {
        wp_enqueue_style('sac-style', plugins_url('_inc/SimplyAjaxContacted.css', __FILE__));
        SimplyAjaxContacted::addValidateScripts();
        $controllers = array('emailController' => plugins_url('controller/email_controller.php', __FILE__),
            'extensions' => fileExtension,
            'sizeLimit' =>attachmentSizeLimit);
        wp_enqueue_script('sac-script', plugins_url('_inc/SimplyAjaxContacted.js', __FILE__));
        wp_localize_script('sac-script', 'controller', $controllers);
    }

    static function addMinifiedScripts($hook) {
        wp_enqueue_style('sac-style', plugins_url('_inc/min/simplyAjaxContacted.min.css', __FILE__));

        SimplyAjaxContacted::addValidateScripts();
        $controllers = array('emailController' => plugins_url('controller/email_controller.php', __FILE__),
            'extensions' => fileExtension,
            'sizeLimit' => attachmentSizeLimit);
        wp_enqueue_script('sac-script', plugins_url('_inc/min/SimplyAjaxContacted.min.js', __FILE__));
        wp_localize_script('sac-script', 'controller', $controllers);
    }

    static function addAdminScripts($hook) {
        if ($hook != 'settings_page_sacMenu') {
            return;
        }
        wp_enqueue_style('sac-style', plugins_url('_inc/SimplyAjaxContacted.css', __FILE__));
        wp_enqueue_style('sacAdmin-style', plugins_url('_inc/admin/sacAdmin.css', __FILE__));
        $controllers = array('settingsController' => plugins_url('controller/admin/settings_controller.php', __FILE__));
        wp_enqueue_script('sacAdmin-script', plugins_url('_inc/admin/sacAdmin.js', __FILE__));
        wp_localize_script('sacAdmin-script', 'controller', $controllers);
        wp_enqueue_script('sac-validate', plugins_url('_inc/jqueryValidate/jquery.validate.min.js',__FILE__));
    }

     static  function addValidateScripts(){
        $handle = 'jquery.validate.min.js';
        $list = 'enqueued';
        if (wp_script_is( $handle, $list )) {
            return;
        } else {
            wp_enqueue_script('sac-validate', plugins_url('_inc/jqueryValidate/jquery.validate.min.js',__FILE__));
            wp_enqueue_script('sac-validatex', plugins_url('_inc/jqueryValidate/additional-methods.min.js',__FILE__));
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
(new SimplyAjaxContacted)->init();
