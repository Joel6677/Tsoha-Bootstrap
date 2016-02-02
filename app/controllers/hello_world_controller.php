<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
      View::make('suunnitelmat/etusivu.html');
   	  
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      View::make('helloworld.html');
    }

    public static function esittelysivu(){
      View::make('suunnitelmat/esittelysivu.html');
  }

  public static function listaussivu(){
      View::make('suunnitelmat/listaussivu.html');
  }

  public static function muokkaussivu(){
      View::make('suunnitelmat/muokkaussivu.html');
  }

   public static function kirjautuminen(){
      View::make('suunnitelmat/kirjautuminen.html');
  }

}
