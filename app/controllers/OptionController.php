<?php

class OptionController extends BaseController{
  
	public static function store() {
		$parametrit = $_POST;

		$option = new Option(array(
      		'name' => $parametrit['name'],
      		'desc' => $parametrit['optiondesc'],
      		'parentID' => $parametrit['parenID'],
      		'visibility' => $parametrit['visibility']
   		 ));

//		Kint::dump($parametrit);

		$option->save();

		Redirect::to('/Poll/pollOptionEdit', array('message' => 'Äänestys lisätty!'));
	}  

}