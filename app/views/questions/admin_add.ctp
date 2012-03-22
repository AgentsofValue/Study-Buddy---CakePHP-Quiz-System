<html>
	<head>
		
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
		<?php echo $javascript->link('dropdowntabs.js'); ?>
		<?php echo $javascript->link('cloning.js'); ?>
		
	</head>
	
	<body>
		<div id="topinvibox2">
			<div class="indent">
				<p style="font-size:20px; color:#458ed2; text-align:center; padding-top: 40px; "><em>Google Analytics Study Buddy</em></p>
			</div>
						  
			<div style=" font-size:15px;">
				
								
				<br><br><br>
				<div id="slidemenu" class="slidetabsmenu">
					<ul>
						
					<li><a href="home" title="Home"><span>Home</span></a></li>
					<li><a href="#" title="Add" rel="dropmenu1_c"><span>Add</span></a></li>
					<li><a href="#" title="Review" rel="dropmenu2_c"><span>View</span></a></li>
							
					</ul>
				</div>

				<br style="clear: left;" />
				<br class="IEonlybr" />



				<!--1st drop down menu -->                                                   
				<div id="dropmenu1_c" class="dropmenudiv_c">
					<?php 
						echo $html->link('Question', array('action'=>'admin_add'));  
						echo $html->link('Topic', array('action'=>'admin_add_topic')); 
					?>
							

				</div>


				<!--2nd drop down menu -->                                                
				<div id="dropmenu2_c" class="dropmenudiv_c">
					<?php 
						echo $html->link('Questions', array('action'=>'admin_view_all'));
						echo $html->link('Topics', array('action'=>'admin_view_all_topics'));
					?>
						
				</div>

				<script type="text/javascript">
					//SYNTAX: tabdropdown.init("menu_id", [integer OR "auto"])
					tabdropdown.init("slidemenu")
				</script>



				
				
			
				<br><br><br><br><br>
					
				<?php
					
					echo $form->create('Question',array('action'=>'add'));
					echo $form->input('topic_id',array('empty'=>('Select a Topic'),'options'=>$topics, 'selected'=>false));
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
						  
			<div style="padding-top:35px;">
							  
			</div>
						
						  
			<div id="boxes">
							 
			</div>
		
		</div>

		<div style="text-align:left;">
								
			<?php echo $this->Html->image('../css/images/poweredtext.png', array('alt' => ''));?>
							
		</div>
	</body>
</html>
	