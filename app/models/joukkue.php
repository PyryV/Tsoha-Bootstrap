<?php

class Joukkue extends BaseModel{
    public $id, $kayttaja, $nimi, $taso, $hyokkaajat, $puolustajat, $maalivahdit;
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi');
    }
    
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
    
    


    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Joukkue (kayttaja,  nimi, hyokkaajat, puolustajat, maalivahdit)
                VALUES (:kayttaja, :nimi, 0, 0, 0) RETURNING id');
        $query->execute(array('kayttaja' => $this->kayttaja, 'nimi' => $this->nimi));
        $row = $query->fetch();
        $this->id = $row['id'];
    }
    
    public function update(){
        $query = DB::connection()->prepare('UPDATE Joukkue SET nimi= :nimi, hyokkaajat= :hyokkaajat, puolustajat= :puolustajat, maalivahdit= :maalivahdit WHERE id= :id');
        
        $query->execute(array('id' => $this->id, 'nimi' => $this->nimi, 'hyokkaajat' => $this->hyokkaajat, 'puolustajat' => $this->puolustajat, 'maalivahdit' => $this->maalivahdit));
        $row = $query->fetch();
        Kint::dump($row);
    }
    
    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Sopimus WHERE Sopimus.joukkue = :id');
        $query->execute(array('id' => $this->id));
        $row = $query->fetch();
        
        $query2 = DB::connection()->prepare('DELETE FROM Joukkue WHERE id= :id');
        $query2->execute(array('id' => $this->id));
        $row2 = $query->fetch();
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
    
    
    
    


    
    
    
    
}
