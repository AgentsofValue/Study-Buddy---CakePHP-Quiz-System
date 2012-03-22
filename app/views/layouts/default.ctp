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
		
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>

  </head>

<body>
  <div id="wrapper">

      <div id="body">
          <div>
		   <div>
		    <div>
			
			 <div class="inner">
                <?php echo $this->Session->flash(); ?>
				<?php echo $content_for_layout; ?>
			  </div>
			  
                      <div class="clear"></div>
                  </div></div>
              </div><!-- end boxes -->
			</div>
		</div>
	</div>
</div><!-- end .inner -->
      </div><!-- end body -->

      <div id="footer">
	  
      </div><!-- end footer -->
  </div><!-- end wrapper -->
</body>
</html>