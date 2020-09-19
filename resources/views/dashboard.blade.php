<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> @yield('titulo') | Systick</title>
    <link rel="icon" href="{{asset('favicon.ico')}}" type="image/x-icon">
    
    <!-- Bootstrap -->
    <link href="{{ asset('gentelella/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('gentelella/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('gentelella/vendors/nprogress/nprogress.css') }}" rel="stylesheet">  
    <!-- iCheck -->
    <link href="{{ asset('gentelella/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">         
    <!-- bootstrap-progressbar -->
    <link href="{{ asset('gentelella/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }} " rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ asset('gentelella/vendors/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('gentelella/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{ asset('gentelella/build/css/custom.min.css') }} " rel="stylesheet">   
    
    @yield('headers')   
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              {{-- <a href="{{ asset('/index') }}" class="site_title">&nbsp;<i class="fa fa-pie-chart"></i> <span> &nbsp;&nbsp;&nbsp; Systick</span></a> --}}
              {{-- <a href="{{ asset('/index') }}" class="site_title">&nbsp; <img src="{{ asset('images/logos/1.png') }}" alt=""></a> --}}
              <br>
              {{-- se comenta este if porque estaba validado para que al hacer click en el logo del sidebar me redirigiera a listado de tickes para usuario standar --}}
              {{-- @if(Auth::user()->rol == 2 || Auth::user()->rol == 1)
                <center><a href="{{asset('/index')}}"><img width="140" height="90" src="{{ asset('images/logos/1.png') }}" alt=""></a></center>              
              @else
                <center><a href="{{asset('/tickets/ver_tickets')}}"><img width="140" height="90" src="{{ asset('images/logos/1.png') }}" alt=""></a></center>
              @endif --}}
              <center><a href="{{asset('/index')}}"><img width="140" height="90" src="{{ asset('images/logos/1.png') }}" alt=""></a></center>              
            </div>

            <div class="clearfix"></div>
            <br><br><br>
            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{ asset('images/profiles/'.Auth::user()->imagen)}}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Bienvenido,</span>
                <h2>{{Auth::user()->name}}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                <div class="menu_section">
                  <h3>Menú</h3>
                  <ul class="nav side-menu">

                    @if(Auth::user()->rol == 2 || Auth::user()->rol == 1)
                    <li><a><i class="fa fa-home"></i> Inicio <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="{{ url ('/estadisticas/ver') }}">Reportes</a></li>                     
                      </ul>
                    </li>

                    @endif

                    @if (Auth::user()->rol == 2)
                      <li><a><i class="fa fa-users"></i> Usuarios <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="{{ url ('/usuarios/ver_usuarios') }}">Gestión de Usuarios</a></li>                      
                        </ul>
                      </li>                        
                    @endif

                    @if ( Auth::user()->rol == 2 || Auth::user()->rol == 1 )
                      <li><a><i class="fa fa-desktop"></i> Equipos <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="{{ url('/equipos/ver_equipos') }}">Gestión equipos</a></li>                      
                        </ul>
                      </li>
                      
                      <li><a><i class="fa fa-building"></i> Oficinas <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="{{ url('/oficinas/ver_oficinas') }}">Gestión Oficinas</a></li>                      
                        </ul>
                      </li>
                      
                      <li><a><i class="fa fa-puzzle-piece"></i> Servicios <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="{{ url('/servicios/ver_servicios') }}">Gestión de Servicios</a></li>                      
                        </ul>
                      </li>
                    @endif
                    
                    @if ((Auth::user()->rol == 0)||(Auth::user()->rol == 2 || Auth::user()->rol == 1))
                      <li><a><i class="fa fa-ticket"></i> Tickets <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="{{ url ('/tickets/ver_tickets') }}">Gestión de Tickets</a></li>                      
                        </ul>
                      </li>
                    @endif
                    @if (Auth::user()->rol == 2 || Auth::user()->rol == 1)
                      <li><a><i class="fa fa-cogs"></i> Mantenimientos <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="{{ url ('/mantenimientos/ver_mantenimientos') }}">Gestión de Mantenimientos</a></li>                      
                        </ul>
                      </li>                    

                      <li><a><i class="fa fa-clone"></i> Otros <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="{{ url('/antivirus/ver_antivirus') }}">Antivirus</a></li>
                          <li><a href="{{ url('/sistemas/ver_sistemas') }}">Sistemas Operativos</a></li>
                          <li><a href="{{ url('/suite/ver_suite') }}">Suite Ofimatica</a></li>
                          <li><a href="{{ url('/marcas/ver_marcas') }}">Marcas de Equipos</a></li>
                          <li><a href="{{ url('/tipos/ver_tipos') }}">Tipos de Equipos</a></li>
                          <li><a href="{{ url('/softwares/ver_softwares') }}">Otros Softwares</a></li>
                          {{-- <li><a href="{{ url('/bitacora/listar') }}">Bitácora</a></li>--}}
                        </ul>
                      </li>
                    @endif
                    
                    @if (Auth::user()->rol == 2)
                      <li><a><i class="fa fa-eye"></i> Bitácora <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="{{ url('/bitacora/listar') }}">Ver bitácora del sistema</a></li>                      
                        </ul>
                      </li>
                    @endif
                    

                  </ul>
                </div> 
              </div>
              <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            {{-- <div class="sidebar-footer hidden-small">
                <a data-toggle="tooltip" data-placement="top">
                  <span class="glyphicon glyphicon-cog-" aria-hidden="true"></span>
                </a>
                <a data-toggle="tooltip" data-placement="top">
                  <span class="glyphicon glyphicon-fullscreen-" aria-hidden="true"></span>
                </a>
                <a data-toggle="tooltip" data-placement="top">
                  <span class="glyphicon glyphicon-eye-close-" aria-hidden="true"></span>
                </a>
                <a data-toggle="tooltip" data-placement="top">
                  <span class="glyphicon glyphicon-off-" aria-hidden="true"></span>
                </a>
            </div> --}}
              <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    {{-- <img src="{{ asset('gentelella/production/images/img.jpg')}}" alt="">{{Auth::user()->name}} --}}
                    <img src="{{ asset('images/profiles/'.Auth::user()->imagen)}}">{{Auth::user()->name}}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="{{ asset('/usuarios/editar/'.Auth::user()->id) }}"> Perfil</a></li>
                    {{-- <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li> --}}
                    {{-- <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li> --}}
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            Salir
                            <i class="fa fa-sign-out pull-right"></i>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-bell-o"></i>
                    @if (isset($contNoti))
                      @if ($contNoti != 0)
                        <span class="badge bg-green">
                          {{$contNoti}}
                        </span>    
                      @endif
                    @endif
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">

                    @if (isset($Notificaciones))
                    @foreach ($Notificaciones as $Noti)
                      <li>
                        <a href="{{ asset('/tickets/ver/notificacion/'.$Noti->ticket_id.'/'.$Noti->id) }}">
                          <span class="image"><img src="{{ asset('images/profiles/'.$Noti->usuarios->imagen)}}" alt="Profile Image" /></span>
                          {{-- <span class="image"><img src="{{ asset('gentelella/production/images/img.jpg')}}" alt="Profile Image" /></span> --}}
                          <span>
                            <span><b>{{$Noti->persona}}</b></span>                           
                            <span class="time">{{$Noti->transcurrido($Noti->created_at)}}</span>
                          </span>
                          <span class="message">
                            {{-- Film festivals used to be do-or-die moments for movie makers. They were where... --}}
                            {!!$Noti->mensaje.'...'!!}
                          </span>
                        </a>
                      </li>                        
                    @endforeach
                    @endif                 

                    <li>
                      <div class="text-center">
                        <a href="{{ asset('/tickets/notificaciones') }}">
                          <strong>Ver todas las notificaciones</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        
        <div class="right_col" role="main">

            @section('content')

            {{-- titulo página --}}
            <div class="page-title">
                <div class="title_left">
                <h3>¡Bienvenido a Systick!</h3>
                </div>    
            </div>

            {{-- Fin titulo página --}}
            <div class="clearfix"></div>

            {{-- CONTENIDO PAGINA INICIO --}}
            <div class="row">
                {{-- grafico de barras --}}
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel"> {{--tile fixed_height_320 overflow_hidden--}}
                        {{-- <div class="x_title">
                            <h2>Grafica de barras</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li>&nbsp;</li>
                                <li>&nbsp;</li>
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>                
                            </ul>
                            <div class="clearfix"></div>
                            
                        </div> --}}
                        <div class="x_content" align="center">               
                            <div>
                              <br>
                              <img src="{{asset('images/logos/Logo_corp.png')}}" width="600px" title="Logo Corporación Autonoma regional del Cesar">
                              <br><br>
                                <div>
                                  <table>
                                      <tr>
                                          <td></td>
                                          <td width="900px">
                                            <h5 align="justify">
                                                Estimado(a) usuario <b>{{Auth::user()->name}}</b>.<br><br>
          
                                                Muchas gracias por hacer uso de Systick! Mediante esta plataforma podrás gestionar ante la coordinación del GIT de sistemas y TIC´S las solicitudes de diferentes tipos que se puedan presentar en tu día de trabajo.<br><br>
          
                                                Esta herramienta tiene el fin de optimizar el proceso de gestión de solicitudes ante la coordinación del GIT de sistemas y TIC´S, y contribuir correcto manejo de los recursos TIC’S de la entidad; así como a mejorar la comunicación asertiva y a contribuir con la reducción de uso de papel en las comunicaciones realizadas entre las diferentes dependencias de la entidad y la coordinación del GIT de sistemas y TIC´S.<br><br>
                                                Recuerda que en caso de tener alguna duda o pregunta sobre el manejo del sistema, siempre podrás descargar el 
                                                @if (Auth::user()->rol == 0)
                                                  <a href="{{ asset('files/manual/Manual_de_usuario_standar.pdf') }}" download="Manual_de_usuario_standar.pdf"><b><i><u>manual de usuario</u></i></b></a>     
                                                @else
                                                  <a href="{{ asset('files/manual/Manual_de_usuario_admin.pdf') }}" download="Manual_de_usuario_admin.pdf"><b><i><u>manual de usuario</u></i></b></a>   
                                                @endif
                                                
                                                del sistema o si lo prefieres, contactarte con el administrador del sistema.
                                                <br><br>
                                            </h5>
                                          </td>
                                          <td></td>
                                      </tr>
                                  </table>                                  
                              </div>
                            </div>
                            {{-- style="width:450px; height:250px;"  --}}
                        </div>
                        
                    </div>
                    
                </div>
                
            </div>
          <!-- top tiles -->
          {{-- <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
              <div class="count">2500</div>
              <span class="count_bottom"><i class="green">4% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Average Time</span>
              <div class="count">123.50</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Males</span>
              <div class="count green">2,500</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Females</span>
              <div class="count">4,567</div>
              <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Collections</span>
              <div class="count">2,315</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Connections</span>
              <div class="count">7,325</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
          </div> --}}
          <!-- /top tiles -->

          {{-- <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Network Activities <small>Graph title sub-title</small></h3>
                  </div>
                  <div class="col-md-6">
                    <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                      <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                      <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                    </div>
                  </div>
                </div>

                <div class="col-md-9 col-sm-9 col-xs-12">
                  <div id="chart_plot_01" class="demo-placeholder"></div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 bg-white">
                  <div class="x_title">
                    <h2>Top Campaign Performance</h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="col-md-12 col-sm-12 col-xs-6">
                    <div>
                      <p>Facebook Campaign</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="80"></div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <p>Twitter Campaign</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 col-sm-12 col-xs-6">
                    <div>
                      <p>Conventional Media</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="40"></div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <p>Bill boards</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>

                <div class="clearfix"></div>
              </div>
            </div>

          </div> --}}
          {{-- <br /> --}}

          {{-- <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>App Versions</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <h4>App Usage across versions</h4>
                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>0.1.5.2</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 66%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span>123k</span>
                    </div>
                    <div class="clearfix"></div>
                  </div>

                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>0.1.5.3</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 45%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span>53k</span>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>0.1.5.4</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span>23k</span>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>0.1.5.5</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 5%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span>3k</span>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>0.1.5.6</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 2%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span>1k</span>
                    </div>
                    <div class="clearfix"></div>
                  </div>

                </div>
              </div>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320 overflow_hidden">
                <div class="x_title">
                  <h2>Device Usage</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="" style="width:100%">
                    <tr>
                      <th style="width:37%;">
                        <p>Top 5</p>
                      </th>
                      <th>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                          <p class="">Device</p>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                          <p class="">Progress</p>
                        </div>
                      </th>
                    </tr>
                    <tr>
                      <td>
                        <canvas class="canvasDoughnut" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                      </td>
                      <td>
                        <table class="tile_info">
                          <tr>
                            <td>
                              <p><i class="fa fa-square blue"></i>IOS </p>
                            </td>
                            <td>30%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square green"></i>Android </p>
                            </td>
                            <td>10%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square purple"></i>Blackberry </p>
                            </td>
                            <td>20%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square aero"></i>Symbian </p>
                            </td>
                            <td>15%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square red"></i>Others </p>
                            </td>
                            <td>30%</td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>


            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Quick Settings</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">
                    <ul class="quick-list">
                      <li><i class="fa fa-calendar-o"></i><a href="#">Settings</a>
                      </li>
                      <li><i class="fa fa-bars"></i><a href="#">Subscription</a>
                      </li>
                      <li><i class="fa fa-bar-chart"></i><a href="#">Auto Renewal</a> </li>
                      <li><i class="fa fa-line-chart"></i><a href="#">Achievements</a>
                      </li>
                      <li><i class="fa fa-bar-chart"></i><a href="#">Auto Renewal</a> </li>
                      <li><i class="fa fa-line-chart"></i><a href="#">Achievements</a>
                      </li>
                      <li><i class="fa fa-area-chart"></i><a href="#">Logout</a>
                      </li>
                    </ul>

                    <div class="sidebar-widget">
                        <h4>Profile Completion</h4>
                        <canvas width="150" height="80" id="chart_gauge_01" class="" style="width: 160px; height: 100px;"></canvas>
                        <div class="goal-wrapper">
                          <span id="gauge-text" class="gauge-value pull-left">0</span>
                          <span class="gauge-value pull-left">%</span>
                          <span id="goal-text" class="goal-value pull-right">100%</span>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div> --}}
          
          @show
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
              Systick, Corporacion Autonoma Regional del Cesar - José F. Palacio S.
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset ('gentelella/vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset ('gentelella/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset ('gentelella/vendors/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ asset ('gentelella/vendors/nprogress/nprogress.js') }}"></script>
    <!-- Chart.js -->
    <script src="{{ asset ('gentelella/vendors/Chart.js/dist/Chart.min.js') }}"></script>
    <!-- gauge.js -->
    <script src="{{ asset ('gentelella/vendors/gauge.js/dist/gauge.min.js') }}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ asset ('gentelella/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset ('gentelella/vendors/iCheck/icheck.min.js') }}"></script>
    <!-- Skycons -->
    <script src="{{ asset ('gentelella/vendors/skycons/skycons.js') }}"></script>
    <!-- Flot -->
    <script src="{{ asset ('gentelella/vendors/Flot/jquery.flot.js') }}"></script>
    <script src="{{ asset ('gentelella/vendors/Flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset ('gentelella/vendors/Flot/jquery.flot.time.js') }}"></script>
    <script src="{{ asset ('gentelella/vendors/Flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset ('gentelella/vendors/Flot/jquery.flot.resize.js') }}"></script>
    <!-- Flot plugins -->
    <script src="{{ asset ('gentelella/vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
    <script src="{{ asset ('gentelella/vendors/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
    <script src="{{ asset ('gentelella/vendors/flot.curvedlines/curvedLines.js') }}"></script>
    <!-- DateJS -->
    <script src="{{ asset ('gentelella/vendors/DateJS/build/date.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset ('gentelella/vendors/jqvmap/dist/jquery.vmap.js') }}"></script>
    <script src="{{ asset ('gentelella/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset ('gentelella/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset ('gentelella/vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset ('gentelella/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    @yield('imports')

    <!-- Custom Theme Scripts -->
    <script src="{{ asset ('gentelella/build/js/custom.min.js') }}"></script>
	
  </body>
</html>
