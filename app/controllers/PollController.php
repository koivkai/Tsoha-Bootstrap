<?php

class PollController extends BaseController{

	public static function makePollList () {

		$polls = Poll::AllPolls();

		Kint::dump($polls);

		View::make('Polls/pollList.html', array('polls' => $polls));
	}

	public static function newPoll() {
		View::make('Polls/pollCreation.html');

	}
  
	public static function store() {
		$parametrit = $_POST;

		$Poll = new Poll(array(
      		'name' => $parametrit['name'],
      		'startDate' => $parametrit['startDate'],
      		'endDate' => $parametrit['endDate'],
      		'visibility' => $parametrit['visibility']
   		 ));

//		Kint::dump($parametrit);

		$Poll->save();

		Redirect::to('/Polls', array('message' => 'Äänestys lisätty!'));
	}  

	public static function edit($id){
    	$poll = Poll::findByID($id);
    	View::make('Poll/editPoll.html', array('attributes' => $game));
  	}

  	public static function update($id){
    $params = $_POST;

    $attributes = array(
      'pollID' => $id,
      'name' => $params['name'],
      'startDate' => $params['startDate'],
      'endDate' => $params['endDate'],
      'published' => $params['published'],
      'visibility' => $params['visibility']
    );

    // Alustetaan olio käyttäjän syöttämillä tiedoilla
    $poll = new Poll($attributes);
    $errors = $poll->errors();

    if(count($errors) > 0){
      View::make('Polls/editPoll.html', array('errors' => $errors, 'attributes' => $attributes));
    }else{
      // Kutsutaan alustetun olion update-metodia, joka päivittää pelin tiedot tietokannassa
      $poll->update();

      Redirect::to('/Polls/' , array('message' => 'Peliä on muokattu onnistuneesti!'));
    }
  }

  public static function show($id) {
    $poll = Poll::findByID($id);

    Kint::dump($poll);

    $options = Option::findByID($id);

    Kint::dump($options);

    View::make('Polls/pollResults.html',  array('options' => $options, 'Poll' => $poll));
  }

}