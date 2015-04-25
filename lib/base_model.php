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

      foreach($this->validators as $validator){
        // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
      }

      return $errors;
    }

    public static function validate_max_lenght($string, $lenght) {
      $truelenght = strlen($string);

      if (truelenght > $lenght) {
        return false;
      }

      return true;
    }

    public static function validate_min_lenght($string, $lenght) {
      $truelenght = strlen($string);

      if (truelenght < $lenght) {
        return false;
      }

      return true;
    }

    public static function validate_is_a_date($date) {
      if (preg_match("\d\d\d\d-\d\d-\d\d", $date)) {
          return true;
      }
      return false;
    }

  }
