<?php
namespace modules\content\models;
use models\_tree as b;
class base extends b{
	 public $get_lists_name = 'index';
	 public $get_form_name = 'index';
	 public $fields;

	 function get_fields(){
	 	return $this->fields;
	 }

	 function get_lists_name(){
	 	return $this->get_lists_name;
	 }

	 function get_form_name(){
	 	return $this->get_form_name;
	 }
	
	
}