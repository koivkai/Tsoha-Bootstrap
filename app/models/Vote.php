<?php

class Vote extends BaseModel {
		public $caster, $castIn, $castDate;

		public function __construct($caster, $castIn, $castDate) {
		$this->caster = $caster;
		$this->castIn = $castIn;
		$this->castDate = $castDate;
		}
 
} 