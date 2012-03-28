<div id="topinvibox1">
				  <div class="indent">
					  <p style="font-size:20px; color:#458ed2; text-align:center; padding-top: 40px; "><em><?php echo ($header_title == null) ? 'Google Analytics Study Buddy' : $header_title; ?></em></p>
					<hr style="color:#dddddd;" />
					  <p style="text-align:center;"><strong><em style="font-size: 14px; color:#4d4d4d;">
						Preparing for tests like a Google Analytics Individual Certificate is tough.<br>
						<?php echo (empty($taglines[2])) ? 'Take the quiz and learn!' : $taglines[2]; ?>
					  </em></strong></p>
				  </div>
				  
					<div style="text-align:center; padding-left:160px; font-size:15px;">
							<?php
	
											$datetime = date('Y-m-d H:i:s'); 
											
											echo $form->create('Quiz',array('action'=>'register'));
											echo $this->Form->hidden('id');
							?>
							
							<table>
								<tr>
									<td>
										<?php
											echo $form->input('user_name');
										?>
									</td>
								</tr>
								<tr>
									<td>
										<?php
											echo $form->input('user_email');
											echo $this->Form->hidden('code');
											echo $this->Form->hidden('allotted_time', array('value'=>5400));
											echo $this->Form->hidden('datetime', array('value'=>$datetime));
											
										
										?>
									</td>
								</tr>
								
								<tr>
									<td><br><br><?php echo $form->end('../css/images/takethequiz-button.png'); ?></td>
								</tr>
								
							</table>
							
					</div>
				  
				  <div style="padding-top:35px;">
					  
				  </div>
				  
				  
				  <div id="boxes">
					 
				  </div>
				  </div>
				  <div style="text-align:left;">
						<?php
							$style = ($viewlogo == 'off') ? 'visibility: hidden' : '';
							echo $this->Html->image('../css/images/poweredtext.png', array('alt' => '', 'style' => $style));
						?>
						
				  </div>