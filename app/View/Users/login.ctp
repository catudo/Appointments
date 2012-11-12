<h1>User Login</h1>
         <p>
            <?php
				echo $this->Session->flash();
			?>
         </p>
        
         <br /><br />
         <div class="round10" id="login">
            <form accept-charset="utf-8" method="post" id="UserLoginForm" action= <?php echo $this->webroot; ?>users/login>
            <table width="400" align="center" cellpadding="5" cellspacing="0">
               <tr>
                  <td align="left">Document type:</td>
                  <td align="left"> <?php echo $this->Form->input('User.document_type',array('options'=>$options,'label'=>false,'empty'=>false,'id'=>'document_type','div'=>false));?></td>
               </tr>
               <tr>
                  <td align="left">Document:</td>
                  <td align="left"><?php echo $this->Form->input('User.document',array('div'=>false, 'label'=>false));?></td>
               </tr>
               <tr>
                  <td align="left">Password:</td>
                  <td align="left"><?php echo $this->Form->input('User.password',array('div'=>false,'label'=>false));?></td>
               </tr>
               <tr>
                  <td align="left">&nbsp;</td>
                  <td align="left"><input type="submit" name="submit" class="btn" value="Submit" /></td>
               </tr>
            </table>
            </form>
   </div>
