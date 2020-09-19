
function cambiar_fecha_grafica_tiposEquipos(){

    var anio_sel=$("#anio_sel").val();
    var mes_sel=$("#mes_sel").val();    
    cargar_grafica_tipos_equipos(anio_sel, mes_sel);
}

function cambiar_fecha_grafica_ticketsMes(){
    var anio_mes=$("#anio_mes").val();
    var mes_mes=$("#mes_mes").val();
    cargar_grafica_ticketsMes(anio_mes, mes_mes);
}

function cambiar_fecha_grafica_mantenimientosMes(){
    var anio_mante=$("#anio_mante").val();
    cargar_grafica_mantenimientosMes(anio_mante);
}

function cambiar_fecha_grafica_mantenimientosTipoMes(){
    var anio_TipoMante=$("#anio_TipoMante").val();
    cargar_grafica_mantenimientosTipoMes(anio_TipoMante);
}

// inicio funcion de graficas barra
function cargar_graficas_barras(anio,mes){

    var options = {
        chart:{
            renderTo: 'div_grafica_barras',
            type:'column'
        },
        title:{
            text:'Numero de registros por mes'
        },
        subtitle:{
            text:'Systick'
        },
        xAxis:{
            categories: [],
            title:{
                text:'días del mes'
            },
            crosshair:true
        },
        yAxis:{
            min:0,
            title:{
                text:'Registros al día'
            }
        },
        tooltip:{
            headerFormat:'<span style="font-size:10px">{point.key}</span><table>',
            pointFormat:'<tr><td style="color:{series.color};padding:0">{series.name}: </td>'+'<td style="padding:0"><b>{point.y} </b></td></tr>',
            footerFormat:'</table>',
            shared: true,
            useHTML:true
        },
        plotOptions:{
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series:[{
            name: 'registros',
            data: []
        }]
    }

    // $("#div_grafica_barras").html( $("#cargador_empresa").html() );

    var url = "grafica_registros/"+anio+"/"+mes+"";


    $.get(url,function(resul){
    var datos= jQuery.parseJSON(resul);
    var totaldias=datos.totaldias;
    var registrosdia=datos.registrosdia;
    var i=0;

    for(i=1;i<=totaldias;i++){        
        options.series[0].data.push( registrosdia[i] );
        options.xAxis.categories.push(i);
    }


    //options.title.text="aqui e podria cambiar el titulo dinamicamente";
    chart = new Highcharts.Chart(options);

    })
    
}
// final graficos barras


// inicio graficos pie
function cargar_grafica_pie(){

    var options={
         // Build the chart
         
        chart: {
            renderTo: 'div_grafica_pie',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Tickets por servicios'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b><br>Cantidad: <b>{point.y}</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Porcentaje',
            colorByPoint: true,
            data: []
        }]         
    }
    
    // se coloca el nombre de la ruta para cargar los datos
    var url = "tiposServicios";    
    
    $.get(url,function(resul){
    var datos= jQuery.parseJSON(resul);
    // var tipos=datos.tipos;
    var servicios=datos.servicios;
    // var totattipos=datos.totaltipos;
    var totalservicios=datos.totalservicios;
    // var numeropublicaciones=datos.numerodepubli;
    var numServixTicket=datos.numServixTicket;
    
        for(i=0;i<=totalservicios-1;i++){  
        var idTP=parseInt(servicios[i].id);
        var objeto= {name: servicios[i].nombre, y: numServixTicket[idTP] };     
        options.series[0].data.push( objeto );  
        }
     //options.title.text="aqui e podria cambiar el titulo dinamicamente";
     chart = new Highcharts.Chart(options);
    
    })
    
}

