<?php

class VoteController extends BaseController{
  
	public static function vote($optionID) {
		self::check_logged_in();
		
		$option = Option::findByOptionID($optionID);

		$pollid = $option->parentPoll;
		$user = self::get_user_logged_in();
    	$userid = $user->voterID;

    	if (!Vote::hasVoted($pollid, $userid)) {
    		$currentVotes = $option->currentVotes(); 

			Option::vote($optionID, $currentVotes);

			$castdate = date("Y-m-d");

			$vote = new Vote(array(
			'caster' => $userid,
			'castin' => $pollid,
			'castdate' => $castdate
			));

			$vote->save();

			Redirect::to('/Polls/results/' . $pollid, array('message' => 'Kiitos äänestämisestä!'));
    	} else {
    		Redirect::to('/Polls', array('message' => 'Olet jo osallistunut tähän äänestykseen.'));
    	}


		
	}

}