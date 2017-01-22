<h1>Recaptcha Settings</h1>
            <label for"reCaptchaEnabled">Enable reCaptcha:</label>
            <input type="checkbox" name="reCaptchaEnabled" value="true" <?php checked(get_option('reCaptchaEnabled'), true); ?>/>
            <br/>
            <label for=""siteKey">Site Key:</label>
            <input type="text" name="siteKey" value="<?php echo get_option('siteKey'); ?>" <?php echo (get_option('reCaptchaEnabled')==true)  ? '': 'disabled';  ?> />
            <br/>
            <label for="secretKey">Secret Key:</label>
            <input type="text" name="secretKey" value="<?php echo get_option('secretKey'); ?>" <?php echo (get_option('reCaptchaEnabled')==true)  ? '': 'disabled';  ?>/>
            <label><i>Need Keys<div class="toolTip">[?]<span class="toolTipText"> To get your <b>site</b> and <b>secret</b> keys head over to 
                            <a href="https://www.google.com/recaptcha/">https://www.google.com/recaptcha/admin</a></span></div>
            </i>
            </label>
            <br/>
            <div  id="recatphaConfig">
            <?php foreach (get_option('reCaptchaConfig') as $i => $v): ?>
                <?php switch ($i) {
                    case "theme":
                        ?>
                        <label for="theme"> reCaptcha Theme<div class="toolTip">
                [?]<span class="toolTipText">The color theme of the widget.</span>
            </div>:</label>
                        <input type='hidden' name='confId[]' value="<?php echo $i; ?>"  id="configId"> 
                        <input name="<?php echo $i; ?>" type="radio" value="light" <?php checked($v, 'light'); ?>
                            <?php echo (get_option('reCaptchaEnabled')==true)  ? '': 'disabled';  ?>>Light
                        <input  name="<?php echo $i; ?>" type="radio" value="dark" <?php checked($v, 'dark'); ?>
                                <?php echo (get_option('reCaptchaEnabled')==true)  ? '': 'disabled';  ?>>Dark
                        <br/>
                        <?php
                        break;
                    case 'type':
                        ?>
                        <label for="theme"> reCaptcha Type<div class="toolTip">
                [?]<span class="toolTipText"> The type of CAPTCHA to serve..</span>
            </div>:</label>
                        <input type='hidden' name='confId[]' value="<?php echo $i; ?>"  id="configId"> 
                        <input name="<?php echo $i; ?>" type="radio" value="image" <?php checked($v, 'image'); ?>
                               <?php echo (get_option('reCaptchaEnabled')==true)  ? '': 'disabled';  ?>>Image
                        <input  name="<?php echo $i; ?>" type="radio" value="audio" <?php checked($v, 'audio'); ?>
                                <?php echo (get_option('reCaptchaEnabled')==true)  ? '': 'disabled';  ?>>Audio
                        <br/>
            <?php break;
        case "size":
            ?>
                        <label for="theme"> reCaptcha Size<div class="toolTip">
                [?]<span class="toolTipText"> The size of the widget.</span>
            </div>:</label>
                        <input type='hidden' name='confId[]' value="<?php echo $i; ?>"  id="configId"> 
                        <input name="<?php echo $i; ?>" type="radio" value="normal"<?php checked($v, 'normal'); ?>
                               <?php echo (get_option('reCaptchaEnabled')==true)  ? '': 'disabled';  ?>>Normal
                        <input  name="<?php echo $i; ?>" type="radio" value="compact" <?php checked($v, 'compact'); ?>
                                <?php echo (get_option('reCaptchaEnabled')==true)  ? '': 'disabled';  ?>>Compact
                        <br/>
                        <?php
                        break;
                }
                ?>
<?php endforeach; ?>
            </div>