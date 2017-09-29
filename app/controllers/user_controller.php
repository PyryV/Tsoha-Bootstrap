<?php
require 'app/models/user.php';
class UserController extends BaseController{
    
    public static function login(){
        View::make('user/login.html');
    }
    
    public static function home(){
        View::make('user/home.html');
    }
    
    public static function handle_login(){
        $params = $_POST;
        
        $kayttaja = User::authenticate($params['nimi'], $params['password']);
        
        if(!$kayttaja){
            View::make('user/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana', 'nimi'));
        }else{
            $_SESSION['kayttaja'] = $kayttaja->id;
            
            Redirect::to('/home', array('message' => 'Kirjautuneena: ' . $kayttaja->nimi));
        }
        
    }
}