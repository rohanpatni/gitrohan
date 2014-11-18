<h1>Blog Tests</h1>

<?php echo $this->Html->link('Add Post',array('controller' => 'tests','action' => 'add')); ?>

<table>

	<tr>
		<th>Id</th>
		<th>Title</th>
		<th>Created</th>
	</tr>

	<?php foreach ($tests as $test): ?>
	<tr>

	<td><?php echo $test['Test']['id']; ?></td>
	<td><?php echo $this->Html->link($test['Test']['title'],array('controller' => 'tests','action' => 'view',$test['Test']['id'])); ?></td>
	<td><?php echo $test['Test']['created']; ?></td>
	</tr>
	<?php endforeach; ?>
	<?php unset ($test); ?>
	</table>