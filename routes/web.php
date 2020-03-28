<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
    if(Auth::check()==true){
        return view('home');
    } else {
        return view('inicio');
    }
})->name('inicio');

//INICIO//
//Route::get('/', 'InicioController@index')->name('inicio');


//LOGIN//
Auth::routes();

Route::group(['prefix' => 'admin'], function () {
        Voyager::routes();
    });

//ALL

Route::group(['middleware' => ['auth']], function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('doctores-asistente', 'HomeController@changedoctor')->name('home.change');
    Route::get('doctor-login', 'HomeController@doctor')->name('home.login');
    Route::get('/home/doctor', 'HomeController@doctorselect')->name('home.doctorselect');
    Route::post('/changedoctor', 'HomeController@cambiardoctor')->name('home.cambiar');
    Route::resource('pacientes', 'PacientesController');
    Route::put('/notas', 'AdjuntosController@notasupdate')->name('update.notas');

    //pacientes
    Route::get('pacientes/estado_traslado/{id}', 'PacientesController@llegopaciente')->name('paciente.llegopaciente');
    Route::get('reportes/ultrasonografia/{id}', 'PacientesController@reporteultrasonografia')->name('pacientes.ultra');
            //ruta para cambiar foto de perfil del paciente
    Route::post('userProfile', 'Pacientes\ImagenController@changeProfile')->name('changeProfile');
            //ruta para obtener los pacientes en la datatable
    Route::get('listadoPacientes', 'PacientesController@listadoPacientes');
    Route::get('pacientes/historico/{id}', 'PacientesController@historico')->name('pacientes.historico');
    Route::get('cumpleanios/mes','PacientesController@cumpleanieros')->name('pacientes.cumples');
    Route::get('habitciones','PacientesController@Habitaciones')->name('pacientes.habitaciones');
    Route::get('habitciones2','PacientesController@Habitaciones2')->name('pacientes.habitaciones2');
    Route::post('enviadopaciente','PacientesController@enviandopaciente')->name('pacientes.enviandopaciente');
    Route::post('createcitaarea','PacientesController@createcitaarea')->name('pacientes.createcitaarea');
    Route::get('createcitaarea/{habitacion}/{paciente}/{procedure}','PacientesController@createcitaarea')->name('pacientes.createcitaareaget');
    Route::get('createcitaarea','PacientesController@createcitaarea')->name('createcitaareaget.index');
   /*  Route::post('listadocitasarea','PacientesController@listadocitasarea')->name('pacientes.listadocitasarea'); */
    Route::get('listadocitasarea/{id}/{procedure}','PacientesController@listadocitasarea')->name('pacientes.listadocitasarea');
    Route::get('listadocitasarea','PacientesController@listadocitasarea')->name('prueba');
    Route::get('procedimientos_areas','PacientesController@procedimientos_areas')->name('pacientes.procedimientos_areas');

    //citas
    //ruta para ver calendario de citas
    Route::get('citas', 'CitasController@index')->name('citas.index');
    Route::get('cargacalendario', 'CitasController@cargacalendario')->name('citas.cargacalendario');
    Route::post('citas/editar', 'CitasController@edit')->name('citas.edit');
    //ruta para hacer cita de un determinado tipo
    Route::get('citas/{tipo}/{id}', 'CitasController@citaPaciente')->name('citas.paciente');
    Route::get('calendarshow', 'CitasController@calendarshow')->name('calendarshow');
    //crear citas y guardarlas
    Route::post('calendarinsert', 'CitasController@calendarinsert')->name('calendarinsert');
    //actualiza una cita
    Route::post('calendarupdate', 'CitasController@calendarupdate')->name('calendarupdate');
    Route::post('calendarupdateajax','CitasController@calendarupdateajax')->name('calendarupdateajax');   
    //eliminar citas con el doctor
    Route::post('calendardelete', 'CitasController@calendardelete')->name('calendardelete');
    Route::get('notificationscitas', 'CitasController@citasnotifications')->name('citas.notifications');
    Route::put('citasupdate/{id}', 'CitasController@marcarvisto')->name('citas.marcarvisto');
    
     //Imagenes
    Route::put('imagenes/avatar/{id}', 'Pacientes\ImagenController@avatar')->name('imagenes.avatar');
    Route::put('imagenes/logo/{id}', 'Pacientes\ImagenController@changelogo')->name('imagenes.logo');
    Route::put('imagenes/marca/{id}', 'Pacientes\ImagenController@changemarca')->name('imagenes.marca');



    //procedimientos
    Route::resource('procedimiento', 'ProcedimientoController');
    Route::get('procedimiento/tipo/{id}', 'ProcedimientoController@tipo')->name('procedimiento.tipo');
    Route::get('procedimiento/plantillas/{tipo}/{id}', 'ProcedimientoController@plantillas')->name('procedimiento.plantillas');
    Route::get('procedimiento/generar/{tipo}/{plantilla}/{id}', 'ProcedimientoController@generar')->name('procedimiento.generar');
    Route::post('procedimiento/dropzone/{tipo}/{plantilla}/{id}', 'ProcedimientoController@dropzone')->name('procedimiento.dropzone');
    Route::post('procedimientoEdit/{id}', 'ProcedimientoController@dropzoneEdit')->name('procedimiento.dropzoneEdit');

    //reportes
    Route::get('reportes/reporteConsulta/{id}', 'ReportesController@generarReporteConsulta')->name('reporteConsulta');

    //rutas para consultas
    Route::resource('/consultas', 'ConsultasController');
    Route::get('/consultas/create/{id}', 'ConsultasController@create')->name('consultas.create');
    //ruta para agregar receta a la consulta
    Route::get('/recetas/{consulta}/{paciente}/{plantilla}', 'ConsultasController@crearReceta')->name('crearReceta');
    //ruta para guardar la receta creada
    Route::post('/guardarReceta', 'ConsultasController@guardarReceta')->name('guardarReceta');
    Route::get('choosereceta/{consulta}/{paciente}/{doctor}', 'ConsultasController@chooseTemplate')->name('consulta.elegirplantilla');


    //rutas para recetas
    Route::get('/nuevaReceta', 'RecetaController@nuevaReceta')->name('nuevaReceta');

    Route::post('/createReceta', 'RecetaController@createReceta')->name('createReceta');

    Route::get('/recetasPrint/{id}', 'RecetaController@recetaPrinter')->name('recetas.print');
    Route::post('/recetaPaciente', 'RecetaController@recetaPaciente')->name('recetaPaciente');
    Route::get('/imprimirReceta/{id}', 'RecetaController@imprimirReceta')->name('imprimirReceta');
    Route::delete('receta/{id}', 'RecetaController@destroy')->name('recetas.destroy');
    Route::get('recetas/mensaje/{user}', 'RecetaController@retornoperfil')->name('recetas.mensaje');
    Route::get('recetas/{id}/edit', 'RecetaController@edit')->name('recetas.edit');
    Route::put('recetas/{id}', 'RecetaController@update')->name('recetas.update');
    Route::post('recetas/create','ConsultasController@printrecetaconsulta')->name('recetas.printreceta');
    Route::put('recetas/imprimir/{id}', 'RecetaController@printrecetareceta')->name('recetas.printedit');
    Route::get('recetaspaqueteseleccionado','RecetaController@paqueteseleccionado')->name('recetas.paqueteseleccionado');

    //rutas para adjuntos
    Route::resource('adjuntos','AdjuntosController');
    Route::get('adjuntos/{id}/printer','AdjuntosController@print')->name('adjuntos.print');

    //ruta inventario
    Route::resource('inventarios','InventarioController');
    Route::get('listatable','InventarioController@listatable')->name('inventarios.listatable');
    Route::get('ventamenu','InventarioController@ventamenu')->name('inventarios.ventamenu');
    Route::post('addventajax','InventarioController@addventajax')->name('inventarios.addventajax');
    Route::get('inventarioventa/{id}','InventarioController@ventapaciente')->name('inventario.addventaperfil');    
    Route::resource('inventariosentrada','EntradaInventarioController');
    Route::post('inventariosentradastore','EntradaInventarioController@store')->name('entradainventarios.store');
    Route::get('inventariosventamedic', 'InventarioController@listaventas')->name('inventario.listaventas');
    Route::get('inventariosverventa/{id}','InventarioController@verventapaciente')->name('inventario.verventa');
    Route::get('inventariocuantos', 'InventarioController@cuantoshay')->name('inventarios.cuantoshay');
    Route::get('inventariogededitdada', 'InventarioController@medicamentoaeditar')->name('inventarios.medicamentoaeditar');
    Route::post('inventarioeditarmedicamento', 'InventarioController@editarmedicamento')->name('inventarios.editarmedicamento');
    Route::post('inventarioeliminarmedicamento', 'InventarioController@eliminarmedicamento')->name('inventarios.eliminarmedicamento');
    Route::get('inventariosagregarcombo', 'InventarioController@agregarcombo')->name('inventarios.agregarcombo');
    Route::post('inventarioscreatecombo','InventarioController@createcombo')->name('inventarios.createcombo');
    Route::get('inventarioslistapaquetes','InventarioController@tablapaquetes')->name('inventarios.tablapaquetes');
    Route::get('inventariosshowcombo', 'InventarioController@showcombo')->name('inventarios.showcombo');
    Route::post('inventariosdeletecombo','InventarioController@deletecombo')->name('inventarios.deletecombo');
    Route::post('inventarioseditarpaquete','InventarioController@editarpaquete')->name('inventarios.editarpaquete');
    Route::get('inventarioscomboaeditar','InventarioController@comboaeditar')->name('inventarios.comboaeditar');
    

    //rutas para graficos
    Route::resource('/graficos', 'Pacientes\GraficosController');
    Route::get('/chartNow','Pacientes\GraficosController@chartNow')->name('graficoConsulta');
    Route::get('/ingresos','Pacientes\GraficosController@tableCobros')->name('graficos.ingresos');
    Route::put('/cobros', 'Pacientes\GraficosController@storeCobros')->name('cobro.trabajo');
    Route::get('/mensual','Pacientes\GraficosController@graficoMensual')->name('graficos.mensual');//ruta para graficos mensual
    Route::get('/chartMensual','Pacientes\GraficosController@chartMensual')->name('graficoMensual');
    Route::get('/anual','Pacientes\GraficosController@graficoAnual')->name('graficos.anual');//ruta para graficos anual
    Route::get('/chartAnual','Pacientes\GraficosController@chartAnual')->name('graficoAnual');
    Route::get('/semanal','Pacientes\GraficosController@graficoSemanal')->name('graficos.semanal');//ruta para graficos semanal
    Route::get('/chartSemanal','Pacientes\GraficosController@chartSemanal')->name('graficoSemanal');

    //USUARIO
    Route::resource('usuario', 'UsuarioController');


    //USUARIO
    Route::resource('usuario', 'UsuarioController');



    ///ROLES
    Route::resource('roles', 'RoleController');
    Route::post('register', 'Auth\RegisterController@register');
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');

    //RUTAS ANEXOS
    Route::resource('anexos',  'AnexosController');
    Route::get('anexos/{id}/{tipo}', 'AnexosController@altapaciente')->name('anexos.paciente');
    Route::post('anexos/pacientestore', 'AnexosController@pacientestore')->name('anexos.newpaciente');
    Route::post('anexos/habitacion', 'AnexosController@altahabitacion')->name('anexos.altahabitacion');
});




