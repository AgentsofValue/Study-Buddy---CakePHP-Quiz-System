<div id="topinvibox1" style="overflow: hidden; height: auto;">
	<div class="indent">
		<p style="font-size:20px; color:#458ed2; text-align:center;"><em>Welcome to Study Buddy Installation Page</em></p>
	</div>
	<br style="clear: left;" />
	<br class="IEonlybr" />
	<div class="box-notification">
		<p>Database file is not yet configured. Before you proceed to install the database tables, you need to manually configure the file <b>database.php</b> inside app/config folder of your CakePHP Application. You may click 'Continue' when you're done.</p>
	</div>
	<div class="box-install">
		<?php echo $html->link('Continue', array('action' => '/')); ?>
	</div>
</div>
<div style="text-align:left;">
	<?php echo $this->Html->image('../css/images/poweredtext.png', array('alt' => ''));?>
</div>