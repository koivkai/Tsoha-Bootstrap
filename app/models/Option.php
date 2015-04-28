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

		Kint::dump($options);

		return $options;
 		}

 		public function save(){
    
    		$query = DB::connection()->prepare('INSERT INTO Option (optionname, optiondesc, votesreceived, parentpoll) VALUES (:name, :optiondesc, :votesreceived, :parentpoll) returning optionid');
    		$query->execute(array('name' => $this->name, 'optiondesc' => $this->desc, 'votesreceived' => 0, 'parentpoll' => $this->parentPoll));
 
   		 	$row = $query->fetch();

//    Kint::trace();
//    Kint::dump($row);
 
    		$this->optionID = $row['optionid'];
  		}

  		

  		public static function findByOptionID($searchedID) { // tietty vaihtoehto
		$query = DB::connection()->prepare('select * from Options where optionid= :optionid order by votesreceived DESC');
		$query->execute(array('optionid' => $searchedID));
		$row = $query->fetch();

		

		Kint::dump($row);

		

			$option = new Option(array(
				'desc' => $row['optiondesc'],
				'name' => $row['optionname'],
				'votes' => $row['votesreceived'],
				'parentPoll' => $row['parentpoll'],
				'optionID' => $row['optionid']
				
			));

		

		Kint::dump($option);

		return $option;
 		}

 		public static function vote($id, $current) {
 			$current++;

 			$query = DB::connection()->prepare('UPDATE Option SET votesreceived = :current WHERE optionid = :id');
    		$query->execute(array('id' => $id, 'current' => $current));

 		}

 		public function currentVotes() {
 			$cVotes = $this->votes;

 			return $cVotes;
 		}
} 