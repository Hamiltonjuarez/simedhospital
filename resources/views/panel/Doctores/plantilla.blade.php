@extends('theme.lte.layout')
@section('contenido')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('doctores.plantillaStore') }}" id="main_form" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="doctor">Doctor: </label>
                            <select name="doctor" id="" class="form-control">
                                @foreach ($doctores as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->nombreDoctor.' '.$doctor->apellidosDoctor }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" id="">
                            
                        </div>
                        <div class="form-group">
                            <a href="{{route('doctores.index')}}" class="btn btn-secondary">Atras</a>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            
                        </div>
                    </form>
                    <div class="input-group">
                        <input type="text" name="new" id="new" class="form-control">
                        <div class="input-group-append">
                            <button id="newbtn" type="button" class="btn btn-info">Agregar plantilla</button>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $('#newbtn').click(function()
            {
                
            });
        });
    </script>
@endsection