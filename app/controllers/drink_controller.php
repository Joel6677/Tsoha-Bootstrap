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
    $attributes = array(
      'name' => $params['name'],
      'description' => $params['description'],
      'publisher' => $params['publisher'],
      'published' => $params['published']
    );

    $drink = new Drink($attributes);
    $errors = $drink->errors();

    if(count($errors) == 0){
    // Peli on validi, hyvä homma!
    $drink->save();

    Redirect::to('/drink/' . $drink->id, array('message' => 'Peli on lisätty kirjastoosi!'));
    }else{
    // Pelissä oli jotain vikaa :(
    View::make('drink/new.html', array('errors' => $errors, 'attributes' => $attributes));
    }
   // Kint::dump($params);
  }

  public static function create() {
    View::make('drink/new.html');
  }

  public static function show($id) {
    View::make('drink/:id.html');
  }

  public static function edit($id){
    $drink = Drink::find($id);
    View::make('drink/edit.html', array('attributes' => $drink));
  }

  // Pelin muokkaaminen (lomakkeen käsittely)
  public static function update($id){
    $params = $_POST;

    $attributes = array(
      'id' => $id,
      'name' => $params['name'],
      'publisher' => $params['publisher'],
      'published' => $params['published'],
      'description' => $params['description']
    );

    // Alustetaan drink-olio käyttäjän syöttämillä tiedoilla
    $drink = new Drink($attributes);
    // $errors = $drink->errors();

    // if(count($errors) > 0){
      // View::make('drink/edit.html', array('errors' => $errors, 'attributes' => $attributes));
    // }else{
      // Kutsutaan alustetun olion update-metodia, joka päivittää pelin tiedot tietokannassa
      $drink->update();

      Redirect::to('/drink/' . $drink->id, array('message' => 'Peliä on muokattu onnistuneesti!'));
    }
  

  // Pelin poistaminen
  public static function destroy($id){
    // Alustetaan drink-olio annetulla id:llä
    $drink = new Drink(array('id' => $id));
    // Kutsutaan drink-malliluokan metodia destroy, joka poistaa pelin sen id:llä
    $drink->destroy();

    // Ohjataan käyttäjä pelien listaussivulle ilmoituksen kera
    Redirect::to('/drink', array('message' => 'Peli on poistettu onnistuneesti!'));
  }

  public static function sandbox(){
  $doom = new Drink(array(
    'name' => 'd',
    'published' => 'eilen',
    'publisher' => 'id Software',
    'description' => 'Boom, boom!'
  ));
  $errors = $doom->errors();

  Kint::dump($errors);
}
}
