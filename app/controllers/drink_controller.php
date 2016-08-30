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
      'publisher' => $params['publisher'],
      'published' => $params['published'],
      'description' => $params['description'],
    );

    $drink = new Drink($attributes);
    $errors = $drink->errors();
    // Kint::dump($errors);


    if(count($errors) == 0){
    // Peli on validi, hyvä homma!
    $drink->save();
    Redirect::to('/drink/' . $drink->id, array('message' => 'Drinkki on lisätty kirjastoosi!'));
    }else{
    // Pelissä oli jotain vikaa :(
    View::make('drink/new.html', array('errors' => $errors, 'attributes' => $attributes));
    }
     }

  public static function create() {
    View::make('drink/new.html');
  }

  public static function show($id) {
    View::make('drink/show.html');
  }

  public static function tiedot($id) {
    $drink = Drink::find($id);
    View::make('drink/tiedot.html', array('drinks' => $drink));
  }

  public static function edit($id){
    $drink = Drink::find($id); // pistä toimimaan
    

    View::make('drink/edit.html', array('attributes' => $drink));
  }

  // Pelin muokkaaminen (lomakkeen käsittely)
  public static function update($id){
    $params = $_POST;
    $attributes = array(
      'id' => $id, //parametri ei toimi
      'name' => $params['name'],
      'publisher' => $params['publisher'],
      'published' => $params['published'],
      'description' => $params['description']
    );


    // Alustetaan drink-olio käyttäjän syöttämillä tiedoilla
    $drink = new Drink($attributes);
    $errors = $drink->errors();

    

    if(count($errors) > 0){
      View::make('drink/edit.html', array('errors' => $errors, 'attributes' => $attributes));
    }else{
      // Kutsutaan alustetun olion update-metodia, joka päivittää pelin tiedot tietokannassa
     
        
      $drink->update();

      Redirect::to('/drink/' . $drink->id, array('message' => 'Drinkkiä on muokattu onnistuneesti!'));
    }
  }

  // Pelin poistaminen
  public static function destroy($id){
    // Alustetaan drink-olio annetulla id:llä
    $drink = new Drink(array('id' => $id));
    // Kutsutaan drink-malliluokan metodia destroy, joka poistaa pelin sen id:llä
    $drink->destroy($id);
    

    // Ohjataan käyttäjä pelien listaussivulle ilmoituksen kera
    Redirect::to('/drink', array('message' => 'Drinkki on poistettu onnistuneesti!'));
  }

  public static function sandbox(){
    // post hommeli tähän
  $kayttaja = new Player(array(
        'player_id' => $row['player_id'],
        'name' => $row['name'],
        'password' => $row['password'],
      ));
    $test = User::authenticate();
    Kint::trace();
    Kint::dump($kayttaja);

}
}

