<?php

namespace App\Http\Controllers;

use App\Paciente;
use App\Consulta;
use App\HistorialClinico;
use App\Receta;
use App\Clinica_doctor;
use App\Doctor;
use Auth;
use App\Plantillas_receta;
use PDF;
use App\DoctorEspeciality;
use Illuminate\Http\Request;
use App\Speciality;

class ConsultasController extends Controller
{
    /* public function __construct()
    {
        $this->middleware('can:consultas.create')->only(['create','store']);
        $this->middleware('can:consultas.edit')->only(['edit','update']);
        $this->middleware('can:consultas.show')->only('show');
     
    } */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if(Auth::user()->hasPermission('create_consultas_proc'))
        {
            $paciente=Paciente::find($id);
            return view('pacientes.Consultas.nuevaConsulta', compact('paciente'));
        }else{
            abort(401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->hasPermission('create_consultas_proc')){
            
            $paciente=Paciente::find($request->paciente_id);
            $doctor=Auth::user()->doctor_id;

            if(isset($_POST['receta'])){
                    $consulta=Consulta::create([
                        'tituloConsulta' => $request->tituloConsulta,
                        'detalleConsulta' => $request->detalleConsulta,
                        'diagnostico' => $request->diagnostico,
                        'prescripcion' => $request->prescripcion,
                        'precioConsulta' => $request->precioConsulta,
                    ]);

                    HistorialClinico::create([
                        'paciente_id' => $request->paciente_id,
                        'consulta_id' => $consulta->id,
                        'plantilla_id' => $request->plantilla_id,
                        'doctor_id' =>$doctor,
                    ]);

                return redirect()->route('consulta.elegirplantilla', ['consulta' => $consulta->id, 'paciente' => $paciente->id, 'doctor' => $doctor]);
            }
            elseif(isset($_POST['guardar'])){
                $consulta=Consulta::create([
                    'tituloConsulta' => $request->tituloConsulta,
                    'detalleConsulta' => $request->detalleConsulta,
                    'diagnostico' => $request->diagnostico,
                    'prescripcion' => $request->prescripcion,
                    'precioConsulta' => $request->precioConsulta,
                ]);

                HistorialClinico::create([
                    'paciente_id' => $request->paciente_id,
                    'consulta_id' => $consulta->id,
                    'plantilla_id' => $request->plantilla_id,
                    'doctor_id' =>$doctor,
                ]);

                return redirect()->route('pacientes.show',['id' => $request->paciente_id]);
            }

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
       $paciente=Paciente::find($id);
       return view('pacientes.consultas.show',compact('paciente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->hasPermission('edit_consultas')){
            $consulta = Consulta::find($id);
            $paciente = HistorialClinico::where('consulta_id',$consulta->id)->pluck('paciente_id')->first();
            $consulta->paciente=$paciente;
            return view('pacientes.Consultas.consultaEdit', compact('consulta')); 
        }
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
        if(Auth::user()->hasPermission('edit_consultas')){
            $consulta = Consulta::find($id);
            $consulta->update($request->all());
            return redirect()->route('pacientes.show', ['id' => $request->paciente]);
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
       if(Auth::user()->hasPermission('delete_consultas')){
        $consulta=Consulta::find($id);
        $historial = HistorialClinico::where('consulta_id',$id)->delete();
        $consulta->delete();
        return back()->with('info', '¡La consulta ha sido eliminada!');
       }
    }

    public function chooseTemplate($consulta, $paciente, $doctor)
    {
        $plantillas=Plantillas_receta::where('doctor_id',$doctor)->orderBy('imagen', 'ASC')->get();
        return view('Recetas.choosetemplate', compact('plantillas','paciente','consulta'));
    }
    //receta ligada al paciente
    public function crearReceta($consulta, $paciente, $plantilla){
        $template = Plantillas_receta::find($plantilla);
        return view('pacientes.Consultas.nuevaReceta', compact('paciente','consulta','template'));
    }

    //esta receta va ligada a un paciente
    public function guardarReceta(Request $request)
    {
        $plantilla=Plantillas_receta::find($request->plantilla_id);
        $doctor = Doctor::find(Auth::user()->doctor_id);

        $receta=Receta::create([
            'paciente_id' => $request->paciente_id,
            'plantilla_id' => $request->plantilla_id,
            'consulta_id' => $request->consulta_id,
            'tituloReceta' => $request->titulo,
            'descripcionReceta' => $request->receta,
            'doctor_id' => $doctor->id,
            ]);

        return redirect()->route('pacientes.show', [$request->paciente_id]);

    }

    public function printrecetaconsulta(Request $request)
    {
        $plantilla=Plantillas_receta::find($request->plantilla_id);
        $doctor = Doctor::find(Auth::user()->doctor_id);
        
        $receta=Receta::create([
            'paciente_id' => $request->paciente_id,
            'plantilla_id' => $request->plantilla_id,
            'consulta_id' => $request->consulta_id,
            'tituloReceta' => $request->titulo,
            'descripcionReceta' => $request->receta,
            'doctor_id' => $doctor->id,
        ]);

        $especialidad=DoctorEspeciality::leftJoin('specialities','specialities.id','doctor_especialities.especialidad_id')
        ->where('doctor_especialities.doctor_id',$doctor->id)
        ->pluck('specialty_name')
        ->first();
        $doctor->specialty_name=$especialidad;
        $clinica = Clinica_doctor::leftJoin('clinicas','clinicas.id','clinica_doctors.clinica_id')
            ->where('clinica_doctors.doctor_id',$doctor->id)->select('clinicas.*')->first();
            
        $paciente=Paciente::find($receta->paciente_id);
        $consulta=Consulta::find($request->consulta_id);

        $pdf= PDF::loadView('Recetas.plantillasReceta.'.$plantilla->plantilla, [
            'consulta' => $consulta,
            'paciente' => $paciente,
            'receta' => $receta,
            'doctor' => $doctor,
            'clinica' => $clinica,
        ])->setPaper('letter', 'portrait');
        $fileName=$receta->tituloReceta;
        return $pdf->stream($fileName.'.pdf');
    }


}
