<div id="contactForm">
    <form  id="msg" name="msg" method="post" action="<?php echo the_permalink(); ?>">
<label class="field"><span class="noti">*</span>Name:</label><input type="text" id="cname" name="cname" maxlength="75"  /><br/>
<label class="field"><span class="noti">*</span>E-mail:</label><input type="text" id="email" name="email" maxlength="75" /><br/>
<label id="field"><span class="noti">*</span>Subject:</label><input type="text" id="subject" name="subject" maxlength="75" /><br/>
<span class="noti">*</span>Message:
<br/><textarea id="message" name="message" rows="15" cols="70"></textarea>
<br/>
<label id="success" class="error">*<span style="color:white">Required fields</span> </label>
<br/>
<span class="sbuttons">
    <?php if(get_option('reCaptchaEnabled')==TRUE): ?>
    <div class="g-recaptcha" data-sitekey="<?php echo get_option('siteKey'); ?>"></div>
<?php endif;?>
    <input type="submit" id="submit" value="Send Message"/>
<input type="reset" id="clear" value="clear"/>
</span>
</form>
</div>
        