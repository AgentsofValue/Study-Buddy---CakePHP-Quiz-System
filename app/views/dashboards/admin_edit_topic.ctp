<div style=" font-size:15px; margin-top: 50px">
	<?php
		echo $form->create('Dashboard',array('action'=>'edit_topic'));
		echo $form->input('Topic.title', array('value'=>$topic['Topic']['title'], 'id'=>'admin'));
		echo $form->input('Topic.items', array('value'=>$topic['Topic']['items'], 'id'=>'input_items'));
		echo $this->Form->hidden('Topic.id', array('value'=>$topic['Topic']['id']));
	?>
	<div align="center">
		<?php
			echo $form->end('../css/images/submit-button.png');
		?>
	</div>
</div>