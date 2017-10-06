<?php
require 'app/models/kayttaja.php';
class KayttajaController extends BaseController{
    
    public static function login(){
        View::make('kayttaja/login.html');
    }
    
    public static function home(){
        if(isset($_SESSION['kayttaja'])){
            $kayttaja_logged_in = Kayttaja::find($_SESSION['kayttaja']);
            View::make('kayttaja/home.html',array('kayttaja_logged_in' => $kayttaja_logged_in));
        }else{
            View::make('kayttaja/home.html');
        }
        
    }
    
    public static function handle_login(){
        $params = $_POST;
        
        $kayttaja = Kayttaja::authenticate($params['nimi'], $params['password']);
        
        if(!$kayttaja){
            View::make('kayttaja/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana', 'nimi'));
        }else{
            $_SESSION['kayttaja'] = $kayttaja->id;
            Redirect::to('/', array('message' => 'Tervetuloa' . $kayttaja->nimi . '!'));
        }
    }
    
    public static function logout(){
        $_SESSION['kayttaja'] = null;
        Redirect::to('/login', array('message' => 'Olet kirjautunut ulos!'));
    }
    
    public static function create(){
        View::make('/kayttaja/uusi.html');
    }
    
    public static function store(){
        $params = $_POST;
        $attributes = array(
            'nimi' => $params['nimi'],
            'password' => $params['password'],
            'password2' => $params['password2']
        );
        
        $kayttaja = new Kayttaja($attributes);
        
        $errors = $kayttaja->errors();
        
        if(count($errors)==0){
            $kayttaja->save();
            $_SESSION['kayttaja'] = $kayttaja->id;
            Redirect::to('/', array('message' => 'Tervetuloa' . $kayttaja->nimi . '!'));
        }else{
            View::make('kayttaja/uusi.html', array('errors' => $errors, 'attributes' => $attributes));
        }
        Kint::dump($errors);
    }
}
