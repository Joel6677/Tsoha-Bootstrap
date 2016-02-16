<?php


class Drink extends BaseModel{

  public $id, $user_id, $name, $grade, $description, $published, $publisher, $added;
  // Konstruktori
  public function __construct($attributes){
    parent::__construct($attributes);
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
        'played' => $row['played'],
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
}



