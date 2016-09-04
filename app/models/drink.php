<?php


class Drink extends BaseModel{

  public $id, $player_id, $category_id, $name, $description, $published, $publisher, $added;
  // Konstruktori
  public function __construct($attributes){
    parent::__construct($attributes);
    $this->validators = array('validate_name', 'validate_publisher', 'validate_published', 'validate_description');
  }

  public static function all(){

    // Alustetaan kysely tietokantayhteydellämme
    $query = DB::connection()->prepare('SELECT Drink.id, Drink.player_id, Drink.name, Drink.published, Drink.description, Drink.publisher, Category.name AS category_name FROM Drink LEFT JOIN Category On Drink.category_id = Category.id');
    // Suoritetaan kysely
    $query->execute();
    // Haetaan kyselyn tuottamat rivit
    $rows = $query->fetchAll();
    $drinks = array();

    // Käydään kyselyn tuottamat rivit läpi
    foreach($rows as $row){
      // Tämä on PHP:n hassu syntaksi alkion lisäämiseksi taulukkoon :)
      $drinks[] = new Drink(array(
        'id' => $row['id'],
        'player_id' => $row['player_id'],
        'name' => $row['name'],
        'category_id' => $row['category_name'],
        'description' => $row['description'],
        'published' => $row['published'],
        'publisher' => $row['publisher'],
      ));
    }

    return $drinks;
  }
 public static function find($id){
    $query = DB::connection()->prepare('SELECT Drink.id, Drink.player_id, Drink.name, Drink.published, Drink.description, Drink.publisher, Category.name AS category_name FROM Drink LEFT JOIN Category On Drink.category_id = Category.id WHERE Drink.id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      $drink[] = new Drink(array(
        'id' => $row['id'],
        'name' => $row['name'],
        'description' => $row['description'],
        'category_id' => $row['category_name'],
        'published' => $row['published'],
        'publisher' => $row['publisher'],
      ));

      return $drink;
    }

    return null;
  }
  public function save(){
    // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
    $query = DB::connection()->prepare('INSERT INTO Drink (name, published, publisher, description, category_id) VALUES (:name, :published, :publisher, :description, :category_id) RETURNING id');
    // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
    $query->execute(array('name' => $this->name, 'publisher' => $this->publisher, 'published' => $this->published, 'description' => $this->description, 'category_id' => $this->category_id));
    // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
    $row = $query->fetch();
    // Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
    $this->id = $row['id'];
  }

  public function update(){

    
    $query = DB::connection()->prepare("UPDATE DRINK SET name = :name, published = :published, publisher = :publisher , description = :description, category_id = :category_id WHERE id = :id");

    $query->execute(array('id' => $this->id, 'name' => $this->name, 'published' => $this->published, 'category_id' =>$this->category_id, 'publisher' => $this->publisher, 'description' => $this->description));
    // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
    $row = $query->fetch();

  }

  public function destroy($id){
    $query = DB::connection()->prepare("DELETE FROM drink WHERE id = :id");

    $query->execute(array('id' => $this->id));

  }

  public function authenticate(){
    $query = DB::connection()->prepare('SELECT * FROM Player WHERE name = :name AND password = :password LIMIT 1');
    $query->execute(array('name' => $name, 'password' => $password));
    $row = $query->fetch();
    if($row){
      $kayttaja = new User(array(
        'id' => $row['id'],
        'name' => $row['name'],
        'password' => $row['password'],
      ));
      return $kayttaja;
  // Käyttäjä löytyi, palautetaan löytynyt käyttäjä oliona
    }else{
      return null;
  // Käyttäjää ei löytynyt, palautetaan null
    }
}

  public function validate_name(){

  // $this->validate_string_length($this->name, strlen($this->name));
  // $errors = $this->validate_is_string($this->name);
    //merge
  $errors = $this->validate_string_length($this->name, strlen($this->name));

  return $errors;
  // Kint::dump($errors);
}

  public function validate_description(){

  // $this->validate_string_length($this->description, strlen($this->description));
  // $errors = $this->validate_is_string($this->description);
  $errors = $this->validate_is_string($this->description);
  
  return $errors;
}

  public function validate_published(){

  $errors = $this->validate_is_numeric($this->published);
  
  return $errors;
}

  public function validate_publisher(){

  // $this->validate_string_length($this->publisher, strlen($this->publisher));
  $errors = $this->validate_string_length($this->publisher, strlen($this->publisher));

  
  return $errors;
}


}



