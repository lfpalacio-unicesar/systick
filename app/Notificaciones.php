<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificaciones extends Model
{
    protected $table = 'notificaciones';

    protected $fillable = [
        'usuario_id',
        'mensaje',
        'visto',
        'persona',
    ];

    public function usuarios(){
        return $this->belongsTo('App\User','usuario_id');
    }

    public function transcurrido($fecha){
        if(empty($fecha)) {
            return "No hay fecha";
        }

        $intervalos = array("segundo", "minuto", "hora", "día", "semana", "mes", "año");
        $duraciones = array("60","60","24","7","4.35","12");
        
        $ahora = time();
        $Fecha_Unix = strtotime($fecha);

        if(empty($Fecha_Unix)) {   
            return "Fecha incorrecta";
        }
        if($ahora > $Fecha_Unix) {   
            $diferencia     =$ahora - $Fecha_Unix;
            $tiempo         = "Hace";
        } else {
            $diferencia     = $Fecha_Unix -$ahora;
            $tiempo         = "Dentro de";
        }
        for($j = 0; $diferencia >= $duraciones[$j] && $j < count($duraciones)-1; $j++) {
          $diferencia /= $duraciones[$j];
        }
         
        $diferencia = round($diferencia);
        
        if($diferencia != 1) {
          $intervalos[5].="e"; //MESES
          $intervalos[$j].= "s";
        }
         
           return "$tiempo $diferencia $intervalos[$j]";
    }
}
