<?php

class Pelaaja extends BaseModel{
    public $id, $kayttaja, $nimi, $seura, $taso, $pelipaikka;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
        
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
}

