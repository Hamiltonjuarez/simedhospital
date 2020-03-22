<nav class="main-header navbar navbar-expand border-bottom navbar-dark navbar-bg-primary">
        <!-- Left navbar links -->
        <ul class="navbar-nav" >
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
          </li>
         @can('home.change')
           @if(auth()->user()->hasRole('Asistente'))
           <li class="nav-item dropdown" v-if="cantidadDoctor()>1">
                <form action="{{route('home.cambiar')}}" method="POST" id="cambiar-doctor">
                    @csrf
                    <input type="hidden" name="_method" value="POST">
                    <select name="doctor_id" id="" class="form-control-sm bg-primary"  onchange="this.form.submit()" >
                        <option v-for="(doctor, index) in doctores"
                        :key="index" :value="doctor.id"
                        :selected="selectedOption(doctor)" >
                        @{{ doctor.nombreDoctor}}
                    </option>
                    </select>
                </form>
            </li>
            @endif
         @endcan
          {{-- <li class="nav-item d-none d-sm-inline-block">
            <a href="{{asset('/')}}" class="nav-link">Contacto</a>
          </li> --}}
        </ul>

        <!-- SEARCH FORM -->
        {{--<form class="form-inline m-auto">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Buscar" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fa fa-search"></i>
              </button>
            </div>
          </div>
        </form>--}}

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">{{ __('Login') }}</a>
                </li>
                {{-- @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif --}}
            @else
                <li v-if="cumpleaneros.length>0" class="nav-item dropdown">
                  <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fa fa-birthday-cake"></i>
                    <span class="badge badge-rosa navbar-badge ml-2" style="font-size:10px" >@{{cumpleaneros.length}}</span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="margin:0%;padding:0%">
                      <ul class="list-group" style="margin:0%;padding:0%">
                        <span class="dropdown-item dropdown-header" >
                          @{{cumpleaneros.length}} Cumpleañeros
                        </span>
                        <li class="list-group-item" style="margin:0%;padding:0%" v-for="cumples of cumpleaneros">
                          <a v-bind:href="'http://127.0.0.1:8000/pacientes/'+cumples.id" class="dropdown-item">
                            <div class="media">
                            <img v-bind:src="'http://127.0.0.1:8000/'+cumples.avatar" alt="User Avatar" width="50px" height="50px" class=" mr-3 img-circle">
                              <div class="media-body">
                                <h3 class="dropdown-item-title">
                                  @{{cumples.nombre}}
                                </h3>
                                <p class="text-sm text-muted"><i class="fa fa-calendar" aria-hidden="true"></i> @{{cumples.fecha}}</p>
                                <p class="text-sm text-primary">Deseale un feliz cumpleaños</p>
                              </div>
                            </div>
                          </a>
                        </li>
                      </ul>
                  </div>
                </li>

              <li v-if="notificaciones.length>0" class="nav-item dropdown"  id="notificaciones" >
                <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="fa fa-bell" aria-hidden="true"></i>
                  <span class="badge badge-warning navbar-badge ml-2" style="font-size:10px">@{{notificaciones.length}}</span>
                </a>
                <div class="dropdown-menu  dropdown-menu-right"  style="width:400px">
                  <ul class="list-group">
                    <span class="dropdown-item dropdown-header">
                      @{{notificaciones.length}} Notificaciones
                    </span>
                    <li class="list-group-item" v-for="item of notificaciones">
                      <div class="row">
                        <div class="col-md-10">
                          <p class="text-sm" style="margin:0%;padding:0%">@{{item.titulo}}</p>
                          <p v-if="item.paciente != 'null null'" class="text-sm" style="margin:0%;padding:0%">@{{item.paciente}}</p>
                          <p class="text-secondary" style="font-size:11px;margin:0%;padding:0%">@{{item.hora}}</p>
                        </div>
                        <div class="col-md-2">
                          <a href="{{route('citas.marcarvisto', 1)}}" class="btn btn-sm btn-success mt-2" onclick="event.preventDefault();document.getElementById('form-visto').submit();"><i class="fa fa-check" aria-hidden="true"></i></a>
                          <form id="form-visto" action="{{route('citas.marcarvisto', 1)}}" method="POST" >
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden"  name="codigo" v-model="item.id">
                          </form>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </li>
                <li class="nav-item dropdown" id="logout">
                  <a id="navbarDropdown" class="nav-link dropdown-toggle d-none d-md-block" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                    <img src="{{asset(Auth::user()->avatar)}}" class="img-circle profile-img img-hidden"  style="width:35px;height:30px;" alt="user profile"> <span class="">{{ Auth::user()->name }}</span>   <span class="caret"></span>
                  </a>
                  <a id="navbarDropdown" class="nav-link dropdown-toggle d-block d-md-none" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                      <img src="{{asset(Auth::user()->avatar)}}" class="img-circle profile-img img-hidden" style="width:35px;height:30px;" alt="user profile">
                  </a>
                    <div class="dropdown-menu dropdown-menu-right " aria-labelledby="dLabel" style="padding:10px;width:300px">
                        <div class="row">
                          <div class="col-2"><img src="{{asset(Auth::user()->avatar)}}" width="100%" height="auto" class="img-circle" style="width:60px;height:60px;margin-left:5px;" alt=""></div>
                          <div class="col-10" >
                              <h5 style="line-height:80%;margin-top:12px;margin-bottom:5px;margin-left:30px">{{ Auth::user()->name }}</h5>
                              <h6 style="margin-top:0px;font-weight:200;font-size:12px;margin-left:30px">{{ Auth::user()->email }}</h6>
                          </div>
                        </div>
                        <div class="divider"></div>
                        @if(Auth::user()->id == 4)
                        <div class="row" style="margin-top:5px">
                          <div class="col-12 text-center">
                              <a href="#" class="btn btn-default btn-block">Usuario: @{{doctor}}</a>
                          </div>
                        </div>
                        @endif
                        <div class="row" style="margin-top:5px">
                          <div class="col-12 text-center">
                              <a href="{{route('doctores.show', Auth::user()->doctor_id)}}" class="btn btn-default btn-block"><i class="fa fa-user-md" aria-hidden="true"></i> Perfil</a>
                          </div>
                        </div>
                        <div class="row" style="margin-top:5px">
                          <div class="col-12 text-center">
                              <a href="{{route('home')}}" class="btn btn-default btn-block"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a>
                          </div>
                        </div>
                        <div class="row" style="margin-top:5px">
                          <div class="col-12 text-center">
                              <a href="{{ route('logout') }}" class="btn btn-danger btn-block" onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                                <i class="fa fa-power-off" aria-hidden="true"></i> Cerrar sesión
                              </a>
                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                  @csrf
                              </form>
                          </div>
                        </div>
                    </div>
                </li>
            @endguest
        </ul>
</nav>