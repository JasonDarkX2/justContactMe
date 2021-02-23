<h1>Just Contact Me Settings</h1>
<div class="jcmAdminBody">
        <ul class="tab">
  <li><a href="#" class="tabLinks active" id="email">Email Settings</a></li>
  <li><a href="#" class="tabLinks" id="reCaptcha">Recaptcha Settings</a></li>
  <li><a href="#" class="tabLinks" id="contact">ContactForm Settings</a></li>
  <li><a href="#" class="tabLinks" id="log">Mail Log/BlackList</a></li>
</ul>

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
    <span id="msg"></span>
    <div>
    </div>
</div>
