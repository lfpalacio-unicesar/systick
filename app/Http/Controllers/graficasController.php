<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Tickets;
use App\Servicios;
use App\Equipos;
use App\Oficinas;
use App\tiposEquipos;
use App\User;
use App\Mantenimientos;
use App\tiposMantenimientos;

class graficasController extends Controller
{
    // CALCULO EL ULTIMO DÍA DEL MES
    public function getUltimoDiaMes($elAnio,$elMes){
        return date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
    }

    public function registros_mes($anio, $mes){

        //establesco el rpimer y ultimo día del mes
        $primer_dia = 1;
        $ultimo_dia = $this->getUltimoDiaMes($anio, $mes);

        //establesco intervalo de fechas para consulta
        $fecha_inicial = date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia));
        $fecha_final = date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia));

        $tickets = Tickets::whereBetween('created_at',[$fecha_inicial, $fecha_final])->get();
        $cantidad = $tickets->count();

        //recorro las posiciones del array registros y las inicializo en 0
        for($d=1; $d<=$ultimo_dia; $d++){
            $registros[$d] = 0;
        }

        foreach ($tickets as $ticket) {
            $diasel=intval(date("d",strtotime($ticket->created_at)));
            $registros[$diasel]++;
        }

        $data = array("totaldias"=>$ultimo_dia, "registrosdia"=>$registros);
        return json_encode($data);
    }

    public function tiposServiciosTickets(){
        
        $servicios = Servicios::get();        
        $cant_servicios = $servicios->count();
        

        $tickets = Tickets::get();        
        $cant_tickets = $tickets->count();
        

        for ($i=0; $i<=$cant_servicios-1; $i++){
            $idCS=$servicios[$i]->id;
            $numServi[$idCS]=0;
        }

        for($i=0; $i<=$cant_tickets-1; $i++){
            $idCS=$tickets[$i]->servicio_id;
            $numServi[$idCS]++;
        }

        //$numServi contiene la cantidad de tipos de servicios realcionados por tickets MIN 32:48
        $data = array("totalservicios"=>$cant_servicios, "servicios"=>$servicios, "numServixTicket"=>$numServi);
        return json_encode($data);

    }

    // TICKET POR TIPOS DE EQUIPOS
    public function tiposEquiposTickets(){
        
        $equipos = Equipos::get();        
        $cant_equipos = $equipos->count();
        

        $tickets = Tickets::where('servicio_id',1)->get();        
        $cant_tickets = $tickets->count();
        

        for ($i=0; $i<=$cant_equipos-1; $i++){
            $idCS=$equipos[$i]->tipos->id;
            $numEqui[$idCS]=0;
        }

        for($i=0; $i<=$cant_tickets-1; $i++){
            $idCS=$tickets[$i]->equipos->tipo_id;
            $numEqui[$idCS]++;
        }
        //$numServi contiene la cantidad de tipos de servicios realcionados por tickets MIN 32:48
        $data = array("totalEquipos"=>$cant_equipos, "equipos"=>$equipos, "numEquixTicket"=>$numEqui);
        return json_encode($data);

    }

    //CANTIDAD DE TICKETS POR OFICINAS, tomando las oficinas de los ususarios que abren los tickets
    public function ticketsOficinas(){

        $oficinas = Oficinas::get();
        $cant_oficinas = $oficinas->count();

        $tickets = Tickets::get();
        $cant_tickets = $tickets->count();

        for ($i=0; $i<=$cant_oficinas-1; $i++){
            $idCS=$oficinas[$i]->id;
            $numOficinas[$idCS]=0;
        }

        for($i=0; $i<=$cant_tickets-1; $i++){
            $idCS=$tickets[$i]->usuarios->oficina_id;
            $numOficinas[$idCS]++;
        }

        $data = array("totalOficinas"=>$cant_oficinas, "oficinas"=>$oficinas, "numOficinas"=>$numOficinas);
        
        //salida
        return json_encode($data);
    }


    // TICKETS POR TIPOS DE EQUIPOS
    public function ticketsEquipos($anio, $mes){
        
        //establesco el primer y ultimo día del mes
        $primer_dia = 1;
        $ultimo_dia = $this->getUltimoDiaMes($anio, $mes);
        

        //establesco intervalo de fechas para consulta
        $fecha_inicial = date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia));
        $fecha_final = date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia));

        $tiposEquipos = tiposEquipos::get();
        $cant_tiposEquipos = $tiposEquipos->count();

        /* aqui valído la consulta dependiendo de los parametros recibidos, valido si no recibo 0,0 para tomar las fechas,
        por el contrario, si recibo las fechas entonces filtro por las mismas, es decir cambio la consulta */
        if( ($anio != 0) and ($mes != 0) ){
            $tickets = Tickets::where('servicio_id',1)
                    ->whereBetween('created_at',[$fecha_inicial, $fecha_final])
                    ->get();
        }else{
            $tickets = Tickets::where('servicio_id',1)->get();
        }        

        $cant_tickets = $tickets->count();

        for ($i=0; $i<=$cant_tiposEquipos-1; $i++){
            $idCS=$tiposEquipos[$i]->id;
            $numTicketsxEquipos[$idCS]=0;
        }

        for($i=0; $i<=$cant_tickets-1; $i++){
            $idCS=$tickets[$i]->equipos->tipo_id;
            $numTicketsxEquipos[$idCS]++;
        }

        $data = array("totalTiposEquipos"=>$cant_tiposEquipos, "tiposEquipos"=>$tiposEquipos, "numTicketsxEquipos"=>$numTicketsxEquipos);
        
        //salida
        return json_encode($data);
    }


    // TOP 5 USUARIOS CON MAS TICKETS
    public function usuariosMasTickets(){
        
        $users = User::get();
        $cant_users = $users->count();

        $tickets = Tickets::get();
        $cant_tickets = $tickets->count();

        for ($i=0; $i<=$cant_users-1; $i++){
            $idCS=$users[$i]->id;
            $numTicketsxUser[$idCS]=0;
            $new[$i]=$users[$i]->id;             
        }

        for($i=0; $i<=$cant_tickets-1; $i++){
            $idCS=$tickets[$i]->user_id;
            $numTicketsxUser[$idCS]++;
        }

        /*
        $numTicketsxUser es un array donde asocio la cantidad de tickets por usuario
        luego convierto ese array en una colección para poder utilizar los metodos necesarios, esto se hace con el metodo collect().
        sort(): me ordena la colección por usuarios con menor cantidad de tickets a usuarios con mayor cantidad
        reverse(): me invierte el orden del anterior, es decir, me ordena por los usuarios de mayor cantidad de tickets a los de menor cantidad de tickets
        y finalmente utilizo el metodo take() para tomar la cantidad de registros que considere necesarios, para este caso serán 5
        //dd($ordenado->sort()->reverse()->take(2));  
        */

        $ordenado = collect($numTicketsxUser);
        $ordenado = $ordenado->sort()->reverse()->take(5);
        $cant_usuarios2 = $ordenado->count();     

        /*el metodo keys() me extrae los keys o llaves del collection en que lo uso, para este caso lo aplico al collection de ordenado 
        para obtener los ids de los usuarios, luego hago una busqueda de usuarios con esos valores en la tabla usuarios y soluciono*/
        
        $userIds = $ordenado->keys();        
        $newUsers = User::whereIn('id',$userIds)->get();     
        
        //$data = array("totalUsuarios"=>$cant_users, "totalUsuarios2"=>$cant_usuarios2, "usuarios"=>$users, "topUsuarios"=>$ordenado, "nuevosUsers"=>$userIds, "nuevosUsuarios"=>$newUsers);
        $data = array("totalUsuarios2"=>$cant_usuarios2, "topUsuarios"=>$ordenado, "nuevosUsers"=>$userIds, "nuevosUsuarios"=>$newUsers);
        
        return json_encode($data);
    }
    
    //función que obtiene mes, dia y año y lo convierte a dia de la semana
    public function saber_dia($mes, $dia, $anio){
        $nom = jddayofweek ( cal_to_jd(CAL_GREGORIAN, $mes,$dia,$anio) , 3 );
        switch ($nom) {
            case '0':
                return 'Domingo';
                break;
            case '1':
                return 'Lunes';
                break;
            case '2':
                return 'Martes';
                break;
            case '3':
                return 'Miercoles';
                break;
            case '4':
                return 'Jueves';
                break;
            case '5':
                return 'Viernes';
                break;
            case '6':
                return 'Sábado';
                break;        
        }
    }

    public function ticketsMes($anio, $mes){     

        $primer_dia=1;       

        if( ($anio != 0) and ($mes != 0) ){

            $ultimo_dia = $this->getUltimoDiaMes($anio, $mes);
            $fecha_inicial = date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia));
            $fecha_final = date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia));
            
            $tickets = Tickets::whereBetween('created_at',[$fecha_inicial, $fecha_final])->get();    
        }else{

            $anio = date("Y");
            $mes = date("m");

            $ultimo_dia = $this->getUltimoDiaMes($anio, $mes);
            $fecha_inicial = date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia));
            $fecha_final = date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia));

            // esta bien
            // $ultimo_dia = $this->getUltimoDiaMes(date("Y"), date("m"));
            // $fecha_inicial = date("Y-m-d H:i:s", strtotime(date("Y")."-".date("m")."-".$primer_dia));
            // $fecha_final = date("Y-m-d H:i:s", strtotime(date("Y")."-".date("m")."-".$ultimo_dia));

            $tickets = Tickets::whereBetween('created_at',[$fecha_inicial, $fecha_final])->get();
            //$tickets = Tickets::get();
        }

        //$tickets = Tickets::whereBetween('created_at',[$fecha_inicial, $fecha_final])->get();
        $cant_tickets = $tickets->count();

        for($d=1; $d<=$ultimo_dia; $d++){
            $registros[$d]=0;
            //$fechas[$d]=date($d."-".$mes."-".$anio);
            $fechas[$d]=[
                "dia"=>$d,
                "mes"=>$mes,
                "anio"=>$anio,
                "nom"=>$this->saber_dia($mes,$d,$anio)
            ];
        }

        foreach ($tickets as $ticket) {
            $diasel=intval(date("d",strtotime($ticket->created_at)));
            $registros[$diasel]++;
        }

        $data = array("totalDias"=>$ultimo_dia, "registrosDia"=>$registros, "fecha_final"=>$fecha_final, "fechas"=>$fechas);
        return json_encode($data);
    }

    //MANTIENIMIENTOS MES A MES
    public function mantenimientosMes($anio){
        
        $tiposEquipos = tiposEquipos::get();
        $cant_tiposEquipos = $tiposEquipos->count();

        
        if($anio != 0){
            $inicio_anio = $anio.'-01-01';
            $final_anio = $anio.'-12-31';
        }else{
            $anio=date('Y');
            $inicio_anio = $anio.'-01-01';
            $final_anio = $anio.'-12-31';
        }       
        
        $mantenimientos = Mantenimientos::whereDate('created_at','>=',$inicio_anio)->whereDate('created_at','<=',$final_anio)->get();           
        
        /*funciona bien, este me saca los mantenimientos por mes
        for($i=1; $i<=12; $i++){
            $registrosMes[$i] = 0;
        }

        foreach ($mantenimientos as $y => $item) {            
            $mes = date("n",strtotime($item->created_at));
            $registrosMes[$mes]++;                
        }*/

        /*funciona bien, este me saca los mantenimientos por mes segun un solo tipo de equipo
        foreach ($tiposEquipos as $tE => $tipo) {
            
            for($i=1; $i<=12; $i++){
                $registrosMes[$i] = 0;
            }

            foreach ($mantenimientos as $y => $item) {
                if($tipo->id == $item->tipo_id){
                    $mes = date("n",strtotime($item->created_at));
                    $registrosMes[$mes]++;
                }            
                                
            }
        }
        */

        //final
        foreach ($tiposEquipos as $tE => $tipo) {
            
            //reestablezo en 0 cada mes del año 1 al 12
            for($i=1; $i<=12; $i++){
                $registrosMes[$i] = 0;
            }

            //recorro cada mantenimiento por cada tipo de equipo
            foreach ($mantenimientos as $y => $item) {

                //valido si coincide los ID tanto del tiposEquipo como en mantenimientos
                if($tipo->id == $item->tipo_id){

                    //extraigo el mes de cada fecha de mantenimiento
                    $mes = date("n",strtotime($item->created_at));
                    
                    //incremento el registro segun mes 
                    $registrosMes[$mes]++;
                }            
                                
            }

            /*construyo el array que será enviado al grafico, con nombre del tipo de equipo y los registros hallados por cada mes
            utilizo el metodo array_flatten para descartar los meses del año con el fin de acomodar el arreglo al formato de la grafica*/
            $series[$tE]=[
                'name'=>$tipo->nombre,
                'data'=>array_flatten($registrosMes)                
            ];
        }
        

        $data = array("anio"=>$anio,"tiposEquipos"=>$tiposEquipos, "totalTipoEquipos"=>$cant_tiposEquipos, "registrosMes"=>$registrosMes, "series"=>$series);

        return json_encode ($data);
    }

    // TIPOS DE MANTENIMIENTOS MES A MES
    public function tipoManteMes($anio){
        
        $tiposMante = tiposMantenimientos::get();
        $cantTipoMante = $tiposMante->count();

        if($anio != 0){
            $inicio_anio = $anio.'-01-01';
            $final_anio = $anio.'-12-31';
        }else{
            $anio=date('Y');
            $inicio_anio = $anio.'-01-01';
            $final_anio = $anio.'-12-31';
        }       
        
        $mantenimientos = Mantenimientos::whereDate('created_at','>=',$inicio_anio)->whereDate('created_at','<=',$final_anio)->get();

        //$mantenimientos = Mantenimientos::get();

        
        foreach ($tiposMante as $tM => $tipo) {
            
            //restablezco en 0 cada mes del año, del 1 al 12
            for($i=1; $i<=12; $i++){
                $registrosMes[$i] = 0;
            }

            //recorro cada mantenimiento por cada tipo de mantenimiento
            foreach ($mantenimientos as $y => $item) {
                
                //valido si coincide los ID tanto de la tabla mantenimientos como tipoMantenimeinto
                if($tipo->id == $item->tipo){

                    //extraigo el mes de cada fecha de mantenimiento
                    $mes = date("n",strtotime($item->created_at));

                    //incremento el registro segun el mes
                    $registrosMes[$mes]++;
                }
            }

            /*construyo el array que será enviado al grafico, con nombre del tipo de equipo y los registros hallados por cada mes
            utilizo el metodo array_flatten para descartar los meses del año con el fin de acomodar el arreglo al formato de la grafica*/
            $series[$tM]=[
                'name'=>$tipo->nombre,
                'data'=>array_flatten($registrosMes)                
            ];
        }

        $data = array("tipoMantenimiento"=>$tiposMante, "cantTipoMante"=>$cantTipoMante, "tiposxMes"=>$registrosMes, "series"=>$series, "anio"=>$anio);
        return json_encode($data);
    }

    public function usuariosMante(){
        
        $users = User::get();
        $cant_users = $users->count();

        /*DATOS MANTENIMIENTOS PREVENTIVO*/
        $mantenimientosP = Mantenimientos::where('tipo',1)->get();
        $cant_manteP = $mantenimientosP->count();

        for($i=0; $i<=$cant_users-1; $i++){
            $index = $users[$i]->id;
            $numMantexUserP[$index]=0;
        }
        for($i=0; $i<=$cant_manteP-1; $i++){
            $index = $mantenimientosP[$i]->usuario_id;
            $numMantexUserP[$index]++;
        }

        $ordenadoP = collect($numMantexUserP);
        $ordenadoP = $ordenadoP->sort()->reverse()->take(5);

        $userIdsP = $ordenadoP->keys();
        $newUsersP = User::whereIn('id',$userIdsP)->get();
        $totalUsersP = $newUsersP->count();
        
        /*DATOS MANTENIMIENTOS CORRECTIVO*/
        $mantenimientosC = Mantenimientos::where('tipo',2)->get();
        $cant_manteC = $mantenimientosC->count();

        for($i=0; $i<=$cant_users-1; $i++){
            $index = $users[$i]->id;
            $numMantexUserC[$index]=0;
        }
        for($i=0; $i<=$cant_manteC-1; $i++){
            $index = $mantenimientosC[$i]->usuario_id;
            $numMantexUserC[$index]++;
        }

        $ordenadoC = collect($numMantexUserC);
        $ordenadoC = $ordenadoC->sort()->reverse()->take(5);       

        $userIdsC = $ordenadoC->keys();
        $newUsersC = User::whereIn('id',$userIdsC)->get();
        $totalUsersC = $newUsersC->count();

        $data = array("mantePxUsuarios"=>$numMantexUserP, "ordenadoP"=>$ordenadoP, "userIdsP"=>$userIdsP, "nuevosUsersP"=>$newUsersP,"totalUsersP"=>$totalUsersP, "manteCxUsuarios"=>$numMantexUserC, "ordenadoC"=>$ordenadoC, "userIdsC"=>$userIdsC, "nuevosUsersC"=>$newUsersC, "totalUsersC"=>$totalUsersC);
        return json_encode($data);
    }



    public function oficinasMante(){
        
        $users = User::get();
        $cant_users = $users->count();

        $oficinas = Oficinas::get();
        $cant_oficinas = $oficinas->count();

        /*DATOS MANTENIMIENTOS PREVENTIVO*/
        $mantenimientosP = Mantenimientos::where('tipo',1)->get();
        $cant_manteP = $mantenimientosP->count();

        for($i=0; $i<=$cant_oficinas-1; $i++){
            $index = $oficinas[$i]->id;
            $numMantexOficinaP[$index]=0;
        }
        for($i=0; $i<=$cant_manteP-1; $i++){
            $index = $mantenimientosP[$i]->oficina_id;
            $numMantexOficinaP[$index]++;
        }

        $ordenadoP = collect($numMantexOficinaP);
        $ordenadoP = $ordenadoP->sort()->reverse()->take(5);

        $oficinaIdsP = $ordenadoP->keys();
        $newOficinaP = Oficinas::whereIn('id',$oficinaIdsP)->get();
        $totalOficinasP = $newOficinaP->count();
        
        /*DATOS MANTENIMIENTOS CORRECTIVO*/
        $mantenimientosC = Mantenimientos::where('tipo',2)->get();
        $cant_manteC = $mantenimientosC->count();

        for($i=0; $i<=$cant_oficinas-1; $i++){
            $index = $oficinas[$i]->id;
            $numMantexOficinaC[$index]=0;
        }
        for($i=0; $i<=$cant_manteC-1; $i++){
            $index = $mantenimientosC[$i]->oficina_id;
            $numMantexOficinaC[$index]++;
        }

        $ordenadoC = collect($numMantexOficinaC);
        $ordenadoC = $ordenadoC->sort()->reverse()->take(5);       

        $oficinaIdsC = $ordenadoC->keys();
        $newOficinasC = Oficinas::whereIn('id',$oficinaIdsC)->get();
        $totalOficinaC = $newOficinasC->count();

        $data = array("mantePxOficinas"=>$numMantexOficinaP, "ordenadoP"=>$ordenadoP, "oficinaIdsP"=>$oficinaIdsP, "nuevosOficinaP"=>$newOficinaP,"totalOficinasP"=>$totalOficinasP, "manteCxOficinas"=>$numMantexOficinaC, "ordenadoC"=>$ordenadoC, "oficinaIdsC"=>$oficinaIdsC, "nuevosOficinasC"=>$newOficinasC, "totalOficinaC"=>$totalOficinaC);
        return json_encode($data);
    }

    public function asignadosMante(){
        
        $users = User::get();
        $cant_users = $users->count();

        /*DATOS MANTENIMIENTOS PREVENTIVO*/
        $mantenimientosP = Mantenimientos::where('tipo',1)->get();
        $cant_manteP = $mantenimientosP->count();

        for($i=0; $i<=$cant_users-1; $i++){
            $index = $users[$i]->id;
            $numMantexUserP[$index]=0;
        }
        for($i=0; $i<=$cant_manteP-1; $i++){
            $index = $mantenimientosP[$i]->responsable;
            $numMantexUserP[$index]++;
        }

        $ordenadoP = collect($numMantexUserP);
        $ordenadoP = $ordenadoP->sort()->reverse()->take(5);

        $userIdsP = $ordenadoP->keys();
        $newUsersP = User::whereIn('id',$userIdsP)->get();
        $totalUsersP = $newUsersP->count();
        
        /*DATOS MANTENIMIENTOS CORRECTIVO*/
        $mantenimientosC = Mantenimientos::where('tipo',2)->get();
        $cant_manteC = $mantenimientosC->count();

        for($i=0; $i<=$cant_users-1; $i++){
            $index = $users[$i]->id;
            $numMantexUserC[$index]=0;
        }
        for($i=0; $i<=$cant_manteC-1; $i++){
            $index = $mantenimientosC[$i]->responsable;
            $numMantexUserC[$index]++;
        }

        $ordenadoC = collect($numMantexUserC);
        $ordenadoC = $ordenadoC->sort()->reverse()->take(5);       

        $userIdsC = $ordenadoC->keys();
        $newUsersC = User::whereIn('id',$userIdsC)->get();
        $totalUsersC = $newUsersC->count();

        $data = array("mantePxUsuarios"=>$numMantexUserP, "ordenadoP"=>$ordenadoP, "userIdsP"=>$userIdsP, "nuevosUsersP"=>$newUsersP,"totalUsersP"=>$totalUsersP, "manteCxUsuarios"=>$numMantexUserC, "ordenadoC"=>$ordenadoC, "userIdsC"=>$userIdsC, "nuevosUsersC"=>$newUsersC, "totalUsersC"=>$totalUsersC);
        return json_encode($data);
    }

}
