<?php echo $this->Html->script('change.js'); ?>
<div class="well span5 center login-box">
					<div class="alert alert-info">
						Please change your password.
					</div>
					<form method="post"  class="form-horizontal">
						<fieldset>
							<div data-rel="tooltip" class="input-prepend" data-original-title="Password">
								<span class="add-on"><i class="icon-lock"></i></span>
								<?php
									echo $this -> Form -> input("password", array("label" => __('Password'), 'name' => "password", 'div' => false,'class'=>"text-long"));
								?>
								
							</div>
							<div class
							<div class="clearfix"></div>

							<div data-rel="tooltip" class="input-prepend" data-original-title="Password">
								<span class="add-on"><i class="icon-lock"></i></span>
								
								
								<?php
								echo $this -> Form -> input("secondPassword", array("label" => __('Retype Password'),'type'=>'password', 'name' => "secondPassword", 'div' => false,'class'=>"text-long"));
								?>
								
							</div>
							<div class="clearfix"></div>

							
							<div class="clearfix"></div>

							<p class="center span5">
							<button class="btn btn-primary" type="submit">Save</button>
							</p>
						</fieldset>
					</form>
				</div>