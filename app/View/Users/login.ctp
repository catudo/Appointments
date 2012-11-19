   
   <div class="alert alert-info">
						  <?php
						
						echo $this->Session->flash();
						
							?>
					</div>
					 <form class="form-horizontal" accept-charset="utf-8" method="post" id="UserLoginForm" action= <?php echo $this->webroot; ?>users/login>
					
						<fieldset>
							<div class="input-prepend" title="Document_type" data-rel="tooltip">
								<span class="add-on"><i class="icon-user"></i></span>
								<?php echo $this->Form->input('User.document_type',array('options'=>$options,'label'=>false,'empty'=>false,'id'=>'document_type','div'=>false, 'class'=>'input-large span10', 'style'=>'width:221px;height:38px'));?>
							</div>
							<div class="clearfix"></div>
							
							<div class="input-prepend" title="Document" data-rel="tooltip">
								<span class="add-on"><i class="icon-user"></i></span>
								<?php echo $this->Form->input('User.document',array('div'=>false, 'label'=>false, 'class'=>'input-large span10', 'style'=>'width:221px;height:38px'));?>
								
							</div>
							<div class="clearfix"></div>
							

							<div class="input-prepend" title="Password" data-rel="tooltip">
								<span class="add-on"><i class="icon-lock"></i></span>
								<?php echo $this->Form->input('User.password',array('div'=>false,'label'=>false));?>
							</div>
							<div class="clearfix"></div>

							<p class="center span5">
							<button type="submit" class="btn btn-primary">Login</button>
							</p>
						</fieldset>
					</form>
