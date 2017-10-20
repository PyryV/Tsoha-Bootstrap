<?php
require 'app/models/pelaaja.php';
require 'app/models/tilasto.php';
class TilastoController extends BaseController{
    
    public static function create_tilasto($id){
        self::check_logged_in();
        $pelaaja = Pelaaja::find($id);
        View::make('tilasto/uusi_tilasto.html', array('pelaaja' => $pelaaja));
    }
    
    public static function tallenna_tilasto($id){
        $params = $_POST;
        $attributes = array(
            'pelaaja' => $id,
            'paivamaara' => date('d M Y', time()),
            'maalit' => $params['maalit'],
            'syotot' => $params['syotot'],
            'pisteet' => $params['syotot'] + $params['maalit'],
            'plusmiinus' => $params['plusmiinus']
        );
        
        $tilasto = new Tilasto($attributes);
        $errors = $tilasto->errors();
        
        if(count($errors)==0){
            $tilasto->save();
            echo $id;
            Redirect::to('/pelaajat/' . $id, array('message' => 'Uusi tilasto luotu', 'id' => $id));
        }else{
            View::make('tilasto/uusi_tilasto.html', array('errors' => $errors, 'attributes' => $attributes));
        }
        
    }
    
    public static function destroy($pelaaja, $id){
        $tilasto = new Tilasto(array('id' => $id));
        $tilasto->destroy();
        
        Redirect::to('/pelaajat/' . $pelaaja);
    }


    
    
    
}

