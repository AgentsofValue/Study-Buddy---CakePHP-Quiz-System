<?php
class Choice extends AppModel {
	var $name = 'Choice';
	var $displayField = 'text';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Question' => array(
			'className' => 'Question',
			'foreignKey' => 'question_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function get_choices($question_id){
		
		return $this->find('list', array('conditions'=>"Choice.question_id=$question_id"));
	
	}
	
	function set_correct_answer($choice_id){
		
		foreach($choice_id as $choice){
			$this->updateAll(array('Choice.isCorrect'=>1), array('Choice.id'=>$choice));
		
		}
		
		
	
	}
	
	function get_current_correct($question_id=0){
		return $current_correct = $this->find('list', array('conditions'=>"Choice.question_id=$question_id AND Choice.isCorrect=1"));
			
		
	}
	
	function update_into_wrong($current_correct){
	
		foreach($current_correct as $key => $current){
			$this->updateAll(array('Choice.isCorrect'=>0), array('Choice.id'=>$key));
		}
		
	
	}
	
	function update_choice($choice, $id){
		//$this->updateAll(array('Choice.text'=>$choice), array('Choice.id'=>$id));
		$this->query("UPDATE choices SET text = '$choice' WHERE id = $id");
	}
	
	function get_correctness($answer){
		$correctness =  $this->find('first', array('field'=>'isCorrect', 'conditions'=>array('Choice.id'=>$answer)));
		return $correctness['Choice']['isCorrect'];
	}
	
	function get_chosen_answers($question_id){
		return $this->find('list', array('fields'=>'Choice.id', 'conditions'=>"Choice.question_id=$question_id AND Choice.isCorrect=1"));
	}
	
	function count_choices($question_id){
		return $this->find('count', array('conditions'=>"Choice.question_id=$question_id"));
	}
}


