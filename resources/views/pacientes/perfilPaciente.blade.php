@extends('theme.lte.layout')
@section('styles')
<link href="{{asset('css/select.css')}}" rel="stylesheet"/> 
<link href="{{asset('css/fileinput.css')}}" media="all" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="{{asset("assets/plugins/font-awesome/css/font-awesome.min.css")}}">
<style type="text/css">
    .main-section{
        margin:0 auto;
        padding: 20px;
        margin-top: 100px;
        background-color: #fff;
        box-shadow: 0px 0px 20px #c1c1c1;
    }
    .img-pointer{
        cursor: pointer;      
    }, 
    .selectborder{
        background: black ;
        color: #000;
        width: 3px;
        border: solid 2px black;
    }    
    .mensaje{
        color: blue;
        text-decoration: underline;
    } 
    .quitarunderline{
        text-decoration: none;
        color: red;
    }
    .editable{
        border: solid black 1px;
        border-radius: 10px;
        width:100%;
        height:auto;
        min-height: 170px;
       /*  overflow:auto; */
        padding-left:10px;
    }    

    .p{
        padding-top:0px;
    }
    .cborder{
        border: solid #009999 1px;
    }
    .cborder2{
       border: solid  #3399ff 1px;
    }
    .cborder3{
       border: solid  #000 1px;
    }
    .img-pointer{
        cursor: pointer;      
    },
    .fileinput-upload{
        display: none;
    }
    .centerbtn{
        left:1cm;
    }
    .badge{
        cursor: pointer;
        margin-left: 5px;
        font-size: 15px;
        font-weight: normal;
    }
    .displaybtn{
        display: none;
    }
    

