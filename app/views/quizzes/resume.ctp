<?php echo $html->link('Back to Home page', '/quizzes/home');  ?>

	<div id="topinnerbox">
		<div class="indent">
			<p style="font-size:20px; color:#458ed2; text-align:center; padding-top: 70px; "><em>Google Analytics Study Buddy</em></p>

			<p style="text-align:center; margin-top:50px">
				<em style="font-size: 18px; color:#4d4d4d;">
						Enter the code sent to your email to continue the quiz.
				</em>
			</p>
		</div>
			  
		<div style="text-align:center; margin-top:50px;">
				<?php
					echo $form->create('Quiz',array('action'=>'resume'));
					echo $form->input('code');
					echo $form->end('../css/images/submit-button.png');
				?>	
		</div>
				  
		
				  
		<div id="boxes">
					 
		</div>
	</div>