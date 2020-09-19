<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>

  <style>

    body{
      font-family: arial,verdana;
      font-size: 12px;
    }

    table{
      border-collapse: collapse;
    }

    td.bordes{
      border-width: 1px;
      border: solid; 
      border-color: #000000;
    }

    td.sombra{
      background:#A9A9A9;
      font-weight: bold;
    }

    td.once{
      font-size: 11px;
    }
  </style>

</head>
<body>


    <table width="100%" style="border:1px solid #000000">
        <tr>
          <td colspan="6"><center style="font-size:16px"><b>EVIDENCIA DE MANTENIMIENTO</b><br><p style="font-size:9px">Sticker Equipo # {{$man->sticker}} | Mantenimiento # {{$man->id}} ({{$man->fentrega}})</p> </center></td>
          {{-- <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td> --}}
        </tr>
        <tr>
          <td colspan="6">&nbsp;</td>
          {{-- <td>2.2</td>
          <td>2.3</td>
          <td>2.4</td>
          <td>2.5</td>
          <td>2.6</td> --}}
        </tr>
        <tr>
          <td colspan="6">&nbsp;</td>
          {{-- <td>adicional</td>
          <td>adicional</td>
          <td>adicional</td>
          <td>adicional</td>
          <td>adicional</td> --}}
        </tr>
        <tr>
          <td colspan="6">
            <table width="100%"> {{--style="border:1px solid #000000"--}}
                <tr>
                  <td colspan="6" class="bordes sombra"><center>DATOS DE PROCEDENCIA DEL EQUIPO</center></td>
                  {{-- <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td> --}}
                </tr>
                <tr>
                  <td class="bordes sombra">Oficina</td>
                  <td colspan="2" class="bordes once">{{ $man->oficinas->nombre }}</td>
                  {{-- <td></td> --}}
                  <td class="bordes sombra">Responsable</td>
                  <td colspan="2" class="bordes once">{{ $man->usuarios->name }}</td>
                  {{-- <td></td> --}}
                </tr>
                <tr>
                    <td class="bordes sombra"><b>Nombre equipo</b></td>
                    <td colspan="2" class="bordes once"> {{$man->nombre}}</td>
                    {{-- <td></td> --}}
                    <td class="bordes sombra"><b>Usuario</b></td>
                    <td colspan="2" class="bordes once">{{ $man->asignado }}</td>
                    {{-- <td></td> --}}
                </tr>
            </table>
          </td>
          {{-- <td>3.2</td>
          <td>3.3</td>
          <td>3.4</td>
          <td>3.5</td>
          <td>3.6</td> --}}
        </tr>
        <tr>
          <td colspan="6">&nbsp;</td>
          {{-- <td>4.2</td>
          <td>4.3</td>
          <td>4.4</td>
          <td>4.5</td>
          <td>4.6</td> --}}
        </tr>        
        <tr>
          <td colspan="6">
              <table width="100%">
                  <tr>
                    <td colspan="6" class="bordes sombra"><center>DATOS DEL MANTENIMIENTO</center></td>
                    {{-- <td class="bordes"></td>
                    <td class="bordes"></td>
                    <td class="bordes"></td>
                    <td class="bordes"></td>
                    <td class="bordes"></td> --}}
                  </tr>
                  <tr>
                    <td class="bordes sombra">Fecha programada</td>
                    <td colspan="2" class="bordes once"> @if (isset($man->fprogramada)) {{$man->fprogramada}} @else {{'N.A'}} @endif </td>
                    {{-- <td class="bordes"></td> --}}
                    <td class="bordes sombra">Responsable</td>
                    <td colspan="2" class="bordes once">{{$man->responsables->name}}</td>
                    {{-- <td class="bordes"></td> --}}
                  </tr>
                  <tr>
                      <td class="bordes sombra">Fecha de realización</td>
                      <td colspan="2" class="bordes once"> {{$man->fingreso}}</td>
                      {{-- <td class="bordes"></td> --}}
                      <td class="bordes sombra">Fecha de entrega</td>
                      <td colspan="2" class="bordes once"> {{$man->fentrega}}</td>
                      {{-- <td class="bordes"></td> --}}
                  </tr>
                  <tr>
                    <td class="bordes sombra">Tipo Mantenimiento</td>
                    <td colspan="2" class="bordes once"> @if ($man->tipo == 0) {{'Preventivo'}} @else {{'Correctivo'}} @endif</td>
                    {{-- <td></td>
                    <td></td>
                    <td></td>
                    <td></td> --}}
                  </tr>     
              </table>
          </td>
          {{-- <td>5.2</td>
          <td>5.3</td>
          <td>5.4</td>
          <td>5.5</td>
          <td>5.6</td> --}}
        </tr>
        <tr>
          <td colspan="6">&nbsp;</td>
          {{-- <td>6.2</td>
          <td>6.3</td>
          <td>6.4</td>
          <td>6.5</td>
          <td>6.6</td> --}}
        </tr>
        <tr>
          <td colspan="6">
              <table width="100%">
                  <tr>
                    <td colspan="6" class="bordes sombra"><center>DATOS DEL EQUIPO</center></td>
                    {{-- <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td> --}}
                  </tr>
                  <tr>
                    <td class="bordes sombra">Tipo</td>
                    <td class="bordes once">{{$man->tipos->nombre}}</td>
                    <td class="bordes sombra">Marca</td>
                    <td class="bordes once">{{$man->marcas->nombre}}</td>
                    <td class="bordes sombra">Modelo</td>
                    <td class="bordes once">{{$man->modelo}}</td>
                  </tr>
                  <tr>
                    <td class="bordes sombra">Procesador</td>
                    <td class="bordes once">{{$man->procesador}}</td>
                    <td class="bordes sombra">Memoria RAM</td>
                    <td class="bordes once">{{$man->ram}}</td>
                    <td class="bordes sombra">Almacenamiento</td>
                    <td class="bordes once">{{$man->almacenamiento}}</td>
                  </tr>
                  <tr>
                    <td class="bordes sombra">Dirrección IP</td>
                    <td class="bordes once">{{$man->ip}}</td>
                    <td class="bordes sombra">Dirección MAC</td>
                    <td class="bordes once">{{$man->mac}}</td>
                    <td class="bordes sombra">Sticker CPU</td>
                    <td class="bordes once">{{$man->sticker}}</td>
                  </tr>
                  <tr>
                    <td class="bordes sombra">Sticker Monitor</td>
                    <td class="bordes once">{{$man->sticker_monitor}}</td>
                    <td class="bordes sombra">Sticker Teclado</td>
                    <td class="bordes once">{{$man->sticker_teclado}}</td>
                    <td class="bordes sombra">Sticker Mouse</td>
                    <td class="bordes once">{{$man->sticker_mouse}}</td>
                  </tr>                  
              </table>
          </td>
          {{-- <td>7.2</td>
          <td>7.3</td>
          <td>7.4</td>
          <td>7.5</td>
          <td>7.6</td> --}}
        </tr>
        <tr>
          <td colspan="6">&nbsp;</td>
          {{-- <td>8.2</td>
          <td>8.3</td>
          <td>8.4</td>
          <td>8.5</td>
          <td>8.6</td> --}}
        </tr>
        <tr>
          {{-- <td></td> --}}
          <td colspan="6">
              <table width="100%">
                  <tr>
                    <td colspan="6" class="bordes sombra"><center>INFORMACIÓN DEL SOFTWARE DEL EQUIPO</center></td>
                    {{-- <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td> --}}
                  </tr>
                  <tr>
                    <td class="bordes sombra" width="20%" ><center>Nombre</center></td>
                    <td colspan="4" class="bordes sombra"><center>Versión</center></td>
                    {{-- <td></td> --}}
                    <td class="bordes sombra" width="10%"><center>Activado</center></td>                    
                  </tr>
                  <tr>
                    <td class="bordes sombra"><center>Suite ofimatica </center></td>
                    <td colspan="4" class="bordes once"><center>{{$man->office->nombre}}</center></td>
                    {{-- <td></td> --}}
                    <td class="bordes once"><center> @if($man->estadoSuite == 0){{'No'}}@elseif($man->estadoSuite == 1){{'Si'}}@else{{'No requiere'}}@endif</center></td>
                  </tr>
                  <tr>
                      <td class="bordes sombra"><center>Sistema operativo</center></td>
                      <td colspan="4" class="bordes once"><center>{{$man->sistemas->nombre}}</center></td>
                      {{-- <td></td> --}}
                      <td class="bordes once"><center> @if($man->estadoSistema == 0){{'No'}}@elseif($man->estadoSistema == 1){{'Si'}}@else{{'No requiere'}}@endif</center></td>
                  </tr>
                  <tr>
                      <td class="bordes sombra"><center>Antivirus</center></td>
                      <td colspan="4" class="bordes once"><center>{{$man->antivirus->nombre}}</center></td>
                      {{-- <td></td> --}}
                      <td class="bordes once"><center> @if($man->estadoAntivirus == 0){{'No'}}@elseif($man->estadoAntivirus == 1){{'Si'}}@else{{'No requiere'}}@endif</center></td>
                  </tr>
                  <tr>
                      <td class="bordes sombra"><center>Otros Softwares</center></td>
                      <td colspan="5" class="bordes once"><center>                          
                          @foreach ($softEquipoMante as $i => $item)
                              {{-- valido dentro de la iteracion para colocar . en el ultimo elemento del vector en lugar de , --}}
                              @if ($i == $cantidad-1)
                                {{ $item->softwares->nombre.'.'}}                                  
                              @else
                                {{ $item->softwares->nombre.','}}  
                              @endif
                          @endforeach
                      </center></td>
                      {{-- <td></td> --}}
                      {{-- <td class="bordes once"><center>Si</center></td> --}}
                  </tr>
              </table>
          </td>
          {{-- <td>9.2</td>
          <td>9.3</td>
          <td>9.4</td>
          <td>9.5</td> --}}
          {{-- <td></td> --}}
        </tr>
        <tr>
          <td colspan="6">&nbsp;</td>
          {{-- <td>10.2</td>
          <td>10.3</td>
          <td>10.4</td>
          <td>10.5</td>
          <td>10.6</td> --}}
        </tr>
        <tr>
          <td colspan="6">&nbsp;</td>
          {{-- <td>adicional</td>
          <td>adicional</td>
          <td>adicional</td>
          <td>adicional</td>
          <td>adicional</td> --}}
        </tr>
        <tr>
          <td colspan="6">
              <table width="100%">
                  <tr>
                    <td colspan="6" class="bordes sombra"><center>ESTADO EN QUE SE RECIBE EL EQUIPO</center></td>
                    {{-- <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td> --}}
                  </tr>
                  <tr>
                    <td colspan="6" class="bordes once" align="justify">
                      {!!$man->estado!!}
                    </td>
                    {{-- <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td> --}}
                  </tr>                  
              </table>
          </td>
          {{-- <td>11.2</td>
          <td>11.3</td>
          <td>11.4</td>
          <td>11.5</td>
          <td>11.6</td> --}}
        </tr>
        <tr>
          <td colspan="6">&nbsp;</td>
          {{-- <td>12.2</td>
          <td>12.3</td>
          <td>12.4</td>
          <td>12.5</td>
          <td>12.6</td> --}}
        </tr>
        <tr>
          <td colspan="6">
              <table width="100%">
                  <tr>
                    <td colspan="6" class="bordes sombra"><center>ACCIONES REALIZADAS</center></td>
                    {{-- <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td> --}}
                  </tr>
                  <tr>
                    <td colspan="6" class="bordes once" align="justify">
                        {!!$man->acciones!!}
                    </td>
                    {{-- <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td> --}}
                  </tr>
              </table>
          </td>
          {{-- <td>13.2</td>
          <td>13.3</td>
          <td>13.4</td>
          <td>13.5</td>
          <td>13.6</td> --}}
        </tr>
        <tr>
          <td colspan="6">&nbsp;</td>
          {{-- <td>14.2</td>
          <td>14.3</td>
          <td>14.4</td>
          <td>14.5</td>
          <td>14.6</td> --}}
        </tr>
        <tr>
          <td colspan="6">
              <table width="100%">
                  <tr>
                    <td colspan="6" class="bordes sombra"><center>CONCLUSIONES Y RECOMENDACIONES</center></td>
                    {{-- <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td> --}}
                  </tr>
                  <tr>
                    <td colspan="6" class="bordes once" align="justify">
                        {!!$man->conclusiones!!}
                    </td>
                    {{-- <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td> --}}
                  </tr>
              </table>
          </td>
          {{-- <td>14.2</td>
          <td>15.3</td>
          <td>15.4</td>
          <td>15.5</td>
          <td>15.6</td> --}}
        </tr>
        
        <tr>
          <td colspan="6">&nbsp;</td>
          {{-- <td>16.2</td>
          <td>16.3</td>
          <td>16.4</td>
          <td>16.5</td>
          <td>16.6</td> --}}
        </tr>
        <tr>
          <td colspan="6">&nbsp;</td>
          {{-- <td>17.2</td>
          <td>17.3</td>
          <td>17.4</td>
          <td>17.5</td>
          <td>17.6</td> --}}
        </tr>
        <tr>
          <td colspan="6">&nbsp;</td>
          {{-- <td>18.2</td>
          <td>18.3</td>
          <td>18.4</td>
          <td>18.5</td>
          <td>18.6</td> --}}
        </tr>
        <tr>
          <td colspan="3"><center>______________________________________________</center></td>
          {{-- <td>19.2</td>
          <td>19.3</td> --}}
          <td colspan="3"><center>______________________________________________</center></td>
          {{-- <td>19.5</td>
          <td>19.6</td> --}}
        </tr>
        <tr>
          <td colspan="3"><center><b>Realizó mantenimiento: {{ucwords($man->responsables->name)}}</b></center></td>
          {{-- <td>19.2</td>
          <td>19.3</td> --}}
          <td colspan="3"><center><b>Recibe equipo: {{ucwords($man->asignado)}}</b></center></td>
          {{-- <td>19.5</td>
          <td>19.6</td> --}}
        </tr>


    </table>
    {{-- <p style="font-size:5px">impreso por systick</p> --}}
  
</body>
</html>