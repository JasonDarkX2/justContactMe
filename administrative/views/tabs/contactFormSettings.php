          <h1>ContactForm Settings</h1>
          <div  class="flex-container">
             <div class="flex">
                 <form id="jcm-options" method="POST" action="<?php echo plugins_url('\controller\contactFormSetting_controller.php', dirname(dirname(__FILE__))); ?>">
             <label for="formTheme">themes<div class="toolTip">[?]<span class="toolTipText">Set the preferred contact Form theme.<strong> Default:</strong> &nbsp;None</span></div>:</label>
             <select name="formTheme">
                 <?php
                     $themes= array('Dark'=>'dark-theme',
                                                'Light'=>'light-theme',
                                                'Transparent'=>'trans-heme',
                                                'None'=>'',
                                                );
                     foreach($themes as $i=>$v){
                         if($v==get_option('formTheme')){
                             echo '<option value="'. $v .'" selected>'. $i .'</option>';    
                         }else{
                        echo '<option value="'. $v .'">'. $i .'</option>';
                         }
                     }
                     ?>
             </select>
             <br/>
             <label for="customCSS">Custom CSS<div class="toolTip">[?]
                     <span class="toolTipText">Use this field for your custom Css styling for the contact Form.</span></div>:</label>
             <br/>
             <textarea  name="customCSS" rows="20"  cols="10"><?php  echo get_option('customCSS');?></textarea>
                 <div class="controlSection">
                     <input type="hidden" name="pluginDir" value ="<?php echo MY_PLUGIN_PATH; ?>"/>
                     <input type="submit" value="Save Changes" id="submitbtn"/>
                 </div>
                 </form>
             </div>
             <div  class="flex">
                                              <div class="previewBox">
                 <strong>Contact form Preview</strong>
                  <?php
                  (new AdminSettings)->getFormPreview();
                  ?>
                  </div>
             </div>
          </div>