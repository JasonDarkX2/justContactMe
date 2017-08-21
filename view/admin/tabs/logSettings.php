<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1>Mail Log and Blacklist</h1>
<div class="log">
 <div class="halfPanel">
     <label>Contacts Address</label>
     <select id="whiteListedLog" name="whitelist[ ]" multiple>
          <?php  foreach (get_option('whiteListLog') as $email => $name) { ?>
           <option value="<?php echo $name. ':'.$email; ?>"> <?php echo $name.'('. $email . ')'; ?></option>
          <?php } ?>
         </select>
     <br/>

 </div>
    <div class="multicontrols">
        <input type="button" id="logLeftBtn" value="&lt;&lt;" />
        <br/>
        <input type="button" id="logRightBtn" value="&gt;&gt;" />
    </div>
 <div class="halfPanel">
     <label> BlackList</label>
       <select id="blackListedLog" name="blacklist[ ]" multiple>
          <?php  foreach (get_option('blackListLog') as $bl=> $name) { ?>
           <option value="<?php echo $name.':'.$bl; ?>"> <?php echo $name. '('.$bl .')'; ?></option> 
          <?php } ?>
         </select>
     <br/>

 </div>
                
        <table border="1px" style="width:100%;">
            <caption>Mail Log:</caption>
            <tr>
            <th>date</th>
            <th> Sender</th>
            <th>Status</th>
            <th>Attempts</th>
            <th>Options</th>
            </tr>
            <?php foreach( get_option('mailLog') as $i=>$entry): ?>
            <tr>
                <td> <?php echo $entry['date']; ?></td>
                <td><?php echo $entry['sender'] . '(' .$i . ')' ; ?></td>
                <td> <?php echo $entry['status']; ?></td>
                <td> <?php echo $entry['attempts']; ?></td>
                <td>More info</td>
            </tr>
            <?php endforeach; ?>
        </table>
 </div>

