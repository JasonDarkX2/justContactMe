<h1>SimplyAJAXContacted Settings</h1>
<p id="msg">
<div class="body">
    <form id="sac-options" method="POST" action="<?php echo plugins_url( 'controller\admin\settings_controller.php',  dirname(dirname(__FILE__))); ?>"/>
                <label for"reCaptchaEnabled">Enable reCaptcha:</label>
                <input type="checkbox" name="reCaptchaEnabled" value="true" <?php checked(get_option('reCaptchaEnabled'), true); ?>/>
                <br/>
                <div id="reCaptchaSetting">
                <label for=""siteKey">Site Key:</label>
                <input type="text" name="siteKey" value="<?php echo  get_option('siteKey'); ?>"/>
                <br/>
                <label for="secretKey">Secret Key:</label>
                <input type="text" name="secretKey" value="<?php echo get_option('secretKey'); ?>"/>
                <p><i>Need Keys</i><div class="toolTip"> <a href="#">[?]</a><span class="toolTipText">placeholder</span></div>
                </p>
                </div>
                <input type="submit" value="Save"/>
          </form>
</div>