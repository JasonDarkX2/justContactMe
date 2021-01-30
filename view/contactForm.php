<div id="contactSection" class="<?php echo get_option('formTheme'); ?>">
    <form  id="contactForm" method="post" action="<?php echo the_permalink(); ?>">
<label class="field"><span class="noti">*</span>Name:</label><input type="text"  name="cname" class="ifield" maxlength="75"  /><br/>
<label class="field"><span class="noti">*</span>E-mail:</label><input type="text"  name="email" class="ifield" maxlength="75" /><br/>
<label id="field"><span class="noti">*</span>Subject:</label><input type="text" name="subject" class="ifield" maxlength="75" /><br/>
<?php if(get_option('attachment')): ?>
<label class="field">Attachment:</label>
 <input id="jcmAttachment" type = "text" name="mailAttachment" value=""  placeholder="<?php echo  inimsg; ?>" class="ifield" >
<?php endif;?>

<label class="field"><span class="noti">*</span>Message:</label>
<br/><textarea id="message" class="ifield" name="message" rows="15" cols="250"></textarea>
<div id="success" ><span class="noti">*</span><span>Required fields</span> </div>
    <?php if(get_option('attachment')): ?>
<input id = "file" type="file"  style="display:none;" name="mailAttachment" onchange="ChangeText(this, '#jcmAttachment');"/>
<?php endif;?>

    <?php if(get_option('reCaptchaEnabled')==TRUE): ?>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <div class="g-recaptcha" data-sitekey="<?php echo get_option('siteKey'); ?>"
         <?php $config=  get_option('reCaptchaConfig');
                    foreach($config as $i =>$v){
                        echo " data-$i=$v ";
                    }
         ?>
         ></div>
<?php endif;?>
<span class="sbuttons">
    <input type="submit" id="submit" value="Send Message"/>
<input type="reset" id="clear" value="clear"/>
</span>
</form>
    
</div>
        