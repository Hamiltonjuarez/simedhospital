<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paciente;
use Auth;
use App\Anexo;
use App\Doctor;
use App\Clinica_doctor;
use App\Clinica;
use App\HistorialClinico;
use PDF;
use Carbon\Carbon;

class AnexosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pacientes = Paciente::select('id','nombre','apellidos')->where('doctor_id', Auth::user()->doctor_id)->orderBy('created_at','DESC')->paginate(25);
        return view('Anexos.index', compact('pacientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->tipo == 'alta')
        {
            if($request->estado_alta=='otro')
            {
                $anexoalta = Anexo::create([
                    'tipo' => $request->tipo,
                    'diagnostico' => $request->diagnostico,
                    'tratamiento' => $request->tratamiento,
                    'estado_alta' => $request->otroestado,
                    'medicamentos_id' => $request->medicamento_id,
                    'agregados' => $request->agregados,
                    'paciente_id' => $request->paciente_id,
                    'doctor_id' => Auth::user()->doctor_id,
                ]);
                $historial = HistorialClinico::create([
                    'doctor_id' => Auth::user()->doctor_id,
                    'paciente_id' => $request->paciente_id,
                    'anexo_id' => $anexoalta->id,
                ]);
            }else{
                $anexoalta = Anexo::create([
                    'tipo' => $request->tipo,
                    'diagnostico' => $request->diagnostico,
                    'tratamiento' => $request->tratamiento,
                    'estado_alta' => $request->estado_alta,
                    'medicamentos_id' => $request->medicamento_id,
                    'agregados' => $request->agregados,
                    'paciente_id' => $request->paciente_id,
                    'doctor_id' => Auth::user()->doctor_id,
                ]);
                $historial = HistorialClinico::create([
                    'doctor_id' => Auth::user()->doctor_id,
                    'paciente_id' => $request->paciente_id,
                    'anexo_id' => $anexoalta->id,
                ]);
            }
            
            $doctor = Doctor::find(Auth::user()->doctor_id);
            $clinica = Clinica_doctor::join('clinicas', 'clinicas.id', 'clinica_doctors.clinica_id')
                ->select('clinicas.*')->where('clinica_doctors.doctor_id', $doctor->id)->first();

            $paciente = Paciente::find($anexoalta->paciente_id);

            $pdf= PDF::loadView('Anexos.anexospdf.alta', [
                'paciente' => $paciente,
                'anexo' => $anexoalta,
                'doctor' => $doctor,
                'clinica' => $clinica,
            ])->setPaper('letter', 'portrait');
            $fileName=$paciente->nombre;
            return $pdf->stream($fileName.'.pdf');

        }else if($request->tipo == 'incapacidad')
        {
            $desde = Carbon::parse($request->desde)->format('Y-m-d');
            $hasta = Carbon::parse($request->hasta)->format('Y-m-d');

            if($request->hospitalizado == 'si')
            {
                $ingresadodesde = Carbon::parse($request->ingresodesde)->format('Y-m-d');
                $ingresadohasta = Carbon::parse($request->ingresohasta)->format('Y-m-d');
                $incapacidad =  Anexo::create([
                    'tipo' => $request->tipo,
                    'diagnostico' => $request->diagnostico,
                    'agregados' => $request->agregados,
                    'doctor_id' => Auth::user()->doctor_id,
                    'paciente_id' => $request->paciente_id,
                    'ingresodesde' => $ingresadodesde,
                    'ingresohasta' => $ingresadohasta,
                    'desde' => $desde,
                    'hasta' => $hasta,
                ]);
                $historial = HistorialClinico::create([
                    'doctor_id' => Auth::user()->doctor_id,
                    'paciente_id' => $request->paciente_id,
                    'anexo_id' => $incapacidad->id,
                ]);
            }else if($request->hospitalizado == 'no'){
                $incapacidad =  Anexo::create([
                    'tipo' => $request->tipo,
                    'diagnostico' => $request->diagnostico,
                    'agregados' => $request->agregados,
                    'doctor_id' => Auth::user()->doctor_id,
                    'paciente_id' => $request->paciente_id,
                    'desde' => $desde,
                    'hasta' => $hasta,
                ]);
                $historial = HistorialClinico::create([
                    'doctor_id' => Auth::user()->doctor_id,
                    'paciente_id' => $request->paciente_id,
                    'anexo_id' => $incapacidad->id,
                ]);
            }

            $doctor = Doctor::find(Auth::user()->doctor_id);
            $clinica = Clinica_doctor::join('clinicas', 'clinicas.id', 'clinica_doctors.clinica_id')
                ->select('clinicas.*')->where('clinica_doctors.doctor_id', $doctor->id)->first();

            $paciente = Paciente::find($incapacidad->paciente_id);

            $pdf= PDF::loadView('Anexos.anexospdf.incapacidadpdf', [
                'paciente' => $paciente,
                'anexo' => $incapacidad,
                'doctor' => $doctor,
                'clinica' => $clinica,
            ])->setPaper('letter', 'portrait');
            $fileName=$paciente->nombre;
            return $pdf->stream($fileName.'.pdf');
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
        $anexo = Anexo::find($id);
        $doctor = Doctor::find(Auth::user()->doctor_id);
        $clinica = Clinica_doctor::join('clinicas', 'clinicas.id', 'clinica_doctors.clinica_id')
            ->select('clinicas.*')->where('clinica_doctors.doctor_id', $doctor->id)->first();

        $paciente = Paciente::find($anexo->paciente_id);

       if($anexo->tipo == 'alta')
       {
            $pdf= PDF::loadView('Anexos.anexospdf.alta', [
                'paciente' => $paciente,
                'anexo' => $anexo,
                'doctor' => $doctor,
                'clinica' => $clinica,
            ])->setPaper('letter', 'portrait');
            $fileName=$paciente->nombre;
            return $pdf->stream($fileName.'.pdf');
       }else if($anexo->tipo == 'incapacidad')
       {
        $pdf= PDF::loadView('Anexos.anexospdf.incapacidadpdf', [
            'paciente' => $paciente,
            'anexo' => $anexo,
            'doctor' => $doctor,
            'clinica' => $clinica,
        ])->setPaper('letter', 'portrait');
        $fileName=$paciente->nombre;
        return $pdf->stream($fileName.'.pdf');
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
        $anexo = Anexo::find($id);
        $paciente = Paciente::find($anexo->paciente_id);
        return view('Anexos.editarAnexo', compact('anexo','paciente'));
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
       $anexo = Anexo::findOrFail($id);
       $anexo->update($request->all());
       return redirect()->route('anexos.show', $anexo->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $anexo = Anexo::find($id);
        $historial = HistorialClinico::where('anexo_id',$anexo->id)->delete();
        $anexo->delete();
        return back()->with('info', 'El enexo se eliminó con éxito');
    }

    public function altapaciente($id, $tipo)
    {
        $paciente = Paciente::find($id);
        return view('Anexos.altaformpaciente', compact('paciente','tipo'));
    }

    public function pacientestore(Request $request)
    {
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
                    'doctor_id' => $request->doctor_id,
                    'estatura' => $request->estatura,
                    'peso' => $request->peso,
                    'presion' => $request->presion,
                    'teltrabajo' => $request->teltrabajo,
                    'celtrabajo' => $request->celtrabajo,
                    'asegurado' => $request->asegurado,
                    'companiaseguro' => $request->companiaseguro,
                    'nopoliza' => $request->nopoliza,
                    'nocarnet' => $request->nocarnet,
                ]);

                return response()->json([
                    'id' => $paciente->id,
                    'nombre' => $paciente->nombre.' '.$paciente->apellidos,
                ]);
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
                    'estatura' => $request->estatura,
                    'peso' => $request->peso,
                    'presion' => $request->presion,
                    'teltrabajo' => $request->teltrabajo,
                    'celtrabajo' => $request->celtrabajo,
                    'asegurado' => $request->asegurado,
                    'companiaseguro' => $request->companiaseguro,
                    'nopoliza' => $request->nopoliza,
                    'nocarnet' => $request->nocarnet,
                ]);

                return response()->json([
                    'id' => $paciente->id,
                    'nombre' => $paciente->nombre.' '.$paciente->apellidos,
                ]);
            }
        }
        else{
            $paciente=Paciente::create($request->all());
            return response()->json([
                'id' => $paciente->id,
                'nombre' => $paciente->nombre.' '.$paciente->apellidos,
            ]);
        }
    }
    function altahabitacion(Request $request){
       $paciente = Paciente::find( $request->paciente);
       $tipo = 'alta';

        return view('Anexos.altaformhabitacion', compact('paciente','tipo'));
    }

}
