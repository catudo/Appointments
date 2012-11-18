<?php echo $this->Html->script('appointments.js'); ?>

<form id="saveAppointmentForm" action= '<?php echo $this->webroot; ?>Patient/save'>
	<h3>Save Patient</h3>
	<fieldset>
		<p>
		<?php echo $this->Form->input('date',array('class'=>'notShow','readonly'=>true,'label'=>'Select the date of your appointment','empty'=>false,'id'=>'date','div'=>false));?>
		</p>
		<p>
		<?php echo $this->Form->input('city_id',array('options'=>$departaments,'label'=>'Select city where you want your appointment','empty'=>false,'id'=>'city_id','div'=>false, 'class'=>'model' ));?>
	    </p>
	    <p id="cami_division">
		
	    </p>
	    <p id="especiality_division">
		
	    </p>
	    <p id="doctor">
		
	    </p>
	    
	</fieldset>
	<?php echo $this -> Form -> input("schedule_id", array("type" => "hidden", 'name' => "schedule_id")); ?>
	<div id="scheduleTableDiv">
		
	</div>
	
	<div id="divButtons"  style="display: none">
	<button id="saveButton" class="btn btn-primary" type="submit">Save changes</button>
	<button class="btn">Cancel</button>
	</div>
</form>




