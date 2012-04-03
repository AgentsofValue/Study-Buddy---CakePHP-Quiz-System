<table>
	<thead id="report-head">
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>No. of Questions</th>
			<th>No. of Correct</th>
			<th>No. of Wrong</th>
			<th>No. Left Blank</th>
			<th>Total Score</th>
			<th></th>
		</tr>
	</thead>
	<tbody id="report-body">
		<?php if(sizeof($report_results) == 0) : ?>
			<tr><td colspan="8">No Results Found!</td></tr>
		<?php else : ?>
			<?php $row = 0; ?>
			<?php foreach($report_results as $rr): ?>
			<?php
				if($row % 2 == 0) :
					$tr_id = 'even';
				elseif($row % 2 == 1) :
					$tr_id = 'odd';
				endif;
				
				$row++;
			?>
			<tr id="<?php echo $tr_id; ?>">
				<td><?php echo $rr['quiz_id']; ?></td>
				<td><?php echo $rr['user_name']; ?></td>
				<td style="text-align: center"><?php echo $rr['total_questions']; ?></td>
				<td style="text-align: center"><?php echo $rr['no_of_correct']; ?></td>
				<td style="text-align: center"><?php echo $rr['no_of_wrong']; ?></td>
				<td style="text-align: center"><?php echo $rr['no_left_blank']; ?></td>
				<td style="text-align: center"><?php echo $rr['total_score'] . "%"; ?></td>
				<td><?php echo $html->link('Review', array('admin' => 'true', 'action' => 'reports_review', $rr['quiz_id'])); ?></td>
			</tr>
			<?php endforeach; ?>
		<?php endif; ?>
	</tbody>
</table>
<div id="load-reports"></div>
<div class="filter-box">
	<a id="tprev" href="javascript:void(0)"><?php echo $html->image('2.png'); ?>Prev</a>
	<a id="tnext" href="javascript:void(0)"><?php echo $html->image('1.png'); ?> Next</a>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		var content = 1;
		var page = <?php echo $page; ?>;
		var url = "<?php echo $html->url('/dashboards/reports_result'); ?>";
		var size = <?php echo sizeof($report_results); ?>;
		var nsize = <?php echo sizeof($nextresults); ?>;
		
		if(page == 1) {
			if(nsize == 0)
				$("#tnext").css({'display':'none'});
			
			$("#tprev").css({'display':'none'});
		} else {
			if(size == 0 || nsize == 0) {
				$("#tnext").css({'display':'none'});
			}
		}
		
		$("#tprev").click(function () {		
			page--;
			url = url + "?p=" + page;
			
			getUrl(content, url);
		});
		
		$("#tnext").click(function () {
			page++;
			url = url + "?p=" + page;
			
			getUrl(content, url);
		});
	});
</script>