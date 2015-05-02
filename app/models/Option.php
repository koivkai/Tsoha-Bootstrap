<?php
class Option extends BaseModel {
		public $optionID, $name, $desc, $votes, $parentPoll;

		public function __construct($attributes){
    		parent::__construct($attributes);
  		}

  		public static function findByID($searchedID) { // kaikki tietyn Äänestyksen vaihtoehdot
			$query = DB::connection()->prepare('select * from Option where parentpoll = :pollID order by votesreceived DESC');
			$searchedID = intval($searchedID);
			$query->execute(array('pollID' => $searchedID));
			$rows = $query->fetchAll();

			$options = array();

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
    
    		$query = DB::connection()->prepare('INSERT INTO Option (optionname, optiondesc, votesreceived, parentpoll) VALUES (:name, :optiondesc, :votesreceived, :parentpoll) returning optionid');
    		$query->execute(array('name' => $this->name, 'optiondesc' => $this->desc, 'votesreceived' => 0, 'parentpoll' => $this->parentPoll));
 
   		 	$row = $query->fetch();
 
    		$this->optionID = $row['optionid'];
  		}

  		

  		public static function findByOptionID($searchedID) { // tietty vaihtoehto
			$query = DB::connection()->prepare('SELECT * from Option where optionid= :optionid');
			$query->execute(array('optionid' => $searchedID));
			$row = $query->fetch();		

			$option = new Option(array(
				'desc' => $row['optiondesc'],
				'name' => $row['optionname'],
				'votes' => $row['votesreceived'],
				'parentPoll' => $row['parentpoll'],
				'optionID' => $row['optionid']
				
			));

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

 		public function destroy() {
			$query = DB::connection()->prepare('DELETE FROM Option WHERE optionid = :optionid');
    		$query->execute(array('optionid' => $this->optionID));
		}

 		public function update() {
			$query = DB::connection()->prepare('UPDATE Option SET optionname = :name, optiondesc = :optiondesc WHERE optionid = :optionid');
    		$query->execute(array('name' => $this->name, 'optiondesc' => $this->desc, 'optionid' => $this->optionID));
		}

} 