<?php
class Topic extends AppModel {
	var $name = 'Topic';
	var $displayField = 'title';
	var $validate = array(
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'items' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => '',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Question' => array(
			'className' => 'Question',
			'foreignKey' => 'topic_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	function select(){
		return $this->find('list');
	
	}
	function get_all(){
		$this->recursive = 1;
		$this->unbindModel( array('hasMany' => array('Question')) );
		return $this->find('all');
	
	}
	
	function get_one_topic($topic_id=0){
		$this->recursive = 1;
		$this->unbindModel( array('hasMany' => array('Question')) );
		return $this->find('first', array('conditions'=>"Topic.id=$topic_id"));
	}
	
	function update_topic($data, $topic_id=0){
		$this->updateAll(array('Topic.title'=>"'".$data['Topic']['title']."'", 'Topic.items'=>$data['Topic']['items']), array('Topic.id'=>$topic_id));
		//$this->query("UPDATE topics SET title = '$data['Topic']['title']', items = '$data['Topic']['items']' WHERE id = $topic_id");
	}
	function get_items($topic_id){
		return $this->find('first', array('conditions'=>"Topic.id=$topic_id"));
		
	}
	
/*	
	function delete_topic($topic_id=0){
		$this->deleteAll(array('Topic.id'=>$topic_id));
	}
*/
}
