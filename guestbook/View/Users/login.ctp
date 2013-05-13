
<div class="users form">
    
<?php echo $this->Form->create('User'); ?>
	<fieldset>
        <legend><?php echo __('Вхід'); ?></legend><br/>
	<?php
            echo $this->Form->input('username', array('label' => 'Ваш email'));
            echo $this->Form->input('password', array('label' => 'Пароль'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Login')); ?>
</div>