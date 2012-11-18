					
<?php if($group==1):?>								
					<li>
							<a class="ajax-link" href="<?php echo $this->webroot?>Users/index"><i class="icon-home"></i><span class="hidden-tablet"> Users</span></a>
							</li>
							<li>
								<a class="ajax-link" href="<?php echo $this->webroot?>Cami/index"><i class="icon-home"></i><span class="hidden-tablet"> Camis</span></a>
							</li>
							<li>
								<a class="ajax-link" href="<?php echo $this->webroot?>Admindoctor/index"><i class="icon-home"></i><span class="hidden-tablet"> Doctors</span></a>
							</li>
							
							<li>
								<a class="ajax-link" href="<?php echo $this->webroot?>Schedules/index"><i class="icon-home"></i><span class="hidden-tablet"> Schedules</span></a>
							</li>
							
							<li>
								<a class="ajax-link" href="<?php echo $this->webroot?>Users/logout"><i class="icon-home"></i><span class="hidden-tablet"> Logout</span></a>
							</li>
							
<?php endif; ?>

<?php if($group==2):?>					
					<li>
							<a class="ajax-link" href="<?php echo $this->webroot?>Doctor/main"><i class="icon-home"></i><span class="hidden-tablet"> Appointments</span></a>
							</li>
							<li>
							<li>
								<a class="ajax-link" href="<?php echo $this->webroot?>Users/logout"><i class="icon-home"></i><span class="hidden-tablet"> Logout</span></a>
							</li>
							
							
					
<?php endif; ?>



<?php if($group==3):?>					
					<li>
							<a class="ajax-link" href="<?php echo $this->webroot?>Patient/create_index"><i class="icon-home"></i><span class="hidden-tablet"> Create</span></a>
							</li>
							<li>
							<a class="ajax-link" href="<?php echo $this->webroot?>Patient/list_appointments"><i class="icon-home"></i><span class="hidden-tablet"> Appointments</span></a>
							</li>
							<li>
								<a class="ajax-link" href="<?php echo $this->webroot?>Patient/change_password"><i class="icon-home"></i><span class="hidden-tablet"> Change Password</span></a>
							</li>
							<li>
								<a class="ajax-link" href="<?php echo $this->webroot?>Users/logout"><i class="icon-home"></i><span class="hidden-tablet"> Logout</span></a>
							</li>
							
							
					
<?php endif; ?>