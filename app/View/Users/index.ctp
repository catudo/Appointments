<?php echo $this -> Html -> script('users.js'); ?>
<form id="saveUserForm" >
	<div class="row-fluid ">
		<?php echo $this -> Form -> input("id", array("type" => "hidden", 'name' => "id")); ?>
		<?php echo $this -> Form -> input("group_id", array("type" => "hidden", 'name' => "group_id", 'class' => 'dont', 'value' => 3)); ?>
		<div class="span3">
			<p>
				<?php echo $this -> Form -> input('document_type_id', array('options' => $options, 'label' => 'Document type', 'empty' => false, 'id' => 'document_type_id', 'div' => false)); ?>
			</p>

			<p>
				<?php echo $this -> Form -> input("document", array("label" => __('document'), 'name' => "document", 'div' => false, 'class' => "text-long")); ?>
			</p>

		</div>
		<div class="span3">

			<p>
				<?php echo $this -> Form -> input("last_name", array("label" => __('Last Name'), 'name' => "last_name", 'div' => false, 'class' => "text-long")); ?>
			</p>

			<p>
				<?php echo $this -> Form -> input("first_name", array("label" => __('First Name'), 'name' => "first_name", 'div' => false, 'class' => "text-long")); ?>
			</p>

		</div>
		<div class="span3">
			<p>
				<?php echo $this -> Form -> input("address", array("label" => __('Address'), 'name' => "address", 'div' => false, 'class' => "text-long")); ?>
			</p>

			<p>
				<?php echo $this -> Form -> input("phone", array("label" => __('Phone'), 'name' => "phone", 'div' => false, 'class' => "text-long")); ?>
			</p>

		</div>
		<div class="span3">
			<p>
				<?php echo $this -> Form -> input("password", array("label" => __('Password'), 'name' => "password", 'div' => false, 'class' => "text-long")); ?>
			</p>

		</div>
		
		<div class="span3">

			<p>
				<?php
				echo $this -> Form -> input("secondPassword", array("label" => __('Retype Password'), 'type' => 'password', 'name' => "secondPassword", 'div' => false, 'class' => "text-long"));
				?>
			</p>
		</div>
	<div class="span3">
		<div style="height: 100px;"></div>
	</div>	
			
	
	<div class="span3">
	<button id="saveUserButton" class="btn btn-primary" type="submit">Save changes</button>
	<button class="btn cancel">Cancel</button>
	</div>
</div>
</form>

<div class="row-fluid ">
				<div id="userTableDiv" class="span12">
					
					
				</div>
			</div>


