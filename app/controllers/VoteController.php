<?php

class VoteController extends BaseController{
  
	public static function vote($optionID) {

		$option = Option::findByOptionID($optionID);

		$currentVotes = $option->currentVotes(); 

		Option::vote($optionID, $currentVotes);

		Redirect::to('/Polls', array('message' => 'Kiitos äänestämisestä!'));
	}

}