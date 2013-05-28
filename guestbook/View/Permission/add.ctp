<div class="tags form">
<?php echo $this->Form->create('Permission'); ?>
	<fieldset>
		<legend><?php echo __('Add Permission'); ?></legend>
	<?php
		echo $this->Form->input('name');
                echo $this->Form->input('Group', array('label' => 'Група'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
