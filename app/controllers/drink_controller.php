<?php

// require 'app/models/drink.php'
class DrinkController extends BaseController {
	public static function index(){
    // Haetaan kaikki pelit tietokannasta
    $drinks = Drink::all();
    // Renderöidään views/drink kansiossa sijaitseva tiedosto index.html muuttujan $drinks datalla
    View::make('drink/index.html', array('drinks' => $drinks));
  }

     public static function esittelysivu(){
      View::make('drink/esittelysivu.html');
  }
  public static function store(){
    // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa

    $params = $_POST;
    // Alustetaan uusi drink-luokan olion käyttäjän syöttämillä arvoilla
    $drink = new Drink(array(
      'name' => $params['name'],
      'description' => $params['description'],
      'publisher' => $params['publisher'],
      'published' => $params['published']
    ));

   // Kint::dump($params);
    // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
    $drink->save();



    // Ohjataan käyttäjä lisäyksen jälkeen pelin esittelysivulle
     Redirect::to('/drink/' . $drink->id, array('message' => 'drinkki on lisätty kirjastoosi!'));
  }

  public static function create() {
    View::make('drink/new.html');
  }

  public static function show($id) {
    View::make('drink/:id.html');
  }
}