// GRAFICO DE BARRAS - CANTIDAD DE TICKETS POR OFICINA
function cargar_grafica_barras(){

    var options = {
        // config

        chart: {
            renderTo: 'div_grafica_barras',
            type: 'column'
        },
        title: {
            text: 'Cantidad de Tickets por Oficina'
        },
        subtitle: {
            text: 'Systick'
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '10px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Cantidad de Tickets'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Total de tickets: <b>{point.y}</b>'
            
        },
        series: [{
            name: 'Oficinas',
            data: [],
            dataLabels: {
                enabled: true,
                rotation: 0,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y}', // one decimal
                y: 35, // 35 pixels down from the top
                x: -35, // 35 pixels left from the right
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    }   

    var url = "ticketsOficinas";    
    
    $.get(url,function(resul){
    var datos= jQuery.parseJSON(resul);
    // var tipos=datos.tipos;
    var oficinas=datos.oficinas;
    // var totattipos=datos.totaltipos;
    var totaloficinas=datos.totalOficinas;
    // var numeropublicaciones=datos.numerodepubli;
    var numTicketsxOficinas=datos.numOficinas;
    
        for(i=0;i<=totaloficinas-1;i++){  
            var idTP=parseInt(oficinas[i].id);
            var objeto= {name: oficinas[i].nombre, y: numTicketsxOficinas[idTP] };     
            options.series[0].data.push( objeto );  
        }
     //options.title.text="aqui e podria cambiar el titulo dinamicamente";
     chart = new Highcharts.Chart(options);
    
    })    
}


// TIQUETS POR TIPOS DE EQUIPOS
function cargar_grafica_tipos_equipos(anio,mes){
    
    var options = {

        // Radialize the colors
        colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
            return {
                radialGradient: {
                    cx: 0.5,
                    cy: 0.3,
                    r: 0.7
                },
                stops: [
                    [0, color],
                    [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
                ]
            };
        }),

        // Build the chart
        chart: {
            renderTo: 'div_grafica_tipos_equipos',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Tickets por tipos de equipos'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b><br>Cantidad: <b>{point.y}</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    connectorColor: 'silver'
                }
            }
        },
        series: [{
            name: 'Porcentaje',
            data: []
        }]
    }
    
    var url = "ticketsEquipos/"+anio+"/"+mes+"";
    
    
    $.get(url,function(resul){
    var datos= jQuery.parseJSON(resul);    
    var tiposEquipos=datos.tiposEquipos;    
    var totalTiposEquipos=datos.totalTiposEquipos;    
    var numTicketsxEquipos=datos.numTicketsxEquipos;

        for(i=0;i<=totalTiposEquipos-1;i++){  
            var idTP=parseInt(tiposEquipos[i].id);
            var objeto= {name: tiposEquipos[i].nombre, y: numTicketsxEquipos[idTP] };     
            options.series[0].data.push( objeto );  
        }
     //options.title.text="aqui e podria cambiar el titulo dinamicamente";
     chart = new Highcharts.Chart(options);
    
    })  
}

// TOP 5 USUARIOS
function cargar_grafica_topUsuarios(){

    // Make monochrome colors
    var pieColors = (function () {
        var colors = [],
            base = Highcharts.getOptions().colors[0],
            i;

        for (i = 0; i < 10; i += 1) {
            // Start out with a darkened base color (negative brighten), and end
            // up with a much brighter color
            colors.push(Highcharts.Color(base).brighten((i - 3) / 7).get());
        }
        return colors;
    }());

    // Build the chart
    var options = {
        chart: {
            renderTo:'div_grafica_topUsuarios',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Top 5: Usuarios con mas Tickets'
        },
        tooltip: {
            // pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b><br>Cantidad: <b>{point.y}</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                colors: pieColors,
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
                    distance: -50,
                    filter: {
                        property: 'percentage',
                        operator: '>',
                        value: 4
                    }
                }
            }
        },
        series: [{
            name: 'Porcentaje',
            data: [
                // { name: 'Chrome', y: 61.41 },
                // { name: 'Internet Explorer', y: 11.84 },
                // { name: 'Firefox', y: 10.85 },
                // { name: 'Edge', y: 4.67 },
                // { name: 'Safari', y: 4.18 },
                // { name: 'Other', y: 7.05 }
            ]
        }]
    }
//chart = new Highcharts.Chart(options);

    var url = "usuariosMasTickets";    
    $.get(url,function(resul){
        var datos= jQuery.parseJSON(resul);    
        //var usuarios=datos.usuarios;
        var usuarios=datos.nuevosUsuarios;    
        //var totalUsuarios=datos.totalUsuarios;
        var totalUsuarios2=datos.totalUsuarios2;  
        var topUsuarios=datos.topUsuarios;

            for(i=0;i<=totalUsuarios2-1;i++){  
                var idTP=parseInt(usuarios[i].id);
                var objeto= {name: usuarios[i].name, y: topUsuarios[idTP] };     
                options.series[0].data.push( objeto );  
            }
        //options.title.text="aqui e podria cambiar el titulo dinamicamente";
        chart = new Highcharts.Chart(options);    
    })
}

