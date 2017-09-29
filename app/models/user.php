<?php

class User extends BaseModel{
    public $id, $nimi, $password;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public static function authenticate($nimi, $password){
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE nimi = :nimi AND password = :password LIMIT 1');
        $query->execute(array('nimi' => $nimi, 'password' => $password));
        $row = $query->fetch();
        if($row){
            $kayttaja = new User(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'password' => $row['password']
                
            ));
            return $kayttaja;
        }else{
            return NULL;
        }
    }
    
    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        if($row){
            $kayttaja = new Pelaaja(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'password' => $row['password']
                
            ));
            return $kayttaja;
        }
    }
}

