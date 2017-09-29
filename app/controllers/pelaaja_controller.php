<?php
require 'app/models/pelaaja.php';
class PelaajaController extends BaseController{
    
    
    public static function index(){
        $kayttaja = BaseController::check_logged_in();
        
        $pelaajat = Pelaaja::all($kayttaja['id']);
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
        $attributes = array(
            'kayttaja' => 1,
            'nimi' => $params['nimi'],
            'seura' => $params['seura'],
            'taso' => $params['taso'],
            'pelipaikka' => $params['pelipaikka']
        );
        
        $pelaaja = new Pelaaja($attributes);
        $errors = $pelaaja->errors();
        
        if(count($errors)==0){
            $pelaaja->save();
            Redirect::to('/pelaajat/' . $pelaaja->id, array('message' => 'Pelaaja lisätty!'));
        }else{
            View::make('pelaaja/uusi.html', array('errors' => $errors, 'attributes' => $attributes));
        }
        Kint::dump($errors);
    }
    
    
}

