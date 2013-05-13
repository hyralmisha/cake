<div class="posts view">
<h2><?php  echo __('Post'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($post['Post']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($post['Post']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Msg Short'); ?></dt>
		<dd>
			<?php echo h($post['Post']['msg_short']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Msg Full'); ?></dt>
		<dd>
			<?php echo h($post['Post']['msg_full']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($post['User']['first_name'], array('controller' => 'users', 'action' => 'view', $post['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Create'); ?></dt>
		<dd>
			<?php echo h($post['Post']['date_create']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Edit'); ?></dt>
		<dd>
			<?php echo h($post['Post']['date_edit']); ?>
			&nbsp;
		</dd>
	</dl>

        <td class="actions">
                <?php echo $this->Html->link(__('View'), array('action' => 'view', $post['Post']['id'])); ?>
                <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $post['Post']['id'])); ?>
                <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $post['Post']['id']), null, __('Are you sure you want to delete # %s?', $post['Post']['id'])); ?>
        </td>
</div>

