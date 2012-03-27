<div style=" font-size:15px; margin-top: 50px">
	<fieldset>
		<legend>Edit Question</legend>
			<div align="right">
				<?php echo $html->link($html->image('../css/images/back-icon.gif'), array('action'=>"/admin_view_one/{$question_id}"), array('escape' => false )); ?>
			</div>
		<?php
			echo $form->create('Dashboard',array('action'=>'admin_edit'));
			
			echo $form->input('New.topic_id',array('empty'=>('Select a Topic'),'options'=>$topics, 'default'=>$topic));
			echo $this->Form->hidden('Question.id', array('value'=>$question_id));
			echo $form->input('Question.text');
			
			for($count=1; $count<=$counter; $count++):
				echo $form->input('Choice.'.$choices_id[$count], array('label'=>'Choice'.$count, 'id'=>'admin'));
			endfor;
			echo $this->Form->hidden('Question.difficulty', array('value'=>1));
		?>
		<div align="center">
			<?php echo $form->end('../css/images/submit-button.png'); ?>
		</div>
	</fieldset>
</div>
		