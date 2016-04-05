<?php

  class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null){
      // Käydään assosiaatiolistan avaimet läpi
      foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
        if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
          $this->{$attribute} = $value;
        }
      }
    }

    public function errors(){
      // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
      $errors = array();
      $validator_errors = array();


      foreach($this->validators as $validator){
        // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon

        $validator_errors[] = $this->{$validator}();
        

        
      }

      Kint::dump($this->validators);

      $errors = array_merge($errors, $validator_errors);
      
      return $errors;
    }

    public function validate_string_length($string, $length) {
      $errors = array();
      if($string == '' || $string == null){
      $errors[] = $string + ' ei saa olla tyhjä!';
      Kint::dump($string);
      Kint::dump($length);
  }
      if(($length) < 2){
      $errors[] = $string + ' pituuden tulee olla vähintään kolme merkkiä!';
  

      return $errors;
    }
  }


    public function validate_is_numeric($date) {
    $errors = array();
    if(!is_numeric($date)){
      $errors[] = $date + 'ei ole numeerinen!';
    }
      return $errors;
    }

    public function validate_is_string($string) {
    $errors = array();
    if(!preg_match("/^[a-zA-Z ]*$/", $string)){
      $errors[] = $string + 'vain kirjaimia';
    }
      return $errors;
    }
}