// function cargar_grafico_pie22(anio, mes){

// }

// GRAFICO DE BARRAS - CANTIDAD DE TICKETS POR MES
function cargar_grafica_ticketsMes(anio,mes){

    var options = {
        
        chart: {
            renderTo: 'div_grafica_ticketsMes',
           
        },
          title: {
            text: 'Tickets por días del mes',
            x: -20 //center
        },
        subtitle: {
            text: 'Systick',
            x: -20
        },
        xAxis: {
            title: {
                text:'Días del Mes'
        },
            categories: []
        },
        yAxis: {
            title: {
                text: 'TICKETS POR DIA'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },  
        tooltip: {
            valueSuffix: ' Tickets'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Cantidad',
            data: []
        }]
    }    
    var url = "ticketsMes/"+anio+"/"+mes+"";

    $.get(url,function(resul){
        var datos= jQuery.parseJSON(resul);
        var totaldias=datos.totalDias;
        var registrosdia=datos.registrosDia;
        var i=0;
            for(i=1;i<=totaldias;i++){            
                options.series[0].data.push( registrosdia[i] );
                options.xAxis.categories.push(i);       
            }
         //options.title.text="aqui e podria cambiar el titulo dinamicamente";
         chart = new Highcharts.Chart(options);
        
    })            
}

function cargar_grafica_mantenimientosMes(anio){

   var options={
    
        chart: {
            renderTo: 'div_grafica_mantenimientosMensuales',
            type: 'column'
        },
        title: {
            text: 'Reporte Mensual de Mantenimientos'
        },
        subtitle: {
            text: 'Systick'
        },
        xAxis: {
            categories: [
                'Ene',
                'Feb',
                'Mar',
                'Abr',
                'May',
                'Jun',
                'Jul',
                'Ago',
                'Sep',
                'Oct',
                'Nov',
                'Dic'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Mantenimientos (Unidad)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{}] 
        }           
        
        //     {
        //     name: 'Tokyo',
        //     data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
    
        // }, {
        //     name: 'New York',
        //     data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]
    
        // }, {
        //     name: 'London',
        //     data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]
    
        // }, {
        //     name: 'Berlin',
        //     data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]
    
        // }

      var url = "mantenimientosMes/"+anio+"";

    $.get(url,function(resul){
        var datos= jQuery.parseJSON(resul);
        var totalTipoEquipos = datos.totalTipoEquipos;
        var registros = datos.series;
            for(j=0; j<=totalTipoEquipos-1;j++){                
                options.series.push(registros[j]);
            }    
         
        //cambio el titulo del grafico de manera dinamica
        options.title.text="Reporte Mensual de Mantenimientos ("+datos.anio+")";
        chart = new Highcharts.Chart(options);
        
    })   
}

function cargar_grafica_mantenimientosTipoMes(anio){

    var options={
     
         chart: {
             renderTo: 'div_grafica_mantenimientosMensualesTipo',
             type: 'column'
         },
         title: {
             text: 'Reporte Mensual de Mantenimientos por Tipos'
         },
         subtitle: {
             text: 'Systick'
         },
         xAxis: {
             categories: [
                 'Ene',
                 'Feb',
                 'Mar',
                 'Abr',
                 'May',
                 'Jun',
                 'Jul',
                 'Ago',
                 'Sep',
                 'Oct',
                 'Nov',
                 'Dic'
             ],
             crosshair: true
         },
         yAxis: {
             min: 0,
             title: {
                 text: 'Mantenimientos (Unidad)'
             }
         },
         tooltip: {
             headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
             pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                 '<td style="padding:0"><b>{point.y}</b></td></tr>',
             footerFormat: '</table>',
             shared: true,
             useHTML: true
         },
         plotOptions: {
             column: {
                 pointPadding: 0.2,
                 borderWidth: 0
             }
         },
         series: [{}] 
         }       
 
       var url = "tipoManteMes/"+anio+"";
 
     $.get(url,function(resul){
         var datos= jQuery.parseJSON(resul);
         var totalTipoMante = datos.cantTipoMante;
         var registros2 = datos.series;
             for(j=0; j<=totalTipoMante-1;j++){                
                 options.series.push(registros2[j]);
             }    
          
         //cambio el titulo del grafico de manera dinamica
         options.title.text="Reporte Mensual de Mantenimientos por Tipo ("+datos.anio+")";
         chart = new Highcharts.Chart(options);
         
     })   
 }

//  function cargar_grafica_mantenimientosUsuarios()

// TOP 5 USUARIOS CON MAS MANTENIMIENTOS PREVENTIVOS
function cargar_grafica_mantenimientosPreventUsuarios(){
    
    var options = {

        // Radialize the colors
        colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
            return {
                radialGradient: {
                    cx: 0.5,
                    cy: 0.3,
                    r: 0.7
                },
                stops: [
                    [0, color],
                    [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
                ]
            };
        }),

        // Build the chart
        chart: {
            renderTo: 'div_grafica_mantenimiento_preventivo_usuarios',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Mantenimientos preventivos por usuarios'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b><br>Cantidad: <b>{point.y}</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    connectorColor: 'silver'
                }
            }
        },
        series: [{
            name: 'Porcentaje',
            data: []
        }]
    }
    
    var url = "usuariosMante";    
    $.get(url,function(resul){
        var datos = jQuery.parseJSON(resul);
        var usuarios = datos.nuevosUsersP;
        var totalUsuarios = datos.totalUsersP;
        var topUsuariosP = datos.ordenadoP;

        for(i=0; i<=totalUsuarios-1; i++){
            var idTP = parseInt(usuarios[i].id);
            var objeto = {name: usuarios[i].name, y:topUsuariosP[idTP]};
            options.series[0].data.push(objeto);
        }
        chart = new Highcharts.Chart(options);
    
    })  
}

