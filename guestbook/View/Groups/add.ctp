<div class="tags form">
<?php echo $this->Form->create('Group'); ?>
	<fieldset>
		<legend><?php echo __('Додати групу користувачів'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
