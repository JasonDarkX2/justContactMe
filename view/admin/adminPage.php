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
                <?php foreach(get_option('reCaptchaConfig') as $i => $v): ?>
                <?php switch($i){
                case "theme": ?>
                 <label for="theme"> reCaptcha Theme:</label>
                <input type='hidden' name='confId[]' value="<?php echo $i; ?>"  id="configId"> 
                <input name="<?php echo $i; ?>" type="radio" value="light" <?php checked($v, 'light');?>>Light
                    <input  name="<?php echo $i; ?>" type="radio" value="dark" <?php  checked($v, 'dark');?> >Dark
                    <br/>
                    <?php
                    break;
                case 'type':?>
                    <label for="theme"> reCaptcha Type:</label>
                <input type='hidden' name='confId[]' value="<?php echo $i; ?>"  id="configId"> 
                    <input name="<?php echo $i; ?>" type="radio" value="image" <?php  checked($v, 'image');?>>Image
                    <input  name="<?php echo $i; ?>" type="radio" value="audio" <?php  checked($v, 'audio');?>>Audio
                    <br/>
                <?php break;
                case "size":?>
                <label for="theme"> reCaptcha Size:</label>
                <input type='hidden' name='confId[]' value="<?php echo $i; ?>"  id="configId"> 
                    <input name="<?php echo $i; ?>" type="radio" value="normal"<?php  checked($v, 'normal');?> >Normal
                    <input  name="<?php echo $i; ?>" type="radio" value="compact" <?php  checked($v, 'compact');?>>Compact
                    <br/>
                    <?php break;
                }
                ?>
                    <?php endforeach;?>
                </div>
                  
                <input type="submit" value="Save"/>
          </form>
</div>