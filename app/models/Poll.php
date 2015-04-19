<?php

class Poll extends BaseModel {

	public $pollID, $name, $startDate, $endDate;

//	public function __construct($name, $startDate, $endDate) {
//		
//		$this->name = $name;
//		$this->startDate = $startDate;
//		$this->endDate = $endDate;
//		
//	}

	public function __construct($attributes){
    	parent::__construct($attributes);
  	}

	public static function AllPolls(){
		$polls = new array();

		$query = DB::connection()->prepare('select * from Poll')

		$query->execute();

		$rows = $query->fetchAll();

		foreach ($rows as $row) {
			$pollID = $row['pollID'];
			$name = $row['name'];
			$startDate = $row['startDate'];
			$endDate = $row['endDate'];
			


			$newPoll = new Poll(array('pollID' => $pollID, 'name' => $name, 'startDate' => $startDate, 'endDate' =>$endDate));
			
			array_push($polls, $newPoll);
		}

		return $polls;
	}

//	public static function findByID($searchedID) {
//		$query = DB::connection()->prepare('select * from Voter where voterID = :VoterID LIMIT 1');
//		$query->execute(array('VoterID' => $searchedID));
//		$row = $query->fetch();
//
//		if($row){	
//			$id = $row['voterID'];
//			$Vname = $row['voterName'];
//			$password = $row['password'];
//			$Fname = $row['firstName'];
//			$Lname = $row['lastName'];
//			$email = $row['email'];
//
//			$newVoter = new Voter($id, $Vname, $password, $Fname, $Lname, $email);
//
//			return $newVoter;
//
//		}
//
//
//
//		return null;
//	}

	public static createPoll($name, $startDate, $endDate) {
		$query = DB::connection()->prepare('insert into Poll (name, startDate, endDate, ) values (:name, :startDate, :endDate)');

		$query->execute(array('name' => $name, 'startDate' => $startDate, 'endDate' => $endDate));

		




	}

	public function addToDBase () {
		$query = DB::connection()->prepare('insert into Poll (name, startDate, endDate, ) values (:name, :startDate, :endDate)');

		$query->execute(array('name' => $this->name, 'startDate' => $this->startDate, 'endDate' => $this->endDate));

	}

	public static function updatePoll() {
		
	}
}
