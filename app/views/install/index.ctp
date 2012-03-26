<div id="topinvibox1" style="overflow: hidden; height: auto;">
	<div class="indent">
		<p style="font-size:20px; color:#458ed2; text-align:center;"><em>Welcome to Study Buddy Installation Page</em></p>
	</div>
	<br style="clear: left;" />
	<br class="IEonlybr" />
	<div class="box-notification">
		<p>Before you proceed to install the database tables, you need to manually configure the file <b>config.php</b> inside app/config folder of your CakePHP Application.</p>
	</div>
	<div class="box-install">
		<div id="box-tableinfo">
			<p><b>Host</b>: <span><?php echo $config['host']; ?></span></p>
			<p><b>Login</b>: <span><?php echo $config['login']; ?></span></p>
			<p><b>Password</b>: <span><?php echo $config['password']; ?></span></p>
			<p><b>Database</b>: <span><?php echo $config['database']; ?></span></p>
			<p><b>Prefix</b>: <span><?php echo $config['prefix']; ?></span></p>
			<?php if(empty($config['prefix'])) : ?>
			<div id="box-warning-error">
				<p><b>Warning:</b> Table prefix is not defined. Please define a table prefix in config.php to avoid table conflicts. If you wan't to continue click "Install" ahead.</p>
			</div>
			<?php else: ?>
			<div id="box-warning-ok">
				<p>Configuration Ok</p>
			</div>
			<?php endif; ?>
		</div>
		<?php echo $form->create('', array('action' => 'installDbTable')); ?>
		<?php echo $form->end('Install'); ?>
	</div>
</div>
<div style="text-align:left;">
	<?php echo $this->Html->image('../css/images/poweredtext.png', array('alt' => ''));?>
</div>