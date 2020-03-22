<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paciente;
use DB;
use App\habitaciones_areas;
use Illuminate\Support\Facades\Storage;
use \Carbon\Carbon;
use App\AdjuntoPaciente;
use App\HistorialClinico;
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
use App\venta;
use App\salida_inventario;
use App\Cita;
use App\Procedimiento_estado;
use App\Medicamentospaquetes;
use App\Procedimiento_tipo;
use App\Datos_operacion;
use App\Personal;

use Notification;
use App\Histortial_habitaciones;
use Illuminate\Support\Str;

class EstacionController extends Controller
{
    public function index($id)
    {
        $paciente = Paciente::find($id);
        /* return $paciente; */
        $habitacion = habitaciones_areas::leftJoin('areas', 'areas.id', 'habitaciones_areas.area_id')->find($paciente->habitacion_id);
        if($habitacion->nombre_area == 'Quirofano'){
        $operacion = Procedimiento_estado::where(['paciente_id'=>$id,'estado'=>'pendiente'])
        ->orderBy('created_at', 'desc')->first();
        $operacionnombre = Procedimiento_tipo::find($operacion->tipoprocedimiento_id);

        //$paciente->update(['estado_traslado' => 'en habitacion']);
        $doctor=Doctor::find(Auth::user()->doctor_id);
        

        
            return view('estacion.quirofano', compact('paciente','operacion','operacionnombre','doctor','estacion')); 

        } else {
            return $habitacion;
        }
        //$estacion = habitaciones_areas::find($id);

        //$estacion->update(['estado' => 'ocupada']);


        /* $habitacion = DB::table('habitacion'), 
        $paciente = Paciente::find(18);

        $estacion = DB::table('habitaciones_areas')->find($paciente->habitacion_id);*/

        
        
    }
    public function selectestacion(Request $request){  
        $areas=areas::join('habitaciones_areas', 'habitaciones_areas.area_id', '=', 'areas.id')
        ->select('areas.nombre_area', 'habitaciones_areas.*')->orderBy('areas.id', 'asc')
        ->orderBY('habitaciones_areas.habitacion_nombre', 'asc')->get();
        $area_id=0;
        
        return view('estacion.seleccionar_habitacion', compact('areas', 'area_id'));
        /* return('here');  */    
        /* $habitaciones = habitaciones_areas::get();
        return view('estacion.seleccionar_habitacion',compact('habitaciones')); */
    }

    public function esperapaciente($habitacion){
        $area = habitaciones_areas::join('areas', 'habitaciones_areas.area_id', '=', 'areas.id')->find($habitacion);

        if($area->nombre_area=='Laboratorio Clinico'){
            $examenes = procedimiento_tipo::where('area_id', '=', '3')->get();
            return view('estacion.laboratorio', compact('area', 'examenes'));
        }
       /*  return $habitacion; */
      $habitacionpaciente = habitaciones_areas::find($habitacion);
      /* return $habitacion; */
      $paciente = Paciente::where('habitacion_id',$habitacionpaciente->id)
      ->orderBy('created_at', 'desc')->first();
      /* return $paciente; */
     if($paciente != null){        
        $operacion = Procedimiento_estado::where([['paciente_id', $paciente->id],['estado','pendiente']])
        ->first();
       
        /* return $operacion; */
        $operacionnombre = Procedimiento_tipo::find($operacion->tipoprocedimiento_id);
     }else{
        $operacion = 'no asignado';
        /* return $operacion; */
        $operacionnombre = 'no asignado';
     }

     $medicos = Personal::get();

     $op = Datos_operacion::where('paciente_id',$paciente->id)
     ->orderBy('created_at', 'desc')->first();
        
     if($op != null){
        $doc = Personal::find($op->doctor_id);
        /* return $doc; */
        $anestesio = Personal::find($op->anestesiologo_id);
        /* return $anestesio; */
        $prime = Personal::find($op->primer_id);
        /* return $prime; */
        $second = Personal::find($op->segundo_id);
        $instru = Personal::find($op->instrumentalista);        
        $circu = Personal::find($op->circular_id);
        
        if($doc != null){
            
           $doctor = $doc->nombre;
       }else{
           $doctor = 'no asignado';
       }
       if($anestesio != null){
           $anestesista = $anestesio->nombre;
       }else{
           $anestesista = 'no asignado';
       }
       if($prime != null){
           $primer = $prime->nombre;
       }else{
           $primer = 'no asignado';
       }
       if($second != null){
           $segundo = $second->nombre;
       }else{
           $segundo = 'no asignado';
       }
       if($instru != null){        
           $instrumentista = $instru->nombre;
       }else{
           
           $instrumentalista = 'no asignado';
       }
       if($circu != null){
           $circular = $circu->nombre;
       }else{
           $circular = 'no asignado';
       }
       /*  if($doc != null){
            array_push($personales,['doctor' => $doc->nombre]);
        }
        if($anestesio != null){
            array_push($personales,['anestesiologo'=>$anestesio->nombre]);
        }
        if($prime != null){
            array_push($personales,['primero'=>$prime->nombre]);
        }
        if($second != null){
            array_push($personales,['segundo'=>$second->nombre]);
        }
        if($instru != null){
            array_push($personales,['instrumentalista'=>$instru->nombre]);
        }
        if($circu != null){
            array_push($personales,['circular'=>$circu->nombre]);
        } */
        $operacion_id = $op->id;
       /*  return $personales; */
     }else{
         $operacion_id = 0;
     }
    
     
     

     
      return view('estacion.cargadatos_operacion',compact('doctor','anestesista','primer','segundo','instrumentista','circular','operacion_id','medicos','habitacionpaciente','paciente','operacion','operacionnombre'));
    }

