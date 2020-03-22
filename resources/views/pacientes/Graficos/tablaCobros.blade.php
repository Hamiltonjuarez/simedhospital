@extends('theme.lte.layout')
@section('contenido')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-sm-12">
                @if (Session::has('success'))
                    <div class="alert alert-success alertas">
                        <button type="button" class="close" data-dismiss="alert">
                            &times;
                        </button>
                        {{Session::get('success')}}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <h5 class="text-uppercase">
                            Cobros
                        </h5>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <p class="pull-right">{{\Carbon\Carbon::now()->format('d-m-Y')}}</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5 col-sm-12">
                        <div class="card border border-info">
                            <div class="card-header bg-info text-uppercase">
                                consultas
                            </div>
                            <div class="card-body">
                                @if ($consultas->count()>0)
                                    <table class="table table-sm text-center">
                                        <thead>
                                            <tr>
                                                <th>Paciente</th>
                                                <th>Precio</th>
                                                <th>Opci¨®n</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($consultas as $consulta)
                                                <tr>
                                                    <td>{{$consulta->nombre.' '.$consulta->apellidos}}</td>
                                                    <td>$ {{$consulta->precioConsulta}}</td>
                                                    <td>
                                                        <form action="{{route('cobro.trabajo')}}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="_method" value="PUT">
                                                            <input type="hidden" name="historia" value="{{$consulta->historia}}">
                                                            <input type="hidden" name="tipo" value="consulta">
                                                            @if($consulta->status=='no-cancelado')
                                                            <button type="submit" class="btn btn-sm btn-danger "  >Cobrar</button>
                                                            @else
                                                            <button type="button" class="btn btn-sm btn-secondary"  disabled>Cobrado</button>
                                                            @endif
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                <p class="text-center">
                                    AUN NO HAY CONSULTAS
                                </p>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-sm-12">
                        <div class="card border border-info">
                            <div class="card-header bg-info text-uppercase">
                                Procedimientos 
                            </div>
                            <div class="card-body">
                                @if($procedimientos->count()>0)
                                <table class="table table-sm text-center">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Paciente</th>
                                            <th>precio</th>
                                            <th>Opci¨®n</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($procedimientos as $procedimiento)
                                            <tr>
                                                @if($procedimiento->precioBiopsia==null)
                                                <td>Procedimiento</td>
                                                @else
                                                <td>Procedimiento con biopsia</td>
                                                @endif
                                                <td>{{$procedimiento->nombre.' '.$procedimiento->apellidos}}</td>
                                                <td>${{number_format($procedimiento->precioProcedimiento+$procedimiento->precioBiopsia, 2)}}</td>
                                                <td>
                                                    <form action="{{route('cobro.trabajo')}}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="PUT">
                                                        <input type="hidden" name="historia" value="{{$procedimiento->historia}}">
                                                        <input type="hidden" name="tipo" value="procedimiento">
                                                        @if($procedimiento->status=='no-cancelado')
                                                        <button type="submit" class="btn btn-sm btn-danger">Cobrar</button>
                                                        @else 
                                                        <button type="button" class="btn btn-sm btn-secondary" disabled>Cobrado</button>
                                                        @endif
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @else
                                <p class="text-center">AUN NO HAY PROCEDIMIENTOS</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection