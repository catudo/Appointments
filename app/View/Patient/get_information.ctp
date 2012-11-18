
<?php if(sizeof($options)>0):?>
<?php echo $this->Form->input($tagId,array('options'=>$options,'label'=>$label,'empty'=>false,'id'=>$tagId,'div'=>false, 'class'=>'model' ));?>
<?php else: ?>
	<?php echo $label ?>
<?php endif; ?>	