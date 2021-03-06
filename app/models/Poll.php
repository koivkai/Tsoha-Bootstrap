<?php

class Poll extends BaseModel {

	public $pollID, $name, $startDate, $endDate, $visibility, $ownerid;



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
				'visibility' => $row['visibility'],
				'ownerid' => $row['ownerid']
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
			'visibility' => $row['visibility'],
			'ownerid' => $row['ownerid']
			));	
			
		return $poll;

		}



		return null;
	}

	public static function findByOwnerID($searchedID) {
		$query = DB::connection()->prepare('select * from Poll where ownerid= :ownerid');
		$query->execute(array('ownerid' => $searchedID));
		$rows = $query->fetchAll();

		$polls = array();

		foreach ($rows as $row) {

			$polls[] = new Poll(array(
				'pollID' => $row['pollid'],
				'name' => $row['name'],
				'startDate' => $row['startdate'],
				'endDate' => $row['enddate'],
				'visibility' => $row['visibility'],
				'ownerid' => $row['ownerid']
			));

		}

		return $polls;

	}

	

	public function save(){
    
    	$query = DB::connection()->prepare('INSERT INTO Poll (name, startdate, enddate, visibility, ownerid) VALUES (:name, :startdate, :enddate, :visibility, :ownerid) returning pollid');
    	$query->execute(array('name' => $this->name, 'startdate' => $this->startDate, 'enddate' => $this->endDate, 'visibility' => $this->visibility, 'ownerid' => $this->ownerid));
 
   		 $row = $query->fetch();
 
    	$this->pollID = $row['pollid'];
  	}

	public function update() {
		$query = DB::connection()->prepare('UPDATE Poll SET name = :name, startdate = :startdate, enddate = :enddate, visibility = :visibility WHERE pollid = :pollid');
    	$query->execute(array('name' => $this->name, 'startdate' => $this->startDate, 'enddate' => $this->endDate, 'visibility' => $this->visibility, 'pollid' => $this->pollID));
	}

	public function destroy() {
		$query = DB::connection()->prepare('DELETE FROM Poll WHERE pollid = :pollid');
    	$query->execute(array('pollid' => $this->pollID));
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

		$startdate = $this->startDate;

		if($startDate > $eDateToValidate) {
			array_push($errors, 'Äänestyksen loppupäivän tulee olla alkupäivää myöhempi päivämäärä');
		}

		return $errors;
	}
}
