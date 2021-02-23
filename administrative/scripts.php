<?php
function addAdminScripts($hook)
{
    if ($hook != 'settings_page_jcmMenu') {
        return;
    }

    wp_enqueue_style('jcmAdmin-style', plugins_url('_inc/jcmAdmin.css', __FILE__));
    wp_enqueue_script('jcmAdmin-script', plugins_url('_inc/jcmAdmin.js', __FILE__));
    $controllers = array('settingsController' => plugins_url('controller/administrative/settings_controller.php', __FILE__));

    wp_localize_script('jcmAdmin-script', 'controller', $controllers);
    wp_enqueue_script('jcm-validate', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js');
    wp_enqueue_script('jcm-ui','https://code.jquery.com/ui/1.12.1/jquery-ui.js');
    wp_enqueue_style('jcmAdmin-ui','//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
}
function createAdminMenu()
{
    add_options_page('justContactMeSettings', 'Just Contact Me', 'manage_options', 'jcmMenu', 'adminView');
}

function adminView()
{
    include(plugin_dir_path(__FILE__) . '/views/adminPage.php');
}
