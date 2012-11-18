<?php echo $this->Html->script('cami.js'); ?>
<div class="row-fluid ">
<form id="saveCamiForm" >
	<h3>Save Cami</h3>
	
	
		<?php echo $this -> Form -> input("id", array("type" => "hidden", 'name' => "id")); ?>
		<div class="span3">
			<p>
			<?php echo $this->Form->input('city_id',array('options'=>$departaments,'label'=>'City','empty'=>false,'id'=>'city','div'=>false ));?>
	    </p>
		
		</div>
		<div class="span3">
			<p>
			<?php
			echo $this -> Form -> input("name", array("label" => __('Name'), 'name' => "name", 'div' => false));
			?>
		</p>	
			
		</div>
		
		<div class="span3">
		<p>
			<?php
			echo $this -> Form -> input("phone", array("label" => __('Phone'), 'name' => "phone", 'div' => false));
			?>
		</p>	
			
		</div>	
		<div class="span2">
			<p>
			<?php
			echo $this -> Form -> input("address", array("label" => __('Address'), 'name' => "address", 'div' => false, "style"=>'width:195px' ));
			?>
			</p>
			
		</div>
		
		<div class="span3">
			<button id ='saveCami' class="btn btn-large">SAVE</button>	
		</div>
		
	
</form>
</div>
<div class="row-fluid " id="camiDiv">
	
	
	
</div>

