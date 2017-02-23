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
     <select name="whitelist" multiple>
         <option value="Johndoe@doe.com">Johndoe@company.com</option>
         <option value="bobred@doe.com">bobred@company.com</option>
         </select>
 </div>
    <div class="multicontrols">
        <input type="button" id="logLeftBtn" value="&lt;&lt;" />
        <br/>
        <input type="button" id="logRightBtn" value="&gt;&gt;" />
    </div>
 <div class="halfPanel">
     <label> BlackList</label>
       <select name="blacklisted" multiple>
         <option value="Johndoe@blocked.com">Johndoe@blocked.com</option>
         <option value="bobred@bl;ocked.com">bobred@clocked.com</option>
         </select>
 </div>
</div>
