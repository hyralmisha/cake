</pre>
<div class="pages index">
    <?php echo $this->element('searchForm/set_pagination_named');?>
    <!--?php echo $this->element('searchForm/form'); ?-->
    
    <div class="posts index">
	<h2><?php echo __('Результати пошуку!'); ?></h2>
	<table cellpadding="0" cellspacing="0">
<!--	<tr>
                <th><?php echo $this->Paginator->sort('id'); ?></th>
                <th><?php echo $this->Paginator->sort('title'); ?></th>
                <th><?php echo $this->Paginator->sort('msg_short'); ?></th>
                <th><?php echo $this->Paginator->sort('msg_full'); ?></th>
                <th><?php echo $this->Paginator->sort('user_id'); ?></th>
                <th><?php echo $this->Paginator->sort('date_create'); ?></th>
                <th><?php echo $this->Paginator->sort('date_edit'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
-->
        <?php if ( isset($posts) && !empty($posts) ) { ?>
	<?php foreach ($posts as $post): ?>
	<tr>
		<td><?php echo h($post['Post']['id']); ?>&nbsp;</td>
		<td><?php echo h($post['Post']['title']); ?>&nbsp;</td>
		<td><?php echo h($post['Post']['msg_short']); ?>&nbsp;</td>
		<td><?php echo h($post['Post']['msg_full']); ?>&nbsp;</td>
		<td><?php echo h($post['Post']['date_create']); ?>&nbsp;</td>
		<td><?php echo h($post['Post']['date_edit']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $post['Post']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $post['Post']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $post['Post']['id']), null, __('Ви дійсно хочете видалити цей пост?', $post['Post']['id'])); ?>
		</td>
	</tr>
        <?php endforeach; }?>
	
<!--      
        </table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
-->
</div>
    
    
    
