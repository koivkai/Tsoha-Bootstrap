<?php

class Voter extends BaseModel {

	public $voterID, $voterName, $password, $firstName, $lastName, $email;

	public function __construct($voterID, $voterName, $password, $firstName, $lastName, $email) {
		$this->voterID = $voterID;
		$this->voterName = $voterName;
		$this->password = $password;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->email = $email;

	}

	public static function AllVoters(){
		$voters = new array();

		$query = DB::connection()->prepare('select * from Voters')

		$query->execute();

		$rows = $query->fetchAll();

		foreach ($rows as $row) {
			$id = $row['voterID'];
			$Vname = $row['voterName'];
			$password = $row['password'];
			$Fname = $row['firstName'];
			$Lname = $row['lastName'];
			$email = $row['email'];

			$newVoter = new Voter($id, $Vname, $password, $Fname, $Lname, $email);

			array_push($voters, $newVoter);
		}

		return $voters;
	}

	public static function findByID($searchedID) {
		$query = DB::connection()->prepare('select * from Voter where voterID = :searchedID LIMIT 1');
		$query->execute(array('VoterID' => $searchedID));
		$row = $query->fetch();

		if($row){
			$id = $row['voterID'];
			$Vname = $row['voterName'];
			$password = $row['password'];
			$Fname = $row['firstName'];
			$Lname = $row['lastName'];
			$email = $row['email'];

			$newVoter = new Voter($id, $Vname, $password, $Fname, $Lname, $email);

			return $newVoter;

		}



		return null;
	}

	public static function makeVoter($voterName, $password, $firstName, $lastName, $email) {
		$query = DB::connection()->prepare('insert into Voter (voterName, password, firstName, lastName, email) values (:voterName, :password, :firstName, :lastName, :email) returning voterID');

		$query->execute(array('voterID' => $voterName, 'password' => $firstName, 'firstName' => $firstName, 'lastName' => $lastName, 'email' => $email));

		$row = $query->fetch();
		Kint::trace();
		Kint::dump($row);





	}

	public static function updateVoter() {
		
	}
}