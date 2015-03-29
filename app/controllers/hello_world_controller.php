<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('suunnitelmat/frontPage.html');;
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      View::make('helloworld.html');;
    }

    public static function frontPage(){
      // Testaa koodiasi täällä
      View::make('suunnitelmat/frontPage.html');;
    }

    public static function pollCreator(){
      // Testaa koodiasi täällä
      View::make('suunnitelmat/pollCreator.html');;
    }

    public static function pollResults(){
      // Testaa koodiasi täällä
      View::make('suunnitelmat/pollResults.html');;
    }

    public static function votingPage(){
      // Testaa koodiasi täällä
      View::make('suunnitelmat/votingPage.html');;
    }

    public static function loginPage(){
      // Testaa koodiasi täällä
      View::make('suunnitelmat/loginPage.html');;
    }

    public static function voterList() {
    $voters = Voter::AllVoters();

    View::make('voter/voterList.html', array('voters' => $voters));
    }

    public static function voterEdit(){
    
    $params = $_POST;

    $voterName => $params['voterName'],
    $password => $params['password'],
    $firstName => $params['firstName'],
    $lastName => $params['lastName']
    $lemail => $params['email']
    
    Voter::update(); //TODO

    Redirect::to('/suunnitelmat/fronPage')
  }

  }
