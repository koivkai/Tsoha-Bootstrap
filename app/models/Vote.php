<?php

class Vote extends BaseModel {
		public $voteid, $caster, $castin, $castdate;

		public function __construct($attributes){
    		parent::__construct($attributes);
  		}

  		public function save(){
    
    		$query = DB::connection()->prepare('INSERT INTO Vote (caster, castin, castdate) VALUES (:caster, :castin, :castdate) returning voteid');
    		$query->execute(array('caster' => $this->caster, 'castin' => $this->castin, 'castdate' => $this->castdate));
 
   			$row = $query->fetch();

    		$this->voteid = $row['voteid'];
		}

		public static function hasVoted($pollid, $userid) {
			$query = DB::connection()->prepare('SELECT * FROM Vote WHERE caster= :caster AND castin = :castin');
			$query->execute(array('caster' => $userid, 'castin' => $pollid));
			$row = $query->fetch();

			if($row){ 
			
				return true;

			}



			return false;
			}
 
} 