<div style=" font-size:15px; margin-top: 50px">
	<fieldset>
		<legend>Select Correct Answer</legend>
		<?php
			echo $form->create('Dashboard',array('action'=>'edit_correct_answers'));
			echo $form->input('New.correct', array('label'=>'','multiple' => 'checkbox', 'options' => $choices, 'selected'=>$selected));
			echo $this->Form->hidden('Question.id', array('value'=>$question_id));
		?>
		<div align="center">
			<?php echo $form->end('../css/images/submit-button.png'); ?>
		</div>
	</fieldset>
</div>