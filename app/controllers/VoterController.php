<?php

class VoterController extends BaseController{
  	
  	public static function login(){
      View::make('user/loginPage.html');
  	}
  	public static function handle_login(){
    	$params = $_POST;

    	$user = Voter::authenticate($params['username'], $params['password']);

    	if(!$user){
      	View::make('user/loginPage.html', array('message' => 'Väärä käyttäjätunnus tai salasana!'));
    	}else{
      		$_SESSION['user'] = $user->voterID;

      		Redirect::to('/Polls', array('message' => 'Tervetuloa takaisin ' . $user->firstname . '!'));
    	}
  	}

  	public static function logout(){
    	$_SESSION['user'] = null;
    	Redirect::to('/login', array('message' => 'Olet kirjautunut ulos!'));
  	}

  	public static function makeReqisterationPage() {
  		View::make('user/reqisteration.html');
  	}

  	public static function store() {
		$parametrit = $_POST;

		$voter = new Voter(array(
      		'username' => $parametrit['username'],
      		'password' => $parametrit['password'],
      		'firstname' => $parametrit['firstname'],
      		'lastname' => $parametrit['lastname'],
      		'email' => $parametrit['email']
   		 ));

//		Kint::dump($parametrit);

		$voter->save();

		Redirect::to('/Polls', array('message' => 'Rekisteröityminen onnistui'));
	}  

}