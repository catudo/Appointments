<form id='saveUser'>
	<h3>Save User</h3>
	<fieldset>

		<?php echo $this -> Form -> input("id", array("type" => "hidden", 'name' => "id")); ?>

		<p>
			<?php
			echo $this -> Form -> input("document", array("label" => __('document'), 'name' => "document", 'div' => false));
			?>
		</p>
		
		<p>
			<?php
			echo $this -> Form -> input("document", array("label" => __('document'), 'name' => "document", 'div' => false));
			?>
		</p>
		

		<input type="submit" value="Save" />
	</fieldset>
</form>