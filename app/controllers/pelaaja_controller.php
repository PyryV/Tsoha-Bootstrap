<?php
require 'app/models/pelaaja.php';
class PelaajaController extends BaseController{
    
    public static function index(){
        $pelaajat = Pelaaja::all();
        View::make('pelaaja/index.html', array('pelaajat' => $pelaajat));
    }
    
    public static function esittely($id){
        $pelaaja = Pelaaja::find($id);
        View::make('pelaaja/esittely.html', array('pelaaja' => $pelaaja));
    }
    
    public static function create(){
        View::make('pelaaja/uusi.html');
    }


    public static function store(){
        $params = $_POST;
        $pelaaja = new Pelaaja(array(
            'kayttaja' => 1,
            'nimi' => $params['nimi'],
            'seura' => $params['seura'],
            'taso' => $params['taso'],
            'pelipaikka' => $params['pelipaikka']
        ));
        
        
        $pelaaja->save();
        Redirect::to('/pelaajat/' . $pelaaja->id, array('message' => 'Pelaaja lisätty!'));
    }
    
    
}

