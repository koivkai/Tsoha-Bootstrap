<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/frontPage', function() {
    HelloWorldController::frontPage();
  });

  $routes->get('/pollCreator', function() {
    HelloWorldController::pollCreator();
  });

  $routes->get('/pollResults', function() {
    HelloWorldController::pollResults();
  });

  $routes->get('/votingPage', function() {
    HelloWorldController::votingPage();
  });


  $routes->get('/voterList', function() {
    HelloWorldController::voterList();
  });

  $routes->post('/Polls/vote/:id', function($id) {
    Kint::dump($id);
    VoteController::vote($id);
  });

  $routes->post('/Polls/makeNewOption', function() {
    OptionController::store();
  });

  $routes->get('/Polls', function() {
    PollController::makePollList();
  });

  $routes->post('/Polls/', function() {
    PollController::store();
  });

  $routes->post('/logout', function(){
  VoterController::logout();
  });



  $routes->get('/Polls/new', function() {
    PollController::newPoll();
  });

  $routes->get('/Polls/:id', function($id) {
    PollController::show($id);
  });

  $routes->get('/Polls/:id/addOption', function($id) {
    OptionController::newOption($id);
  });

  $routes->get('/Polls/votePage/:id', function($id) {
    PollController::makeVotePage($id);
  });

  $routes->get('/login', function(){
  // Kirjautumislomakkeen esittäminen
  VoterController::login();
  });

$routes->post('/login', function(){
  // Kirjautumisen käsittely
  VoterController::handle_login();
});

$routes->post('/reqister', function(){
  // Kirjautumisen käsittely
  VoterController::store();
});

$routes->get('/reqister', function(){
  // Kirjautumislomakkeen esittäminen
  VoterController::makeReqisterationPage();
  });




  
