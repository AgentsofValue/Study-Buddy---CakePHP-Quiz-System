<div style=" font-size:15px; margin-top: 50px">
	<div align="center">
		<table id="view_all_admin">
			<?php $row=0; ?>
			<?php foreach($users as $user): ?>	
			<?php
				if($row % 2 == 0) :
					$tr_id = 'even';
				elseif($row % 2 == 1) :
					$tr_id = 'odd';
				endif;
				
				$row++;
			?>
			<tr id="<?php echo $tr_id; ?>">
				<td><?php echo $user['User']['username']; ?></td>
				<td><?php echo $user['User']['date_registered']; ?></td>
				<td><?php echo $user['User']['last_login']; ?></td>
				<td>
					<?php echo $html->link('Edit', array('action'=>'admin_edit', $user['User']['id']));?>
				</td>
				<td>
					<?php echo $html->link('Delete', array('action'=>'admin_delete', $user['User']['id']), null, sprintf(__('Are you sure you want to delete this user?', true)));?>
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
	</div>
</div>