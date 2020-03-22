@extends('theme.lte.layout')
@section('contenido')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12"><h5 class="text-uppercase">Editar {{$informacion}}</h5></div>
                    <div class="col-md-6 col-sm-12"><a href="{{route('doctores.show', $doctor->id)}}" class="btn btn-secondary pull-right">Cancelar</a></div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{route('doctores.updateinfo', $doctor->id)}}" method="POST" >
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="doctor_id"  value="{{$doctor->id}}">
                <div class="form-group">
                    <textarea name="{{$var}}" id="{{$var}}" class="textarea form-control" cols="30" rows="10" >@if(isset($data)){{$data->$var}}@endif</textarea>
                </div>
                <div class="form-group text-center">
                    <a href="{{route('doctores.show', $doctor->id)}}" class="btn btn-sm btn-secondary ">Cancelar</a>
                    <button class="btn btn-sm btn-primary">Guardar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
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
    </script>
@endsection