// TOP 5 USUARIOS CON MAS MANTENIMIENTOS CORRECTIVOS
function cargar_grafica_mantenimientosCorrectUsuarios(){
    
    var options = {

        // Radialize the colors
        colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
            return {
                radialGradient: {
                    cx: 0.5,
                    cy: 0.3,
                    r: 0.7
                },
                stops: [
                    [0, color],
                    [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
                ]
            };
        }),

        // Build the chart
        chart: {
            renderTo: 'div_grafica_mantenimiento_correctivo_usuarios',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Mantenimientos correctivos por usuarios'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b><br>Cantidad: <b>{point.y}</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    connectorColor: 'silver'
                }
            }
        },
        series: [{
            name: 'Porcentaje',
            data: []
        }]
    }
    
    var url = "usuariosMante";    
    $.get(url,function(resul){
        var datos = jQuery.parseJSON(resul);
        var usuarios = datos.nuevosUsersC;
        var totalUsuarios = datos.totalUsersC;
        var topUsuariosC = datos.ordenadoC;

        for(i=0; i<=totalUsuarios-1; i++){
            var idTP = parseInt(usuarios[i].id);
            var objeto = {name: usuarios[i].name, y:topUsuariosC[idTP]};
            options.series[0].data.push(objeto);
        }
        chart = new Highcharts.Chart(options);
    
    })  
}


// TOP 5 OFICINAS CON MAS MANTENIMIENTOS PREVENTIVOS
function cargar_grafica_mantenimientosPreventOficinas(){
    
    var options = {

        // Radialize the colors
        colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
            return {
                radialGradient: {
                    cx: 0.5,
                    cy: 0.3,
                    r: 0.7
                },
                stops: [
                    [0, color],
                    [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
                ]
            };
        }),

        // Build the chart
        chart: {
            renderTo: 'div_grafica_mantenimiento_preventivo_oficinas',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Mantenimientos preventivos por oficinas'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b><br>Cantidad: <b>{point.y}</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    connectorColor: 'silver'
                }
            }
        },
        series: [{
            name: 'Porcentaje',
            data: []
        }]
    }
    
    var url = "oficinasMante";    
    $.get(url,function(resul){
        var datos = jQuery.parseJSON(resul);
        var oficinas = datos.nuevosOficinaP;
        var totalOficinasP = datos.totalOficinasP;
        var topOficinasP = datos.ordenadoP;

        for(i=0; i<=totalOficinasP-1; i++){
            var idTP = parseInt(oficinas[i].id);
            var objeto = {name: oficinas[i].nombre, y:topOficinasP[idTP]};
            options.series[0].data.push(objeto);
        }
        chart = new Highcharts.Chart(options);
    
    })  
}

