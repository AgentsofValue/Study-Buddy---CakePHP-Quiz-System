<html>
	<head>
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<?php echo $javascript->link('dropdowntabs.js'); ?>
	</head>
	<body>
		<div id="topinvibox1">
			<div class="indent">
				<p style="font-size:20px; color:#458ed2; text-align:center; padding-top: 40px; "><em>Google Analytics Study Buddy</em></p>
					
			</div>
			<br><br>
			<div id="slidemenu" class="slidetabsmenu">
				<ul>
					
				<li><a href="#" title="Home"><span>Home</span></a></li>
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


				

				
			<p style="text-align:center; margin-top:120px;"><strong><em style="font-size: 14px; color:#4d4d4d;">
					Preparing for tests like a Google Analytics Individual Certificate is tough.<br>
					Sign up for the free use of our study buddy.
			</em></strong></p>

 
									 
				  
				
  
				 
				
		</div>
		
		<div style="text-align:left;">
						
			<?php echo $this->Html->image('../css/images/poweredtext.png', array('alt' => ''));?>
					
		</div>





	</body>
</html>