<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use \Carbon\Carbon;
use App\AdjuntoPaciente;
use App\HistorialClinico;
use App\Paciente;
use App\Reporte;
use App\Anexos;
use Auth;
use App\Doctor_asistente;
use App\User;
use PDF;
use App\Mix;
use App\Examen;
use App\Consulta;
use Image;
use App\Receta;
use App\Historico;
use App\Doctor;
use App\Procedimiento;
use App\Http\Requests\CreatePacienteRequest;
use App\Notifications\invoicePaid;
use App\inventario;
use App\Paquetes;
use App\areas;
use App\Cita;
use App\Procedimiento_estado;
use App\Procedimiento_tipo;
use App\habitaciones_areas;
use App\Medicamentospaquetes;
use Notification;
use App\Histortial_habitaciones;
use Illuminate\Support\Str;

class PacientesController extends Controller
{
    public $codigo;
    /* public function __construct()
    {
        $this->middleware('can:pacientes.index')->only('index');
        $this->middleware('can:pacientes.create')->only(['create','store']);
        $this->middleware('can:pacientes.edit')->only(['edit','update']);
        $this->middleware('can:pacientes.show')->only('show');
        $this->middleware('can:pacientes.destroy')->only('destroy');
    } */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posee = Doctor::find(Auth::user()->doctor_id);
       $pacientes = Paciente::where('doctor_id',Auth::user()->doctor_id)->orderBy('created_at','DESC');

        $areas = areas::get();
       /*  return $areas; */
        

