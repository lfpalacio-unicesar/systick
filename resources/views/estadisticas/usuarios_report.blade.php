@extends('dashboard')

@section('titulo','Estadisticas')

@section('headers')
    
@endsection

@section('content')
    {{-- Titulo de página  --}}
    <div class="page-title">
        <div class="title_left">
        <h3>Estadisticos Sistema</h3>
        </div>    
    </div>

    {{-- Fin titulo página --}}
    <div class="clearfix"></div>

    {{-- fila graficos --}}

    {{-- TICKETS POR SERVICIOS --}}
    <div class="row">        
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
            <div class="x_title">
                <h2>Tickets por tipos de servicios</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>&nbsp;</li>
                    <li>&nbsp;</li>
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>                
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content" align="center">               
                <div id="div_grafica_pie"></div>                                
            </div>
        </div>
        </div>
    </div>


    {{-- TICKETS POR OFICINAS --}}
    <div class="row">
        {{-- grafico de barras --}}
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel"> {{--tile fixed_height_320 overflow_hidden--}}
                <div class="x_title">
                    <h2>Tickets por oficinas</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>                
                    </ul>
                    <div class="clearfix"></div>
                    
                </div>
                <div class="x_content" align="center">               
                    <div id="div_grafica_barras"></div>                    
                </div>                
            </div>            
        </div>        
    </div>


    {{-- TICKETS POR TIPOS EQUIPOS --}}
    <div class="row">
        {{-- grafico de barras --}}
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel"> {{--tile fixed_height_320 overflow_hidden--}}
                <div class="x_title">
                    <h2>Tickets por tipos de equipos</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>                
                    </ul>
                    <div class="clearfix"></div>                    
                </div>

                <div class="col-md-6 col-sm-6 col-xs-6">
                    <select name="anio" id="anio_sel" class="form-control" onchange="cambiar_fecha_grafica_tiposEquipos();">
                        <option value="" disabled selected> Seleccione Año</option>                    
                            @for ($i=2019; $i<=date('Y'); $i++)
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor                    
                    </select>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <select name="mes" id="mes_sel" class="form-control" onchange="cambiar_fecha_grafica_tiposEquipos();">
                        <option value="" disabled selected> Seleccione Mes</option>
                            @foreach ($meses as $y => $mes)
                                <option value="{{$y+1}}">{{$mes}}</option>
                            @endforeach
                    </select>
                </div>
                <div class="row">&nbsp;</div>

                <div class="x_content" align="center">               
                    <div id="div_grafica_tipos_equipos"></div>                    
                </div>                
            </div>            
        </div>        
    </div>

    {{-- TICKETS POR USUARIOS --}}
    <div class="row">
        {{-- grafico de barras --}}
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel"> {{--tile fixed_height_320 overflow_hidden--}}
                <div class="x_title">
                    <h2>Top 5: Usuarios con mas Tickets</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>                
                    </ul>
                    <div class="clearfix"></div>
                    
                </div>
                <div class="x_content" align="center">               
                    <div id="div_grafica_topUsuarios"></div>                    
                </div>                
            </div>            
        </div>        
    </div>

    {{-- TICKETS POR DÍAS --}}
    <div class="row">
        {{-- grafico de barras --}}
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel"> {{--tile fixed_height_320 overflow_hidden--}}
                <div class="x_title">
                    <h2>Tickets por días del mes</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>                
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" align="center">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <select name="anio" id="anio_mes" class="form-control" onchange="cambiar_fecha_grafica_ticketsMes();">
                            {{-- <option value="" disabled selected> Seleccione Año</option>                     --}}
                                @for ($i=2019; $i<=date('Y'); $i++)
                                    @if ($i == date("Y"))
                                        <option value="{{$i}}" selected>{{$i}}</option>    
                                    @else
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endif
                                    
                                @endfor                    
                        </select>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <select name="mes" id="mes_mes" class="form-control" onchange="cambiar_fecha_grafica_ticketsMes();">
                            {{-- <option value="" disabled selected> Seleccione Mes</option> --}}
                                @foreach ($meses as $y => $mes)
                                    @if ($y+1 == date("m"))
                                        <option value="{{$y+1}}" selected>{{$mes}}</option>
                                    @else
                                        <option value="{{$y+1}}">{{$mes}}</option>                                        
                                    @endif    
                                @endforeach
                        </select>
                    </div>
                    <div class="row">&nbsp;</div>                               
                    <div id="div_grafica_ticketsMes"></div>                    
                </div>                
            </div>            
        </div>        
    </div>


    {{-- REPORTE MENSUAL DE MANTENIMIENTOS --}}
    <div class="row">
        {{-- grafico de barras --}}
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel"> {{--tile fixed_height_320 overflow_hidden--}}
                <div class="x_title">
                    <h2>Reporte mensual de mantenimientos</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>                
                    </ul>
                    <div class="clearfix"></div>
                    
                </div>
                <div class="x_content" align="center">

                    <div class="col-md-2 col-sm-2 col-xs-2">
                        <select name="anio" id="anio_mante" class="form-control" onchange="cambiar_fecha_grafica_mantenimientosMes();" >
                            {{-- <option value="" disabled selected> Seleccione Año</option>                     --}}
                                @for ($i=2019; $i<=date('Y'); $i++)
                                    @if ($i == date("Y"))
                                        <option value="{{$i}}" selected>{{$i}}</option>    
                                    @else
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endif
                                    
                                @endfor                    
                        </select>
                    </div>

                    <div class="row">&nbsp;</div>
                    <div id="div_grafica_mantenimientosMensuales"></div>                                

                </div>                
            </div>            
        </div>        
    </div>

    {{-- REPORTE MENSUAL DE TIPO MANTENIMIENTOS --}}
    <div class="row">
        {{-- grafico de barras --}}
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel"> {{--tile fixed_height_320 overflow_hidden--}}
                <div class="x_title">
                    <h2>Reporte mensual de mantenimientos por tipo</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>                
                    </ul>
                    <div class="clearfix"></div>
                    
                </div>
                <div class="x_content" align="center">

                    <div class="col-md-2 col-sm-2 col-xs-2">
                        <select name="anio" id="anio_TipoMante" class="form-control" onchange="cambiar_fecha_grafica_mantenimientosTipoMes();" >
                            {{-- <option value="" disabled selected> Seleccione Año</option>                     --}}
                                @for ($i=2019; $i<=date('Y'); $i++)
                                    @if ($i == date("Y"))
                                        <option value="{{$i}}" selected>{{$i}}</option>    
                                    @else
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endif
                                    
                                @endfor                    
                        </select>
                    </div>

                    <div class="row">&nbsp;</div>
                    <div id="div_grafica_mantenimientosMensualesTipo"></div>                                

                </div>                
            </div>            
        </div>        
    </div>

    {{-- DOBLE PIE MANTENIMIENTOS POR USUARIOS --}}    
    <div class="row">
        {{-- grafico de barras --}}
        <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="x_panel"> {{--tile fixed_height_320 overflow_hidden--}}
                <div class="x_title">
                    <h2>Top 5: Usuarios con mas Mantenimientos (Preventivos)</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>                
                    </ul>
                    <div class="clearfix"></div>
                    
                </div>
                <div class="x_content" align="center">               
                    <div id="div_grafica_mantenimiento_preventivo_usuarios"></div>
                </div>                
            </div>            
        </div>
        
        <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="x_panel"> {{--tile fixed_height_320 overflow_hidden--}}
                <div class="x_title">
                    <h2>Top 5: Usuarios con mas Mantenimientos (Correctivos)</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>                
                    </ul>
                    <div class="clearfix"></div>
                    
                </div>
                <div class="x_content" align="center">               
                    <div id="div_grafica_mantenimiento_correctivo_usuarios"></div>
                </div>                
            </div>            
        </div>
    </div>


    {{-- DOBLE PIE MANTENIMIENTOS POR OFICINAS --}}    
    <div class="row">
        {{-- grafico de barras --}}
        <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="x_panel"> {{--tile fixed_height_320 overflow_hidden--}}
                <div class="x_title">
                    <h2>Top 5: Oficinas con mas Mantenimientos (Preventivos)</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>                
                    </ul>
                    <div class="clearfix"></div>
                    
                </div>
                <div class="x_content" align="center">               
                    <div id="div_grafica_mantenimiento_preventivo_oficinas"></div>
                </div>                
            </div>            
        </div>
        
        <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="x_panel"> {{--tile fixed_height_320 overflow_hidden--}}
                <div class="x_title">
                    <h2>Top 5: Oficinas con mas Mantenimientos (Correctivos)</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>                
                    </ul>
                    <div class="clearfix"></div>
                    
                </div>
                <div class="x_content" align="center">               
                    <div id="div_grafica_mantenimiento_correctivo_oficinas"></div>
                </div>                
            </div>            
        </div>
    </div>

    {{-- DOBLE PIE MANTENIMIENTOS POR RESPONSABLES MANTENIMIENTOS --}}    
    <div class="row">
        {{-- grafico de barras --}}
        <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="x_panel"> {{--tile fixed_height_320 overflow_hidden--}}
                <div class="x_title">
                    <h2>Mantenimientos asignados (Preventivos)</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>                
                    </ul>
                    <div class="clearfix"></div>
                    
                </div>
                <div class="x_content" align="center">               
                    <div id="div_grafica_mantenimiento_preventivo_asignados"></div>
                </div>                
            </div>            
        </div>
        
        <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="x_panel"> {{--tile fixed_height_320 overflow_hidden--}}
                <div class="x_title">
                    <h2>Mantenimientos asignados (Correctivos)</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>                
                    </ul>
                    <div class="clearfix"></div>
                    
                </div>
                <div class="x_content" align="center">               
                    <div id="div_grafica_mantenimiento_correctivo_asignados"></div>
                </div>                
            </div>            
        </div>
    </div>   
    

    {{-- fin fila graficos --}}
