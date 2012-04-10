<style>
	/*#admin-review-header {
		border: 1px solid #0071A3;
		height: 110px;
	}
	
	#admin-review-header #left {
		background-color: #0071A3;
		float: left;
		height: 110px;
		width: 180px;
	}
	
	#admin-review-header #right {
		float: left;
		height: 110px;
		width: auto;
	}
	
	#admin-review-header #right h2 {
		color: #0071A3;
		padding-left: 10px;
		padding-top: 15px;
	}
	
	#admin-review-header #left-top {
		border-top: 1px solid #0071A3;
	}
	
	#admin-review-header #left-top h3 {
		color: #0071A3;
		font-size: 12px;
		padding-left: 10px;
	}
	
	#admin-review-header p {
		color: #0071A3;
		font-size: 12px;
		margin: 5px 0;
		padding-left: 10px;
	}
	
	#admin-review-body {
		border-bottom: 1px solid #0071A3;
		border-right: 1px solid #0071A3;
		border-top: 1px solid #0071A3;
		height: auto;
		margin-top: 10px;
		overflow: hidden;
	}
	
	#admin-review-body #top {
		border-bottom: 1px solid #0071A3;
		border-left: 1px solid #0071A3;
		height: 30px
	}
	
	#admin-review-body #content {
		
	}
	
	#box-content {
		border-left: 1px solid #0071A3;
		float: left;
		height: auto;
		overflow: hidden;
	}
	
	#admin-review-body #review {
		border-spacing: 0;
		padding: 5px;
		width: 558px;
	}
	
	#admin-review-body thead {
		background: none repeat scroll 0 0 #615D57;
	}
	
	#admin-review-body thead th {
		border: 1px solid;
		color: #FFFFFF;
		padding: 5px;
		text-align: center;
		vertical-align: middle;
	}
	
	#admin-review-body tbody td { padding: 5px 2px; }
	#admin-review-body .question-text { width: 255px; }
	#admin-review-body .answer, #admin-review-body .correct-answer { text-align: center; width: 100px; }
	
	#admin-review-body .wrong, #admin-review-body .correct { text-align: center; width: 20px; }
	
	#admin-review-body .wrong { color: #f00; }
	#admin-review-body .correct { color: #0f0; } */
	
</style>
<div style=" font-size: 13px; margin-top: 50px">
	<div id="admin-review-header">
		<div id="left"></div>
		<div id="right">
			<h2>REVIEW TEST RESULTS</h2>
			<div id="left-top">
				<p><b>Username: </b><?php echo $quiz_user['Quizzes']['user_name']; ?></p>
				<p><b>Date Taken: </b><?php echo date('M d, Y', strtotime($quiz_user['Quizzes']['datetime'])); ?></p>
				<p><?php echo ($quiz_user['Quizzes']['is_finished'] == 0) ? 'Undone' : 'Done'; ?></p>
			</div>
		</div>
	</div>
	<div id="admin-review-body">
		<div id="top"></div>
		<div id="content">
			<div id="box-content">
				<table id="review">
					<thead>
						<tr>
							<th></th>
							<th>#</th>
							<th>Question</th>
							<th>Answer</th>
							<th>Correct Answer/s</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php foreach($review_result as $rr) : ?>
						<?php
							if($i % 2 == 0) :
								$tr_id = 'even';
							elseif($i % 2 == 1) :
								$tr_id = 'odd';
							endif;
							
							if($rr['is_correct'] == 0) {
								$marked_class = 'wrong';
							} else {
								$marked_class = 'correct';
							}
						?>
						<tr id="<?php echo $tr_id; ?>">
							<td class="<?php echo $marked_class; ?>"><?php echo $rr['marked_string']; ?></td>
							<td><?php echo $i; ?></td>
							<td class="question-text"><?php echo $rr['question_text']; ?></td>
							<td class="answer"><?php echo $rr['answer']; ?></td>
							<td class="correct-answer"><?php echo $rr['correct_answer']; ?></td>
						</tr>
						<?php $i++; ?>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>