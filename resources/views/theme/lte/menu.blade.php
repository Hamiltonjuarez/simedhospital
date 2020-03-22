<aside class="main-sidebar menu-bg-primary elevation-4 sidebar-dark-success">
    <!-- Brand Logo -->
    <a href="{{ route('inicio') }}" class="brand-link">
      <img src="{{asset("assets/img/logosiimed.png")}}" alt="AdminLTE Logo" class="brand-image"
           style="opacity: .8">
      <span class="brand-text font-weight-light">SIMED</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
    {{--   <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset("assets/dist/img/user2-160x160.jpg")}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            @if(Auth::user()->hasPermission('view_pacients'))
             <li class="nav-item">
            <a href="{{route('pacientes.index')}}" class="nav-link">
              <i class="nav-icon fa fa-address-book"></i>
              <p>
                Pacientes
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>
         @endif

          @if(Auth::user()->hasPermission('index_agenda'))
          <li class="nav-item">
            <a href="{{ route('citas.index')}}" class="nav-link">
              <i class="nav-icon fa fa-calendar"></i>
              <p>Agenda</p>
            </a>
          </li>
          @endif

          {{-- <li class="nav-item">
              <a href="{{route('perfilDoctor')}}" class="nav-link">
                    <i class="nav-icon fa fa-user-md" ></i>
                    <p>Perfil</p>
                </a>
          </li> --}}

          @if(Auth::user()->hasPermission('index_recetas'))
          <li class="nav-item">
                <a href="{{route('nuevaReceta')}}" class="nav-link">
                <img src="{{asset('/assets/img/reseta.png')}}" alt="" width="25px" height="25px">
                      <p>Recetas</p>
                  </a>
            </li>
          @endif

          @if(Auth::user()->hasPermission('index_anexos'))
          <li class="nav-item has-treview">
              <a href="{{route('anexos.index')}}" class="nav-link">
                <i class="nav-icon fa fa-file-text"></i>
                <p>Anexos</p>
              </a>
          </li>
          @endif
          <li class="nav-item has-treview">
            <a href="{{route('estacion.selecthabitacion')}}" class="nav-link">
              <i class="nav-icon fa fa-home"></i>
              <p>Estacion </p>
            </a>
        </li>

          <li class="nav-item has-treview">
            <a href="{{route('inventarios.index')}}" class="nav-link">
              <i class="nav-icon fa fa-archive"></i>
              <p>Inventario</p>
            </a>
          </li>
          
          @if(Auth::user()->hasPermission('index_graficos'))
            <li class="nav-item has-treview">
              <a href="{{route('graficos.index')}}" class="nav-link">
                  <i class="nav-icon fa fa-pie-chart" ></i>
                    <p>Estadísticas
                    </p>
                </a>
          </li>
          @endif
          
          @if(Auth::user()->hasPermission('show_doctors')) 
          <li class="nav-item">
            <a href="{{route('doctores.show', Auth::user()->doctor_id)}}" class="nav-link">
              <i class="nav-icon fa fa-user-md"></i>
              <p>
                Mi perfil
              </p>
            </a>
          </li>
          @endif

          @if(Auth::user()->hasPermission('index_cobros'))
          <li class="nav-item has-treview">
              <a href="{{route('graficos.ingresos')}}" class="nav-link">
                  <i class="nav-icon fa fa-money" aria-hidden="true"></i>
                    <p>Cobros
                    </p>
                </a>
          </li>
          @endif

          @if(Auth::user()->hasPermission('change_users'))
          <li class="nav-item">
            <a href="{{route('users.change')}}" class="nav-link">
                <i class="nav-icon fa fa-check" aria-hidden="true"></i>
                <p>Cambiar usuario</p>
            </a>
          </li>
          @endif

         {{--  @if(auth()->user()->hasRole('Admin'))
          <li class="nav-item has-treeview menu-close">
            <a href="" class="nav-link ">
              <i class="nav-icon fa fa-suitcase" aria-hidden="true"></i>
              <p>
                Panel Administrativo
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('users.change')}}" class="nav-link">
                    <i class="nav-icon fa fa-check" aria-hidden="true"></i>
                    <p>Cambiar usuario</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('users.index')}}" class="nav-link ">
                  <i class="nav-icon fa fa-users" aria-hidden="true"></i>
                  <p>Usuarios</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('doctores.index')}}" class="nav-link ">
                  <i class="nav-icon fa fa-user-md" aria-hidden="true"></i>
                  <p>Doctores</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('permisos.index')}}" class="nav-link ">
                 <i class="nav-icon fa fa-key" aria-hidden="true"></i>
                  <p>Permisos</p>
                </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('roles.index') }}" class="nav-link">
                    <i class="nav-icon fa fa-puzzle-piece" aria-hidden="true"></i>
                    <p>Roles</p>
                  </a>
                </li>
              <li class="nav-item">
                <a href="{{route('clinicas.index')}}" class="nav-link">
                  <i class="nav-icon fa fa-home" aria-hidden="true"></i>
                  <p>Clinicas</p>
                </a>
              </li>
            </ul>
          </li>
          @endif --}}
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>



