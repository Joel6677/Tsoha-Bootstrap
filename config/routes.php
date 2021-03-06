<?php

  // $routes->get('/', function() {
  //  HelloWorldController::index();
  // });

  

  $routes->get('/esittelysivu', function() {
    HelloWorldController::esittelysivu();
  });

  $routes->get('/listaussivu', function() {
    HelloWorldController::listaussivu();
  });

  $routes->get('/muokkaussivu', function() {
    HelloWorldController::muokkaussivu();
  });

  $routes->get('/kirjautuminen', function() {
    HelloWorldController::kirjautuminen();
  });

  $routes->get('/hiekkalaatikko', function() {
    DrinkController::sandbox();
  });

   $routes->get('/', function() {
    DrinkController::index();
  });

     $routes->get('/drink', function(){
  DrinkController::index();
});

$routes->post('/drink', function(){
 DrinkController::store();
});

  $routes->get('/drink/new', function(){
  DrinkController::create();
});


  $routes->get('/drink/:id', function($id){
  DrinkController::show($id);
});

$routes->get('/drink/:id/edit', function($id){
  // Pelin muokkauslomakkeen esittäminen
  DrinkController::edit($id);
});

$routes->post('/drink/:id/edit', function($id){ // tässä vika
  // Pelin muokkaaminen

  DrinkController::update($id);
});

$routes->get('/drink/:id/tiedot', function($id){
  // Pelin muokkauslomakkeen esittäminen
  DrinkController::tiedot($id);
});


$routes->post('/drink/:id/destroy', function($id){
  // Pelin poisto
  DrinkController::destroy($id);
});

$routes->get('/login', function(){
  // Kirjautumislomakkeen esittäminen
  UserController::login();
});
$routes->post('/login', function(){
  // Kirjautumisen käsittely
  UserController::handle_login();
});

$routes->post('/logout', function(){
  UserController::logout();
});




