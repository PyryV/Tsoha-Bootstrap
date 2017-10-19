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
  $routes->get('/login', function(){
      KayttajaController::login();
  });
  
  $routes->post('/login', function(){
      KayttajaController::handle_login();
  });
  
  $routes->get('/', function(){
    KayttajaController::home();
  });
  
  $routes->post('/logout', function(){
      KayttajaController::logout();
  });
  
  $routes->get('/uusi_kayttaja', function(){
  KayttajaController::create();
  });
  
  $routes->post('/uusi_kayttaja', function(){
  KayttajaController::store();
  });
  
  //Joukkue
  
  $routes->post('/joukkueet/uusi', function(){
      JoukkueController::store();
  });
  
  $routes->get('/joukkueet/uusi', function(){
      JoukkueController::create();
  });
  
  $routes->get('/joukkueet', function(){
      JoukkueController::index();
  });
  
  $routes->get('/joukkueet/:id', function($id){
      JoukkueController::esittely($id);
  });
  
  $routes->post('/joukkueet/:id/muokkaus', function($id){
      JoukkueController::update($id);
  });
  
  $routes->get('/joukkueet/:id/muokkaus', function($id){
      JoukkueController::edit($id);
  });
  
  $routes->post('/joukkueet/:id/destroy', function($id){
      JoukkueController::destroy($id);
  });
  
  $routes->get('/joukkueet/:id/lisaa_pelaaja', function($id){
      JoukkueController::lisaa_pelaaja($id);
  });
  
  $routes->post('/joukkueet/:id/lisaa_pelaaja/:pelaaja_id', function($id, $pelaaja_id){
      JoukkueController::lisays($id, $pelaaja_id);
  });
  
  
  
  
  
  
  
  
