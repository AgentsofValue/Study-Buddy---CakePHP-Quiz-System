<div style=" font-size:15px; margin-top: 50px">
	<?php
		echo $form->create('Dashboard',array('action'=>'add_topic'));
		echo $form->input('Topic.title', array('id'=>'admin'));
		echo $form->input('Topic.items', array('id'=>'input_items'));
		echo $this->Form->hidden('Topic.id');
	?>
	<div align="center">
		<?php
			echo $form->end('../css/images/submit-button.png');
		?>
	</div>
</div>