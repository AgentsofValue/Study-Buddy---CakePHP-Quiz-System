<div style=" font-size:15px; margin-top: 50px">
	<fieldset>
		<strong id="admin_display">Topic:</strong><br>
			<li><?php echo $topic;?></li><br><br>
		<strong id="admin_display">Question:</strong><br>
			<li><?php echo $question;?></li><br><br>
		<strong id="admin_display">Choices:</strong><br>
			<?php foreach($choices as $choice):?>
				<li> <?php echo $choice['text'];?></li>
			<?php endforeach; ?>
			<br><br><br>
			<div align="center">
				<?php echo $html->link('<<', array('action'=>'previous', $question_id));?>
				Question <?php echo $question_number;?> of <?php echo $total_questions;?>
				<?php echo $html->link('>>', array('action'=>'next', $question_id));?>
			</div>
		<div id="top-right">
			<?php echo $html->link($html->image('../css/images/edit-button.gif'), array('action'=>'admin_edit', $question_id), array('escape' => false ));?>
		</div>
	</fieldset>
</div>