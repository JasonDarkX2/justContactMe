<h1>SimplyAJAXContacted Settings</h1>
<div class="sacAdminBody">
        <ul class="tab">
  <li><a href="#" class="tabLinks active" id="email">Email Settings</a></li>
  <li><a href="#" class="tabLinks" id="reCaptcha">Recaptcha Settings</a></li>
  <li><a href="#" class="tabLinks" id="contact">ContactForm Settings</a></li>
  <li><a href="#" class="tabLinks" id="log">Mail Log/BlackList</a></li>
</ul>

    <form id="sac-options" method="POST" action="<?php echo plugins_url('controller\admin\settings_controller.php', dirname(dirname(__FILE__))); ?>">
         <!--E-mail  section!-->
         <div id="emailSettings" class="panelSection">
            <?php include('tabs/emailSettings.php');?>
         </div>
         <!--end of email section!-->
        <!--recaptcha section!-->
        <div id="reCaptchaSettings" class="panelSection" hidden="true">
            <?php include('tabs/recaptchaSettings.php');?>
        </div>
        <!--end of recaptch section!-->
                  <!--Contact form  section!-->
         <div id="contactSettings" class="panelSection" hidden="true">
             <?php include('tabs/contactFormSettings.php');?>
         </div>
         <!--end of ContactForm section!-->
                           <!--Contact form  section!-->
         <div id="logSettings" class="panelSection" hidden="true">
             <?php include('tabs/logSettings.php');?>
         </div>
         <!--end of ContactForm section!-->
         <div class="controlSection">
                     <input type="hidden" name="pluginDir" value ="<?php echo MY_PLUGIN_PATH; ?>"/>
                     <input type="submit" value="Save"/><span id="msg"></span>
         </div>
    </form>
    <div>
    </div>
</div>
