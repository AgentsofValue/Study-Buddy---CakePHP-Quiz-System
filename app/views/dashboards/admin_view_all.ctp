<div style=" font-size:15px; margin-top: 50px">
	<strong id="admin_display">Click on the linked question to view question individually.</strong><br><br>
	<div align="center">
		<table id="view_all_admin">
			<?php $row=0; ?>
			<?php foreach($questions as $item): ?>	
				<?php if($row%2==0): ?>
					<tr id="even">
				<?php elseif($row%2==1): ?>
					<tr id="odd">
				<?php endif; $row++; ?>
				
					<td>
						<?php echo $html->link($item['Question']['text'], array('action'=>"/admin_view_one/{$item['Question']['id']}")); ?>
					</td>
					<td>
						<?php echo $html->link('Edit', array('action'=>'admin_edit', $item['Question']['id']));?>
					</td>
					<td>
						<?php echo $html->link('Delete', array('action'=>'admin_delete', $item['Question']['id']), null, sprintf(__('Are you sure you want to delete this question?', true)));?>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
</div>