    public function Personaloperacion(Request $request){
        /* return $request; */
       if($request->operacion_id == 0){
           
           
           if($request->doctorselect != null){               
               $doctor = $request->doctorselect;
           }else{
               if($request->doctorinput != null){ 
                                    
                   $personal =Personal::create([
                       'nombre' => $request->doctorinput
                   ]);
                   $doctor = $personal->id;
               }else{
                   $doctor = '';
               }
           }
           if($request->anestesiologoselect != null){
            $anestesiologo = $request->anestesiologoselect;
        }else{
            if($request->anestesiologoinput != null){
                $personal =Personal::create([
                    'nombre' => $request->doctorinput
                ]);
                $anestesiologo = $personal->id;
            }else{
                $anestesiologo = '';
            }
        }
        if($request->primerselect != null){
            $primer = $request->primerselect;
        }else{
           /* return $request->primerinput; */
            if($request->primerinput != null){
                $personal =Personal::create([
                    'nombre' => $request->primerinput
                ]);
                $primer = $personal->id;
            }else{
                $primer = '';
            }
        }
        if($request->segundoselect != null){
            $segundo = $request->segundoselect;
        }else{
            if($request->segundoinput != null){
                $personal =Personal::create([
                    'nombre' => $request->segundoinput
                ]);
                $segundo = $personal->id;
            }else{
                $segundo = '';
            }
        }
        if($request->instrumentalistaselect != null){
            $instrumentalista = $request->instrumentalistaselect;
           /* return $instrumentalista; */
        }else{
            if($request->instrumentalistainput != null){
                $personal =Personal::create([
                    'nombre' => $request->instrumentalistainput
                ]);
                $instrumentalista = $personal->id;
            }else{
                $instrumentalista = '';
            }
        }
        if($request->circularselect != null){
            $circular = $request->circularselect;
        }else{
            if($request->circularinput != null){
                $personal =Personal::create([
                    'nombre' => $request->circularinput
                ]);
                $circular = $personal->id;
            }else{
                $circular = '';
            }
        }
        
       /*  return $request->paciente_id; */
        $operacion = Datos_operacion::create([
            'paciente_id' => $request->paciente_id,
            'habitacion_id' => $request->habitacion_id,
            'doctor_id' => $doctor,
            'anestesiologo_id' => $anestesiologo,
            'primer_id' => $primer,
            'segundo_id' => $segundo,
            'instrumentalista' => $instrumentalista,
            'circular_id' => $circular 
        ]);
        /* return $operacion; */
        $operacion_id = $operacion->id;
       }else{
           /* return 'wut'; */
        $operacion =Datos_operacion::find($request->operacion_id);
        
        $operacion_id = $operacion->id;
        if($request->doctorselect != null){
           /*  return 'dfvdfv'; */
            $doctor = $request->doctorselect;
            $operacion->update([
                'doctor_id' => $doctor,
            ]);
        }else{
            /* return 'here2'; */
            if($request->doctorinput != null){                  
                $personal =Personal::create([
                    'nombre' => $request->doctorinput
                ]);
               /*  return $doctor; */
                $doctor = $personal->id;
                $operacion->update([
                    'doctor_id' => $doctor,
                ]);
            }
        }
        if($request->anestesiologoselect != null){
         $anestesiologo = $request->anestesiologoselect;
         $operacion->update([
            'anestesiologo_id' => $anestesiologo,
        ]);
     }else{
         if($request->anestesiologoinput != null){
             $personal =Personal::create([
                 'nombre' => $request->doctorinput
             ]);
             $anestesiologo = $personal->id;
             $operacion->update([
                'anestesiologo' => $anestesiologo,
            ]);
         }
     }
     if($request->primerselect != null){
         $primer = $request->primerselect;
         $operacion->update([
            'doctor_id' => $primer,
        ]);
     }else{
         if($request->primerinput != null){
             $personal =Personal::create([
                 'nombre' => $request->primnerinput
             ]);
             $primer = $personal->id;
             $operacion->update([
                'primer_id' => $primer,
            ]);
         }
     }
     if($request->segundoselect != null){
         $segundo = $request->segundoselect;
         $operacion->update([
            'segundo_id' => $segundo,
        ]);
     }else{
         if($request->segundoinput != null){
             $personal =Personal::create([
                 'nombre' => $request->segundoinput
             ]);
             $segundo = $personal->id;
             $operacion->update([
                'segundo_id' => $segundo,
            ]);
         }
     }
     if($request->instrumentalistaselect != null){
         $instrumentalista = $request->instrumentalistaselect;
         $operacion->update([
            'instrumentalista' => $instrumentalista,
        ]);
     }else{
         if($request->instrumentalistainput != null){
             $personal =Personal::create([
                 'nombre' => $request->instrumentalistainput
             ]);
             $instrumentalista = $personal->id;
             $operacion->update([
                'instrumentalista' => $instrumentalista,
            ]);
         }
     }
     if($request->circularselect != null){
         $circular = $request->circularselect;
         $operacion->update([
            'circular_id' => $circular,
        ]);
     }else{
         if($request->circularinput != null){
             $personal =Personal::create([
                 'nombre' => $request->circularinput
             ]);
             $circular = $personal->id;
             $operacion->update([
                'circular_id' => $circular,
            ]);
         }
     }
     
       }

       $habitacionpaciente = habitaciones_areas::find($request->habitacion_id);
      
      $paciente = Paciente::where('habitacion_id',$habitacionpaciente->id)
        ->orderBy('created_at', 'desc')->first();
    
     if($paciente != null){
        
        $operacion = Procedimiento_estado::where(['paciente_id'=>$paciente->id,'estado'=>'pendiente'])
        ->orderBy('created_at', 'desc')->first();
        /* return $operacion; */
       
        $operacionnombre = Procedimiento_tipo::find($operacion->tipoprocedimiento_id);
     }else{
        $operacion = 'no asignado';
        /* return $operacion; */
        $operacionnombre = 'no asignado';
     }
$operating = Datos_operacion::find($operacion_id);

     $medicos = Personal::get();


     if(isset($doctor)){
        $doc = Personal::find($doctor);
     }else{
        $doc = Personal::find($operating->doctor_id);
     }
     if(isset($anestesiologo)){
        $anestesio = Personal::find($anestesiologo);
     }else{
        $anestesio = Personal::find($operating->anestesiologo_id);
     }
     if(isset($primer)){
        $prime = Personal::find($primer);
     }else{
        $prime = Personal::find($operating->primer_id);
     }
     if(isset($segundo)){
        $second = Personal::find($segundo);
     }else{
        $second = Personal::find($operating->segundo_id);
     }
     if(isset($instrumentalista)){
        $instru = Personal::find($instrumentalista);
     }else{
        $instru = Personal::find($operating->instrumentalista);
     }
     if(isset($circular)){
        $circu = Personal::find($circular);
     }else{
        $circu = Personal::find($operating->circular_id);
     }

   /*  $doc = Personal::find($doctor);
    $anestesio = Personal::find($anestesiologo);
    $prime = Personal::find($primer);
    $second = Personal::find($segundo);
    $instru = Personal::find($instrumentalista); */
   

  
    if($doc != null){
        $doctor = $doc->nombre;
    }else{
        $doctor = 'no asignado';
    }
    if($anestesio != null){
        $anestesista = $anestesio->nombre;
    }else{
        $anestesista = 'no asignado';
    }
    if($prime != null){
        $primer = $prime->nombre;
    }else{
        $primer = 'no asignado';
    }
    if($second != null){
        $segundo = $second->nombre;
    }else{
        $segundo = 'no asignado';
    }
    if($instru != null){
        $instrumentista = $instru->nombre;
    }else{
        $instrumentalista = 'no asignado';
    }
    if($circu != null){
        $circular = $circu->nombre;
    }else{
        $circular = 'no asignado';
    }

     
      return view('estacion.cargadatos_operacion',compact('doctor','anestesista','primer','segundo','instrumentista','circular','operacion_id','medicos','habitacionpaciente','paciente','operacion','operacionnombre'));

    }

