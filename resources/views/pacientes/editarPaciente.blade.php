<form method="POST" action="{{ route('pacientes.update',$paciente->id) }}" class="form-horizontal">
    @csrf
    <div class="modal fade" id="editarPaciente" tabindex="-1" role="dialog" aria-labelledby="editarPaciente" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Paciente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                    <input type="hidden" name="_method" value="PUT">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="nombre" >{{ __('Nombre:') }}</label>
                                        <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{$paciente->nombre}}" required autocomplete="nombre" autofocus>
                                        @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="apellidos" >{{ __('Apellidos:') }}</label>
                                    <input id="apellidos" type="text" class="form-control @error('apellidos') is-invalid @enderror" name="apellidos" value="{{$paciente->apellidos }}" required autocomplete="apellidos" autofocus>
                                    @error('apellidos')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="telefono" >{{ __('Telefono:') }}</label>
                                    <input id="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ $paciente->telefono }}"  autocomplete="telefono">
                                    @error('telefono')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="dui" >{{ __('DUI:') }}</label>
                                    <input id="dui" type="text" class="form-control @error('dui') is-invalid @enderror" name="dui" value="{{ $paciente->dui }}"  autocomplete="dui">
                                    @error('dui')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nacimiento" >{{ __('Fecha de nacimiento:') }}</label>
                                    <input id="nacimiento" type="date" class="form-control @error('nacimiento') is-invalid @enderror" name="nacimiento" value="{{ $paciente->nacimiento }}" required autocomplete="nacimiento" max="3000-12-31">
                                    @error('nacimiento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="sexo" >{{ __('Sexo:') }}</label>
                                    <select id="sexo" class="form-control @error('sexo') is-invalid @enderror" name="sexo" value="{{ $paciente->sexo }}" required autocomplete="sexo">
                                        <option value="M" @if($paciente->sexo=='M')echo selected @endif>M</option>
                                        <option value="F" @if($paciente->sexo=='F')echo selected @endif>F</option>
                                    </select>
                                    @error('sexo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="civil" >{{ __('Estado civil:') }}</label>
                                    <select id="civil" class="form-control @error('civil') is-invalid @enderror" name="civil" value="{{ $paciente->civil }}"  autocomplete="civil">
                                        <option value="">Seleccione...</option>
                                        <option value="Casado(a)" @if($paciente->civil=='Casado(a)')echo selected @endif>Casado(a)</option>
                                        <option value="Soltero(a)" @if($paciente->civil=='Soltero(a)')echo selected @endif>Soltero(a)</option>
                                        <option value="Acompañado(a)" @if($paciente->civil=='Acompañado(a)')echo selected @endif>Acompañado(a)</option>
                                    </select>
                                    @error('civil')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="email" >{{ __('Email:') }}</label>
                                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $paciente->email }}"  autocomplete="email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="celtrabajo" >{{ __('Celular del trabajo:') }}</label>
                                    <input id="celtrabajo" type="text" class="form-control @error('celtrabajo') is-invalid @enderror" name="celtrabajo" value="{{ $paciente->celtrabajo }} " >
                                    @error('celtrabajo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="teltrabajo" >{{ __('Teléfono del trabajo:') }}</label>
                                    <input id="teltrabajo" type="text" class="form-control @error('teltrabajo') is-invalid @enderror" name="teltrabajo" value="{{ $paciente->teltrabajo }} " >
                                    @error('teltrabajpo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label for="estatura" >{{ __('Estatura en metros:') }}</label>
                                    <input id="estatura" type="number" class="form-control @error('estatura') is-invalid @enderror" step="0.01" name="estatura" value="@isset($historico->estatura){{$historico->estatura}}@endisset" autocomplete="estatura">
                                    @error('estatura')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label for="peso" >{{ __('Peso en Kg:') }}</label>
                                    <input id="peso" type="number" class="form-control @error('peso') is-invalid @enderror" step="any" name="peso" value="@isset($historico->peso){{ $historico->peso}}@endisset" autocomplete="peso">
                                    @error('peso')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label for="presion" >{{ __('Presión en mm Hg:') }}</label>
                                    <input id="presion" type="text" class="form-control @error('presion') is-invalid @enderror" name="presion" value="@isset($historico->presion){{ $historico->presion }} @endisset" autocomplete="presion">
                                    @error('presion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group ">
                                    <label for="temperatura" >{{ __('Temperatura en Cº:') }}</label>
                                    <input id="temperatura" type="number" class="form-control @error('temperatura') is-invalid @enderror" step="0.01" name="temperatura" value="@isset($historico->temperatura){{$historico->temperatura}}@endisset" autocomplete="temperatura">
                                    @error('temperatura')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group ">
                                    <label for="glucosa" >{{ __('Glucosa en mg/dl:') }}</label>
                                    <input id="glucosa" type="number" class="form-control @error('glucosa') is-invalid @enderror" step="0.01" name="glucosa" value="@isset($historico->glucosa){{$historico->glucosa}}@endisset" autocomplete="glucosa">
                                    @error('glucosa')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label for="direccion" >{{ __('Dirección:') }}</label>
                                    <input id="direccion" type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{ $paciente->direccion }}"  autocomplete="direccion">
                                    @error('direccion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label >Asegurado:</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="asegurado" @if($paciente->asegurado == 'si') checked @endif id="siposee" value="si">
                                <label class="form-check-label" for="siposee">SI</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="asegurado" @if($paciente->asegurado == 'no') checked @endif id="noposee" value="no">
                                <label class="form-check-label" for="noposee">NO</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12" id="asegurados" @if($paciente->asegurado == 'no') style="display:none" @endif>
                                <div class="form-group">
                                    <label for="companiaseguro" >{{ __('Compañia aseguradora:') }}</label>
                                    <input type="text" name="companiaseguro" id="companiaseguro" class="form-control @error('companiaseguro') is-invalid @enderror" value="{{$paciente->companiaseguro}}">
                                    @error('companiaseguro')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="presion" >{{ __('Número de póliza:') }}</label>
                                    <input type="text" name="nopoliza" id="nopoliza" class="form-control  @error('nopoliza') is-invalid @enderror" value="{{$paciente->nopoliza}}">
                                    @error('nopoliza')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nocarnetpresion" >{{ __('Número de carné:') }}</label>
                                    <input type="text" name="nocarnet" id="nocarnet" class="form-control  @error('nocarnet') is-invalid @enderror" value="{{$paciente->nocarnet}}">
                                    @error('nocarnet')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="doctor_id" id="doctor_id" value="{{$paciente->doctor_id}}">
                        <input type="hidden" name="codigo" id="codigo" value="{{$paciente->codigo}}">
            </div>
            <div class="modal-footer">
                <div class="form-group ">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary btn-sm">
                            {{ __('Actualizar') }}
                    </button>
                </div>
            </div>
            </div>
        </div>
    </div>
</form>
