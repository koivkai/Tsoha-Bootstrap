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

  $routes->get('/Polls/myPolls', function() {
    PollController::makeUserPollList();
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

  $routes->get('/Polls/:id/optionList', function($id) {
    OptionController::makeOptionList($id);
  });

  $routes->get('/Polls/votePage/:id', function($id) {
    PollController::makeVotePage($id);
  });

  $routes->get('/Polls/results/:id', function($id) {
    PollController::makeResultsPage($id);
  });

  $routes->get('/login', function(){
    VoterController::login();
  });

  $routes->post('/login', function(){
    VoterController::handle_login();
  });

  $routes->post('/reqister', function(){
    VoterController::store();
  });

  $routes->get('/reqister', function(){
    VoterController::makeReqisterationPage();
  });

  $routes->get('/Polls/:id/edit', function($id){
    PollController::edit($id);
  });

  $routes->post('/Polls/:id/edit', function($id){
    PollController::update($id);
  });

  $routes->post('/Polls/:id/destroy', function($id){
    PollController::destroy($id);
  });

  $routes->get('/Polls/editOption/:id', function($id){
    OptionController::edit($id);
  });

  $routes->post('/Polls/editOption/:id', function($id){
    OptionController::update($id);
  });

  $routes->post('/Polls/destroyOption/:id', function($id){
    OptionController::destroy($id);
  });




  
