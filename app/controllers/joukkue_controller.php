<?php
require 'app/models/joukkue.php';
require 'app/models/pelaaja.php';
class JoukkueController extends BaseController{
    
    public static function index(){
        self::check_logged_in();
        $kayttaja = $_SESSION['kayttaja'];
        $joukkueet = Joukkue::all($kayttaja);
        View::make('joukkue/index.html', array('joukkueet' => $joukkueet));
    }
    
    public static function esittely($id){
        self::check_logged_in();
        $joukkue = Joukkue::find($id);
        $pelaajat = Pelaaja::joukkueen_pelaajat($id);
        $taso = Pelaaja::getTaso($pelaajat, $id);
        $taso2 = number_format($taso, 0);
        $pelipaikat = Pelaaja::getPelipaikat($pelaajat);
        
        
        View::make('joukkue/esittely.html', array('joukkue' => $joukkue, 'pelaajat' => $pelaajat, 'taso' => $taso2,
            'hyokkaajat' => $pelipaikat['hyokkaajat'], 'puolustajat' => $pelipaikat['puolustajat'], 'maalivahdit' => $pelipaikat['maalivahdit']));
    }
    
    public static function create(){
        self::check_logged_in();
        View::make('joukkue/uusi.html');
    }
    
    public static function store(){
        $params = $_POST;
        $kayttaja = $_SESSION['kayttaja'];
        if($kayttaja == null){
            $kayttaja = '';
        }
        $attributes = array(
            
            'kayttaja' => $kayttaja,
            'nimi' => $params['nimi']
        );
        
        $joukkue = new Joukkue($attributes);
        $errors = $joukkue->errors();
        
        if(count($errors)==0){
            $joukkue->save();
            Redirect::to('/joukkueet/' . $joukkue->id, array('message' => 'Uusi joukkue luotu!'));
        }else{
            View::make('joukkue/uusi.html', array('errors' => $errors, 'attributes' => $attributes));
        }
        Kint::dump($errors);
    }
    
    public static function edit($id){
        self::check_logged_in();
        $joukkue = Joukkue::find($id);
        View::make('joukkue/muokkaus.html', array('attributes' => $joukkue));
    }
    
    public static function update($id){
        $params = $_POST;
        $kayttaja = $_SESSION['kayttaja'];
        $attributes = array(
            'id' => $id,
            'kayttaja' => $kayttaja,
            'nimi' => $params['nimi']
        );
        $joukkue = new Joukkue($attributes);
        $errors = $joukkue->errors();
        if(count($errors)==0){
            $joukkue->update();
            Redirect::to('/joukkueet/' . $joukkue->id, array('message' => 'Joukkuetta muokattu onnistuneesti!'));
        }else{
            View::make('joukkue/muokkaus.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }
    
    public static function destroy($id){
        $joukkue = new Joukkue(array('id' => $id));
        $joukkue->destroy();
        
        Redirect::to('/joukkueet', array('message' => 'Joukkue poistettu onnistuneesti'));
    }

    public static function lisaa_pelaaja($id){
        self::check_logged_in();
        $kayttaja = $_SESSION['kayttaja'];
        $joukkue = Joukkue::find($id);
        $pelaajat = Pelaaja::vapaat_pelaajat($id, $kayttaja);
        
        View::make('joukkue/lisaa.html', array('joukkue' => $joukkue, 'pelaajat' => $pelaajat));
    }
    
    public static function lisays($id, $pelaaja_id){
        $joukkue = new Joukkue(array('id' => $id, 'pelaaja_id' => $pelaaja_id));
        $joukkue->sopimus();
        Redirect::to('/joukkueet/' . $id, array('message' => 'Pelaaja lisätty joukkueeseen') );
    }
    
    public static function poisto($id, $pelaaja_id){
        $joukkue = new Joukkue(array('id' => $id, 'pelaaja_id' => $pelaaja_id));
        $joukkue->pura_sopimus();
        Redirect::to('/joukkueet/' . $id, array('message' => 'Pelaaja poistettu joukkueesta'));
    }
    
    
}

