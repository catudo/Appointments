<?php echo $this -> Html -> script('schedule.js'); ?>
<div class="row-fluid ">
	<form id="saveScheduleForm" >
		<?php echo $this -> Form -> input("id", array("type" => "hidden", 'name' => "id")); ?>
		<h3>Save Schedule</h3>
		<fieldset>
			<div class="row-fluid">
				<div class="span4">
					<p>
						<?php echo $this -> Form -> input('user_id', array('options' => $doctorList, 'label' => 'Doctors', 'empty' => false, 'id' => 'user_id', 'div' => false)); ?>
					</p>
				</div>

				<div class="span8" style="">

				</div>
			</div>

			<div class="row-fluid">
				<div class="span4">
					<p>
						<?php echo $this -> Form -> input('week_day', array('options' => $days, 'label' => 'Days', 'empty' => false, 'id' => 'week_day', 'div' => false)); ?>
					</p>
				</div>

				<div class="span8" style=""></div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<div class="span4">
						
							<?php echo $this -> Form -> input('entry_hour', array('options' => $hours, 'label' => 'Entry Hour', 'empty' => false, 'id' => 'entry_hour', 'div' => false)); ?>
						
						&nbsp; &nbsp;:
					</div>

					<div class="span1" style="position: relative; top:22px; right: 100px;">
						
							<?php echo $this -> Form -> input('entry_minute', array('options' => $minutes, 'label' => false, 'empty' => false, 'id' => 'entry_minute', 'div' => false)); ?>
						
					</div>

				</div>
			</div>
			
			<div class="row-fluid">
				<div class="span12">
					<div class="span4">
						
							<?php echo $this -> Form -> input('exit_hour', array('options' => $hours, 'label' => 'Exit Hour', 'empty' => false, 'id' => 'exit_hour', 'div' => false)); ?>
						
						&nbsp; &nbsp;:
					</div>

					<div class="span1" style="position: relative; top:22px; right: 100px;">
						
							<?php echo $this -> Form -> input('exit_minute', array('options' => $minutes, 'label' => false, 'empty' => false, 'id' => 'exit_minute', 'div' => false)); ?>
						
					</div>

				</div>
			</div>

		</fieldset>
	</form>
	<div class="row-fluid">
			<div class="span1">
			<button id ='saveSchedule' class="btn btn-large">SAVE</button>
			</div>
	</div>

</div>
<div class="row-fluid ">
	<div class="span12">
	<p>
		<?php echo $this -> Form -> input('user_id', array('options' => $doctors, 'label' => 'Doctors', 'empty' => false, 'id' => 'doctors', 'div' => false)); ?>
	</p>
	</div>
	<div class="row-fluid ">
	<div id='tableDiv' class="span12">

	</div>
	</div>
</div>

