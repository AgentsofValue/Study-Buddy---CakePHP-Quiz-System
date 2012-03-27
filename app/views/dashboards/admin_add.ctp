<div style=" font-size:15px; margin-top: 50px">
	<?php
		echo $form->create('Dashboard',array('action'=>'add'));
		echo $form->input('Question.topic_id',array('empty'=>('Select a Topic'),'options'=>$topics, 'selected'=>false));
		echo $form->input('Question.text');
	?>
	<strong id="choices_label">Choices:</strong><br><br>
	<input type="text" name="data[Choice][1]" id="admin" label="Choice 1">
	<input type="text" name="data[Choice][2]" id="admin" label="Choice 2">
	<div id="input2" style="margin-bottom:4px;" class="clonedInput">
		<input type="text" style="display: none;">
	</div>
	<?php 
		echo $this->Form->button($html->image('../css/images/add-a-choice-btn.png'), array('type'=>'button', 'id'=>'btnAdd'));
		echo $this->Form->button($html->image('../css/images/remove-a-choice-btn.png'), array('type'=>'button','id'=>'btnDel'));
		echo $this->Form->hidden('Question.difficulty', array('value'=>1)); 
	?>
	<div align="center" style="margin-top:40px;">
		<?php echo $form->end('../css/images/submit-button.png');?>
	</div>
</div>