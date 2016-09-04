<?php

// require 'app/models/drink.php'
class DrinkController extends BaseController {
	public static function index(){
    self::check_logged_in();
    // Haetaan kaikki pelit tietokannasta
    $drinks = Drink::all(); // tähän molemmat taulut
    // Renderöidään views/drink kansiossa sijaitseva tiedosto index.html muuttujan $drinks datalla
    View::make('drink/index.html', array('drinks' => $drinks));
  }


  public static function store(){
    // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa

    $params = $_POST;

    $category = $params['category'];
    // Alustetaan uusi drink-luokan olion käyttäjän syöttämillä arvoilla
    $attributes = array(
      'name' => $params['name'],  
      'publisher' => $params['publisher'],
      'published' => $params['published'],
      'category_id' => $category,
      'description' => $params['description'],
    );

    $drink = new Drink($attributes);
    $errors = $drink->errors();
    $categories = Category::all();
        Kint::dump($errors);


    if(count($errors) == 0){
    // Peli on validi, hyvä homma!
    $drink->save();
    Redirect::to('/drink/' . $drink->id, array('message' => 'Drinkki on lisätty kirjastoosi!'));
    }else{
    // Pelissä oli jotain vikaa :(
    View::make('drink/new.html', array('errors' => $errors, 'attributes' => $attributes, 'categories' => $categories));
    }
  }

  public static function create() {
    $categories = Category::all();

    View::make('drink/new.html', array('categories' => $categories));
  }

  public static function show($id) {
    self::check_logged_in();
    View::make('drink/show.html');
  }

  public static function tiedot($id) {
    $drink = Drink::find($id);
    View::make('drink/tiedot.html', array('drinks' => $drink));
  }

  public static function edit($id){
    self::check_logged_in();
    $drink = Drink::find($id);
    $category = Category::all(); 
    

    View::make('drink/edit.html', array('attributes' => $drink, 'categories' => $category));
  }

  // Pelin muokkaaminen (lomakkeen käsittely)
  public static function update($id){
    $params = $_POST;
    $category = $params['category'];
    $attributes = array(
      'id' => $id, 
      'name' => $params['name'],
      'publisher' => $params['publisher'],
      'published' => $params['published'],
      'category_id' => $category,
      'description' => $params['description']
    );


    // Alustetaan drink-olio käyttäjän syöttämillä tiedoilla
    $drink = new Drink($attributes);
    $errors = $drink->errors();
    $categories = Category::all();

    

    if(count($errors) > 0){
      View::make('drink/edit.html', array('errors' => $errors, 'attributes' => $drink, 'categories' => $categories));
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

     $drink = Drink::find(6);
     Kint::dump($drink);
  // $attributes = array(
  //   'name' => 'daaa',
  //   'published' => 'eilen',
  //   'publisher' => 'a',
  //   'category_id' => '1',
  //   'description' => 'Boom, boom!'
  //   );

  //   $drink = new Drink($attributes);
  //   $er = $drink->errors();
  //   Kint::dump($er);
  //   $categories = Category::all();
   
  //   View::make('drink/new.html', array('errors' => $er, 'attributes' => $attributes, 'categories' => $categories));
    
}
}

