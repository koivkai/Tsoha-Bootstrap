<?php
class Option extends BaseModel {
		public $optionID, $name, $desc, $votes, $parentPoll;

		public function __construct($attributes){
    	parent::__construct($attributes);
  		}

  		public static function findByID($searchedID) { // kaikki tietyn Äänestyksen vaihtoehdot
		$query = DB::connection()->prepare('select * from Options where parentpoll= :pollID order by votesreceived DESC');
		$query->execute(array('pollID' => $searchedID));
		$rows = $query->fetchAll();

		$options = array();

		Kint::dump($rows);

		foreach ($rows as $row) {

			$options[] = new Option(array(
				'desc' => $row['optiondesc'],
				'name' => $row['optionname'],
				'votes' => $row['votesreceived'],
				'parentPoll' => $row['parentpoll'],
				'optionID' => $row['optionid']
				
			));

		}

		return $options;
 		}

 		public function save(){
    
    	$query = DB::connection()->prepare('INSERT INTO Option (optionname, optiondesc, votesreceived, parentpoll) VALUES (:name, :optiondesc, '0', :parentpoll) returning optionid');
    	$query->execute(array('name' => $this->name, 'optiondesc' => $this->desc, 'parentpoll' => $this->parentPoll));
 
   		 $row = $query->fetch();

//    Kint::trace();
//    Kint::dump($row);
 
    	$this->optionID = $row['optionid'];
  	}
} 