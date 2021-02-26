<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1>Mail Log and Blacklist</h1>
<div class="log">
        <table border="1px" id="mailLog">
            <caption>Mail Log:</caption>
            <tr>
            <th> Latest attempt date</th>
            <th> Sender</th>
            <th>Status</th>
            <th>Attempts</th>
            <th>Options</th>
            </tr>
            <?php
            foreach( get_option('mailLog') as $i=>$entry): ?>
            <tr>
                <td> <?php echo end($entry['date']); ?></td>
                <td><?php echo $entry['sender'] . '(' . $i .')'; ?></td>
                <td> <?php echo $entry['status']; ?></td>
                <td> <?php echo $entry['attempts']; ?></td>
                <td>More info</td>
            </tr>
            <?php endforeach; ?>
        </table>
    <a href="<?php echo plugins_url('administrative\controller\logSetting_controller.php', dirname(dirname(dirname(__FILE__)))); ?>?clearMailLog=True"
       title="Clear Mail Log" id="clearmaillog" class="actionLink"> Clear Mail Log</a>
</div>
<hr/>
    <div>
        <h1>The Blacklist</h1>
        <p> Here you can view every sender who used your contact form. You can blacklist individual Sender address or domain. Blacklisting will cause their message to be ignored.</p>
        <hr/>
        <form  method="POST" action="<?php echo plugins_url('\controller\logSetting_controller.php', dirname(dirname(__FILE__))); ?>">
        <div class="halfPanel">
            <label>Sender Address:</label>
            <select id="whiteListedLog" name="whitelist[ ]" multiple>
                <?php  foreach (get_option('whiteListLog') as $email => $name) { ?>
                    <option value="<?php echo $name. ':'.$email; ?>"> <?php echo $name.'('. $email . ')'; ?></option>
                <?php } ?>
            </select>
            <a href="<?php echo plugins_url('administrative\controller\logSetting_controller.php', dirname(dirname(dirname(__FILE__)))); ?>?clearSenderLog=True"
               title="Clear Sender List" id="clearSenderLog" class="actionLinkSelect"> Clear sender List</a>|
            <a href="#" title="Add sender to BlackList&gt" id="logRightBtn"> BlackList Sender &gt</a>|
            <a href="#" title="BlackList sender Domain" id="domRightBtn"> Blacklist Sender domain&gt</a>|<br/>
            <a href="#" title="Delete entry from WhiteList" class="removeEntry">Delete Sender Entry</a>|
        </div>

        <div class="halfPanel">
        <label> BlackListed Senders:</label>
        <select id="blackListedLog" name="blacklist[ ]" multiple>
            <?php  foreach (get_option('blackListLog') as $bl=> $name) { ?>
                <option value="<?php echo $name.':'.$bl; ?>"> <?php echo $name. '('.$bl .')'; ?></option>
            <?php } ?>
        </select>
        <a href="<?php echo plugins_url('administrative\controller\logSetting_controller.php', dirname(dirname(dirname(__FILE__)))); ?>?clearBlacklist=True"
           title="Clear Sender List" id="clearBlacklist" class="actionLinkSelect"> Clear BlackList</a>|
        <a href="#" title="Remove Sender from BlackList&gt" id="logLeftBtn">&lt;WhiteList Sender </a>|
            <a href="#" title="Delete entry from BlackList&gt" class="removeEntry">Delete BlackList Entry</a>|<br/>
    </div>

        <div class="halfPanel">
            <label> BlackListed Domain:</label>
            <select class="list" id="blackListedDomainLog" name="blacklistDom[ ]" multiple>
                <?php  foreach (get_option('blackListDomain') as $bl=> $name) { ?>
                    <option value="<?php echo $name; ?>"> <?php echo $name ; ?></option>
                <?php } ?>
            </select>
            <a href="<?php echo plugins_url('administrative\controller\logSetting_controller.php', dirname(dirname(dirname(__FILE__)))); ?>?clearBlackListDom=True"
               title="Clear Sender List" id="clearSenderLog" class="actionLinkSelect"> Clear BlackList Domain</a>|
            <a href="#" title="Remove domain entry BlackList&gt" class="removeEntry">Delete Domain Entry</a>|
        </div>
        <hr/>
       <div>
           Display Blacklisted error message(leave blank if wish to show nothing):<br/>
           <input class="textInput" type="text" id="pin" name="blackListMsg" value="<?php echo get_option('blackListMessage'); ?>" maxlength="160" size="160">
       </div>
<hr/>
        <div class="controlSection">
            <input type="hidden" name="pluginDir" value ="<?php echo MY_PLUGIN_PATH; ?>"/>
            <input type="submit" value="Save Changes" id="submitbtn"/>
        </div>
        </form>
</div>



