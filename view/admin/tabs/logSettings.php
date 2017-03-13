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
     <label> Mail Log</label>
     <select id="whiteListedLog" name="whitelist[ ]" multiple>
          <?php  foreach (get_option('whiteListLog') as $wl) { ?>
           <option value="<?php echo $wl; ?>"> <?php echo $wl; ?></option>
          <?php } ?>
         </select>
 </div>
    <div class="multicontrols">
        <input type="button" id="logLeftBtn" value="&lt;&lt;" />
        <br/>
        <input type="button" id="logRightBtn" value="&gt;&gt;" />
    </div>
 <div class="halfPanel">
     <label> BlackList</label>
       <select id="blackListedLog" name="blacklist[ ]" multiple>
          <?php  foreach (get_option('blackListLog') as $bl) { ?>
           <option value="<?php echo $bl; ?>"> <?php echo $bl; ?></option>
          <?php } ?>
         </select>
 </div>
 </div>
<div class="log">
    <div class="halfPanel">
            <label>Mail Log:</label>
        <table border="1px">
            <tr>
            <th>date</th>
            <th> Sender</th>
            <th>Status</th>
            <th>Options</th>
            </tr>
            <tr>
                <td> March, 10,2017</td>
                <td>Johdoe@domain.com</td>
                <td> Send Fail</td>
                <td>More info</td>
            </tr>
        </table>
    </div>
    <div>
            <label>Mail Log:</label>
        <table border="1px">
            <tr>
            <th>date</th>
            <th> Sender</th>
            <th>Status</th>
            <th>Options</th>
            </tr>
            <tr>
                <td> March, 10,2017</td>
                <td>Johdoe@domain.com</td>
                <td> Send Fail</td>
                <td>More info</td>
            </tr>
        </table>
    </div>
</div>
