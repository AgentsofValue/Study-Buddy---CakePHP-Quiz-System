<div id="topinvibox1" style="overflow: hidden; height: auto;">
	<div class="indent">
		<p style="font-size:20px; color:#458ed2; text-align:center;"><em>Welcome to Study Buddy Installation Page</em></p>
	</div>
	<div id="box-account" style=" font-size:15px;">
		<h3 style="font-weight: bold">Account Information</h3>
		<br style="clear: left;" />
		<br class="IEonlybr" />
		<?php
			echo $form->create('', array('action' => 'account'));
			echo $form->input('User.username');
			echo $form->input('User.password');
			echo $form->input('User.password_confirmation', array('type' => 'password'));
		?>
		<div align="center" style="/*margin-top:40px;*/ float: right;">
			<?php
				$options = array(
					'type' => 'image',
					'src' => '/StudyBuddy/app/webroot/img/../css/images/submit-button.png',
					'style' => 'height: 35px;'
				);
				echo $form->end($options);
			?>
		</div>
	</div>
</div>
<div style="text-align:left;">
	<?php echo $this->Html->image('../css/images/poweredtext.png', array('alt' => ''));?>
</div>