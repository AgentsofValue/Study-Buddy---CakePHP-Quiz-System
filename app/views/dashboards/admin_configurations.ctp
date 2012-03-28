<div id="form-configuration" style="/*text-align:center; padding-left:160px;*/ font-size:15px; margin-top: 50px">
	<?php echo $form->create('Dashboards',array('action'=>'admin_configurations')); ?>
	<table>
		<tr>
			<td><label>Site Title: </label></td>
			<td><?php echo $form->input('Option.stitle', array('value' => $stitle, 'label' => false)); ?></td>
		</tr>
		<tr>
			<td><label>Header Title: </label></td>
			<td><?php echo $form->input('Option.title', array('value' => $title, 'label' => false)); ?></td>
		</tr>
		<tr>
			<td><label>Tagline 1: </label></td>
			<td><?php echo $form->input('Option.0.description', array('value' => $taglines[0], 'label' => false)); ?></td>
		</tr>
		<tr>
			<td><label>Tagline 2: </label></td>
			<td><?php echo $form->input('Option.1.description', array('value' => $taglines[1], 'label' => false)); ?></td>
		</tr>
		<tr>
			<td><label>Tagline 3: </label></td>
			<td><?php echo $form->input('Option.2.description', array('value' => $taglines[2], 'label' => false)); ?></td>
		</tr>
		<tr>
			<td><label>Tagline 4: </label></td>
			<td><?php echo $form->input('Option.3.description', array('value' => $taglines[3], 'label' => false)); ?></td>
		</tr>
		<tr>
			<td><label>Logo: </label></td>
			<td><?php echo $form->select('Option.viewlogo', array('on' => 'On', 'off' => 'Off'), $viewlogo, array('style' => 'margin-bottom: 0px;', 'empty' => '-')); ?></td>
		</tr>
	</table>
	<?php echo $form->end('Save'); ?>
</div>