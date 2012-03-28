<?php
class Option extends AppModel {

	var $name = 'Option';
	
	function getOption($name) {
		$value = null;
		
		$options = $this->findByName($name);
		if(!empty($options)) {
			$value = $options['Option']['value'];
			
			// return false if the value of selected option is empty or null
			if($value == '' || $value == null) {
				return false;
			}
		}
		
		if(@unserialize($value) !== false) {
			return unserialize($value);
		}
		
		return $value;
	}
	
	function setOption($name, $value, $isnew = true) {
		if(is_array($value)) {
			$value = serialize($value);
		}
		if($isnew) {
		
			$this->create();
			$this->data['Option'] = array('name' => $name, 'value' => $value);
				return true;
			if($this->save($this->data)) {
			}
		} else {
			$oldvalue = $this->getOption($name);
			
			// No need to update the option since it's the same.
			if($oldvalue == $value) {
				return false;
			}
			
			$options = $this->findByName($name);
			$this->id = $options['Option']['id'];
			if($this->saveField('value', $value)) {
				return true;
			}
		}
		
		return false;
	}
}