    function llegopaciente(Request $request){
        /* return $request; */
        $paciente = Paciente::find($request->id);
        $paciente->update([
            'estado_traslado' => 'en habitacion'
        ]);
        $hitorial = Histortial_habitaciones::create([
            'paciente_id' =>$request->id,
            'habitacion_id' => $request->habitacion_id,
        ]);
              
        return redirect()->route('estacion.esperapaciente', ['id' => $request->habitacion_id]);
    }
    function startop(Request $request){
        
       
      
       $operacion = Datos_operacion::find($request->operacionid);
      $doctor = Personal::find($operacion->doctor_id);
      $anestesiologo = Personal::find($operacion->anestesiologo_id);
      $primer = Personal::find($operacion->primer_id);
      $segundo = Personal::find($operacion->segundo_id);
      $instrumentalista = Personal::find($operacion->instrumentalista);
      $circular = Personal::find($operacion->circular_id);
      $procedimiento = Procedimiento_tipo::find($request->opname);
      /* return view('estacion.quirofano',compact('paciente,operacion,doctor,anestesiologo,primer,segundo,instrumentalista,circular,procedimiento')); */ 
      $paciente = Paciente::find($request->pacienteid);
      /* return $paciente; */
      $habitacion = habitaciones_areas::leftJoin('areas', 'areas.id', 'habitaciones_areas.area_id')->find($paciente->habitacion_id);

      if($habitacion->nombre_area == 'Quirofano'){
      $operacion = Procedimiento_estado::where(['paciente_id'=>$request->pacienteid,'estado'=>'pendiente'])
      ->orderBy('created_at', 'desc')->first();
      $operacionnombre = Procedimiento_tipo::find($operacion->tipoprocedimiento_id);

      //$paciente->update(['estado_traslado' => 'en habitacion']);
      /* $doctor=Doctor::find(Auth::user()->doctor_id); */
      

      
          return view('estacion.quirofano', compact('operacion','doctor','anestesiologo','primer','segundo','instrumentalista','circular','procedimiento','paciente','operacion','operacionnombre','habitacion')); 

      } else {
          return $habitacion;
      }
/* 
      $procedimiento = Procedimientos   */ 
    }

