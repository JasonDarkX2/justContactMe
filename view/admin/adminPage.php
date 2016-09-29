<h1>SimplyAJAXContacted Settings</h1>
<p id="msg">
<div class="body">
    <form id="sac-options" method="POST" action="<?php echo the_permalink(); ?>"/>
                <label for"reCaptchaEnabled">Enable reCaptcha:</label>
                <input type="checkbox" name="reCaptchaEnabled" value="true" <?php checked($widget['reCaptchaEnabled'], true); ?>/>
                <br/>
                <div id="reCaptchaSetting">
                <label for=""siteKey">Site Key:</label>
                <input type="text" name="siteKey" value="<?php get_option('siteKey') ?>"/>
                <br/>
                <label for="secretKey">Secret Key:</label>
                <input type="text" name="secretKey" value="<?php get_option('secretee3Key') ?>"/>
                </div>
                <input type="submit" value="Save"/>
          </form>
</div>