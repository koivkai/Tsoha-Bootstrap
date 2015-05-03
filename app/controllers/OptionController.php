<?php

class OptionController extends BaseController{
  
	public static function store() {
		$parametrit = $_POST;

		$option = new Option(array(
      		'name' => $parametrit['name'],
      		'desc' => $parametrit['optiondesc'],
      		'parentPoll' => $parametrit['parentPoll']
      		
   		 ));


		$option->save();

    $parentPoll = $parametrit['parentPoll'];

		Redirect::to('/Polls/' . $parentPoll . '/optionList', array('message' => 'Vaihtoehto lisätty!'));
	}

	public static function newOption($id) {
		self::check_logged_in();

		$poll = Poll::findByID($id);

		View::make('/Polls/optionCreate.html' , array('poll' => $poll));
	}

	public static function makeOptionList($id) {
    	self::check_logged_in();
    	$poll = Poll::findByID($id);

    	$user = self::get_user_logged_in();
      	$userid = $user->voterID;
      	$ownerid = $poll->ownerid;
      	
      	if ($userid === $ownerid) {
      		$options = Option::findByID($id);

    		View::make('Polls/optionList.html',  array('options' => $options, 'Poll' => $poll));
      	} else {
        	Redirect::to('/Polls/myPolls' , array('message' => 'Virhe: Valitsemasi äänestys ei näytä kuuluvan sinulle.'));
      	}


    	
  	}

  	public static function edit($id){
      	self::check_logged_in();

    	$option = Option::findByOptionID($id);

      	$user = self::get_user_logged_in();
      	$userid = $user->voterID;
      	$parentPoll = $option->parentPoll;
      	$poll = Poll::findByID($parentPoll);
      	$ownerid = $poll->ownerid;

      	if ($userid === $ownerid) {
        	View::make('Polls/optionEdit.html', array('option' => $option));
      	} else {
        	Redirect::to('/Polls/myPolls' , array('message' => 'Virhe: Valitsemasi äänestys ei näytä kuuluvan sinulle.'));
      	}

    	
  	}

  	public static function update($id){

      self::check_logged_in();

      $params = $_POST;

      $attributes = array(
        'optionID' => $id,
        'name' => $params['name'],
        'desc' => $params['optiondesc'],
        'parentPoll' => $params['parentPoll']
      );

    
      $option = new Option($attributes);

     $parentPoll = $option->parentPoll;

 //     $errors = $poll->errors();

 //     if(count($errors) > 0){
   //     View::make('Polls/editPoll.html', array('errors' => $errors, 'poll' => $poll));
  //    }else{
      
        $option->update();

        Redirect::to('/Polls/' . $parentPoll . '/optionList' , array('message' => 'Vaihtoehtoa on muokattu onnistuneesti!'));
     // }
  	}  

  	public static function destroy($id) {
    	$option = Option::findByOptionID($id);
      $parentPoll = $option->parentPoll;
    	$option->destroy();

    	Redirect::to('/Polls/' . $parentPoll . '/optionList' , array('message' => 'Vaihtoehto poistettu.'));
  	}



}