//PRUEBA DE GRÁFICOS








/*  Route::get('listarPacientes', 'PacientesController@listar')->name('listar'); */
//Route::get('listarDocores', 'DoctorController@listarDoctores')->name('listarDoctores');



//rutas de examenes

//rutas de agenda
Route::resource('/agenda', 'AgendaController');

//ADMIN
Route::group(['middleware' => ['auth']], function(){
Route::resource('panel', 'PanelController');
/* Route::resource('asistentes', 'PanelAdministrativo\AsistentesController'); */
Route::resource('users', 'PanelAdministrativo\UserController');
Route::get('userschange', 'PanelAdministrativo\UserController@cambiarusuario')->name('users.change');
Route::get('users/change/{id}', 'PanelAdministrativo\UserController@changeUser')->name('users.changeuser');
Route::get('listausers','PanelAdministrativo\UserController@table')->name('users.list');
Route::get('usersimg/profile','PanelAdministrativo\UserController@imagenes')->name('users.profileimg');
route::get('newuser/{id}','paneladministrativo\usercontroller@newuser')->name('users.nuevo');
Route::resource('doctores', 'PanelAdministrativo\DoctorController');
Route::put('doctores/informacion/{id}/', 'PanelAdministrativo\DoctorController@edicioninfo')->name('doctores.informacion');
Route::put('doctores/updateinfo/{id}', 'PanelAdministrativo\DoctorController@updateinfo')->name('doctores.updateinfo');
Route::get('doctorperfil/{id}', 'PanelAdministrativo\DoctorController@perfil')->name('doctores.profile');
Route::post('doctoresperfil/{id}', 'PanelAdministrativo\DoctorController@changeperfil')->name('doctores.perfil');
Route::get('nuevodoctor/{id}', 'PanelAdministrativo\DoctorController@nuevo')->name('doctores.nuevo');
Route::get('logosdoctor/{id}', 'PanelAdministrativo\DoctorController@logos')->name('doctores.logos');
Route::put('doctores/password/{id}', 'PanelAdministrativo\DoctorController@changepassword')->name('doctores.changepass');
Route::post('subirlogo/', 'PanelAdministrativo\DoctorController@logoupload')->name('doctores.upload');
Route::get('plantilla', 'PanelAdministrativo\DoctorController@plantilla')->name('doctores.plantilla');
Route::post('plantilla', 'PanelAdministrativo\DoctorController@plantillaStore')->name('doctores.plantillaStore');
Route::get('/new-asistente/{id}', 'PanelAdministrativo\DoctorController@newAsistente')->name('doctores.newasistente');
Route::get('/agregar-asistente/{doctor}/{asistente}', 'PanelAdministrativo\DoctorController@agregarAsistente')->name('doctores.agregar-asistente');
Route::delete('/quitar-asistente/{id}', 'PanelAdministrativo\DoctorController@quitarAsistente')->name('doctores.quitarasistente');
Route::post('/agregarclinica', 'PanelAdministrativo\DoctorController@storeClinica')->name('doctores.clinica');
Route::resource('permisos', 'PanelAdministrativo\PermissionController');
Route::post('/agregarrecetas', 'PanelAdministrativo\ArchivosController@crearReceta')->name('archivos.newreceta');
Route::get('/archivos', 'PanelAdministrativo\ArchivosController@index')->name('archivos.index');
Route::resource('/clinicas', 'PanelAdministrativo\ClinicaController');
Route::get('/clinicasdoctor/{id}', 'PanelAdministrativo\ClinicaController@doctor')->name('clinicas.doctor');
Route::delete('/clinicasdelete/{id}', 'PanelAdministrativo\ClinicaController@doctorquitar')->name('doctores.quitar');
Route::post('/clinicasadd', 'PanelAdministrativo\ClinicaController@doctoradd')->name('doctores.agregar');
Route::get('prueba/{id}', 'PanelController@prueba');
});



Route::get('estacion/', 'EstacionController@index')->name('estacion.index');
Route::get('areas','EstacionController@selectestacion')->name('estacion.selecthabitacion');
Route::get('estacion/{id}', 'EstacionController@index')->name('estacion.enviar');
Route::get('area/','EstacionController@esperapaciente')->name('estacion.area');
Route::get('area/{habitacion}','EstacionController@esperapaciente')->name('estacion.esperapaciente');
Route::post('operacion/cargarpersonal','EstacionController@Personaloperacion')->name('estacion.Personaloperacion');
Route::post('pacienteensala','EstacionController@llegopaciente')->name('estacion.pacientesala');
Route::post('operation','EstacionController@startop')->name('estacion.startop');
Route::post('endoperation','EstacionController@endoperation')->name('estacion.endoperation');
Route::post('selectencargado','EstacionController@selectencargado')->name('estacion.selectencargado');
Route::post('habitaciondisponible','EstacionController@habitaciondisponible')->name('estacion.habitaciondisponible');
Route::post('freeroom','EstacionController@freeroom')->name('estacion.freeroom');
Route::post('cambiarencargado','EstacionController@cambiarencargado')->name('estacion.cambiarencargado');

