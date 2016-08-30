<?php

class User extends BaseModel{

 public $id, $name, $password;

 public static function authenticate($name, $password){
    $query = DB::connection()->prepare('SELECT * FROM Player WHERE name = :name AND password = :password LIMIT 1');
    $query->execute(array('name' => $name, 'password' => $password));
    $row = $query->fetch();
    if($row){
      $kayttaja = new User(array(
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