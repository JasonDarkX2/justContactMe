<div id="contactSection" class="<?php echo get_option('formTheme'); ?>-theme">
    <form  id="contactForm" method="post" action="<?php echo the_permalink(); ?>">
<label class="field"><span class="noti">*</span>Name:</label><input type="text"  name="cname" class="ifield" maxlength="75"  /><br/>
<label class="field"><span class="noti">*</span>E-mail:</label><input type="text"  name="email" class="ifield" maxlength="75" /><br/>
<label id="field"><span class="noti">*</span>Subject:</label><input type="text" name="subject" class="ifield" maxlength="75" /><br/>
<?php if(get_option('attachment')): ?>
<label class="field">Attachment:</label>
 <input id="sacAttachment" type = "text" name="mailAttachment"  value="<?php echo  inimsg; ?>" class="ifield" >
<?php endif;?>

<label class="field"><span class="noti">*</span>Message:</label>
<br/><textarea id="message" class="ifield" name="message" rows="15" cols="250"></textarea>
<div id="success" ><span class="noti">*</span><span style="color:white">Required fields</span> </div>
    <?php if(get_option('attachment')): ?>
<input id = "file" type="file"  style="display:none;" name="mailAttachment" onchange="ChangeText(this, '#sacAttachment');"/>
<?php endif;?>
<span class="sbuttons">
    <?php if(get_option('reCaptchaEnabled')==TRUE): ?>
    <div class="g-recaptcha" data-sitekey="<?php echo get_option('siteKey'); ?>"
         <?php $config=  get_option('reCaptchaConfig');
                    foreach($config as $i =>$v){
                        echo " data-$i=$v ";
                    }
         ?>
         ></div>
<?php endif;?>
    <input type="submit" id="submit" value="Send Message"/>
<input type="reset" id="clear" value="clear"/>
</span>
</form>
    
</div>
        