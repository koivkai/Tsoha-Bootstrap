<?php

class voterController extends BaseController {
	public static function index() {
		$voters = Voter::AllVoters();

		View::make('voter/voterList.html', array('voters' => $voters));
	}
}