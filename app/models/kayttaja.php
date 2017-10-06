<?php

class Kayttaja extends BaseModel{
    public $id, $nimi, $password, $password2;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi', 'validate_password');
    }
    
    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE id= :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        if($row){
            $kayttaja = new Kayttaja(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'password' => $row['password']
            ));
            return $kayttaja;
        }else{
            return null;
        }
        
    }
    
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Kayttaja (nimi, password) VALUES (:nimi, :password) RETURNING id');
        $query->execute(array('nimi' => $this->nimi, 'password' => $this->password));
        $row = $query->fetch();
        $this->id = $row['id'];
    }


    public static function authenticate($nimi, $password){
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE nimi= :nimi AND password= :password LIMIT 1');
        $query->execute(array('nimi' => $nimi, 'password' => $password));
        $row = $query->fetch();
        
        if($row){
            $kayttaja = new Kayttaja(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'password' => $row['password']
            ));
            return $kayttaja;
        }else{
            return null;
        }
        
        
    }
    
    public function validate_nimi(){
        $errors = array();
        if($this->nimi == '' || $this->nimi == NULL){
            $errors[] = 'Nimi ei saa olla tyhjä!';
        }
        if(strlen($this->nimi) < 4){
            $errors[] = 'Nimen tulee olla vähintään 4 merkkiä pitkä!';
        }
        return $errors;
    }
    
    public function validate_password(){
        $errors = array();
        if($this->password == '' || $this->password == NULL){
            $errors[] = 'Nimi ei saa olla tyhjä!';
        }
        if($this->password != $this->password2){
            $errors[] = 'Varmista, että salasanat vastaavat toisiaan!';
        }
        return $errors;
    }
}

