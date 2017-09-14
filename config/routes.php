<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/joukkueet', function() {
    HelloWorldController::joukkueet();
  });
  
  $routes->get('/joukkueet/1', function() {
    HelloWorldController::esittely_joukkue();
  });
  
  $routes->get('/login', function() {
    HelloWorldController::login();
  });
  
  $routes->get('/joukkueet/1/muokkaus', function() {
    HelloWorldController::muokkaus_joukkue();
  });
  
  $routes->get('/joukkueet/1/pelaajamuokkaus', function() {
    HelloWorldController::muokkaus_pelaaja();
  });
