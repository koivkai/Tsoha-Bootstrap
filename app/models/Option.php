<?php
class Option extends BaseModel {
		public $name, $desc, $votes, $parentSerial;

		public function __construct($name, $desc, $votes, $parentSerial) {
		$this->name = $name;
		$this->desc = $desc;
		$this->votes = $votes;
		$this->parentSerial = $parentSerial;
		}
 
} 