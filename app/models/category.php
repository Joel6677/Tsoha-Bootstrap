<?php

class Category extends BaseModel{

 public $id, $drink_id, $name;

public static function all() {

    // Alustetaan kysely tietokantayhteydellämme
    $query = DB::connection()->prepare('SELECT * FROM Category');
    // Suoritetaan kysely
    $query->execute();
    // Haetaan kyselyn tuottamat rivit
    $rows = $query->fetchAll();
    $categories = array();

    // Käydään kyselyn tuottamat rivit läpi
    foreach($rows as $row){
      // Tämä on PHP:n hassu syntaksi alkion lisäämiseksi taulukkoon :)
      $categories[] = new Category(array(
        'id' => $row['id'],
        'name' => $row['name'],
      ));
    }

    return $categories;
  }

}