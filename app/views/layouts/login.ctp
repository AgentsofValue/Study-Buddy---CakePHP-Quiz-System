<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Welcome New - Page</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
		<meta http-equiv="Content-Language" content="en" /> 
		<meta name="robots" content="FOLLOW,INDEX" /> 
		<link rel="stylesheet" href="style.css" type="text/css" /> 
		<?php
			echo $this->Html->css('reset');
			echo $this->Html->css('style');
		?>
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<?php echo $html->script(array('dropdowntabs.js')); ?>
</head>
<body>
	<div id="wrapper">
		<div id="body">
			<div>
				<div>
					<div>
						<div class="inner">
							
							<div id="topinvibox1" style="height: auto; min-height: 450px; overflow: hidden;">
								<?php echo $this->Session->flash(); ?>
								
								<br /><br />
								
								<br style="clear: left;" />
								<br class="IEonlybr" />
								<?php echo $content_for_layout; ?>
							
							</div>
							<div style="text-align:left;">
								<?php echo $this->Html->image('../css/images/poweredtext.png', array('alt' => ''));?>
							</div>
						</div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div><!-- end boxes -->
		<div id="footer"></div><!-- end footer -->
	</div><!-- end wrapper -->
</body>
</html>