        return view('pacientes/lista', compact('posee','pacientes','areas'));
    }

    public function listadoPacientes()
    {
        if(Auth::user()->hasPermission('list_pacients'))
            {
                return datatables()
                ->eloquent(Paciente::where('doctor_id',Auth::user()->doctor_id)->LeftJoin('habitaciones_areas','pacientes.habitacion_id','habitaciones_areas.id')
                ->select('pacientes.*','habitaciones_areas.habitacion_nombre')->orderBy('pacientes.created_at','DESC'))
                ->addColumn('nacimiento', function($row){
                    return "{$row->age}";
                })
                ->addColumn('created_at', function($row){
                    return \Carbon\Carbon::parse($row->created_at)->format('d/m/Y - h:i a');
                })
                ->addColumn('btn', 'pacientes.actions')
                /* ->addColumn('grab', 'pacientes.grab') */
                ->rawColumns(['btn'/* ,'grab' */])
                ->toJson();
            }
            elseif(Auth::user()->hasPermission('list_pacients_asistent')){
                return datatables()
                ->eloquent(Paciente::where('doctor_id',Auth::user()->doctor_id)->orderBy('created_at','DESC'))
                ->addColumn('nacimiento', function($row){
                    return "{$row->age}";
                })
                ->addColumn('created_at', function($row){
                    return \Carbon\Carbon::parse($row->created_at)->format('d/m/Y - h:i a');
                })
                 ->addColumn('btn', 'pacientes.actionsSecretaria')
                 ->rawColumns(['btn'])
                 ->toJson();
            }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $examen=Examen::orderBy('nombreExamen','ASC')->get();
        return view('pacientes.nuevoPaciente', compact('examen'));
    }

  /*   public function crearCodigo($doctor){
       $anio = \Carbon\Carbon::now()->format('Y');
       $mes = \Carbon\Carbon::now()->format('m');
       $this->codigo = Paciente::select('codigo')
       ->where('doctor_id', $doctor)->orderBy('created_at','DESC')->first();

       
    } */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
       /*  return $request; */
        if(Auth::user()->hasPermission('store_pacients')){
            if($request->codigo == null)
            {
                $codigo = Paciente::where('codigo',\Carbon\Carbon::now()->format('Y').'/'.\Carbon\Carbon::now()->format('m').'/'.'1')
                            ->where('doctor_id', $request->doctor_id)->exists();
                if($codigo==false)
                {
                    $codigopaciente = \Carbon\Carbon::now()->format('Y').'/'.\Carbon\Carbon::now()->format('m').'/'.'1';

                    $paciente = Paciente::create([
                        'nombre' => $request->nombre,
                        'apellidos' => $request->apellidos,
                        'nacimiento' => $request->nacimiento,
                        'telefono' => $request->telefono,
                        'email' => $request->email,
                        'sexo' => $request->sexo,
                        'civil' => $request->civil,
                        'codigo' => $codigopaciente,
                        'dui' => $request->dui,
                        'habitacion_id' => $request->habitaciones,
                        'doctor_id' => $request->doctor_id,
                        'teltrabajo' => $request->teltrabajo,
                        'celtrabajo' => $request->celtrabajo,
                        'asegurado' => $request->asegurado,
                        'companiaseguro' => $request->companiaseguro,
                        'nopoliza' => $request->nopoliza,
                        'nocarnet' => $request->nocarnet,
                        'direccion' => $request->direccion,
                    ]);

                    if($request->peso != null || $request->presion != null || $request->estatura != null || $request->temperatura != null || $request->glucosa != null){
                        $otrosdatos = Historico::create([
                            'temperatura' => $request->temperatura,
                            'peso' => $request->peso,
                            'presion' => $request->presion,
                            'glucosa' => $request->glucosa,
                            'estatura' => $request->estatura,
                            'paciente_id' => $paciente->id,
                        ]);
                    }
                   
                   /*  $historialnavegacion = Histortial_habitaciones::create([
                        'paciente_id' => $paciente->id,
                        'habitacion_id' => $request->habitaciones
                    ]); */

                    $habitacion = habitaciones_areas::find($request->habitaciones);
                    $pacientes = Paciente::select('id','nombre','apellidos')->where('doctor_id', Auth::user()->doctor_id)->orderBy('created_at','DESC')->paginate(25);
                   /*  $citashabitacion = Cita::where('habitacion_id',$habitacion->id)->get(); */

                    /* return view('pacientes.citashabitaciones', compact('pacientes','citashabitacion','habitacion','paciente')); */
                    

                    return redirect()->route('pacientes.show', $paciente->id);
                }
                else
                {
                    $endpaciente = Paciente::where('doctor_id', $request->doctor_id)->max('created_at');
                    $endpacienteUno = Paciente::where('created_at', $endpaciente)->first();
                    $increment = explode("/", $endpacienteUno->codigo);
                    $id = $increment[2]+0001;
                    $paciente = Paciente::create([
                        'nombre' => $request->nombre,
                        'apellidos' => $request->apellidos,
                        'nacimiento' => $request->nacimiento,
                        'telefono' => $request->telefono,
                        'email' => $request->email,
                        'sexo' => $request->sexo,
                        'civil' => $request->civil,
                        'codigo' => \Carbon\Carbon::now()->format('Y').'/'.\Carbon\Carbon::now()->format('m').'/'.$id,
                        'dui' => $request->dui,
                        'doctor_id' => $request->doctor_id,
                        'teltrabajo' => $request->teltrabajo,
                        'habitacion_id' => $request->habitaciones,
                        'celtrabajo' => $request->celtrabajo,
                        'asegurado' => $request->asegurado,
                        'companiaseguro' => $request->companiaseguro,
                        'nopoliza' => $request->nopoliza,
                        'nocarnet' => $request->nocarnet,
                        'direccion' => $request->direccion,
                    ]);

                    if($request->peso != null || $request->presion != null || $request->estatura != null || $request->temperatura != null || $request->glucosa != null){
                        $otrosdatos = Historico::create([
                            'temperatura' => $request->temperatura,
                            'peso' => $request->peso,
                            'presion' => $request->presion,
                            'glucosa' => $request->glucosa,
                            'estatura' => $request->estatura,
                            'paciente_id' => $paciente->id,
                        ]);
                    }

                   /*  $historialnavegacion = Histortial_habitaciones::create([
                        'paciente_id' => $paciente->id,
                        'habitacion_id' => $request->habitaciones
                    ]); */
                  
                    $pacientes = Paciente::select('id','nombre','apellidos')->where('doctor_id', Auth::user()->doctor_id)->orderBy('created_at','DESC')->paginate(25);
                    $habitacion = habitaciones_areas::find($request->habitaciones);
                   /*  $citashabitacion = Cita::where('habitacion_id',$habitacion->id)->get(); */

                   /*  return view('pacientes.citashabitaciones', compact('pacientes','citashabitacion','habitacion','paciente')); */
                   return redirect()->route('pacientes.show', $paciente->id);
                }
            }
            else{
               
                $paciente=Paciente::create($request->all());
                $pacientes = Paciente::select('id','nombre','apellidos')->where('doctor_id', Auth::user()->doctor_id)->orderBy('created_at','DESC')->paginate(25);

                /* $historialnavegacion = Histortial_habitaciones::create([
                    'paciente_id' => $paciente->id,
                    'habitacion_id' => $request->habitaciones
                ]);
 */
                $habitacion = habitaciones_areas::find($request->habitaciones);
                /* $citashabitacion = Cita::where('habitacion_id',$habitacion->id)->get(); */

               /*  return view('pacientes.citashabitaciones', compact('pacientes','citashabitacion','habitacion','paciente')); */
                return redirect()->route('pacientes.show', $paciente->id);
            }
       }else{
           abort(401);
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->hasPermission('show_pacient')){
            $doctor=Doctor::find(Auth::user()->doctor_id);
            $paciente=Paciente::find($id);
            if($paciente){
                if ($paciente->doctor_id == $doctor->id) {
                    $historial=HistorialClinico::leftJoin('consultas','historial_clinicos.consulta_id','consultas.id')
                    ->leftJoin('procedimientos','historial_clinicos.procedimiento_id','procedimientos.id')
                    ->leftJoin('recetas','recetas.consulta_id','consultas.id')
                    ->leftJoin('procedimiento_tipos As t', 'procedimientos.procedimiento_tipo_id', 't.id')
                    ->leftJoin('anexos', 'anexos.id','historial_clinicos.anexo_id')
                    ->where('historial_clinicos.paciente_id',$id)
                    ->select('historial_clinicos.*','anexos.diagnostico As diagnosticoanexo','anexos.tipo','consultas.tituloConsulta','consultas.detalleConsulta','consultas.diagnostico','prescripcion', 't.procedimiento_nombre','recetas.id As receta')
                    ->orderBy('historial_clinicos.created_at','DESC')->get();

                    $cantidad=$historial->count();
                    $recetas=Receta::where('paciente_id',$paciente->id)->orderBy('created_at','DESC')->get();
                    $cantidadRecetas=$recetas->count();

                    $adjuntos=AdjuntoPaciente::where('paciente_id',$id)->orderBy('created_at', 'DESC')->get();
                    $cantidadAdjuntos=$adjuntos->count();

                    $historico = Historico::where('paciente_id',$paciente->id)->orderBy('created_at','DESC')->take(1)->first();
                    $doctor2 = Auth::user()->doctor_id;
                    $medicamentos = inventario::where('doctor_id',$doctor2)->get();  
                    $paquetes = Paquetes::where('doctor_id',$doctor2)->get();       
                    $areas = areas::get();
                   if($paciente->habitacion_id != null){
                    $habitacion = habitaciones_areas::find($paciente->habitacion_id);

                   }else{
                       $habitacion = 'no asignado';
                   }
                    $historialnavegacion = Histortial_habitaciones::Join('habitaciones_areas','histortial_habitaciones.habitacion_id','habitaciones_areas.id')
                    ->Join('areas','habitaciones_areas.area_id','areas.id')
                    ->where('histortial_habitaciones.paciente_id',$id)->select('habitaciones_areas.habitacion_nombre','areas.nombre_area','histortial_habitaciones.created_at')                   
                    ->orderBy('histortial_habitaciones.created_at','DESC')->get();/* return $medicamentos; */

                    return view('pacientes.perfilPaciente', compact('habitacion','paquetes','historialnavegacion','areas','paciente','medicamentos','historico','historial','cantidad','cantidadAdjuntos','adjuntos','doctor','recetas','cantidadRecetas'));

                }
                else{
                    return redirect()->route('pacientes.index');
                }
            }else{
                return redirect()->route('pacientes.index');
            }
        }else{
            abort(401);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()->hasPermission('update_pacient')){
            $paciente = Paciente::find($id);
            $paciente->update($request->all());
            $historico = Historico::where('paciente_id',$id)->orderBy('created_at','DESC')->take(1)->first();

            if($historico !=null){
                if($request->peso != $historico->peso || $request->estatura != $historico->estatura || $request->temperatura != $historico->temperatura || $request->presion != $historico->presion || $request->glucosa != $historico->glucosa ){
                    if($request->peso != null && $historico->peso != null){
                        $valor = abs($request->peso - $historico->peso);
                        if($request->peso > $historico->peso){
                            $mejora = 'ha incrementado '.$valor.' Libras.';
                        }else if($request->peso < $historico->peso){
                            $mejora = 'ha disminuido '.$valor.' Libras.';
                        }else{
                            $mejora = '';
                        }
                        $newhistorico = Historico::create([
                            'peso' => $request->peso,
                            'presion' => $request->presion,
                            'estatura' => $request->estatura,
                            'glucosa' => $request->glucosa,
                            'temperatura' => $request->temperatura,
                            'mejora' => $mejora,
                            'paciente_id' => $paciente->id,
                        ]);
                    }else{
                        $newhistorico = Historico::create([
                            'peso' => $request->peso,
                            'presion' => $request->presion,
                            'estatura' => $request->estatura,
                            'glucosa' => $request->glucosa,
                            'temperatura' => $request->temperatura,
                            'paciente_id' => $paciente->id,
                        ]);
                    }
                    return back()->with('exito', 'Los datos del paciente se actualizaron con éxito');
                }else{
                    return back()->with('exito', 'Los datos del paciente se actualizaron con éxito');
                }
            }else{
                $newhistorico = Historico::create([
                    'peso' => $request->peso,
                    'presion' => $request->presion,
                    'estatura' => $request->estatura,
                    'glucosa' => $request->glucosa,
                    'temperatura' => $request->temperatura,
                    'paciente_id' => $paciente->id,
                ]);
                return back()->with('exito', 'Los datos del paciente se actualizaron con éxito');
            }
        }else{
            abort(401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->hasPermission('delete_pacient'))
        {
            $paciente=Paciente::find($id);
            $historias=HistorialClinico::where('paciente_id',$paciente->id)->get();
            $consultas = array();
            $procedimientos = array();
            foreach ($historias as $key => $historia) {
                $consultas[]=$historia->consulta_id;
                $procedimientos[]=$historia->procedimiento_id;
            }
            
            if(count($historias))
            {
                $eliminados=HistorialClinico::destroy($historias);
            }
            if (count($consultas)>0) {
                $deleteConsulta=Consulta::destroy($consultas);
            }

            $url = public_path('adjuntospaciente/'.'paciente'.$paciente->id);

            if (file_exists($url))
            {
                $files=glob($url.'/*');
                foreach ($files as $key => $file)
                {
                    if(is_file($file))
                    {
                        unlink($file);
                    }
                }
                if(file_exists($url))
                {
                    rmdir($url);
                }
                $paciente->delete();
                return redirect()->route('pacientes.index');
            } else {
                $paciente->delete();

                return redirect()->route('pacientes.index');
            }
        }else{
           abort(401);
        }
    }

    public function historico($id){
        if(Auth::user()->hasPermission('historic_pacient'))
        {
            $doctor=Doctor::find(Auth::user()->doctor_id);
            $paciente=Paciente::find($id);
            if($paciente){
                if ($paciente->doctor_id == $doctor->id) {
                    $historicos = Historico::select('*')->where('paciente_id',$id)->orderBy('created_at','DESC')->get();
                    if(count($historicos)>0){
                        return view('pacientes.historico', compact('paciente','doctor','historicos'));
                    }else{
                        return 'El paciente no tiene registros para el historico de peso y presión.......';
                    }
                }
                else{
                    return redirect()->route('pacientes.index');
                }
            }else{
                return redirect()->route('pacientes.index');
            }
        }
        if(Auth::user()->hasPermission('historic_pacient_asistent'))
        {
            $paciente = Paciente::find($id);
            $id_doctor = Auth::user()->doctor_id;
            if($id_doctor!=null)
            {
                $doctor = Doctor::find($id_doctor);

                if($paciente){
                    $paciente=Paciente::find($id);
                    if ($paciente->doctor_id == $doctor->id) {
                        $historicos = Historico::select('*')->where('paciente_id',$id)->orderBy('created_at','DESC')->get();
                        if(count($historicos)>0){
                            return view('pacientes.historico', compact('paciente','doctor','historicos'));
                        }else{
                            return 'El paciente no tiene registros para el historico de peso y presión.......';
                        }
                    }
                    else{
                        return redirect()->route('pacientes.index');
                    }
                }else{
                    return redirect()->route('pacientes.index');
                }
            }else{
                return redirect()->route('pacientes.index');
            }
        }
    }
    
    public function addmovil(Request $request){
     $variable = explode('||',$request);
     $cadena = Str::substr($variable[0],-8);
     return response()->json([
            'dui' => $cadena,
            'apellidos' => $variable[2],
            'nombre' => $variable[1],
            'direccion' => $variable[5].' '.$variable[6],
            'sexo' => $variable[8],
            'nacimiento' => $variable[9],
         ]);
    }
    
    public function cumpleanieros(){
        $mes = Carbon::now()->month;
        $cumples = Paciente::select('pacientes.telefono','pacientes.nombre','pacientes.apellidos','pacientes.nacimiento','pacientes.id','pacientes.photo_extension')
                ->whereMonth('nacimiento',$mes)->where('doctor_id',Auth::user()->doctor_id)
                ->orderBy('nacimiento','DESC')->get();
        return $cumples;
    }

    public function Habitaciones(Request $request){

        $habitaciones = habitaciones_areas::where('area_id',$request->dato)->where('habitaciones_areas.estado','libre')->get();
        return response()->json([
            $habitaciones
        ]);
    }
    public function Habitaciones2(Request $request){

        $habitaciones = habitaciones_areas::where('area_id',$request->dato)->get();
        return response()->json([
            $habitaciones
        ]);
    }
    public function enviandopaciente(Request $request){
        /* return $request; */
       $paciente = Paciente::find($request->paciente);
       $habitacion = habitaciones_areas::find($request->habitaciones);
      /*  return $request->procedimiento; */
       $tipoprocedimiento = Procedimiento_tipo::find($request->procedimiento);
       
      if($request->areas == 3 or $request->areas == 4 or $request->areas == 1){
        $procedimiento = new Procedimiento_estado;
        $procedimiento->paciente_id = $paciente->id;
        $procedimiento->habitacion_id = $habitacion->id;
        $procedimiento->tipoprocedimiento_id = $tipoprocedimiento->id;
        $procedimiento->estado = 'pendiente';
        $procedimiento->save();
      }
      /*  return $paciente; */
       $hanterior = habitaciones_areas::find($paciente->habitacion_id);      
       if($hanterior !== null){         
        if($hanterior->area_id != 2){
          /*   return $hanterior->area_id; */
            $hanterior->update([
                'estado' => 'libre'
            ]);
        }
       }
     

      if($habitacion->area_id != 5){
            $habitacion->update([
                'estado' => 'ocupada'
             ]);
      }

      $paciente->update([
        'habitacion_id' => $habitacion->id,
        'estado_traslado' => 'enviado'
      ]);

      $posee = Doctor::find(Auth::user()->doctor_id);
      return view('pacientes/lista', compact('posee','areas'))->with('exito', 'Los datos del paciente se actualizaron con éxito');
      /*  return back(); */
    }

    public function llegopaciente($id){
       $paciente = Paciente::find($id);
       $paciente->update([
           'estado_traslado' => 'en habitacion'
       ]);

       $historial = Histortial_habitaciones::create([
           'paciente_id' => $id,
           'habitacion_id' => $paciente->habitacion_id  
       ]);
   
    return redirect()->route('pacientes.show', $paciente->id)->with('exito', 'paciente ingresado a la habitacion');
      
    }

    public function createcitaarea($habitacion, $paciente){
      
        $citashabitacion = Cita::where('habitacion_id',$habitacion)->get();
        $habitacion = habitaciones_areas::find($habitacion);
        $paciente = Paciente::find($paciente);
       
        return view('pacientes.citashabitaciones', compact('citashabitacion','habitacion','paciente'));
    }

    public function listadocitasarea(Request $request, $habitacion){
        /* return $request; */
       
        $citashabitacion = Cita::where('habitacion_id',$habitacion)->get();
        $habitacion = habitaciones_areas::find($habitacion);
        $pacientes = Paciente::select('id','nombre','apellidos')->where('doctor_id', Auth::user()->doctor_id)->orderBy('created_at','DESC')->paginate(25);
       
        return view('pacientes.citashabitacionesshow', compact('citashabitacion','habitacion','pacientes'));
    }


    function procedimientos_areas(Request $request){
        $procedimientos = Procedimiento_tipo::where('area_id',$request->dato)->get();
        return response()->json([
            $procedimientos
        ]);
    }


}
