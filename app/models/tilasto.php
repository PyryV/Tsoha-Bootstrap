<?php

class Tilasto extends BaseModel{
    public $id, $pelaaja, $paivamaara, $maalit, $syotot, $pisteet, $plusmiinus;
    
    public function __construct($attributes){
        parent::__construct($attributes);
        $this->validators = array('validate_maalit', 'validate_syotot', 'validate_plusmiinus');
    }
    
    public static function all($pelaaja){
        $query = DB::connection()->prepare('SELECT * FROM Tilasto WHERE Tilasto.pelaaja = :pelaaja');
        $query->execute(array('pelaaja' => $pelaaja));
        $rows = $query->fetchAll();
        $tilastot = array();
        
        foreach ($rows as $row){
            $tilastot[] = new Tilasto(array(
                'id' => $row['id'],
                'pelaaja' => $row['pelaaja'],
                'paivamaara' => $row['paivamaara'],
                'maalit' => $row['maalit'],
                'syotot' => $row['syotot'],
                'pisteet' => $row['pisteet'],
                'plusmiinus' => $row['plusmiinus']
            ));
        }
        return $tilastot;
    }
    
    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Tilasto WHERE id = :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        if($row){
            $tilasto = new Tilasto(array(
                'id' => $row['id'],
                'pelaaja' => $row['pelaaja'],
                'maalit' => $row['maalit'],
                'syotot' => $row['syotot'],
                'pisteet' => $row['pisteet'],
                'plusmiinus' => $row['plusmiinus']
            ));
            return $tilasto;
        }
    }


    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Tilasto (pelaaja, paivamaara, maalit, syotot, pisteet, plusmiinus)
                VALUES (:pelaaja, :paivamaara, :maalit, :syotot, :pisteet, :plusmiinus) RETURNING pelaaja');
        $query->execute(array('pelaaja' => $this->pelaaja, 'paivamaara' => $this->paivamaara, 'maalit' => $this->maalit, 'syotot' => $this->syotot, 'pisteet' => $this->pisteet, 'plusmiinus' => $this->plusmiinus));
        $row = $query->fetch();
        $this->pelaaja = $row['pelaaja'];
    }
    
    
    public function destroy(){
        $query = DB::connection()->prepare('DELETE FROM Tilasto WHERE Tilasto.id = :id');
        $query->execute(array('id' => $this->id));
        $row = $query->fetch();
    }
    
    public function validate_syotot(){
        $errors = array();
        
        if($this->syotot < 0|| $this->syotot > 100 || $this->syotot == NULL || !is_numeric($this->syotot)){
            $errors[] = 'Syöttöjen määrän tulee olla väliltä 0-100!';
        }
        
        return $errors;
    }
    
    public function validate_maalit(){
        $errors = array();
        if($this->maalit < 0|| $this->maalit > 100 || $this->maalit == NULL || !is_numeric($this->maalit)){
            $errors[] = 'Maalimäärän tulee olla väliltä 0-100!';
        }
        return $errors;
    }
    
    public function validate_plusmiinus(){
        $errors = array();
        if(($this->plusmiinus) < (-100) || $this->plusmiinus > 100 || $this->plusmiinus == NULL || !is_numeric($this->plusmiinus)){
            $errors[] = 'Plusmiinustilaston tulee olla väliltä -99 - 100!';
        }
        return $errors;
    }
    
    
    
    
}

