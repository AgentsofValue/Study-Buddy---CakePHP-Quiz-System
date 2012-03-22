<?php 
	$this->Session->delete('start_time');
	$this->Session->delete('quiz_id');
?>

<div id="topinvibox1">
	<div class="indent">
		<p style="font-size:20px; color:#458ed2; text-align:center; padding-top: 40px; "><em>Google Analytics Study Buddy</em></p>
		<hr style="color:#dddddd;" />
		<p style="text-align:center;"><strong><em style="font-size: 14px; color:#4d4d4d;">
			Preparing for tests like a Google Analytics Individual Certificate is tough.<br>
			Sign up for the free use of our study buddy.
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
						
	<?php echo $this->Html->image('../css/images/poweredtext.png', array('alt' => ''));?>
					
	<div style="float:right; padding-top:25px;">
		<strong><em>
			<?php echo $html->link('Learn More',''); ?> |
			<?php echo $html->link('Resume a Quiz', '/quizzes/resume'); ?>
							
		</em></strong>
	</div>
</div>