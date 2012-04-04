<div id="topinnerbox">
				  <div class="indent">
					  <p style="font-size:20px; color:#458ed2; text-align:center; padding-top: 70px; "><em><?php echo ($header_title == null) ? 'Study Buddy' : $header_title; ?></em></p>

					  <p style="text-align:center;"><em style="font-size: 22px; color:#4d4d4d; font-weight:bold;">
						You Paused the Quiz
					  </em></p>
				  </div>
				  
				  <div style="text-align:center;">
					<strong>
						<em style="color:#4d4d4d; font-size: 12px;">Time Left</em>
						<em style="color:#000; font-size: 14px;"><?php echo $time;?></em>
					</strong>
					</div>
				  
				<div style="padding-top:35px;">
					  <div id="dividerx-prev">
						<?php echo $html->link($html->image('../css/images/play-button.png'), "/questions/display/{$question_quiz_id}/{$from_review}/{$last_paused}/review:{$review}", array('escape' => false )); ?>
					  </div>
					  <div id="dividerx-next">
						<?php
							if($from_review==0):
								echo $html->link($html->image('../css/images/review-button.png'), "/questions/review/{$question_quiz_id}/{$from_review}/review:{$review}", array('escape' => false, 'id'=>'review'));
							endif;
						?>
					  </div>
				
				</div>
				<div style="padding-top:35px;">
					<div id="dividerx-prev">
						<?php echo $html->link($html->image('../css/images/see-result.png'), array('controller'=>'questions','action'=>'show_results', true), array('escape'=>false), sprintf(__('Are you sure you want to get your quiz result?', true)));?>
					</div>	
					<div id="dividerx-next">
						
						<?php echo $html->link($html->image('../css/images/exit-button.png'), '/quizzes/home', array('escape' => false ));  ?><br><br>
					</div>
						
				 
				</div>
				
				  <div id="boxes">
					 
				  </div>
				  </div>