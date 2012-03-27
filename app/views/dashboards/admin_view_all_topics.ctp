<div style=" font-size:15px; margin-top: 50px">
	<div align="center">
		<table id="view_all_admin">
			<?php $row=0; ?>
			<?php foreach($topics as $topic): ?>	
				<?php if($row%2==0): ?>
					<tr id="even">
				<?php elseif($row%2==1): ?>
					<tr id="odd">
				<?php endif; $row++; ?>
					<td>
						<?php echo $html->link($topic['Topic']['title'], array('action'=>"/admin_view_one_topic/{$topic['Topic']['id']}")); ?>
					</td>
					<td>
						<?php echo $html->link('Edit', array('action'=>'admin_edit_topic', $topic['Topic']['id']));?>
					</td>
					<td>
						<?php echo $html->link('Delete', array('action'=>'admin_delete_topic', $topic['Topic']['id']), null, sprintf(__('Are you sure you want to delete this topic?', true)));?>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
</div>