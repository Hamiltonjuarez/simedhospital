@extends('theme.lte.layout')
@section('contenido')
<div class="container-fluid">
    <section class="content-header">
        <div class="container-fluid">
        <div class="row ">
            <div class="col-sm-6">
                <h1>Agenda</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Citas</li>
                </ol>
            </div>
        </div>
        </div>
    </section>
{{-- <div class="row">

    <div class="col-sm-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title"><strong>Citas</strong></h3>
                <div class="card-tools">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" placeholder="Search Mail">
                        <div class="input-group-append">
                            <div class="btn btn-primary">
                                <i class="fa fa-search"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                        <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table table-hover table-striped table-responsive  table-sm">
            <tbody>
                @foreach ($agenda as $i => $agenda)
                <tr >
                       <td> <strong>Fecha:</strong> {{$fecha[$i]['fecha']}}<br>
                        <strong> Hora: </strong>{{$fecha[$i]['hora']}}<br></td>
                        <td><strong>Paciente:</strong> {{$agenda->nombre}} {{$agenda->apellidos}}<br>
                            <strong>Tipo de examen:</strong> {{$agenda->nombreExamen}}</td>

                        <td >
                            <a href="" class="btn btn-sm btn-primary">Generar Reporte</a>
                            <a href="" class="btn btn-sm btn-danger">Eliminar Cita</a>
                        </td >
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    </div>
</div> --}}

<div class="card card-primary">

    <div class="card-body">
        <table class="table  mt-2 table-striped table-hover">
            <thead>
                <tr>
                    <th>Dia</th>
                    <th>Hora</th>
                    <th>Paciente</th>
                    <th>Tipo de examen</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($agenda  as $i =>$agenda)
                <tr>
                    <td>{{$fecha[$i]['fecha']}}</td>
                    <td>{{$fecha[$i]['hora']}}</td>
                    <td>{{$agenda->Apellidos}} {{$agenda->nombre}}</td>
                    <td>{{$agenda->nombreExamen}}</td>
                    <td></td>
                    <td class="text-right">
                    <a href="{{route('citas.destroy',$agenda->id)}}" class="btn btn-sm btn-danger ">Eliminar Cita</a>
                    <a href="{{-- {{route('generarReporte',$agenda->id)}} --}}" class="btn btn-sm btn-primary">Generar Reporte</a>
                    </td >
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>

@endsection
