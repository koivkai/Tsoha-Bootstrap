<?php

class Voter extends BaseModel {

	public $voterID, $username, $password, $firstname, $lastname, $email;



	public function __construct($attributes){
    	parent::__construct($attributes);
  	}

  	public static function authenticate($username, $password) {

  		Kint::dump($username);
  		Kint::dump($password);

  		$query = DB::connection()->prepare('SELECT * FROM Voter WHERE username = :name AND password = :password LIMIT 1');
		$query->execute(array('name' => $username, 'password' => $password));
		$row = $query->fetch();
		Kint::dump($row);
		if($row){

			$voter = new Voter(array(
				'voterID' => $row['voterid'],
				'username' => $row['username'],
				'password' => $row['password'],
				'firstname' => $row['firstname'],
				'lastname' => $row['lastname'],
				'email' => $row['email']
			));

			return $voter;
  			
		}else{
  			return null;
		}

  	}

  	public function save(){
    
    	$query = DB::connection()->prepare('INSERT INTO Voter (username, password, firstname, lastname, email) VALUES (:username, :password, :firstname, :lastname, :email) returning voterid');
    	$query->execute(array('username' => $this->username, 'password' => $this->password, 'firstname' => $this->firstname, 'lastname' => $this->lastname, 'email' => $this->email));
 
   		 $row = $query->fetch();

//    Kint::trace();
//    Kint::dump($row);
 
    	$this->voterID = $row['voterid'];
  	}

  	public static function findByID($searchedID) {
		$query = DB::connection()->prepare('select * from Voter where voterid= :voterid LIMIT 1');
		$query->execute(array('voterid' => $searchedID));
		$row = $query->fetch();

		if($row){ $voter = new Voter(array(
			'voterID' => $row['voterid'],
			'username' => $row['username'],
			'password' => $row['password'],
			'firstname' => $row['firstname'],
			'lastname' => $row['lastname'],
			'email' => $row['email']
			));	
			
		return $voter;

		}



		return null;
	}



	public static function updateVoter() {
		
	}
}