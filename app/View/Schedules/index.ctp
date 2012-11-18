<?php echo $this->Html->script('schedule.js'); ?>
<form id="saveScheduleForm" >
		<?php echo $this -> Form -> input("id", array("type" => "hidden", 'name' => "id")); ?>
	<h3>Save Schedule</h3>
	<fieldset>		
		<p>
		<?php echo $this->Form->input('user_id',array('options'=>$doctorList,'label'=>'Doctors','empty'=>false,'id'=>'user_id','div'=>false ));?>
	    </p>
	    <p>
		<?php echo $this->Form->input('week_day',array('options'=>$days,'label'=>'Days','empty'=>false,'id'=>'week_day','div'=>false ));?>
	    </p>
	    <p>
		<?php echo $this->Form->input('entry_hour',array('options'=>$hours,'label'=>'Entry Hour','empty'=>false,'id'=>'entry_hour','div'=>false ));?>
	    </p>
	    <p>
		<?php echo $this->Form->input('entry_minute',array('options'=>$minutes,'label'=>'Entry Minute','empty'=>false,'id'=>'entry_minute','div'=>false ));?>
	    </p>
	    
	     <p>
		<?php echo $this->Form->input('exit_hour',array('options'=>$hours,'label'=>'Exit Hour','empty'=>false,'id'=>'exit_hour','div'=>false ));?>
	    </p>
	    <p>
		<?php echo $this->Form->input('exit_minute',array('options'=>$minutes,'label'=>'Exit Minute','empty'=>false,'id'=>'exit_minute','div'=>false ));?>
	    </p>
	    
	    
		<button id ='saveSchedule' class="btn btn-large">SAVE</button>
	</fieldset>
</form>
<div>
	<p>
	<?php echo $this->Form->input('user_id',array('options'=>$doctors,'label'=>'Doctors','empty'=>false,'id'=>'doctors','div'=>false ));?>
	</p>
	
	<div id='tableDiv'>
		
		
	</div>
	
	
</div>

