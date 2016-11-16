<h1>SimplyAJAXContacted Settings</h1>
<div class="sacAdminBody">
        
    <form id="sac-options" method="POST" action="<?php echo plugins_url('controller\admin\settings_controller.php', dirname(dirname(__FILE__))); ?>">
         <!--E-mail  section!-->
         <div id="emailSetting" class="section">
             <h1>E-mail Settings</h1>
              <label for="toAddress">Sent to E-mail Address
                  <div class="toolTip">
                      [?]<span class="toolTipText">Set the e-mail address that mail would be sent to. <strong>Default:</strong>
                    <?php echo get_option('admin_email');?></span>
                 </div>
                  :</label>
              <input type="text" name="toAddress" value="<?php echo get_option('toAddress');?>"/>
              <br/>
             <label for="fromAddress">From E-mail Address Name
                 <div class="toolTip">
                      [?]<span class="toolTipText"> Use this field if you would like to change the default email address WordPress uses for sending mails.<br/> <strong>Default:</strong>
                    <?php echo 'wordpress@' . $_SERVER['HTTP_HOST'];?></span>
                 </div>:</label>
             <input type="text" name="fromAddress" value="<?php echo get_option('fromAddress');?>"/>
             <br/>
             <label for="Cc/Bcc Address">Cc: and/or Bcc Address:
                 <div class="toolTip">
                      [?]<span class="toolTipText">You can specify the Cc: and/or Bcc:  recipients Addresses here. <br/> <strong>Default:</strong>
                    None</span>
                 </div>:</label>
             <input type="text" name="copyAddress" value="<?php echo get_option('copyAddress');?>"/>
              <br/>
             <label for="Cc/Bcc Address"> Allow Attachments?
                 <div class="toolTip">
                      [?]<span class="toolTipText">You can specify whether the contact form will allow sender to send attachments <br/> <strong>Default:</strong>
                    Disabled</span>
                 </div>:</label>
             <input type="radio" name="attachment" value="true" <?php checked(get_option('attachment'),1); ?>/>Enable
             <input type="radio" name="attachment" value="false" <?php checked(get_option('attachment'),''); ?>/>Disabled
             <!-- attachment extra settings!-->
             <div id="attachmentOpt" <?php echo (get_option('attachment')) ? '':'hidden';?>>   
                 <label for="fileType"> Attachment file type restrictions: </label>
                 <select name="fileType">
                     <?php
                     $fileTypes= array('docs'=>'Only Documents',
                                                'photo'=>'Only  Photos',
                                                'zip'=>'Only  zip files',
                                                'none'=>'No restrictions');
                     foreach($fileTypes as $i=>$v){
                         if($i==get_option('attachmentType')){
                             echo '<option value="'. $i .'" selected>'. $v .'</option>';    
                         }else{
                        echo '<option value="'. $i .'">'. $v .'</option>';
                         }
                     }
                     ?>
                 </select>
                 <br/><label for="fileSize"> Attachment file  size restrictions: </label>
                 <select name="fileSize">
                     <?php
                     $fileTypes= array('1'=>'1MB',
                                                '2'=>'2MB',
                                                '25'=>'25MB',
                                                '64'=>'64MB');
                     foreach($fileTypes as $i=>$v){
                         if($i==get_option('attachmentSize')){
                             echo '<option value="'. $i .'" selected>'. $v .'</option>';    
                         }else{
                        echo '<option value="'. $i .'">'. $v .'</option>';
                         }
                     }
                     ?>
                 </select>
             </div>
         </div>
         <!--end of email section!-->
        <!--recaptcha section!-->
        <div id="reCaptchaSetting" class="section">
            <h1>Recaptcha Settings</h1>
            <label for"reCaptchaEnabled">Enable reCaptcha:</label>
            <input type="checkbox" name="reCaptchaEnabled" value="true" <?php checked(get_option('reCaptchaEnabled'), true); ?>/>
            <br/>
            <label for=""siteKey">Site Key:</label>
            <input type="text" name="siteKey" value="<?php echo get_option('siteKey'); ?>"/>
            <br/>
            <label for="secretKey">Secret Key:</label>
            <input type="text" name="secretKey" value="<?php echo get_option('secretKey'); ?>"/>
            <label><i>Need Keys<div class="toolTip">[?]<span class="toolTipText"> To get your <b>site</b> and <b>secret</b> keys head over to 
                            <a href="https://www.google.com/recaptcha/">https://www.google.com/recaptcha/admin</a></span></div>
            </i>
            </label>
            <br/>
            <?php foreach (get_option('reCaptchaConfig') as $i => $v): ?>
                <?php switch ($i) {
                    case "theme":
                        ?>
                        <label for="theme"> reCaptcha Theme<div class="toolTip">
                [?]<span class="toolTipText">The color theme of the widget.</span>
            </div>:</label>
                        <input type='hidden' name='confId[]' value="<?php echo $i; ?>"  id="configId"> 
                        <input name="<?php echo $i; ?>" type="radio" value="light" <?php checked($v, 'light'); ?>>Light
                        <input  name="<?php echo $i; ?>" type="radio" value="dark" <?php checked($v, 'dark'); ?> >Dark
                        <br/>
                        <?php
                        break;
                    case 'type':
                        ?>
                        <label for="theme"> reCaptcha Type<div class="toolTip">
                [?]<span class="toolTipText"> The type of CAPTCHA to serve..</span>
            </div>:</label>
                        <input type='hidden' name='confId[]' value="<?php echo $i; ?>"  id="configId"> 
                        <input name="<?php echo $i; ?>" type="radio" value="image" <?php checked($v, 'image'); ?>>Image
                        <input  name="<?php echo $i; ?>" type="radio" value="audio" <?php checked($v, 'audio'); ?>>Audio
                        <br/>
            <?php break;
        case "size":
            ?>
                        <label for="theme"> reCaptcha Size<div class="toolTip">
                [?]<span class="toolTipText"> The size of the widget.</span>
            </div>:</label>
                        <input type='hidden' name='confId[]' value="<?php echo $i; ?>"  id="configId"> 
                        <input name="<?php echo $i; ?>" type="radio" value="normal"<?php checked($v, 'normal'); ?> >Normal
                        <input  name="<?php echo $i; ?>" type="radio" value="compact" <?php checked($v, 'compact'); ?>>Compact
                        <br/>
                        <?php
                        break;
                }
                ?>
<?php endforeach; ?>
        </div>
        <!--end of recaptch section!-->
                  <!--Contact form  section!-->
         <div id="ContactSetting" class="section">
             <h1>ContactForm Settings</h1>
         </div>
         <!--end of ContactForm section!-->
                     <input type="hidden" name="pluginDir" value ="<?php echo MY_PLUGIN_PATH; ?>"/>
                     <input type="submit" value="Save"/><span id="msg"></span>
    </form>
    <div>
        <a href="<?php echo plugins_url('controller\admin\settings_controller.php', dirname(dirname(__FILE__))); ?>?sendTest=True"
           title="Send Test Mail"  id="testMail">
            Send Test Mail</a>
    </div>
</div>