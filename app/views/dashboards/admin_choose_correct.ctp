<div style=" font-size:15px; margin-top: 50px">
	<strong id="admin_display"><?php echo $question;?></strong>
	<br><br><br>
	<?php 
		echo $form->create('Dashboard',array('action'=>'choose_correct'));
		echo $form->input('Choice.id', array('label'=>'','multiple' => 'checkbox', 'options' => $choices));
	?>
	<div align="center">
		<?php
			echo $form->end('../css/images/submit-button.png');
		?>
	</div>
</div>