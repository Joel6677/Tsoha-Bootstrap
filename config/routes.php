<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

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

