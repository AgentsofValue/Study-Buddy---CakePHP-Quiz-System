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