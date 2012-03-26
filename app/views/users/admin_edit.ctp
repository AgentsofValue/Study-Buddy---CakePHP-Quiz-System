<div class="indent">
	<p style="font-size:20px; color:#458ed2; text-align:center; padding-top: 40px; "><em>Google Analytics Study Buddy</em></p>
</div>
<fieldset>
	<legend>Edit User</legend>
		<div align="right">
			<?php echo $html->link($html->image('../css/images/back-icon.gif'), array('action'=>"admin_view"), array('escape' => false )); ?>
		</div>
	<?php
		echo $form->create('User', array('action'=>'admin_edit'));
		echo $form->input('username', array('value' => $user['User']['username']));
		echo $form->input('password', array('value' => $user['User']['password']));
		echo $form->input('password_confirmation', array('type' => 'password'));
		echo $form->hidden('id', array('value' => $user['User']['id']));
	?>
	<div align="center">
		<?php echo $form->end('../css/images/submit-button.png', '', array('style' => 'height: 35px;')); ?>
	</div>
</fieldset>
<div style="text-align:left;">
	<?php echo $this->Html->image('../css/images/poweredtext.png', array('alt' => ''));?>
</div>