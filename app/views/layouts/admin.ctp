<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title><?php echo $title_for_layout; ?> <?php echo ($site_title == null) ? '- Study Buddy' : $site_title; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
		<meta http-equiv="Content-Language" content="en" /> 
		<meta name="robots" content="FOLLOW,INDEX" /> 
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<?php
			echo $html->script(array('dropdowntabs.js', 'cloning.js'));
			echo $html->css(array('reset', 'style', 'slidingdoor'));
		?>
</head>
<body>
	<div id="wrapper">
		<div id="body">
			<div>
				<div>
					<div>
						<div class="inner">
							<div class="nav-head" style="float: right;">
								<?php echo $html->link('Visit Site', array('admin' => false, 'controller' => 'quizzes', 'action' => 'home')); ?>&nbsp|&nbsp
								<?php if($is_logged_in) : ?>
									Welcome <?php echo $username; ?>!&nbsp;&nbsp;
									(<?php echo $html->link('Logout', array('controller' => 'users', 'action' => 'admin_logout')); ?>)
								<?php else: ?>
									<?php echo $html->link('Login', array('controller' => 'users', 'action' => 'admin_login')); ?>
								<?php endif; ?>
							</div>
							<div id="topinvibox1" style="height: auto; min-height: 450px; overflow: hidden;">
								<div class="indent">
									<p id="site-header-title"><em><?php echo ($header_title == null) ? 'Study Buddy' : $header_title; ?><br />Administrator Dashboard</em></p>
								</div>
								<br /><br />
								<div id="slidemenu" class="slidetabsmenu">
									<ul>
										<li><a href="<?php echo $html->url(array('controller' => 'dashboards', 'action' => 'admin_home')); ?>" title="Home"><span>Home</span></a></li>
										<li><a href="<?php echo $html->url(array('controller' => 'dashboards', 'action' => 'admin_configurations')); ?>" title="Configurations"><span>Configurations</span></a></li>
										<li><a href="<?php echo $html->url(array('controller' => 'dashboards', 'action' => 'admin_reports')); ?>" title="Reports"><span>Reports</span></a></li>
										<li><a href="#" title="Add" rel="dropmenu1_c"><span>Add</span></a></li>
										<li><a href="#" title="Review" rel="dropmenu2_c"><span>View</span></a></li>
									</ul>
								</div>
								
								<br style="clear: left;" />
								<br class="IEonlybr" />
								
								<!--1st drop down menu -->                                                   
								<div id="dropmenu1_c" class="dropmenudiv_c" style="width: 150px;">
								<?php
									echo $html->link('Question', array('controller' => 'dashboards', 'action'=>'admin_add'));  
									echo $html->link('Topic', array('controller' => 'dashboards', 'action'=>'admin_add_topic')); 
									echo $html->link('User', array('controller' => 'users', 'action'=>'admin_add'));
								?>
								</div>


								<!--2nd drop down menu -->                                                
								<div id="dropmenu2_c" class="dropmenudiv_c" style="width: 150px;">
								<?php
									echo $html->link('Questions', array('controller' => 'dashboards', 'action'=>'admin_view_all'));
									echo $html->link('Topics', array('controller' => 'dashboards', 'action'=>'admin_view_all_topics'));
									echo $html->link('Users', array('controller' => 'users', 'action'=>'admin_view'));
								?>
								</div>
							<?php echo $this->Session->flash(); ?>
							<?php echo $content_for_layout; ?>
							</div>
							<div style="text-align:left; margin-top: 20px;">
								<?php
									$style = ($viewlogo == 'off' || $viewlogo == null) ? 'visibility: hidden' : '';
									echo $this->Html->image('../css/images/poweredtext.png', array('alt' => '', 'style' => $style));
								?>
							</div>
						</div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div><!-- end boxes -->
		<div id="footer">
			<script type="text/javascript">
				//SYNTAX: tabdropdown.init("menu_id", [integer OR "auto"])
				tabdropdown.init("slidemenu")
			</script>
		</div><!-- end footer -->
	</div><!-- end wrapper -->
</body>
</html>