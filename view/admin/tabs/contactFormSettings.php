          <h1>ContactForm Settings</h1>
             <div class="halfPanel">
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
             <textarea  name="customCSS" rows="20"  cols="50"><?php  echo get_option('customCSS');?></textarea>
             </div>
             <div class="halfPanel">
                                              <div class="previewBox">
                 <strong>Contact form Preview</strong>
                  <?php
                  self::$settings->getFormPreview();
                  ?>
                  </div>
             </div>