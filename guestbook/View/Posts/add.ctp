<div class="posts form">
<?php echo $this->Form->create('Post'); ?>
	<fieldset>
            <legend><h1><?php echo __('Додати пост'); ?></h1></legend>
	<?php
        
                echo $this->Form->input('title', array('label' => 'Заголовок'));
                echo $this->Form->input('msg_short', array('label' => 'Короткий зміст'));
                echo $this->Form->input('msg_full', array('label' => 'Текст'));
                echo $this->Form->input('user_id', array('label' => 'Користувач'));
                echo $this->Form->input('Tag', array('label' => 'Теги'));
        ?>
	</fieldset><br/>
<?php echo $this->Form->end(__('Додати')); ?>
</div>

