<div style=" font-size:15px; margin-top: 50px">
	<?php echo $this->Session->flash('auth'); ?>
	<?php
		echo $form->create('User',array('action'=>'admin_add'));
		echo $form->input('username');
		echo $form->input('password');
		echo $form->input('password_confirmation', array('type' => 'password'));
	?>
	<div align="center" style="/*margin-top:40px;*/ float: right;">
		<?php echo $form->end('../css/images/submit-button.png', '', array('style' => 'height: 35px;'));?>
	</div>
</div>