    function endoperation(Request $request){
        $suma = 0;

        
        $agujas = inventario::find(11);
        $agujaprecio = $agujas->precioiva;
       
        $suma = $suma + ($agujaprecio * $request->agujas);
        
        $compresas = inventario :: find(9);
        $compresaprecio = $compresas->precioiva;
       
        $suma = $suma + ($compresaprecio * $request->compresas);
        
        $torundas = inventario::find(10);
        $torundasprecio = $torundas->precioiva;
       
        $suma = $suma + ($torundasprecio * $request->torundas);
        
        $gasas = inventario::find(12);
        $gasasprecio = $gasas->precioiva;
       
        $suma = $suma + ($gasasprecio * $request->gasas);
        
        $mechas = inventario::find(13);
        $mechasprecio = $mechas->precioiva;
       
        $suma = $suma + ($mechasprecio * $request->mechas);
        
        
        $personal = Datos_operacion::find($request->personal_id);
        $paciente = Paciente::find($personal->paciente_id);
       
        
        $venta = venta::create([
            'paciente_id' => $paciente->id,
            'total_venta' => $suma,
            'clinica_id' => 1
        ]);

            $salidaagujas = salida_inventario::create([
                'venta_id' => $venta->id,
                'medicamento_id' => $agujas->id,
                'cantidad' => $request->agujas,
            ]);
            $salidatorundas = salida_inventario::create([
                'venta_id' => $venta->id,
                'medicamento_id' => $torundas->id,
                'cantidad' => $request->torundas,
            ]);
            $salidagasas = salida_inventario::create([
                'venta_id' => $venta->id,
                'medicamento_id' => $gasas->id,
                'cantidad' => $request->gasas,
            ]);
            $salidamechas = salida_inventario::create([
                'venta_id' => $venta->id,
                'medicamento_id' => $mechas->id,
                'cantidad' => $request->mechas,
            ]);
            $salidacompresas = salida_inventario::create([
                'venta_id' => $venta->id,
                'medicamento_id' => $compresas->id,
                'cantidad' => $request->compresas,
            ]);

            $agujasstock =inventario::where('id',$agujas->id)->update([
                'stock' => $agujas->stock - $request->agujas
            ]);
            $mechas =inventario::where('id',$mechas->id)->update([
                'stock' => $mechas->stock - $request->mechas
            ]);
            $torundas =inventario::where('id',$torundas->id)->update([
                'stock' => $torundas->stock - $request->torundas
            ]);
            $gasas =inventario::where('id',$gasas->id)->update([
                'stock' => $gasas->stock - $request->gasas
            ]);
            $compresas =inventario::where('id',$compresas->id)->update([
                'stock' => $compresas->stock - $request->compresas
            ]);

            return redirect()->route('pacientes.show', $paciente->id);

    }
}