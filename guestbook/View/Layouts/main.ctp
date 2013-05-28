<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
            Гостьова книга
                <?php //echo $cakeDescription; ?>
		<?php //echo $title_for_layout;?>
                
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('main');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
<div id="wrapper">
<div id="header">
<div class="link">
</div>
<div class="title">
<h1>Гостьова книга</h1>
</div>
<ul class="menu">
    <li><?php echo $this->Html->link(__('Головна'), array('controller' => 'posts', 'action' => 'index')); ?></li>
    <li><?php echo $this->Html->link(__('Список постів'), array('controller' => 'posts', 'action' => 'index')); ?></li>
    <li><?php echo $this->Html->link(__('Додати права'), array('controller' => 'permission', 'action' => 'add')); ?></li>
    <li><?php echo $this->Html->link(__('Новий пост'), array('controller' => 'posts', 'action' => 'add')); ?> </li>
    <li><?php echo $this->Html->link(__('Додати групу'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
    <li><?php echo $this->Html->link(__('Реєстрація'), array('controller' => 'users', 'action' => 'registration')); ?> </li>
    <li><?php echo $this->Html->link(__('Список тегів'), array('controller' => 'tags', 'action' => 'index')); ?> </li>
    <li><?php echo $this->Html->link(__('Новий тег'), array('controller' => 'tags', 'action' => 'add')); ?> </li>
    <li><?php if ($Auth) {
         echo $this->Html->link(__('Вийти'), array('controller' => 'users', 'action' => 'logout')); 
    } else {
         echo $this->Html->link(__('Увійти'), array('controller' => 'users', 'action' => 'login'));  
    }?></li>
</ul>

    <?php echo $this->element( 'searchForm\form' ); ?>

</div>

<div id="content">
<div class="top">
</div>
<div class="isi">
<p> 
     
    <?php echo $this->Session->flash(); ?>

    <?php echo $this->fetch('content'); ?>
</p>
    
    <div align="center">
    <?php //echo $this->element( 'tagcloud' ); ?>
    </div>
</div>
<div id="kotakkiri"></div>

<div class="foot"></div>
</div>

<div id="middle">
    <div id="footer">&copy; <?php echo date('Y')." hyralm@mail.ru";?> </div>
</div>

</div>

</body>
</html>    
    



	