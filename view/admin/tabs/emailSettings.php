<h1>E-mail Settings</h1>
              <label for="toAddress">Sent to E-mail Address
                  <div class="toolTip">
                      [?]<span class="toolTipText">Set the e-mail address that mail would be sent to. <strong>Default:</strong>
                    <?php echo get_option('admin_email');?></span>
                 </div>
                  :</label>
              <input type="text" name="toAddress" value="<?php echo get_option('toAddress');?>"/>
              <br/>
                 <div class="toolTip">
                      [?]<span class="toolTipText"> Use this field if you would like to change the name that appears on all outbound WordPress mail.<br/> <strong>Default:</strong>
                    <?php echo 'wordpress'?></span>
                 </div>:</label>
             <input type="text" name="fromAddress" value="<?php echo get_option('fromName');?>"/>
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
                 <a href="<?php echo plugins_url('controller\admin\settings_controller.php', dirname(dirname(dirname(__FILE__)))); ?>?attachTest=True" 
                    title="send test mail with attachment"  id="AttachmentTest"> Send Test mail with attachment file</a>
             </div>
             <div>
                <label for="messageBody" style="vertical-align: top;">Message Body<div class="toolTip" style="vertical-align: top;">
                      [?]<span class="toolTipText"> Here you can  customize the message body with HTML and tags below.<br/> <strong>Default:</strong>
                    [senderMessage]</span>
                 </div>:</label>
                 <textarea id="msgBody" name="messageBody" style="vertical-align: middle; " rows="10" cols="50" ><?php echo  stripslashes(get_option('messageBody'));?></textarea>
                 <label>Message Tags: &nbsp;</label>
                     <?php $msgTags= self::$messageTags;
                     foreach($msgTags as $v):?>
                         <a  href="#" title="<?php echo $v; ?>" class="TagClick"><?php echo $v; ?></a>
                 <?php endforeach;?>    
         </div>
                    <a href="<?php echo plugins_url('controller\admin\settings_controller.php', dirname(dirname(dirname(__FILE__)))); ?>?sendTest=True"
           title="Send Test Mail"  id="testMail">
            Send Test Mail</a>