</style>
@endsection
@section('contenido')
<section class="content row justify-content-center">
    <div class="col-md-12 col-xl-11 col-sm-12">
            @if (Session::has('exito'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">
                    &times;
                </button>
                {{Session::get('exito')}}
            </div>
        @endif
        
        {{-- <div class="row">
            <div class="col-md-12 col-sm-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb ">
                        <li class="breadcrumb-item active pull-right" ><a href="{{route('home')}}" title="Ir a inicio">INICIO</a></li>
                        <li class="breadcrumb-item active pull-right" ><a href="{{route('pacientes.index')}}" title="Ir a lista de pacientes">LISTA DE PACIENTES</a></li>
                        <li class="breadcrumb-item active" aria-current="page">PERFIL DEL PACIENTE</li>
                    </ol>
                </nav>
            </div>
        </div> --}}
        <div class="row">
            <div class="col-md-4 col-xs-12">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="row text-center">
                            <div class="col-8 ">
                                <a href="{{asset($paciente->photo_extension)}}" target="_blank">
                                    <img  src="{{$paciente->getAvatarUrl()}}" alt="User profile picture" class="profile-user-img img-fluid img-circle  pull-right" id="avatarProfile" style="display:block">
                                </a>
                            </div>
                            <div class="col-4">
                                <label for="inputProfile"><i class="fa fa-camera-retro fa-2x change pull-left"  aria-hidden="true"  title="Cambiar foto de perfil"></i></label>
                                <div id="formperfil" style="display:none">
                                    <form action="{{route('changeProfile')}}"  method="POST" id="formProfile" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="paciente" value="{{$paciente->id}}">
                                        <input type="hidden" name="tipo" id="dispositivo">
                                        <input type="file" name="photo" id="inputProfile"  accept="image/*" onchange="cambiar()">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12" style="display:none" id="divoculto">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" id="barraProfile">0 %</div>
                                </div>
                            </div>
                        </div>
                        <h6 class="profile-username text-center">{{$paciente->apellidos}}, {{$paciente->nombre}}</h6>
                        <p class="text-muted text-center">{{$paciente->codigo}}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Registro:</b> <a class="float-right">{{ \Carbon\Carbon::parse($paciente->created_at)->format('d/m/Y - h:i a')}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>DUI:</b> <a class="float-right">{{$paciente->dui}} </a>
                            </li>
                            <li class="list-group-item">
                                <b>Edad:</b> <a class="float-right">{{$paciente->getAgeAttribute()}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Sexo:</b> <a class="float-right">{{$paciente->sexo}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Teléfono:</b> <a class="float-right">{{$paciente->telefono}}</a>
                            </li>
                            
                            <li class="list-group-item">
                                <b>Email:</b> <a class="float-right">{{$paciente->email}} </a>
                            </li>
                            <li class="list-group-item text-center" id="limostrar">
                               <button type="button" class="btn btn-sm btn-primary" style="width:100%" id="mostrarMas" onclick="mostrardatos()">Mostrar más datos</button>
                            </li>
                            <li class="list-group-item masdatos" style="display:none" >
                                <b>Teléfono del trabajo:</b> <a class="float-right">{{$paciente->teltrabajo}}</a>
                            </li>
                            <li class="list-group-item masdatos" style="display:none" >
                                <b>Celular del trabajo:</b> <a class="float-right">{{$paciente->celtrabajo}}</a>
                            </li>
                            <li class="list-group-item masdatos" style="display:none" >
                                <b>Asegurado:</b> <a class="float-right">{{$paciente->asegurado}}</a>
                            </li>
                            @if($paciente->asegurado=='si')
                            <li class="list-group-item masdatos" style="display:none" >
                                <b>Compañia de seguro:</b> <a class="float-right">{{$paciente->companiaseguro}}</a>
                            </li>
                            <li class="list-group-item masdatos" style="display:none" >
                                <b>Número de póliza</b> <a class="float-right">{{$paciente->nopoliza}}</a>
                            </li>
                            <li class="list-group-item masdatos" style="display:none" >
                                <b>Número de carné:</b> <a class="float-right">{{$paciente->nocarnet}}</a>
                            </li>
                            @endif
                            <li class="list-group-item masdatos" style="display:none" >
                                <b>Estado civil:</b> <a class="float-right">{{$paciente->civil}}</a>
                            </li>
                            @if($historico != null)
                            <li class="list-group-item masdatos" style="display:none">
                                <b>Peso:</b> <a class="float-right">{{$historico->peso}} Libras</a>
                            </li>
                            <li class="list-group-item masdatos" style="display:none">
                                <b>Estatura:</b> <a class="float-right">{{$historico->estatura}} metros</a>
                            </li>
                            @endif
                             @if($paciente->direccion != null)
                            <li class="list-group-item masdatos" style="display:none">
                                <b>Dirección:</b><p>{{$paciente->direccion}}</p>
                            </li>
                            @endif
                            @if(Auth::user()->hasPermission('create_consultas_proc'))
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xl-5"><a title="Nueva consulta" class="btn btn-info btn-block btn-sm" href="{{route('consultas.create',$paciente->id)}}" ><i class="fa fa-book" aria-hidden="true"></i> CONSULTA</a></div>
                                    <div class=" d-none d-md-block col-xl-7"><a title="Nuevo procedimiento" class="btn btn-info btn-block btn-sm" href="{{ route('procedimiento.tipo', $paciente->id) }}" ><i class="fa fa-camera" aria-hidden="true"></i> PROCEDIMIENTO</a></div>
                                </div>
                            </li>
                            @endif
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Notas</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool"  data-toggle="modal" data-target="#notas" title="editar notas"><i class="fa fa-pencil fa-2x"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    {!! $paciente->notas !!}
                                </div>
                            </div>

                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <a title="editar perfil" class="btn btn-primary btn-block btn-sm" href="#" data-toggle="modal" data-target="#editarPaciente"><i class="fa fa-pencil" aria-hidden="true"></i> EDITAR</a>
                                    </div>
                                    <div class="col-xl-6 ">
                                        @if(Auth::user()->hasPermission('delete_pacient'))
                                        <form action="{{route('pacientes.destroy', $paciente->id)}}" method="POST" id="formDelete">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button class=" btn btn-danger btn-block btn-sm" type="submit"  title="Eliminar Paciente">
                                                <i class="fa fa-trash" aria-hidden="true"></i> ELIMINAR
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-8 col-xs-12">
                <div class="card card-primary card-outline">
                    <div class="card-header ">
                        <div class="row">
                            <div class="col-lg-9 col-md-12 col-sm-12">
                                <ul class="nav nav-pills  p-2">
                                    <li class="nav-item d-none d-sm-block" ><a class="nav-link nav-link-sm active" href="#hmovimientos"  data-toggle="tab" title="Historial de movimientos del paciente {{$paciente->nombre}}">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i> navegacion</a>
                                    </li>
                                    <li class="nav-item"><a class=" nav-link nav-link-sm " href="#Historial" data-toggle="tab" title="Historial del paciente {{$paciente->nombre}}">
                                        <i class="fa fa-address-book-o" aria-hidden="true"></i> Historial</a>
                                    </li>
                                    <li class="nav-item "><a class="nav-link nav-link-sm " href="#adjuntos"  data-toggle="tab" title="Historial de Archivos del paciente {{$paciente->nombre}}">
                                        <i class="fa fa-paperclip" aria-hidden="true"></i> Adjuntos</a>
                                    </li>
                                    <li class="nav-item d-none d-sm-block" ><a class="nav-link nav-link-sm " href="#recetas"  data-toggle="tab" title="Historial recetas del paciente {{$paciente->nombre}}">
                                        <img src="{{asset('/assets/img/reseta.png')}}" alt="" width="25px" height="25px"> Recetas</a>
                                    </li>
                                   
                                </ul>
                            </div>
                            <div class="col-lg-3 col-md-0   d-none d-lg-block">
                                <div class="dropdown mt-2 pull-right">
                                    <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        + Opciones
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @if(Auth::user()->hasPermission('create_recetas'))
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#nuevaReceta"  title="Nueva receta para el paciente {{$paciente->nombre}}">
                                            <i class="fa fa-plus-circle" aria-hidden="true">&nbsp;Receta</i>
                                        </a>
                                        @endif
                                        <a class="dropdown-item" href="#"  data-toggle="modal" data-target="#adjunto" title="Adjuntar archivo al paciente {{$paciente->nombre}}">
                                            <i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Adjunto</a>
                                        @if(Auth::user()->hasPermission('create_anexos'))
                                        <a class="dropdown-item" href=" {{route('citas.paciente',['procedimiento',$paciente->id])}} "  title="Nueva cita para el paciente {{$paciente->nombre}}">
                                            <i class="fa fa-plus-circle" aria-hidden="true">&nbsp;Citas de procedimiento</i></a>
                                        <a class="dropdown-item" href="{{route('citas.paciente',['consulta', $paciente->id])}}"  title="Nueva cita para el paciente {{$paciente->nombre}}">
                                            <i class="fa fa-plus-circle" aria-hidden="true">&nbsp;Citas de consulta</i></a>
                                        <a class="dropdown-item" href="{{route('anexos.paciente', [$paciente->id, 'tipo' => 'alta'])}}" aria-hidden="true">
                                            <i class="fa fa-plus-circle" aria-hidden="true">&nbsp;Hoja de alta</i></a>
                                        <a class="dropdown-item" href="{{route('anexos.paciente', [$paciente->id, 'tipo' => 'incapacidad'])}}" aria-hidden="true">
                                            <i class="fa fa-plus-circle" aria-hidden="true">&nbsp;Hoja de incapacidad</i></a>
                                        </a>
                                        @endif
                                        <a class="dropdown-item" href="{{route('inventario.addventaperfil', [$paciente->id])}}" aria-hidden="true">
                                            <i class="fa fa-plus-circle" aria-hidden="true">&nbsp;Agregar medicamentos/insumos</i></a>
                                            <form id="formlistas" action="{{route('inventario.listaventas')}}">
                                            <input type="hidden" value="{{$paciente->id}}" id="idlista" name="idlista">
                                                @csrf
                                        <a class="dropdown-item" href="#" aria-hidden="true" onclick="listaventass()">
                                            </form>
                                        
                                            <i class="fa fa-plus-circle" aria-hidden="true">&nbsp;Listado de  medicamentos/insumos</i></a>
                                        <a href="{{route('pacientes.historico', $paciente->id)}}" class="dropdown-item">
                                            <i class="fa fa-plus-circle" aria-hidden="true">&nbsp;Historial de peso</i></a>
                                        </a>
                                        {{-- <a href="{{route('pacientes.historico', $paciente->id)}}" class="dropdown-item">
                                            <i class="fa fa-plus-circle" aria-hidden="true">&nbsp;Historial de peso</i></a>
                                        </a> --}}
                                    </div>
                                </div>
                                @if ($paciente->estado_traslado == 'en habitacion')
                                <button style="position:absolute; width:3cm;heigh:3cm; top:0.2cm ; right:3.50cm" onclick="regresarhabitacion({{$habitacion->id}})" class="btn btn-primary " type="button" id="dropdownMenuButton" aria-haspopup="true" aria-expanded="false">
                                    <i class="nav-icon fa fa-home"> Estacion </i>
                                           
                                </button>
                              
                                @endif  
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                    <div class="tab-content">
                        @if($cantidad>0)
                            <div class="tab-pane" id="Historial">
                                <ul class="timeline timeline-inverse">
                                    @foreach ($historial as $historial)
                                        @if ($historial->consulta_id!=null)
                                            <li class="time-label ">
                                                <span class="bg-info">
                                                    {{ \Carbon\Carbon::parse($historial->created_at)->format('d/m/Y - h:i a')}}
                                                </span>
                                            </li>
                                            <li>
                                                <div class="timeline-item shadow-lg p-3 mb-5 bg-white rounded">
                                                    <div class=" row timeline-header " style="color:#000;font-family:Verdana, Geneva, Tahoma, sans-serif">
                                                        <div class="col-md-7 col-sm-12">
                                                            <p>{{$historial->tituloConsulta}}</p>
                                                        </div>
                                                        <div class="col-md-5 col-sm-12 ">
                                                            <div class="form-group pull-right">
                                                                    @if($historial->receta!=null)<a id="reporte" href="{{route('imprimirReceta', $historial->receta)}}" target="_blank"><i class="fa fa-print " aria-hidden="true">Receta Médica</i></a>@endif |
                                                                    <a id="reporte" href="{{route('reporteConsulta',$historial->id)}}"  target="_blank"><i class="fa fa-print " aria-hidden="true">Consulta</i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="collapse" id="collapseExample{{$historial->id}}">
                                                        <div class="card card-body">
                                                           <strong>DETALLE:</strong> {!!$historial->detalleConsulta!!}
                                                            <br>
                                                           @if($historial->diagnostico)<strong>DIAGNOSTICO:</strong>  {!!$historial->diagnostico!!}@endif
                                                            <br>
                                                        @if($historial->prescripcion!=null)<strong>PRESCRIPCION:</strong> {!!$historial->prescripcion!!}@endif
                                                        </div>
                                                    </div>
                                                    <div class="timeline-footer ">
                                                            <form action="{{route('consultas.destroy', $historial->consulta_id)}} " method="POST" >
                                                                @csrf
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button type="button" class="btn btn-sm  btn-primary " data-toggle="collapse" href="#collapseExample{{$historial->id}}" role="button" aria-expanded="false"  >
                                                                ver más
                                                            </button>
                                                            @if(Auth::user()->hasPermission('edit_consultas'))
                                                            <a href="{{route('consultas.edit', $historial->consulta_id)}}" class="btn btn-sm btn-info " >Editar</a>
                                                            @endif
                                                            @if(Auth::user()->hasPermission('delete_consultas'))
                                                            <button class="btn btn-sm btn-danger deleteconsulta" type="submit">Eliminar </button>
                                                            @endif
                                                        </form>
                                                    </div>
                                                </div>
                                            </li>
                                        @elseif($historial->procedimiento_id!=null)
                                            <li class="time-label">
                                                <span class="bg-info">
                                                    {{ \Carbon\Carbon::parse($historial->created_at)->format('d/m/Y - h:i a')}}
                                                </span>
                                            </li>
                                            <li>
                                                <div class="timeline-item shadow-lg p-3 mb-5 bg-white rounded">
                                                    <h3 class="timeline-header " style="color:blue">
                                                        Procedimiento de {{ $historial->procedimiento_nombre }}
                                                    </h3>
                                                    <div class="timeline-body">
                                                            <a href="{{route('procedimiento.show',$historial->id)}}" target="_blank" title="ver procedimiento" class="btn btn-sm btn-primary"> &nbsp; Ver &nbsp;</a>
                                                            @if(Auth::user()->hasPermission('edit_procedimientos')) 
                                                                <a href="{{route('procedimiento.edit',$historial->id)}}" title="editar procedimiento" class="btn btn-sm btn-info">Editar</a>
                                                            @endif
                                                            @if(Auth::user()->hasPermission('delete_procedimientos'))
                                                                <span class="btn btn-sm btn-danger   eliminarProcedimientoBtn">Eliminar</span>
                                                               <form action="{{route('procedimiento.destroy',$historial->id)}}" method="POST">
                                                                @csrf
                                                                    <input type="hidden" name="_method" value="DELETE">
                                                                </form>
                                                            @endif
                                                    </div>
                                                </div>
                                            </li>
                                        @elseif($historial->anexo_id!=null)
                                            <li class="time-label">
                                                <span class="bg-info">
                                                    {{ \Carbon\Carbon::parse($historial->created_at)->format('d/m/Y - h:i a')}}
                                                </span>
                                            </li>
                                            <li>
                                                <div class="timeline-item shadow-lg p-3 mb-5 bg-white rounded">
                                                    <h3 class="timeline-header " style="color:blue">
                                                       Hoja de {{ $historial->tipo }}
                                                    </h3>
                                                    <div class="timeline-body">
                                                        <a href="{{route('anexos.show',$historial->anexo_id)}}" target="_blank" title="imprimir anexo" class="btn btn-sm btn-primary"> Imprimir</a>
                                                            
                                                        @if(Auth::user()->hasPermission('seeting_anexos'))
                                                        <a href="{{route('anexos.edit',$historial->anexo_id)}}" title="editar Anexo" class="btn btn-sm btn-info">Editar</a>
                                                
                                                        <span class="btn btn-sm btn-danger " onclick="event.preventDefault();document.getElementById('deleteAnexo').submit();">Eliminar</span>
                                                        <form action="{{route('anexos.destroy',$historial->anexo_id)}}" method="POST" id="deleteAnexo">
                                                        @csrf
                                                            <input type="hidden" name="_method" value="DELETE">
                                                        </form>
                                                        @endif
                                                           
                                                    </div>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>

                        @else
                            <div class="tab-pane" id="Historial">
                                <div class="mensaje">
                                    <p>
                                        ¡Vaya al parecer el paciente aún no tiene ninguna historia!
                                        @if(Auth::user()->hasPermission('create_consultas_proc'))
                                            <a href="{{route('consultas.create',$paciente->id)}}" class=" btn btn-primary btn-sm" ><i class=" fa fa-plus-circle" aria-hidden="true"></i>&nbsp;añadir una Consulta</a>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @endif

                        @if ($cantidadAdjuntos>0)
                            <div class=" tab-pane"  id="adjuntos">
                                <a class="btn btn-sm btn-primary" href="#"  data-toggle="modal" data-target="#adjunto" title="Adjuntar archivo al paciente {{$paciente->nombre}}">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp; Nuevo Archivo
                                </a><br><br>
                                <ul class="timeline timeline-inverse">
                                    @foreach ($adjuntos as $adjunto)
                                        <li class="time-label">
                                            <span class="bg-info">
                                                {{ \Carbon\Carbon::parse($adjunto->created_at)->format('d/m/Y H:i:s')}}
                                            </span>
                                        </li>
                                        <li>
                                            <div class="timeline-item shadow-lg p-3 mb-5 bg-white rounded">
                                                <div class="timeline-body">
                                                    <p id="description" class="text-sm" style="margin:0%;padding:0%"><strong>Descripción: </strong>{!! $adjunto->descripcion !!}</p>
                                                    <div id="mostrarImg" class="row ">
                                                        @if ($adjunto->extenAdjunto()=='imagen')
                                                            <a id="imagen" href="{{asset($adjunto->adjunto)}}" target="_blank">
                                                                <img class="rounded image ml-2 img-thumbnail"   width="200" height="200"
                                                                    src="{{asset($adjunto->adjunto)}}"></a>
                                                        @elseif($adjunto->extenAdjunto()=='word')
                                                            <a id="imagen" href="{{asset($adjunto->adjunto)}}" target="_blank">
                                                                <img  class="imgHistorial  image ml-2 img-thumbnail"
                                                                    src="{{asset('assets/img/docs.png')}}"></a>
                                                        @elseif($adjunto->extenAdjunto()=='pdf')
                                                        <a id="imagen" href="{{asset($adjunto->adjunto)}}" target="_blank">
                                                            <img  class="imgHistorial  image ml-2 img-thumbnail"
                                                                src="{{asset('assets/img/pdf.png')}}"  ></a>
                                                        @elseif($adjunto->extenAdjunto()=='excel')
                                                        <a id="imagen" href="{{asset($adjunto->adjunto)}}" target="_blank">
                                                            <img  class="imgHistorial  image ml-2 img-thumbnail"
                                                                src="{{asset('assets/img/excel.png')}}"  ></a>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="timeline-footer ">
                                                    @if($adjunto->extenAdjunto()=='imagen' || $adjunto->extenAdjunto()=='pdf')
                                                    <a href="{{route('adjuntos.print',$adjunto->id)}}" class="btn btn-sm btn-primary " target="_blank "> Imprimir</a>
                                                    @endif
                                                    <a href="{{route('adjuntos.show',$adjunto->id)}}" class="btn btn-sm btn-primary  "> Descargar </a>
                                                    <a href="{{route('adjuntos.destroy',$adjunto->id)}}" class="btn btn-sm btn-danger" onclick="event.preventDefault();document.getElementById('delete-adjunto{{$adjunto->id}}').submit();">Eliminar</a>
                                                    <form id="delete-adjunto{{$adjunto->id}}" action="{{route('adjuntos.destroy',$adjunto->id)}}" method="POST" >
                                                    @csrf
                                                        <input type="hidden" name="_method" value="DELETE">
                                                    </form>
                                                </div>
                                            </div>
                                       </li>
                                    @endforeach
                                </ul>
                            </div>
                        @else

                            <div class="tab-pane" id="adjuntos">
                                <p>no hay nada que mostrar
                                    <a class="btn btn-sm btn-primary " href="#"  data-toggle="modal" data-target="#adjunto" title="Adjuntar archivo al paciente {{$paciente->nombre}}">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp; Nuevo Archivo
                                    </a>
                                </p>
                            </div>

                        @endif
                        @if($cantidadRecetas>0)
                        <div class=" tab-pane"  id="recetas">
                            @if(Auth::user()->hasPermission('create_recetas'))
                            <a class="btn btn-sm btn-primary +" href="#" data-toggle="modal" data-target="#nuevaReceta"  title="Nueva receta para el paciente {{$paciente->nombre}}">
                                <i class="fa fa-plus-circle" aria-hidden="true"> Nueva Receta</i>
                            </a><br><br>
                            @endif
                            <ul class="timeline timeline-inverse">
                                @foreach ($recetas as $receta)
                                    <li class="time-label">
                                        <span class="bg-info">
                                            {{ \Carbon\Carbon::parse($receta->created_at)->format('d/m/Y H:i:s')}}
                                        </span>
                                    </li>
                                    <li>
                                        <div class="timeline-item shadow-lg p-3 mb-5 bg-white rounded">
                                            <div class="pull-right mr-1"><i class="fa fa-print" aria-hidden="true"><a id="archivo" href="{{route('imprimirReceta',$receta->id)}}" target="_blank"> Imprimir</a></i></div>
                                            {{-- <div class="pull-right mr-1"><i class="fa fa-eye" aria-hidden="true"><a id="imagen" href="" target="_blank"> Ver</a></i></div> --}}
                                            <br>
                                            <div class="timeline-body">
                                                {!!$receta->tituloReceta!!}
                                                <hr size="20" />                                              
                                                {!! $receta->descripcionReceta !!}
                                            </div>
                                                <div class="row timeline-footer">
                                                    <div class="col-md-12 col-sm-12">
                                                        <a href="{{route('recetas.edit', $receta->id)}}" class="btn btn-sm btn-info">Editar</a>
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                        onclick="event.preventDefault();document.getElementById('formdeletereceta').submit();">
                                                        Eliminar
                                                    </button>
                                                    </div>
                                                    <form action="{{route('recetas.destroy', $receta->id)}}" method="POST" id="formdeletereceta">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="DELETE">
                                                    </form>
                                                </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        @else
                            <div class="tab-pane" id="recetas">
                                <p>no hay nada que mostrar
                                    @if(Auth::user()->hasPermission('create_recetas'))
                                    <a class="btn btn-sm btn-primary " href="#" data-toggle="modal" data-target="#nuevaReceta"  title="Nueva receta para el paciente {{$paciente->nombre}}">
                                        <i class="fa fa-plus-circle" aria-hidden="true"> Nueva Receta</i>
                                    </a>
                                    @endif
                                </p>
                            </div>
                        @endif
                        <div class="tab-pane  active" id="hmovimientos">
                            
                            <nav>
                                <div class="nav nav-tabs " id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link  active" style="  color:#009999;" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true" {{-- onclick="toglecolor()" --}}>Redireccionar</a>
                                    <a class="nav-item nav-link text-center" style="width:120px; color:007bff;" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Cita</a>                                  
                                </div>
                            </nav>
                            <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="card cborder" style="height:8cm;">
                                        <form action="{{route('pacientes.enviandopaciente')}}" method="POST" id="redirectionform">
                                        <input type="hidden" value="{{$paciente->id}}" name="paciente" id="paciented">
                                              @csrf
                                              <div class="card-header d-flex justify-content-center">
                                                 <h3>Redireccion de paciente </h3>
                                             </div>
                                             <div class="card-body">
                                              <div class="row form-group">
                                                  <div class="col-md-6">
                                                      <label for="">Seleccione area de ingreso:</label>
                                                      <select  name="areas" id="areas" class="form-control selectpicker" data-live-search="true" onchange="seleccionarArea()">                          
                                                          <option value="" selected disabled>Seleccione Area</option>                  
                                                          @foreach ($areas as $area)
                                                      <option value="{{$area->id}}" id="{{$area->nombre_area}}" >{{$area->nombre_area}}</option>                        
                                                          @endforeach                    
                                                      </select> 
                                                  </div>
                                                  <div id="divhabitaciones" class="col" style="display:none">
                                                      <label id="labelmedicamento" for=""></label>
                                                      <select  name="habitaciones" id="habitaciones" class="form-control " data-live-search="true" onchange="cargaprocedures()" onfocus="this.selectedIndex = -1;">                          
                                                          <option value="" selected disabled selected>Habitaciones disponibles</option>                                                         
                                                      </select>
                                                  </div>
                                              </div>
                                                  <div class="row d-flex justify-content-center displaybtn" >
                                                   <div class="col-md-6">
                                                        <div id="divprocedimientos" style="display:none">
                                                            <label id="prolabel"   for="">Seleccione procedimiento</label>
                                                            <select  name="procedimiento" id="procedimiento"   class="form-control " data-live-search="true" onchange="submitalready()">                          
                                                                <option value="" selected disabled selected>procedimientos disponibles</option>                                                         
                                                            </select>
                                                        </div>  
                                                   </div>
                                                   <div class="col">                                                      
                                                       <button type="submit" id="btngo" style="display:none; position:absolute;top:0.8cm;left:3.5cm" class="btn btn-primary">Mover paciente</button>
                                                   </div>
                                                 </div>
                                             </div>
                                          </form>
                                        </div>         
                                </div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <div class="card cborder2">
                                        <form action="{{-- {{route('pacientes.createcitaarea')}} --}}" method="POST" id="redirectionform">
                                        <input type="hidden" value="{{$paciente->id}}" name="paciente" id="paciented">
                                              @csrf
                                              <div class="card-header d-flex justify-content-center">
                                                 <h3>Crear Cita </h3>
                                             </div>
                                             <div class="card-body">
                                              <div class="row form-group">
                                                  <div class="col-md-6">
                                                      <label for="">Seleccione area de ingreso:</label>
                                                      <select  name="areas" id="areas2" class="form-control selectpicker" data-live-search="true" onchange="seleccionarArea2()">                          
                                                          <option value="" selected disabled>Seleccione Area</option>                  
                                                          @foreach ($areas as $area)
                                                      <option value="{{$area->id}}" id="{{$area->nombre_area}}" >{{$area->nombre_area}}</option>                        
                                                          @endforeach                    
                                                      </select> 
                                                  </div>
                                                  <div id="divhabitaciones2" class="col" style="display:none">
                                                      <label id="labelmedicamento2" for=""></label>
                                                      <select  name="habitaciones" id="habitaciones2" class="form-control " data-live-search="true">                          
                                                          <option value="" selected disabled selected>Habitaciones disponibles</option>                                                         
                                                      </select>
                                                  </div>
                                              </div>
                                                  <div class="row d-flex justify-content-center displaybtn" >
                                                   <button type="button" id="btngo2" style="display:none" class="btn btn-primary" onclick="envarahabitacioncalendar()">Crear Cita</button>
                                                 </div>
                                             </div>
                                          </form>
                                      </div>                      
                                  </div>                               
                              </div>
                   
                           
                           
                            <div class="card {{-- cborder --}}">
                               <div class="card-header cborder3 d-flex justify-content-center">
                                   <h3>Historial de movimientos del paciente</h3>
                               </div>
                               <div class="card-body">
                                <table class="table" style=" border: 1px solid;
                                                padding: 10px;
                                                box-shadow: 5px 10px #888888;">
                                    <thead class="thead-dark">
                                      <tr>                                       
                                        <th scope="col" class="text-center">Habitacion</th>
                                        <th scope="col" class="text-center">Area</th>
                                        <th scope="col" class="text-center">Fecha y hora de ingreso</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                   @foreach ($historialnavegacion as $navegacion)
                                   <tr>                                    
                                   <td class="text-center">{{$navegacion->habitacion_nombre}}</td>
                                    <td class="text-center">{{$navegacion->nombre_area}}</td>
                                   <td class="text-center">{{$navegacion->created_at}}</td>
                                  </tr>        
                                   @endforeach
                                    </tbody>
                                </table>                                
                               </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    @include('pacientes.notas')
    @include('Recetas.recetaPaciente')
    @include('pacientes.editarPaciente')
    @include('pacientes.adjuntos')




@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript" src="{{asset('js/select.js')}}"></script>
<script>    
       var conta = 0;

    function cargaprocedures(){
        var area = $('#areas').val();
        dato = area;
        /* alert(dato); */
        if(area == 3 || area == 4 || area == 1){           
            document.getElementById('divprocedimientos').style.display = 'block';
            $('#procedimiento option:not(:first)').remove();           
                $.ajax({
                    url: '{{ route("pacientes.procedimientos_areas") }}',
                    type: 'GET',
                    data:{'dato':dato, '_token': '{{ csrf_token() }}'},
                success:function(response)
                {      var contador = 0;                   
                    response[0].forEach(element => {
                        var select = document.getElementById('procedimiento');
                        var option = document.createElement('option');
                        option.innerHTML= response[0][contador].procedimiento_nombre;
                        option.value = response[0][contador].id;
                        select.appendChild(option);
                        contador++;                    
                    });
               
                }
            });   

        }
        else{            
            document.getElementById('divprocedimientos').style.display = 'none';
            document.getElementById('btngo').classList.addClass = 'centerbtn';
            document.getElementById('btngo').style.display = "block";
        }
    }
    function submitalready(){
        var procedure = document.getElementById('procedimiento').value;
        if (procedure != null){
            document.getElementById('btngo').style.display = "block";
        }
    }


    function seleccionarArea(){
        document.getElementById('divhabitaciones').style.display = "block";
        
       var dato = $('#areas').val();
       if(conta == 0){           
          $('#pasodatos').val(dato);
       }
       var compa = $('#pasodatos').val(); 
      if(dato == compa){
        $.ajax({
                url: '{{ route("pacientes.habitaciones") }}',
                type: 'GET',
                data:{'dato':dato, '_token': '{{ csrf_token() }}'},
            success:function(response)
            {      var contador = 0;        
                console.log(response[0]);
                  response[0].forEach(element => {
                    var select = document.getElementById('habitaciones');
                    var option = document.createElement('option');
                    option.innerHTML= response[0][contador].habitacion_nombre;
                    option.value = response[0][contador].id;
                    select.appendChild(option);
                    contador++;                    
                  });
                  var labb = document.getElementById('labelmedicamento');
                  var are = document.getElementById('areas');
                  var tex = are.options[are.selectedIndex].id;
                  labb.innerHTML = "Seleccione: "+ tex;
                 $('#cantidad').val(response[0].length)
                
                /*  console.log(response[0][0].habitacion_nombre); */
            }
        });     
      }else{          
          $('#pasodatos').val(dato);
          var objett = document.getElementById('habitaciones');
          $('#habitaciones option:not(:first)').remove();

          $.ajax({
                url: '{{ route("pacientes.habitaciones") }}',
                type: 'GET',
                data:{'dato':dato, '_token': '{{ csrf_token() }}'},
            success:function(response)
            {      var contador = 0;        
                console.log(response[0]);
                  response[0].forEach(element => {
                    var select = document.getElementById('habitaciones');
                    var option = document.createElement('option');
                    option.innerHTML= response[0][contador].habitacion_nombre;
                    option.value = response[0][contador].id;
                    select.appendChild(option);
                    contador++;                    
                  });
                  var labb = document.getElementById('labelmedicamento');
                  var are = document.getElementById('areas');
                  var tex = are.options[are.selectedIndex].id;
                  labb.innerHTML = "Seleccione: "+ tex;
                 $('#cantidad').val(response[0].length)
                
                /*  console.log(response[0][0].habitacion_nombre); */
            }
        });   
      }
      conta++;
    }
    function seleccionarArea2(){
        document.getElementById('divhabitaciones2').style.display = "block";
        document.getElementById('btngo2').style.display = "block";
       var dato = $('#areas2').val();
       if(conta == 0){           
          $('#pasodatos2').val(dato);
       }
       var compa = $('#pasodatos2').val(); 
      if(dato == compa){
        $.ajax({
                url: '{{ route("pacientes.habitaciones2") }}',
                type: 'GET',
                data:{'dato':dato, '_token': '{{ csrf_token() }}'},
            success:function(response)
            {      var contador = 0;        
                console.log(response[0]);
                  response[0].forEach(element => {
                    var select = document.getElementById('habitaciones2');
                    var option = document.createElement('option');
                    option.innerHTML= response[0][contador].habitacion_nombre;
                    option.value = response[0][contador].id;
                    select.appendChild(option);
                    contador++;                    
                  });
                  var labb = document.getElementById('labelmedicamento2');
                  var are = document.getElementById('areas2');
                  var tex = are.options[are.selectedIndex].id;
                  labb.innerHTML = "Seleccione: "+ tex;
                 $('#cantidad').val(response[0].length)
                
                /*  console.log(response[0][0].habitacion_nombre); */
            }
        });     
      }else{          
          $('#pasodatos2').val(dato);
          var objett = document.getElementById('habitaciones2');
          $('#habitaciones2 option:not(:first)').remove();

          $.ajax({
                url: '{{ route("pacientes.habitaciones2") }}',
                type: 'GET',
                data:{'dato':dato, '_token': '{{ csrf_token() }}'},
            success:function(response)
            {      var contador = 0;        
                console.log(response[0]);
                  response[0].forEach(element => {
                    var select = document.getElementById('habitaciones2');
                    var option = document.createElement('option');
                    option.innerHTML= response[0][contador].habitacion_nombre;
                    option.value = response[0][contador].id;
                    select.appendChild(option);
                    contador++;                    
                  });
                  var labb = document.getElementById('labelmedicamento2');
                  var are = document.getElementById('areas2');
                  var tex = are.options[are.selectedIndex].id;
                  labb.innerHTML = "Seleccione: "+ tex;
                 $('#cantidad').val(response[0].length)
                
                /*  console.log(response[0][0].habitacion_nombre); */
            }
        });   
      }
      conta++;
    }

    function envarahabitacioncalendar(){
        var habitacion = $('#habitaciones2').val();
        var paciente = $('#paciented').val();
        window.location="{{route('createcitaareaget.index')}}"+'/'+habitacion+'/'+paciente;
       
    }
    const carga = "{{asset('img/loading.gif')}}";

    function mostrardatos(){
        $('#limostrar').hide();
        $(".masdatos").show();
    }
    
    $(document).ready(function() {

        $("#siposee").click(function() {  
            document.getElementById('asegurados').style.display = "block";
            document.getElementById('companiaseguro').value = "{{$paciente->companiaseguro}}";
            document.getElementById('nopoliza').value = "{{$paciente->nopoliza}}";
            document.getElementById('nocarnet').value = "{{$paciente->nocarnet}}";
        });

        $("#noposee").click(function() {  
            document.getElementById('asegurados').style.display = "none";
            document.getElementById('companiaseguro').value = "";
            document.getElementById('nopoliza').value = "";
            document.getElementById('nocarnet').value = "";
        });

    });

    toastr.options = {
        "positionClass": "toast-bottom-right",
    }

@if(Session::has('info'))
    @if(Session::get('info') == 'El archivo ha sido eliminado correctamente!')
         $('a[href="#adjuntos"]').click();
        toastr.success('Se elimino el archivo correctamente');
    @elseif(Session::get('info') == 'La receta se eliminó correctamente')
            $('a[href="#recetas"]').click();
            toastr.success('La receta se elimino correctamente');
    @elseif(Session::get('info') == 'El adjunto se subio correctamente')
        $('a[href="#adjuntos"]').click();
        toastr.success('el archivo se subio con exito');
    @elseif(Session::get('info') == 'ok')
        toastr.success('La foto de perfil se cambio con exito');
    @elseif(Session::get('info') == 'receta exito')
        $('a[href="#recetas"]').click();
    @elseif(Session::get('info') == '¡La consulta ha sido eliminada!')
        toastr.success('Se ha eliminado la consulta');
    @endif
@endif

//para el textarea
$(function () {
        // bootstrap WYSIHTML5 - text editor
        $('.textarea').wysihtml5({
            toolbar: { fa: true,
                "image" : false,
                "link" : false,
                "font-styles" : false,
            },
            useLineBreaks : true,
        })
    })

//comfirmar para eliminar un paciente
    $('#formDelete').on('submit', function(e){
        if(!confirm('Desea eliminar al paciente?')){
            e.preventDefault();
        }
    });
//para formulario de receta
    $('#formReceta').on()
//ara formulario de adjuntos
   /*  $('#file-3').fileinput({
        theme: 'fa',
        maxFileSize:5000,
        overwriteInitial: false,
        maxFilesNum: 1,
        slugCallback: function (filename) {
            return filename.replace('(', '_').replace(']', '_');
        }
    }); */
//para formularios de procedimientos
document.addEventListener('DOMContentLoaded', (event) => {      
        $('#plantilla1').click(function(){
            $('#receta1').addClass('border border-primary');
            $('#receta2').removeClass('border border-primary');
            $('#receta3').removeClass('border border-primary');
            $('#receta4').removeClass('border border-primary');
        });
        $('#plantilla2').click(function(){
            $('#receta1').removeClass('border border-primary');
            $('#receta2').addClass('border border-primary');
            $('#receta3').removeClass('border border-primary');
            $('#receta4').removeClass('border border-primary');
        });
        $('#plantilla3').click(function(){
            $('#receta1').removeClass('border border-primary');
            $('#receta2').removeClass('border border-primary');
            $('#receta3').addClass('border border-primary');
            $('#receta4').removeClass('border border-primary');
        });
        $('#plantilla5').click(function(){
            $('#receta1').removeClass('border border-primary');
            $('#receta2').removeClass('border border-primary');
            $('#receta3').removeClass('border border-primary');
            $('#receta4').addClass('border border-primary');
        });
    });
    $(document).ready(function(){
        $('.eliminarProcedimientoBtn').click(function(){
            if (confirm('Desea eliminar el procedimiento')){
                $(this).siblings('form').submit();
            }
        });
    });

    $(document).ready(function(){
        $('.deleteconsulta').click(function(){
            if (confirm('¿Desea eliminar la consulta?')){
                $(this).siblings('form').submit();
            }
        });
    });

    $(document).ready(function(){
        $('.deleteadjunto').click(function(){
            if (confirm('¿Desea eliminar el adjunto?')){
                $(this).siblings('form').submit();
            }
        });
    });


    function showPreview(archivo){
        extensiones =['.png','.jpg','.jpeg','.gif','.tif'];
        extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase();
        name = document.getElementById('file').files[0].name;
        $('#nombrefile').html(name);
        if(extension == '.doc' || extension == '.docx'){
            $("#prueba").attr("src","{{asset('assets/img/docs.png')}}");
        }else if(extension == '.xls' || extension == '.xlsx'){
            $("#prueba").attr("src","{{asset('assets/img/excel.png')}}");
        }else if(extension == '.pdf'){
            $("#prueba").attr("src","{{asset('assets/img/pdf.png')}}");
        }else{
            $('#tipoarchivo').val('imagen');
            for (var i = 0; i < extensiones.length; i++) {
                if (extensiones[i] == extension) {
                    file = document.getElementById('file').files[0];
                    preview = document.getElementById('prueba');

                    reader = new FileReader();

                    reader.addEventListener("load", function() {
                        preview.src = reader.result;
                    },false);

                    reader.readAsDataURL(file);
                    
                }
            }
        }

        try{ 
            document.createEvent("TouchEvent"); 
            $('#tipodispositivo').val('movil');
        }
        catch(e){ 
            $('#tipodispositivo').val('computadora');
        }
    }


  
    

   function enviado(){
    var div= document.getElementById("receta").innerHTML;
        console.log(div);
        var leng = div.length;       
        if(leng > 0 ){
            $('#descripcion').val(div);
            formulario = $('#formularioReceta').submit();
            window.location = "{{route('recetas.mensaje', $paciente->id)}}"
        }else{
            $("#invalid-textarea").show();
        }
      /*  if($("#receta").val().length >0){
            formulario = $('#formularioReceta').submit();
            window.location = "{{route('recetas.mensaje', $paciente->id)}}"
       }else{
           $("#invalid-textarea").show();
       } */
   }

   function cambiar(){
        var imagenavatar = $("#avatarProfile");
        imagenavatar.attr('src', carga);
            try{ 
                document.createEvent("TouchEvent"); 
                $('#dispositivo').val('movil');
                $('#formProfile').submit();
            }
            catch(e){ 
                $('#dispositivo').val('computadora');
                $('#formProfile').submit();
            }
   }
   
   function listaventass(){      
       $('#formlistas').submit();     
   }

   $("#adjuntoss").submit(function(){
        var imagenadjunto = $("#prueba");
        imagenadjunto.attr('src', "{{asset('img/loading.gif')}}");
    });
    function addmedicamento(){
        var dato = $("#medicamentos option:selected").attr("id");
        var cantidad = $('#cantidad').val();
        var nombre = "b[]";
        if(dato > 0){
            var selecion = $('#medicamentos').val();
           if(selecion == "paquete"){
                var idd = $("#medicamentos option:selected").attr("id");
                $.ajax({
                    url: '{{ route("recetas.paqueteseleccionado")}}',
                    type: 'GET',
                    data:{'idd':idd, '_token': '{{ csrf_token() }}'},
                    success:function(response)
                    {
                       var dar = {!!$paquetes!!};
                       console.log(dar[0].nombre);      
                       for(f = 0; f<dar.length;f++){
                          if(dar[f].id == idd){
                             var nombcodigo = dar[f].nombre;
                          }
                       }              
                         var combo = $("#medicamentos option:selected");                       
                         var lista = document.createElement('ul');
                    for(i = 0 ; i< response[0].length ; i++){
                        var col = document.createElement('li');
                        col.innerHTML +="&nbsp;"+ response[0][i].nombre +"&nbsp;";
                        lista.innerHTML +="-&nbsp;" + col.innerHTML + "<br>";
                        lista.classList.add = ('text-center');
                    }       
                    console.log(lista);
                    var texarea = document.getElementById('receta');
                    texarea.innerHTML += "<p><b><h4>"+nombcodigo+"</h4></b>"+"<b>"+lista.innerHTML+"</b></p>"+"&nbsp;";                   
                   /*  texarea.innerHTML += ;   */           
                     
                    }, 
                    error: function(request, status, error){
                        console.log(request.responseText);

                    }
                });
           }else{
            if(cantidad > 0){
                var d = dato+"!"+cantidad;
               /*  var formulario = document.getElementById("createreceta");
                var input = document.createElement('input');
                input.name = nombre;
                input.type = "hidden";
                input.value =  d; 
                input.id = d;              
                formulario.appendChild(input);        */         
                
              
                var text =$('#medicamentos').val(); 
                var spa = document.createElement('span');
                spa.innerHTML = "<b>"+cantidad+" "+"Unidades de"+text+"</b>"+"&nbsp;";
                var texarea = document.getElementById('receta');
                texarea.innerHTML += "&nbsp;";
                /* texarea.innerHTML += "<span>"+"<b>"+cantidad+" "+"Unidades de"+text+"</b>"+"</span>"+"&nbsp;";  */
                texarea.innerHTML += spa.innerHTML;        
                texarea.innerHTML += "&nbsp;";               
               
                
                $('#cantidad').val("");
              }else{
               Swal.fire({
                position: 'top-end',
                icon: 'warning',
                title: 'ingrese la cantidad de medicamento',
                showConfirmButton: false,
                    timer: 1000
                });    
                $('#cantidad').addClass('is-invalid');
                $('#cantidad').focus();
            } 
           }
            }else{
                Swal.fire({
                position: 'top-end',
                icon: 'warning',
                title: 'Seleccione un medicamento',
                showConfirmButton: false,
                timer: 1000
             }); 
             $('#medicamentos').addClass('is-invalid');
             $('#medicamentos').focus();  
        }
    }

    function showmodal(){
        document.getElementById('medicamentoscard').style.display ="block";
    }
    function regresarhabitacion(id){
        window.location="{{route('estacion.area')}}"+'/'+id;
      
    }
</script>
@endsection
