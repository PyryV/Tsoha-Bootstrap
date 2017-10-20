<?php

class Joukkue extends BaseModel{
    public $id, $kayttaja, $nimi, $taso, $hyokkaajat, $puolustajat, $maalivahdit, $pelaaja_id;
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi');
    }
    
    //Palauttaa käyttäjän kaikki joukkueet
    public static function all($kayttaja){
        if($kayttaja==null){
            $query = DB::connection()->prepare('SELECT * FROM Joukkue');
            $query->execute();
        }else{
            $query = DB::connection()->prepare('SELECT * FROM Joukkue WHERE kayttaja= :kayttaja');
            $query->execute(array('kayttaja' => $kayttaja));
        }
        
        $rows = $query->fetchAll();
        $joukkueet = array();
        
        foreach($rows as $row){
            $joukkueet[]= new Joukkue(array(
                'id' => $row['id'],
                'kayttaja' => $row['kayttaja'],
                'nimi' => $row['nimi'],
                'hyokkaajat' => $row['hyokkaajat'],
                'puolustajat' => $row['puolustajat'],
                'maalivahdit' => $row['maalivahdit']
            ));
            
            
        }
        return $joukkueet;
    }
    
    //Palauttaa tietyn joukkueen
    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Joukkue WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        if($row){
            
            $joukkue = new Joukkue(array(
                'id' => $row['id'],
                'kayttaja' => $row['kayttaja'],
                'nimi' => $row['nimi'],
                'hyokkaajat' => $row['hyokkaajat'],
                'puolustajat' => $row['puolustajat'],
                'maalivahdit' => $row['maalivahdit']
               
                
            ));
            return $joukkue;
        }
    }
    
    //Tallentaa uuden joukkueen
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Joukkue (kayttaja,  nimi, hyokkaajat, puolustajat, maalivahdit)
                VALUES (:kayttaja, :nimi, 0, 0, 0) RETURNING id');
        $query->execute(array('kayttaja' => $this->kayttaja, 'nimi' => $this->nimi));
        $row = $query->fetch();
        $this->id = $row['id'];
    }
    
    //Päivittää joukkueeseen tehdyt muutokset tietokantaan
    public function update(){
        $query = DB::connection()->prepare('UPDATE Joukkue SET nimi= :nimi, hyokkaajat= :hyokkaajat, puolustajat= :puolustajat, maalivahdit= :maalivahdit WHERE id= :id');
        
        $query->execute(array('id' => $this->id, 'nimi' => $this->nimi, 'hyokkaajat' => $this->hyokkaajat, 'puolustajat' => $this->puolustajat, 'maalivahdit' => $this->maalivahdit));
        $row = $query->fetch();
        Kint::dump($row);
    }
    
    //Poistaa joukkueen tietokannasta
    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Sopimus WHERE Sopimus.joukkue = :id');
        $query->execute(array('id' => $this->id));
        $row = $query->fetch();
        
        $query2 = DB::connection()->prepare('DELETE FROM Joukkue WHERE id= :id');
        $query2->execute(array('id' => $this->id));
        $row2 = $query->fetch();
    }
    
    //Luo sopimuksen pelaajan ja joukkueen välille
    public function sopimus(){
        $query = DB::connection()->prepare('INSERT INTO Sopimus (pelaaja, joukkue) VALUES (:pelaaja, :joukkue)');
        $query->execute(array('pelaaja' => $this->pelaaja_id, 'joukkue' => $this->id));
        $row = $query->fetch();
    }
    
    public function pura_sopimus(){
        $query = DB::connection()->prepare('DELETE FROM Sopimus WHERE Sopimus.pelaaja = :pelaaja AND Sopimus.joukkue = :joukkue');
        $query->execute(array('pelaaja' => $this->pelaaja_id, 'joukkue' => $this->id));
        
    }

    //Validaattorit
    
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
    
    
    
    


    
    
    
    
}
