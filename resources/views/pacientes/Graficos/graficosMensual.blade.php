@extends('theme.lte.layout')
@section('styles')
    <style>

        table tr:last-child td:first-child {
        border-bottom-left-radius: 10px;
        }

        table tr:last-child td:last-child {
            border-bottom-right-radius: 10px;
        }
        @media screen and (min-width: 300px) and (max-width: 565px) {
            .lista{
                    margin-top: 0;
            }
        }
    </style>
@endsection
@section('contenido')
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-9">
            <div class="card">
                <div class="card-header ">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <p class="card-title">Estadistica mensual</p>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="dropdown pull-right">
                                <button class="btn  btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Elegir periodo
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{route('graficos.index')}}">Diario</a>
                                    <a class="dropdown-item" href="{{route('graficos.semanal')}}">Semanal</a>
                                    <a class="dropdown-item" href="{{route('graficos.mensual')}}">Mensual</a>
                                    <a class="dropdown-item" href="{{route('graficos.anual')}}">Anual</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="padding:10px">
                    @if(count($query)>0)
                    <div class="tab-content" id="pills-tabContent">
                            <div class="tabe-pane fade " id="graficos" role="tabpanel" aria-labelledby="pills-graficos-tab">
                                <div class="row">
                                    <div-col-sm-12 class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">Resultados mensuales</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table text-center"  id="table-grafico" style="border-radius:15px">
                                                        <thead class="thead-dark">
                                                            <tr>
                                                                <th class="text-left">Producto</th>
                                                                <th>Cantidad</th>
                                                                <th>Total Generado</th>
                                                                <th>Total Cobrado</th>
                                                                <th>Total Por cobrar</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="bg-success">
                                                                <td class="text-left">Consultas</td>
                                                                <td id="cantidadConsultas"></td>
                                                                <td>$ {{$generadoConsulta}} </td>
                                                                <td>$ {{$cobradoConsulta}}</td>
                                                                <td>$ {{$generadoConsulta-$cobradoConsulta}}</td>
                                                            </tr>
                                                            <tr class="bg-info">
                                                                <td class="text-left">Procedimientos</td>
                                                                <td id="cantidadProcedimientos"></td>
                                                                <td>$ {{$generadoProcedimiento}} </td>
                                                                <td>$ {{$cobradoProcedimiento}}</td>
                                                                <td>$ {{$generadoProcedimiento-$cobradoProcedimiento}}</td>
                                                            </tr>
                                                            <tr class="bg-danger">
                                                                <td class="text-left">Biopsias</td>
                                                                <td id="cantidadBiopsias"></td>
                                                                <td>$ {{$generadoBiopsia}} </td>
                                                                <td>$ {{$cobradoBiopsia}}</td>
                                                                <td>$ {{$generadoBiopsia-$cobradoBiopsia}}</td>
                                                            </tr>
                                                            <tr class="bg-warning">
                                                                <td class="text-left">Total general</td>
                                                                <td id="cantidadTotal"></td>
                                                                <td >$ {{$generadoConsulta,$generadoBiopsia,$generadoProcedimiento}} </td>
                                                                <td>$ {{$cobradoBiopsia+$cobradoConsulta+$cobradoProcedimiento}}</td>
                                                                <td>$ {{($generadoConsulta-$cobradoConsulta)+($generadoProcedimiento-$cobradoProcedimiento)+($generadoBiopsia-$cobradoBiopsia)}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div-col-sm-12>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">Gráfico</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-8">
                                                        <img src="{{asset('assets/img/logosiimed3.png')}}" class="img-fluid" alt=""  style="position:absolute;  top: 45%;left: 38%;  width:25%">
                                                        <canvas id="grafico"  height="200px"></canvas>
                                                    </div>
                                                    <div class="col-sm-12 col-md-4">
                                                        <ul class="chart-legend clearfix " >
                                                            <li ><i class="fa fa-circle text-success"></i> <span id="consultas"></span> </li>
                                                            @foreach ($query as $item)
                                                                <li><i class="fa fa-circle text-info"></i> {{$item->proce.' '.$item->procedimiento_nombre}}</li>
                                                            @endforeach
                                                            <li><i class="fa fa-circle text-danger"></i> <span id="biopsiasView"></span> </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <h1 class="text-center"> Aún no hay registros</h1>
                        @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{asset('assets/plugins/chart.js/Chart.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/plugins/moment/moment.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/CardWidget.js')}}"></script>
<script>
    
    @if(isset($_GET['page']))
        $('a[href="#detalles"]').click();
    @else
        $('#graficos').addClass('show active');
    @endif
    

    var url = "{{url('chartMensual')}}";

    var Consultas = new Array();
    var Procedimientos = new Array();
    var Biopsias= new Array();
    var ProBiopsias=new Array();
    var ProSinBiopsia=new Array();
    $(document).ready(function(){
            $.get(url, function(response){
                response.forEach(function(data){
                    Consultas.push(data.consultas);
                    Procedimientos.push(data.procedimientos);
                    Biopsias.push(data.biopsia);
                    ProBiopsias.push(data.proceConBiopsia);
                    ProSinBiopsia.push(data.proceSinBiopsia);
                });

            if(Biopsias>0 || Procedimientos>0 || Consultas>0)
            {
                var circularChart = new Chart(document.querySelector('#grafico').getContext('2d'), {
                    type: 'doughnut', //Gráfica circular
                    data: {
                        labels: [" Consultas","procedimientos"," Biopsias"], //Etiquetas
                        datasets: [{
                            data: [Consultas,Procedimientos,Biopsias], //Cantidad de la ¿rebanada?
                            backgroundColor: [ //Color del segmento
                                "#38c172",
                                "#6cb2eb",
                                "#e3342f"
                            ],
                            hoverBackgroundColor: [ //Color al hacer hover al segmento
                                "#38c172",
                                "#6cb2eb",
                                "#e3342f"
                            ]
                        }]
                    },
                });
                var cantidadTotal= parseInt(Biopsias)+parseInt(Procedimientos)+parseInt(Consultas);
                document.getElementById("cantidadConsultas").innerHTML=Consultas;
                document.getElementById("cantidadProcedimientos").innerHTML=Procedimientos;
                document.getElementById("cantidadBiopsias").innerHTML=Biopsias;
                document.getElementById("cantidadTotal").innerHTML=cantidadTotal;
                document.getElementById("consultas").innerHTML=Consultas+" consultas";
                document.getElementById("biopsiasView").innerHTML=Biopsias+" biopsias";

                /* document.getElementById("conBiopsias").innerHTML="$ "+ProBiopsias;
                document.getElementById("sinBiopsias").innerHTML="$ "+ProSinBiopsia; */

            }
        });
    });
</script>
@endsection
