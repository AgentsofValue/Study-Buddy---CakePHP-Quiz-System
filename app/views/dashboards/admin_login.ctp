<style>
	#authMessage {
		color: #f00;
		text-align: center;
	}
</style>
<div id="topinvibox1">
	<div class="indent">
		<p style="font-size:20px; color:#458ed2; text-align:center; padding-top: 40px; "><em>Google Analytics Study Buddy</em></p>
		<hr style="color:#dddddd;" />
		<p style="text-align:center;"><strong><em style="font-size: 14px; color:#4d4d4d;">
		Preparing for tests like a Google Analytics Individual Certificate is tough.<br>
		Take the quiz and learn!</em></strong></p>
	</div>
	<?php echo $this->Session->flash('auth'); ?>
	<div style="text-align:center; padding-left:160px; font-size:15px;">
		<?php echo $form->create('Dashboard', array('action'=>'login')); ?>
		<table>
			<tr>
				<td><?php echo $form->input('User.username'); ?></td>
			</tr>
			<tr>
				<td><?php echo $form->input('User.password'); ?></td>
			</tr>
			<tr>
				<td></td>
			</tr>
		</table>
		<?php echo $form->end('Login'); ?>
	</div>
	<div style="padding-top:35px;"></div>
	<div id="boxes"></div>
</div>
<div style="text-align:left;">
	<?php echo $this->Html->image('../css/images/poweredtext.png', array('alt'=>''));?>
</div>