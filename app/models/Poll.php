<?php

class Poll extends BaseModel {

	public $pollID, $name, $startDate, $endDate, $visibility;



	public function __construct($attributes){
    	parent::__construct($attributes);
  	}

	public static function AllPolls(){
		
		$query = DB::connection()->prepare('select * from Poll');

		$query->execute();

		$rows = $query->fetchAll();

		$polls = array();


		foreach ($rows as $row) {

			$polls[] = new Poll(array(
				'pollID' => $row['pollid'],
				'name' => $row['name'],
				'startDate' => $row['startdate'],
				'endDate' => $row['enddate'],
				'visibility' => $row['visibility']
			));

		}

		return $polls;
	}

	public static function findByID($searchedID) {
		$query = DB::connection()->prepare('select * from Poll where pollid= :pollID LIMIT 1');
		$query->execute(array('pollID' => $searchedID));
		$row = $query->fetch();

		if($row){ $poll = new Poll(array(
			'pollID' => $row['pollid'],
			'name' => $row['name'],
			'startDate' => $row['startdate'],
			'endDate' => $row['enddate'],
			'visibility' => $row['visibility']
			));	
			
		return $poll;

		}



		return null;
	}

	

	public function save(){
    
    	$query = DB::connection()->prepare('INSERT INTO Poll (name, startdate, enddate, visibility) VALUES (:name, :startdate, :enddate, :visibility) returning pollid');
    	$query->execute(array('name' => $this->name, 'startdate' => $this->startDate, 'enddate' => $this->endDate, 'visibility' => $this->visibility));
 
   		 $row = $query->fetch();

//    Kint::trace();
//    Kint::dump($row);
 
    	$this->pollID = $row['pollid'];
  	}

	public static function update() {
		
	}

	public function valitade_name() {
		$errors = array();

		$nameToValidate = $this->name;

		$maxLtestScore = BaseModel::validate_max_lenght($nameToValidate, 50);
		$minLtestScore = BaseModel::validate_min_lenght($nameToValidate, 1);

		if (!$maxLtestScore) {
			array_push($errors, 'Nimen pitää olla 1-50 merkkiä pitkä');
		}

		if (!$minLtestScore) {
			array_push($errors, 'Nimen pitää olla 1-50 merkkiä pitkä');
		}

		return $errors;
	}

	public function validate_visibility() {
		$errors = array();

		$visibilityToValidate = $this->visibility;

		$minLtestScore = BaseModel::validate_min_lenght($nameToValidate, 1);

		if (!$minLtestScore) {
			array_push($errors, 'Näkyvyyttä ei ole määritelty');
			return $errors;
		}

		if (preg_match("(A|N|T)", $visibilityToValidate)) {

		} else {
			array_push($errors, 'Näkyvyys on määritelty väärin. Sallitut arvot: A, T, N');
		}

		return $errors;
	}

	public function validate_startDate() {
		$errors = array();

		$sDateToValidate = $this->startDate;

		$isADatetestScore = BaseModel::validate_is_a_date($sDateToValidate);

		if (!$isADatetestScore) {
			array_push($errors, 'Päivämäärä tulee antaa muodossa yyyy-mm-dd');
		}
		return $errors;
	}

	public function validate_endDate() {
		$errors = array();

		$eDateToValidate = $this->endDate;

		$isADatetestScore = BaseModel::validate_is_a_date($eDateToValidate);

		if (!$isADatetestScore) {
			array_push($errors, 'Päivämäärä tulee antaa muodossa yyyy-mm-dd');
		}
		return $errors;
	}
}
