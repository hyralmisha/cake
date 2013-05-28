</pre>
<div class="search" style="margin: 10px;">
<fieldset>
 <?php echo $this->Form->create(array('controller' => 'posts','action' => 'search', 'type' => 'GET')); ?>
 <?php  $name = isset($this->params['url']['name']) ? $this->params['url']['name'] : null;?>
 <?php  echo $this->Form->input('name', array('label'=>'','value'=>$name));?><br/>
 <?php  echo $this->Form->submit('Пошук',array('class'=>'button'));?>
 
<?php echo $this->Form->end(); ?></fieldset>
</div>
<pre>