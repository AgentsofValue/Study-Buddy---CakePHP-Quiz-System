<style>
	#authMessage {
		color: #f00;
		text-align: center;
	}
</style>
<div class="indent">
	<p style="font-size:20px; color:#458ed2; text-align:center;"><em>Admin Login</em></p>
</div>
<?php echo $this->Session->flash('auth'); ?>
<div style="font-size:15px; padding-bottom:20px; padding-left:160px; text-align:center;">
	<?php echo $form->create('User',array('action'=>'login')); ?>
	<table>
		<tr>
			<td><?php echo $form->input('username'); ?></td>
		</tr>
		<tr>
			<td><?php echo $form->input('password'); ?></td>
		</tr>
		<tr>
			<td></td>
		</tr>
	</table>
	<?php echo $form->end('Login'); ?>
</div>