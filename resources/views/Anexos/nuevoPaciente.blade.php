<form method="POST" action="{{route('anexos.newpaciente')}}" class="form-horizontal" id="formnewpaciente">
        @csrf
        <div class="modal fade" id="nuevoPacienteincapacidad" tabindex="-1" role="dialog" aria-labelledby="nuevoPaciente" aria-hidden="true">
                <div class="modal-dialog " role="document">
                  <div class="modal-content">
                    <div class="modal-header  ">
                      <h5 class="modal-title" id="titleNuevoPaciente">Agregar nuevo paciente</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                            <input type="hidden" name="_method" value="POST">
                            <div class="row form-group ">
                                <div class="col">
                                    <input type="text" class="form-control  @error('nombre') is-invalid @enderror" name="nombre" id="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus  placeholder="Nombre">
                                    @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control  @error('apellidos') is-invalid @enderror" name="apellidos" value="{{ old('apellidos') }}" required autocomplete="apellidos" autofocus placeholder="Apellidos">
                                     @error('apellidos')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                               <div class="col">
                                    <input type="text" maxlength=11  id="telefono" class="form-control  @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}"  autocomplete="telefono" placeholder="Télefono">
                                    @error('telefono')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                               </div>
                               <div class="col">
                                    <input type="text"   id="email" class="form-control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" placeholder="email Electrónico">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col">
                                    <input type="text" id="dui" name="dui" class="form-control @error('dui') is-invalid @enderror" name="dui" value="{{ old('dui') }}"  autocomplete="dui" placeholder="DUI">
                                    @error('dui')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <input id="celtrabajo" type="text" class="form-control @error('celtrabajo') is-invalid @enderror" name="celtrabajo"  placeholder="Celular del trabajo">
                                        @error('celtrabajo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <input id="teltrabajo" type="text" class="form-control @error('teltrabajo') is-invalid @enderror" name="teltrabajo" placeholder="Teléfono del trabajo" >
                                        @error('teltrabajpo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                               <div class="col">
                                   <label for="nacimiento">Fecha de nacimiento:</label>
                                    <input type="date" name="nacimiento" id="nacimiento" class=" form-control @error('nacimiento') is-invalid @enderror" name="nacimiento" value="{{ old('nacimiento') }}" required  min="1900-01-31" max="3000-12-31">
    
                                @error('nacimiento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                               </div>
                            </div>
                            <div class="row form-group">
                                <div class="col">
                                    <div class="col form-check form-check-inline" >
                                        <input class="form-check-input " type="radio" name="sexo" id="sexoHombre" value="M" required>
                                        <label class="form-check-label" for="sexoHombre">Hombre</label>&nbsp;
                                        <input class="form-check-input float-right " type="radio" name="sexo" id="sexoMujer" value="F" required>
                                        <label class="form-check-label" for="sexoMujer">Mujer</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col">
                                    <div class="col form-check form-check-inline" >
                                        <input class="form-check-input " type="radio" name="civil" id="soltero" value="Soltero(a)" >
                                        <label class="form-check-label" for="soltero">Soltero(a)</label>&nbsp;
                                        <input class="form-check-input float-right " type="radio" name="civil" id="casado" value="Casado(a)" >
                                        <label class="form-check-label" for="casado">Casado(a)</label>&nbsp;
                                        <input class="form-check-input float-right " type="radio" name="civil" id="acompañado" value="Acompañado(a)" >
                                        <label class="form-check-label" for="acompañado">Acompañado(a)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col">
                                        <input id="codigo" type="text" class="form-control @error('codigo') is-invalid @enderror" name="codigo"   placeholder="Código de paciente">
                                        @error('codigo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                </div>
                            </div>
                            <div class="row form-group ">
                                <div class="col">
                                    <input type="text" class="form-control  @error('estatura') is-invalid @enderror" name="estatura" id="estatura" value="{{ old('estatura') }}"  autocomplete="estatura" autofocus  placeholder="Estatura">
                                    @error('estatura')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control  @error('peso') is-invalid @enderror" name="peso" value="{{ old('peso') }}"  autocomplete="peso" autofocus placeholder="Peso">
                                     @error('peso')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <input id="presion" type="text" class="form-control @error('presion') is-invalid @enderror" name="presion"   placeholder="presión ">
                                    @error('presion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                            </div>
                            </div>
                            <input type="hidden" name="doctor_id" id="doctor_id" value="{{ Auth::user()->doctor_id }}">
                            <div class="form-group">
                                <label >Asegurado:</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="asegurado" id="siposee" value="si">
                                    <label class="form-check-label" for="siposee">SI</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="asegurado" checked id="noposee" value="no">
                                    <label class="form-check-label" for="noposee">NO</label>
                                </div>
                            </div>
                            <div id="asegurados" style="display:none">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="text" name="companiaseguro" id="companiaseguro" class="form-control @error('companiaseguro') is-invalid @enderror" placeholder="Compañia aseguradora">
                                            @error('companiaseguro')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="text" name="nopoliza" id="nopoliza" class="form-control  @error('nopoliza') is-invalid @enderror" placeholder="Número de póliza">
                                            @error('nopoliza')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="text" name="nocarnet" id="nocarnet" class="form-control  @error('nocarnet') is-invalid @enderror" placeholder="Número de carnet">
                                            @error('nocarnet')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                            <div class="modal-footer">
                                <button type="button" class="btn  btn-secondary" data-dismiss="modal" id="cerrar">Cancelar</button>
                                <button type="button" class="btn btn-primary" onclick="createpacient()">Guardar</button>
                            </div>
                  </div>
                </div>
              </div>
            </form>