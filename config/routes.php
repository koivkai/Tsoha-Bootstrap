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
