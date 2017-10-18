<?php
require 'app/models/pelaaja.php';
class PelaajaController extends BaseController{
    
    
    public static function index(){
        self::check_logged_in();
        $kayttaja = $_SESSION['kayttaja'];
        $pelaajat = Pelaaja::all($kayttaja);
        View::make('pelaaja/index.html', array('pelaajat' => $pelaajat));
    }
    
    public static function esittely($id){
        self::check_logged_in();
        $pelaaja = Pelaaja::find($id);
        View::make('pelaaja/esittely.html', array('pelaaja' => $pelaaja));
    }
    
    public static function create(){
        self::check_logged_in();
        View::make('pelaaja/uusi.html');
    }


    public static function store(){
        $params = $_POST;
        $kayttaja = $_SESSION['kayttaja'];
        if($kayttaja == null){
            $kayttaja = '';
        }
        $attributes = array(
            
            'kayttaja' => $kayttaja,
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
    
    public static function edit($id){
        self::check_logged_in();
        $pelaaja = Pelaaja::find($id);
        View::make('pelaaja/muokkaus.html', array('attributes' => $pelaaja));
    }
    
    public static function update($id){
        $params = $_POST;
        $kayttaja = $_SESSION['kayttaja'];
        $attributes = array(
            'id' => $id,
            'kayttaja' => $kayttaja,
            'nimi' => $params['nimi'],
            'seura' => $params['seura'],
            'taso' => $params['taso'],
            'pelipaikka' => $params['pelipaikka']
        );
        $pelaaja = new Pelaaja($attributes);
        
        $errors = $pelaaja->errors();
        
        if(count($errors)==0){
            $pelaaja->update();
            Redirect::to('/pelaajat/' . $pelaaja->id, array('message' => 'Pelaajaa muokattu onnistuneesti!'));
        }else{
            View::make('pelaaja/muokkaus.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }
    
    public static function destroy($id){
        $pelaaja = new Pelaaja(array('id' => $id));
        $pelaaja->destroy();
        
        Redirect::to('/pelaajat', array('message' => 'Pelaaja poistettu onnistuneesti'));
    }
    
}

