<?php

class Voter extends BaseModel {

	public $voterID, $username, $password, $firstName, $lastName, $email;

//	public function __construct($voterID, $username, $password, $firstName, $lastName, $email) {
//		$this->voterID = $voterID;
//		$this->username = $username;
//		$this->password = $password;
//		$this->firstName = $firstName;
//		$this->lastName = $lastName;
//		$this->email = $email;
//
//	}

	public function __construct($attributes){
    	parent::__construct($attributes);
  	}

	public static function AllVoters(){
		$voters = new array();

		$query = DB::connection()->prepare('select * from Voter')

		$query->execute();

		$rows = $query->fetchAll();

		foreach ($rows as $row) { $newVoter = new Voter(array(
			'voterID' = $row['voterID'];
			'username' = $row['username'];
			'password' = $row['password'];
			'firstName' = $row['firstName'];
			'lastName' = $row['lastName'];
			'email' = $row['email'];
			))
			

			array_push($voters, $newVoter);
		}

		return $voters;
	}

	public static function findByID($searchedID) {
		$query = DB::connection()->prepare('select * from Voter where voterid = :VoterID LIMIT 1');
		$query->execute(array('VoterID' => $searchedID));
		$row = $query->fetch();

		if($row){$newVoter = new Voter(array(
			'voterID' = $row['voterid'];
			'username' = $row['username'];
			'password' = $row['password'];
			'firstName' = $row['firstname'];
			'lastName' = $row['lastname'];
			'email' = $row['email'];
			))

			return $newVoter;

		}



		return null;
	}

	public static function makeVoter($username, $password, $firstName, $lastName, $email) {
		$query = DB::connection()->prepare('insert into Voter (username, password, firstName, lastName, email) values (:username, :password, :firstName, :lastName, :email) returning voterID');

		$query->execute(array('voterID' => $username, 'password' => $firstName, 'firstName' => $firstName, 'lastName' => $lastName, 'email' => $email));

		$row = $query->fetch();
		Kint::trace();
		Kint::dump($row);





	}

	public static function updateVoter() {
		
	}
}