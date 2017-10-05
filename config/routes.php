<?php


/*
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
  */
  
  
  
  //Pelaaja
  $routes->post('/pelaajat', function(){
      PelaajaController::store();
  });
  
  $routes->get('/pelaajat/uusi', function(){
      PelaajaController::create();
  });
  
  $routes->get('/pelaajat', function() {
      PelaajaController::index();
  });
  
  $routes->get('/pelaajat/:id', function($id) {
      PelaajaController::esittely($id);
  });
  
  $routes->get('/pelaajat/:id/muokkaus', function($id){
  PelaajaController::edit($id);
  });
  
  $routes->post('/pelaajat/:id/muokkaus', function($id){
  PelaajaController::update($id);
  });
  
  $routes->post('/pelaajat/:id/destroy', function($id){
  PelaajaController::destroy($id);
  });
  
  //User

  
  
  
  
  
  
