<?php 
	$this->Session->delete('start_time');
	$this->Session->delete('quiz_id');
?>

<div id="topinvibox1">
	<div class="indent">
		<p style="font-size:20px; color:#458ed2; text-align:center; padding-top: 40px; "><em><?php echo ($header_title == null) ? 'Google Analytics Study Buddy' : $header_title; ?></em></p>
		<hr style="color:#dddddd;" />
		<p style="text-align:center;"><strong><em style="font-size: 14px; color:#4d4d4d;">
			<?php echo (empty($taglines[0])) ? 'Preparing for tests like a Google Analytics Individual Certificate is tough.' : $taglines[0]; ?><br>
			<?php echo (empty($taglines[1])) ? 'Sign up for the free use of our study buddy.' : $taglines[1]; ?>
		</em></strong></p>
	</div>
				  
	<div style="text-align:center; padding-left:160px; font-size:15px;">
						
	</div>
				  
	<div style="padding-top:35px;">
					  
	</div>
	<div style="text-align:center;">
		<?php echo $html->link($html->image('../css/images/sign-up-button.png'),array('controller'=>'quizzes', 'action'=>'register'),array('escape' => false ));?>
	</div>
				  
	<div id="boxes">
					 
	</div>
</div>

<div style="text-align:left;">
						
	<?php
		$style = ($viewlogo == 'off') ? 'visibility: hidden' : '';
		echo $this->Html->image('../css/images/poweredtext.png', array('alt' => '', 'style' => $style));
	?>				
	<div style="float:right; padding-top:25px;">
		<strong><em>
			<?php echo $html->link('Learn More',''); ?> |
			<?php echo $html->link('Resume a Quiz', '/quizzes/resume'); ?>
							
		</em></strong>
	</div>
</div>