// TOP 5 OFICINAS CON MAS MANTENIMIENTOS CORRECTIVOS
function cargar_grafica_mantenimientosCorrectOficinas(){
    
    var options = {

        // Radialize the colors
        colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
            return {
                radialGradient: {
                    cx: 0.5,
                    cy: 0.3,
                    r: 0.7
                },
                stops: [
                    [0, color],
                    [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
                ]
            };
        }),

        // Build the chart
        chart: {
            renderTo: 'div_grafica_mantenimiento_correctivo_oficinas',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Mantenimientos correctivos por oficinas'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b><br>Cantidad: <b>{point.y}</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    connectorColor: 'silver'
                }
            }
        },
        series: [{
            name: 'Porcentaje',
            data: []
        }]
    }
    
    var url = "oficinasMante";    
    $.get(url,function(resul){
        var datos = jQuery.parseJSON(resul);
        var oficinas = datos.nuevosOficinasC;
        var totalOficinaC = datos.totalOficinaC;
        var topUsuariosC = datos.ordenadoC;

        for(i=0; i<=totalOficinaC-1; i++){
            var idTP = parseInt(oficinas[i].id);
            var objeto = {name: oficinas[i].nombre, y:topUsuariosC[idTP]};
            options.series[0].data.push(objeto);
        }
        chart = new Highcharts.Chart(options);
    
    })  
}


// USUARIOS ASIGNADOS
// TOP 5 USUARIOS CON MAS MANTENIMIENTOS PREVENTIVOS
function cargar_grafica_mantenimientosPreventAsignados(){
    
    var options = {

        // Radialize the colors
        colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
            return {
                radialGradient: {
                    cx: 0.5,
                    cy: 0.3,
                    r: 0.7
                },
                stops: [
                    [0, color],
                    [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
                ]
            };
        }),

        // Build the chart
        chart: {
            renderTo: 'div_grafica_mantenimiento_preventivo_asignados',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Mantenimientos preventivos por usuarios'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b><br>Cantidad: <b>{point.y}</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    connectorColor: 'silver'
                }
            }
        },
        series: [{
            name: 'Porcentaje',
            data: []
        }]
    }
    
    var url = "asignadosMante";    
    $.get(url,function(resul){
        var datos = jQuery.parseJSON(resul);
        var usuarios = datos.nuevosUsersP;
        var totalUsuarios = datos.totalUsersP;
        var topUsuariosP = datos.ordenadoP;

        for(i=0; i<=totalUsuarios-1; i++){
            var idTP = parseInt(usuarios[i].id);
            var objeto = {name: usuarios[i].name, y:topUsuariosP[idTP]};
            options.series[0].data.push(objeto);
        }
        chart = new Highcharts.Chart(options);
    
    })  
}

// USUARIOS ASIGNADOS
// TOP 5 USUARIOS CON MAS MANTENIMIENTOS CORRECTIVOS
function cargar_grafica_mantenimientosCorrectAsignados(){
    
    var options = {

        // Radialize the colors
        colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
            return {
                radialGradient: {
                    cx: 0.5,
                    cy: 0.3,
                    r: 0.7
                },
                stops: [
                    [0, color],
                    [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
                ]
            };
        }),

        // Build the chart
        chart: {
            renderTo: 'div_grafica_mantenimiento_correctivo_asignados',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Mantenimientos correctivos por usuarios'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b><br>Cantidad: <b>{point.y}</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    connectorColor: 'silver'
                }
            }
        },
        series: [{
            name: 'Porcentaje',
            data: []
        }]
    }
    
    var url = "asignadosMante";    
    $.get(url,function(resul){
        var datos = jQuery.parseJSON(resul);
        var usuarios = datos.nuevosUsersC;
        var totalUsuarios = datos.totalUsersC;
        var topUsuariosC = datos.ordenadoC;

        for(i=0; i<=totalUsuarios-1; i++){
            var idTP = parseInt(usuarios[i].id);
            var objeto = {name: usuarios[i].name, y:topUsuariosC[idTP]};
            options.series[0].data.push(objeto);
        }
        chart = new Highcharts.Chart(options);
    
    })  
}