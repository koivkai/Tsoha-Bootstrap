<?php

class PollController extends BaseController{

	public static function makePollList () {

		$polls = Poll::AllPolls();

		View::make('Polls/pollList.html', array('polls' => $polls));
	}

  public static function makeResultList () {

    $polls = Poll::AllPolls();

    View::make('Polls/pollResultList.html', array('polls' => $polls));
  }

  public static function makeUserPollList() {
    self::check_logged_in();

    $user = self::get_user_logged_in();
    $ownerid = $user->voterID;

    $polls = Poll::findByOwnerID($ownerid);

    View::make('Polls/myPolls.html', array('polls' => $polls));
  }

	public static function newPoll() {
    self::check_logged_in();

		View::make('Polls/pollCreation.html');

	}
  
	public static function store() {
    self::check_logged_in();

		$parametrit = $_POST;

		$Poll = new Poll(array(
      		'name' => $parametrit['name'],
      		'startDate' => $parametrit['startDate'],
      		'endDate' => $parametrit['endDate'],
      		'visibility' => $parametrit['visibility']
   		 ));

    $user = self::get_user_logged_in();
    $ownerid = $user->voterID;
    $Poll->ownerid = $ownerid;

		$Poll->save();

		Redirect::to('/Polls/myPolls', array('message' => 'Äänestys lisätty!'));
	}  

	public static function edit($id){
      self::check_logged_in();

    	$poll = Poll::findByID($id);

      $user = self::get_user_logged_in();
      $userid = $user->voterID;
      $ownerid = $poll->ownerid;

      if ($userid === $ownerid) {
        View::make('Polls/pollEdit.html', array('poll' => $poll));
      } else {
        Redirect::to('/Polls/myPolls' , array('message' => 'Virhe: Valitsemasi äänestys ei näytä kuuluvan sinulle.'));
      }

    	
  	}

  	public static function update($id){

      self::check_logged_in();

      $params = $_POST;

      $attributes = array(
        'pollID' => $id,
        'name' => $params['name'],
        'startDate' => $params['startDate'],
        'endDate' => $params['endDate'],
        'visibility' => $params['visibility']
      );

    
      $poll = new Poll($attributes);

      $user = self::get_user_logged_in();
      $ownerid = $user->voterID;
      $Poll->ownerid = $ownerid;

 //     $errors = $poll->errors();

 //     if(count($errors) > 0){
   //     View::make('Polls/editPoll.html', array('errors' => $errors, 'poll' => $poll));
  //    }else{
      
        $poll->update();

        Redirect::to('/Polls/myPolls' , array('message' => 'Äänestystä on muokattu onnistuneesti!'));
     // }
  }

  public static function destroy($id) {
    $poll = Poll::findByID($id);

    $poll->destroy();

    Redirect::to('/Polls/myPolls' , array('message' => 'Äänestys poistettu.'));
  }

  public static function show($id) {
    $poll = Poll::findByID($id);

    $options = Option::findByID($id);

    View::make('Polls/pollResults.html',  array('options' => $options, 'Poll' => $poll));
  }

  public static function makeVotePage($id) {
    self::check_logged_in();
    $poll = Poll::findByID($id);

    $options = Option::findByID($id);

    View::make('Polls/pollVotepage.html',  array('options' => $options, 'Poll' => $poll));
  }

  public static function makeResultsPage($id) {
    
    $poll = Poll::findByID($id);

    $options = Option::findByID($id);

    View::make('Polls/pollResults.html',  array('options' => $options, 'Poll' => $poll));
  }

}