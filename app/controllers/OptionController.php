<?php

class OptionController extends BaseController{
  
	public static function store() {
		$parametrit = $_POST;

		$option = new Option(array(
      		'name' => $parametrit['name'],
      		'desc' => $parametrit['optiondesc'],
      		'parentPoll' => $parametrit['parentPoll']
      		
   		 ));

		Kint::dump($parametrit);

		Kint::dump($option);

		$option->save();

		Redirect::to('/Polls', array('message' => 'Vaihtoehto lisätty!'));
	}

	public static function newOption($id) {
		self::check_logged_in();

		$poll = Poll::findByID($id);

		Kint::dump($poll);

		View::make('/Polls/optionCreate.html' , array('poll' => $poll));
	}  

}