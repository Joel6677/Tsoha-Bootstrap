<?php


class Drink extends BaseModel{

  public $id, $user_id, $name, $grade, $description, $published, $publisher, $added;
  // Konstruktori
  public function __construct($attributes){
    parent::__construct($attributes);
    $this->validators = array('validate_name', 'validate_published', 'validate_publisher', 'validate_description');
  }


  public static function all(){

    // Alustetaan kysely tietokantayhteydellämme
    $query = DB::connection()->prepare('SELECT * FROM Drink');
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
        'description' => $row['description'],
        'published' => $row['published'],
        'publisher' => $row['publisher'],
        'added' => $row['added']
      ));
    }

    return $drinks;
  }
 public static function find($id){
    $query = DB::connection()->prepare('SELECT * FROM Drink WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      $drink = new Drink(array(
        'id' => $row['id'],
        'player_id' => $row['player_id'],
        'name' => $row['name'],
        'description' => $row['description'],
        'published' => $row['published'],
        'publisher' => $row['publisher'],
        'added' => $row['added']
      ));

      return $drink;
    }

    return null;
  }
  public function save(){
    // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
    $query = DB::connection()->prepare('INSERT INTO Drink (name, published, publisher, description) VALUES (:name, :published, :publisher, :description) RETURNING id');
    // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
    $query->execute(array('name' => $this->name, 'published' => $this->published, 'publisher' => $this->publisher, 'description' => $this->description));
    // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
    $row = $query->fetch();
    // Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
    $this->id = $row['id'];
  }

  public function update(){
    $query = DB::connection()->prepare('UPDATE Drink SET name = :name, published = :published, publisher = :publisher , description = :description RETURNING id');

    $query->execute(array('name' => $this->name, 'published' => $this->published, 'publisher' => $this->publisher, 'description' => $this->description));
    // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
    $row = $query->fetch();
    // Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
    // Kint::dump($row);
    $this->id = $row['id'];
  }

  public function destroy(){
    $query = DB::connection()->prepare('DELETE FROM Drink RETURNING id');

    $query->execute(array('name' => $this->name, 'published' => $this->published, 'publisher' => $this->publisher, 'description' => $this->description));
    // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
    $row = $query->fetch();
    // Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
    // Kint::dump($row);
    $this->id = $row['id'];
  }

  public function authenticate(){
    $query = DB::connection()->prepare('SELECT * FROM Player WHERE name = :name AND password = :password LIMIT 1');
    $query->execute(array('name' => $name, 'password' => $password));
    $row = $query->fetch();
    if($row){
      $kayttaja = new User();
      return $kayttaja;
  // Käyttäjä löytyi, palautetaan löytynyt käyttäjä oliona
    }else{
      return null;
  // Käyttäjää ei löytynyt, palautetaan null
    }
}

  public function validate_name(){

  $this->validate_string_length($this->name, strlen($this->name));
}

  public function validate_description(){

  $this->validate_string_length($this->description, strlen($this->description));
}

  public function validate_published(){

  $this->validate_string_length($this->published, strlen($this->published));
}

  public function validate_publisher(){

  $this->validate_string_length($this->publisher, strlen($this->publisher));
}

}