@endsection

@section('imports')
 <!-- Echarts -->
 <script src="{{ asset ('gentelella/vendors/echarts/dist/echarts.min.js') }}"></script>
 <script src="{{ asset ('gentelella/vendors/echarts/map/js/world.js') }}"></script>
 {{-- <script src="{{ asset ('gentelella/vendors/highcharts/highcharts.js') }}"></script> --}}
 <script src="{{ asset ('js/graficos.js') }}"></script>
 <script src="{{ asset ('js/highcharts.js') }}"></script>
 {{-- <script src="{{ asset ('js/data.js') }}"></script> --}}

 <!-- Echarts -->
 <script src="{{ asset ('gentelella/vendors/echarts/dist/echarts.min.js') }}"></script>
 <script src="{{ asset ('gentelella/vendors/echarts/map/js/world.js') }}"></script>
 <script src="{{ asset ('gentelella/vendors/highcharts/highcharts.js') }}"></script>
 <script src="{{ asset ('js/graficos.js') }}"></script>
 {{-- <script src="{{ asset ('js/highcharts.js') }}"></script> --}}
 {{-- <script src="{{ asset ('js/data.js') }}"></script> --}}
 {{-- <script src="{{ asset ('js/exporting.js') }}"></script> --}}
 {{-- <script src="{{ asset ('js/export-data.js') }}"></script> --}}


<script>
    cargar_grafica_pie();
    cargar_grafica_barras();
    /*aqui debe llamarse con parametros, inicio con (0,0) para no enviar una fecha en el cargue del página y validar en el controlador para obtener
     la grafica sin fechas, es decir el resumen total*/
    cargar_grafica_tipos_equipos(0,0);    
    cargar_grafica_topUsuarios();
    cargar_grafica_ticketsMes(0,0);
    cargar_grafica_mantenimientosMes(0);
    cargar_grafica_mantenimientosTipoMes(0);
    cargar_grafica_mantenimientosPreventUsuarios();
    cargar_grafica_mantenimientosCorrectUsuarios();
    cargar_grafica_mantenimientosPreventOficinas();
    cargar_grafica_mantenimientosCorrectOficinas();
    cargar_grafica_mantenimientosPreventAsignados();
    cargar_grafica_mantenimientosCorrectAsignados();
</script>
    
@endsection