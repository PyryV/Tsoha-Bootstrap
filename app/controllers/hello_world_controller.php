<?php
require 'app/models/pelaaja.php';    
class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  //View::make('home.html');
        echo 'Tämä on etusivu!';
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
       // $sidney = new Pelaaja(['id' => 1, 'kayttaja' => 1, 'nimi' => 'Sidney Crosby',
         //   'seura' => 'Pittshburg Penguins', 'taso' => 94, 'pelipaikka' => 'hyökkääjä']);
      /*  $pelaaja = new Pelaaja(array(
            'kayttaja' => 1,
            'nimi' => 'Pe',
            'seura' => 'aaaaaaaaa',
            'taso' => 1,
            'pelipaikka' => 'hyökkääjä'
        ));
        $errors = $pelaaja->errors();
        Kint::dump($errors);
       
       */
    }
    /*
    public static function login(){
        View::make('suunnitelmat/login.html');
    }
    
    public static function joukkueet(){
        View::make('suunnitelmat/joukkueet.html');
    }
    
    public static function esittely_joukkue(){
        View::make('suunnitelmat/esittely_joukkue.html');
    }
    
    public static function muokkaus_joukkue(){
        View::make('suunnitelmat/muokkaus_joukkue.html');
    }
    
    public static function muokkaus_pelaaja(){
        View::make('suunnitelmat/muokkaus_pelaaja.html');
    }*/
  }
