<div class="posts form">
<?php echo $this->Form->create('Post'); ?>
	<fieldset>
		<legend><?php echo __('Редагувати пост'); ?></legend>
	<?php
		echo $this->Form->hidden('id');
		echo $this->Form->input('title', array('label' => 'Заголовок'));
                echo $this->Form->input('msg_short', array('label' => 'Короткий зміст'));
                echo $this->Form->input('msg_full', array('label' => 'Текст'));
                echo $this->Form->input('user_id', array('label' => 'Користувач'));
                echo $this->Form->input('Tag', array('label' => 'Теги'));
    
	?>
	</fieldset>
<?php echo $this->Form->end(__('Редагувати')); ?>
</div>
