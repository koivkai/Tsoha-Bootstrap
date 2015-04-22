<?php

class Poll extends BaseModel {

	public $pollID, $name, $startDate, $endDate, $visibility;

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
			$id = $row['pollid'],
			$Vname = $row['name'],
			$password = $row['startdate'],
			$Fname = $row['enddate'],
			$visibility => $row['visibility']
			));	
			
		return $poll;

		}



		return null;
	}

	

	public function save(){
    
    $query = DB::connection()->prepare('INSERT INTO Poll (name, startdate, enddate, visibility) VALUES (:name, :startdate, :enddate, :visibility) returning pollid');
    $query->execute(array('name' => $this->name, 'startdate' => $this->startDate, 'enddate' => $this->endDate, 'visibility' => $this->visibility));
 
    $row = $query->fetch();

    Kint::trace();
    Kint::dump($row);
 
    $this->pollID = $row['pollid'];
  	}

	public static function updatePoll() {
		
	}
}
