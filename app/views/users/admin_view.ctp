<?php echo $html->script(array('dropdowntabs')); ?>
<div id="topinvibox2">
	<div class="indent">
		<p style="font-size:20px; color:#458ed2; text-align:center; padding-top: 40px; "><em>Google Analytics Study Buddy</em></p>
	</div> 
	<div style=" font-size:15px;">
		<br /><br /><br />
		<div id="slidemenu" class="slidetabsmenu">
			<ul>
				<li><a href="<?php echo $html->url(array('controller' => 'dashboards', 'action'=>'home')); ?>" title="Home"><span>Home</span></a></li>
				<li><a href="#" title="Add" rel="dropmenu1_c"><span>Add</span></a></li>
				<li><a href="#" title="Review" rel="dropmenu2_c"><span>View</span></a></li>
			</ul>
		</div>
		<br style="clear: left;" />
		<br class="IEonlybr" />
		<!--1st drop down menu -->                                                   
		<div id="dropmenu1_c" class="dropmenudiv_c">
			<?php 
				echo $html->link('Question', array('controller' => 'dashboards', 'action'=>'admin_add'));  
				echo $html->link('Topic', array('controller' => 'dashboards', 'action'=>'admin_add_topic'));
				echo $html->link('User', array('action'=>'admin_add'));
			?>
		</div>
		<!--2nd drop down menu -->                                                
		<div id="dropmenu2_c" class="dropmenudiv_c">
			<?php 
				echo $html->link('Questions', array('controller' => 'dashboards', 'action'=>'admin_view_all'));
				echo $html->link('Topics', array('controller' => 'dashboards', 'action'=>'admin_view_all_topics'));
				echo $html->link('User', array('action'=>'admin_view'));
			?>
		</div>
		<script type="text/javascript">
			//SYNTAX: tabdropdown.init("menu_id", [integer OR "auto"])
			tabdropdown.init("slidemenu")
		</script>
		<br /><br /><br /><br /><br />
		<div align="center">
			<table id="view_all_admin">
				<?php $row=0; ?>
				<?php foreach($users as $user): ?>	
				<?php
					if($row % 2 == 0) :
						$tr_id = 'even';
					elseif($row % 2 == 1) :
						$tr_id = 'odd';
					endif;
					
					$row++;
				?>
				<tr id="<?php echo $tr_id; ?>">
					<td><?php echo $user['User']['username']; ?></td>
					<td><?php echo $user['User']['date_registered']; ?></td>
					<td><?php echo $user['User']['last_login']; ?></td>
					<td>
						<?php echo $html->link('Edit', array('action'=>'admin_edit', $user['User']['id']));?>
					</td>
					<td>
						<?php echo $html->link('Delete', array('action'=>'admin_delete', $user['User']['id']), null, sprintf(__('Are you sure you want to delete this user?', true)));?>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
	</div>
	<div style="padding-top:35px;"></div>
	<div id="boxes"></div>
</div>
<div style="text-align:left;">
	<?php echo $this->Html->image('../css/images/poweredtext.png', array('alt' => ''));?>
</div>

