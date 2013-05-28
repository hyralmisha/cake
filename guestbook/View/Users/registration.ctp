<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
        <legend><h1><?php echo __('Реєстрація'); ?></h1></legend><br/>
	<?php
            echo $this->Form->input('last_name', array('label' => 'Прізвище'));
            echo $this->Form->input('first_name', array('label' => 'Ім\'я'));
            echo $this->Form->input('username', array('label' => 'Email'));
            echo $this->Form->input('password', array('label' => 'Пароль'));
            echo $this->Form->input('Group', array('label' => 'Група'));
	?>
	</fieldset><br/>
<?php echo $this->Form->end(__('Зареєструватися')); ?>
</div>
