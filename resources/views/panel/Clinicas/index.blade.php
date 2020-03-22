@extends('theme.lte.layout')
@section('contenido')
    <div class="container-fluid justify-content-center">
       <div class="card">
           <div class="card-header">
                <a href="{{route('clinicas.create')}}" class="btn btn-primary" >Nueva clinica</a>
           </div>
           <div class="card-body">
               @include('pacientes.Notificaciones.notificacionHistorial')
             <div class="table-responsive">
                <table class="table table-sm table-hover  text-center ">
                    <thead class="bg-info">
                        <tr>
                            <th class="text-left">NOMBRE</th>
                            <th >CORREO</th>
                            <th >TELEFONOS</th>
                            <th >CELULAR</th>
                            <th >OPCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clinicas as $clinica)
                            <tr>
                                <td class="text-left">{{$clinica->nombreClinica}}</td>
                                <td >{{$clinica->email}}</td>
                                <td >{{$clinica->telefonos}}</td>
                                <td >{{$clinica->celular}}</td>
                                <td width="225px" class="text-right">
                                    <a href="{{route('clinicas.doctor', $clinica->id)}}" class="btn  btn-primary"><i class="fa fa-plus" aria-hidden="true">Doctor</i></a>
                                    <a href="{{route('clinicas.show', $clinica->id)}}" class="btn   btn-info"><i class="fa fa-info" aria-hidden="true"></i></a>
                                    <a href="{{route('clinicas.edit', $clinica->id)}}" class="btn  btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <button type="button" href="{{route('clinicas.destroy', $clinica->id)}}" class="btn  btn-danger" disabled
                                        onclick="event.preventDefault();
                                        document.getElementById('clinicaDelete').submit();"><i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                        <form action="{{route('clinicas.destroy', $clinica->id)}}" method="POST" id="clinicaDelete">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$clinicas->links()}}
            </div>
           </div>
       </div>
    </div>
@endsection
