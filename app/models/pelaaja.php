<?php

class Pelaaja extends BaseModel{
    public $id, $kayttaja, $nimi, $seura, $taso, $pelipaikka;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi', 'validate_seura', 'validate_taso', 'validate_pelipaikka');
    }
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Pelaaja');
        $query->execute();
        $rows = $query->fetchAll();
        $pelaajat = array();
        
        foreach($rows as $row){
            $pelaajat[]= new Pelaaja(array(
                'id' => $row['id'],
                'kayttaja' => $row['kayttaja'],
                'nimi' => $row['nimi'],
                'seura' => $row['seura'],
                'taso' => $row['taso'],
                'pelipaikka' => $row['pelipaikka']
            ));
            
            
        }
        return $pelaajat;
    }
    
    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Pelaaja WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        if($row){
            $pelaaja = new Pelaaja(array(
                'id' => $row['id'],
                'kayttaja' => $row['kayttaja'],
                'nimi' => $row['nimi'],
                'seura' => $row['seura'],
                'taso' => $row['taso'],
                'pelipaikka' => $row['pelipaikka']
                
            ));
            return $pelaaja;
        }
    }
    
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Pelaaja (nimi, seura, taso, pelipaikka)
                VALUES (:nimi, :seura, :taso, :pelipaikka) RETURNING id');
        $query->execute(array('nimi' => $this->nimi, 'seura' => $this->seura, 'taso' => $this->taso, 'pelipaikka' => $this->pelipaikka));
        $row = $query->fetch();
        $this->id = $row['id'];
        
    }
    
    public function update(){
        $query = DB::connection()->prepare('UPDATE Pelaaja SET nimi= :nimi, seura= :seura, taso= :taso, pelipaikka= :pelipaikka WHERE id= :id');
        
        $query->execute(array('id' => $this->id, 'nimi' => $this->nimi, 'seura' => $this->seura, 'taso' => $this->taso, 'pelipaikka' => $this->pelipaikka));
        $row = $query->fetch();
        
        
        Kint::dump($row);
        
    }
    
    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Pelaaja WHERE id= :id');
        $query->execute(array('id' => $this->id));
        $row = $query->fetch();
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
    
    public function validate_seura(){
        $errors = array();
        if($this->seura == '' || $this->seura == NULL){
            $errors[] = 'Seurajoukkue ei saa olla tyhjä!';
        }
        if(strlen($this->seura) < 2){
            $errors[] = 'Seurajoukkueen nimen tulee olla vähintään 2 merkkiä pitkä!';
        }
        return $errors;
    }
    
    public function validate_taso(){
        $errors = array();
        if(($this->taso) < 0 || ($this->taso) > 99 || $this->nimi == NULL){
            $errors[] = 'Tason tulee olla väliltä 0-99!';
        }
        
        return $errors;
    }
    
    public function validate_pelipaikka(){
        $errors = array();
        if((($this->pelipaikka != 'Hyökkääjä' && $this->pelipaikka != 'Puolustaja' && $this->pelipaikka != 'Maalivahti') ||$this->pelipaikka == NULL )){
            $errors[] = 'Pelaajalle tulee valita pelipaikka! (Hyökkääjä, Puolustaja tai Maalivahti)';
        }
        return $errors;
    }
}

