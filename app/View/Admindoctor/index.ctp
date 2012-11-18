<?php echo $this -> Html -> script('doctors.js'); ?>

<div class="row-fluid">
	<form id="saveUserForm" >
		<?php echo $this -> Form -> input("id", array("type" => "hidden", 'name' => "id")); ?>
		<?php echo $this -> Form -> input("group_id", array("type" => "hidden", 'name' => "group_id", 'class' => 'dont', 'value' => 2)); ?>
		<div class="span3">

			<div class="control-group">
				<?php echo $this -> Form -> input('document_type_id', array('options' => $options, 'label' => 'Document type', 'empty' => false, 'id' => 'document_type_id', 'div' => false)); ?>
			</div>
			<div class="input-append">
				<?php echo $this -> Form -> input("document", array("label" => __('document'), 'name' => "document", 'div' => false, 'class' => " focused")); ?>
			</div>

		</div>

		<div class="span3">
			<div class="control-group">
				<?php echo $this -> Form -> input("last_name", array("label" => __('Last Name'), 'name' => "last_name", 'div' => false, 'class' => " focused")); ?>
			</div>

			<div class="control-group">
				<?php echo $this -> Form -> input("first_name", array("label" => __('First Name'), 'name' => "first_name", 'div' => false, 'class' => " focused")); ?>
			</div>

		</div>

		<div class="span3">

			<div class="control-group">

				<?php echo $this -> Form -> input("address", array("label" => __('Address'), 'name' => "address", 'div' => false, 'class' => " focused")); ?>
			</div>

			<div class="control-group">
				<?php echo $this -> Form -> input("phone", array("label" => __('Phone'), 'name' => "phone", 'div' => false, 'class' => " focused")); ?>
			</div>

		</div>

		<div class="span3">

			<div class="control-group">
				<?php echo $this -> Form -> input("surgery", array("label" => __('Surgery'), 'name' => "surgery", 'div' => false, 'class' => " focused")); ?>
			</div>

			<div class="control-group">
				<?php echo $this -> Form -> input("password", array("label" => __('Password'), 'name' => "password", 'div' => false, 'class' => " focused")); ?>
			</div>

		</div>

		<div class="span3">
			<div>
				<?php echo $this -> Form -> input("secondPassword", array("label" => __('Retype Password'), 'type' => 'password', 'name' => "secondPassword", 'div' => false, 'class' => " focused")); ?>
			</div>
			<div class="control-group">
				<?php echo $this -> Form -> input('cami_id', array('options' => $camis, 'label' => 'Cami', 'empty' => false, 'id' => 'cami', 'div' => false)); ?>
			</div>
		</div>

		<div class="span3">

			<div class="control-group">
				<?php echo $this -> Form -> input('speciality_id', array('options' => $specialities, 'label' => 'Speciality', 'empty' => false, 'id' => 'speciality_id', 'div' => false)); ?>
			</div>
		</div>
		<div class="span3">
			<div style="height: 110px;">
				
			</div>	
		
		</div>
			
			
		<div class="span3">
			<button id="saveUserButton" class="btn btn-primary" type="submit">
				Save changes
			</button>
			<button class="btn">
				Cancel
			</button>

		</div>
		
		
		

	</form>

</div>

<div class="row-fluid" id="userTableDiv">

</div>

