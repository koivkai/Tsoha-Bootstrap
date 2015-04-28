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

  $routes->get('/loginPage', function() {
    HelloWorldController::loginPage();
  });

  $routes->get('/voterList', function() {
    HelloWorldController::voterList();
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

  $routes->post('/Polls/vote/:id', function($id) {
    VoteController::vote($id);
  });
