<?php

class PollController extends BaseController{

	public static function makePollList () {

		$polls = Poll::AllPolls();

		Kint::dump($polls);

		View::make('Polls/pollList.html', array('polls =>$polls'));
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

		Kint::dump($parametrit);

		$Poll->save();

	//	Redirect::to('/game/' . $game->id, array('message' => 'Peli on lisätty kirjastoosi!'));
	}  

}