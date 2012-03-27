<div style=" font-size:15px; margin-top: 50px">
	<fieldset>
		<strong id="admin_display">Topic:</strong><br>
			<li><?php echo $topic['Topic']['title'];?></li><br><br>
		<strong id="admin_display">Items:</strong><br>
			<li><?php echo $topic['Topic']['items'];?></li><br><br>
		<div id="top-right">
			<?php echo $html->link($html->image('../css/images/edit-button.gif'), array('action'=>'admin_edit_topic', $topic_id), array('escape' => false ));?>
		</div>
	</fieldset>
</div>