<?php

class User extends BaseModel{

  public $player_id, $name, $password;
  // Konstruktori
 public function authenticate(){
    $query = DB::connection()->prepare('SELECT * FROM Player WHERE name = :name AND password = :password LIMIT 1');
    $query->execute(array('name' => $name, 'password' => $password));
    $row = $query->fetch();
    if($row){
      $kayttaja = new Player(array(
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

}