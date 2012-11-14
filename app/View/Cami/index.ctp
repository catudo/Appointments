<?php echo $this->Html->script('cami.js'); ?>

<form id="saveCamiForm" >
	<h3>Save Cami</h3>
	<fieldset>
			<?php echo $this -> Form -> input("id", array("type" => "hidden", 'name' => "id")); ?>
		<p>
		<?php echo $this->Form->input('city_id',array('options'=>$departaments,'label'=>'City','empty'=>false,'id'=>'city','div'=>false ));?>
	    </p>
		<p>
			<?php
			echo $this -> Form -> input("name", array("label" => __('Name'), 'name' => "name", 'div' => false));
			?>
		</p>
		<p>
			<?php
			echo $this -> Form -> input("phone", array("label" => __('Phone'), 'name' => "phone", 'div' => false));
			?>
		</p>
		<p>
			<?php
			echo $this -> Form -> input("address", array("label" => __('Address'), 'name' => "address", 'div' => false));
			?>
		</p>
		
		
		<button id ='saveCami' class="btn btn-large">SAVE</button>
	</fieldset>
</form>
<div id="camiDiv">
	
	
	
</div>

