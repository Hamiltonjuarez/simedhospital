<?php

namespace App\Http\Controllers;
use App\Receta;
use App\Consulta;
use Auth;
use App\Clinica_doctor;
use PDF;
use App\Plantillas_receta;
use App\Doctor;
use App\Paciente;
use App\HistorialClinico;
use App\DoctorEspeciality;
use App\inventario;
use App\Paquetes;
use App\Medicamentospaquetes;
use Illuminate\Http\Request;

class RecetaController extends Controller
{

    public function nuevaReceta()
    {
        $doctor = Auth::user()->doctor_id;

        $recetas=Receta::where('doctor_id',$doctor)
            ->orderBy('created_at','DESC')->paginate(10);

        $pacientes=Paciente::select('id','nombre','apellidos')
            ->where('doctor_id',$doctor)
            ->orderBy('nombre','ASC')
            ->get();

        $medicamentos = inventario::where('doctor_id',$doctor)->get(); 
        $paquetes = Paquetes::where('doctor_id',$doctor)->get();   
       
        return view('Recetas.listadoRecetas', compact('pacientes','recetas','medicamentos','paquetes'));
    }


    public function createReceta(Request $request)
    {
        
        $doctor = Doctor::where('id',Auth::user()->doctor_id)->pluck('id')->first();

        if($request->paciente_id==null)
        {
            $receta=Receta::create([
                'tituloReceta' =>$request->tituloReceta,
                'descripcionReceta' => $request->descripcionReceta,
                'plantilla_id' => $request->plantilla_id,
                'doctor_id'=>$doctor,
            ]);

            return back();
        }else{
            $receta=Receta::create($request->all());

            return back();
        }

    }

    public function imprimirReceta($id)
    {
        
        $receta=Receta::find($id);
        $template=Plantillas_receta::find($receta->plantilla_id);
        $doctor = Doctor::where('id',Auth::user()->doctor_id)->first();
        $especialidad=DoctorEspeciality::leftJoin('specialities','specialities.id','doctor_especialities.especialidad_id')
            ->where('doctor_especialities.doctor_id',$doctor->id)
            ->pluck('specialty_name')
            ->first();
        $doctor->specialty_name=$especialidad;
        $clinica = Clinica_doctor::leftJoin('clinicas','clinicas.id','clinica_doctors.clinica_id')
            ->where('clinica_doctors.doctor_id',$doctor->id)->select('clinicas.*')->first();

        if($receta->paciente_id!=null)
        {
            
            $paciente=Paciente::find($receta->paciente_id);
            /* return $paciente; */
            $pdf= PDF::loadView('Recetas.plantillasReceta.'.$template->plantilla, [
                'receta' => $receta,
                'doctor' => $doctor,
                'clinica' => $clinica,
                'paciente' => $paciente,
            ])->setPaper('letter', 'portrait');
            $fileName=$receta->tituloReceta;
            return $pdf->stream($fileName.'.pdf');
        }else{           
            $pdf= PDF::loadView('Recetas.plantillasReceta.'.$template->plantilla, [
                'receta' => $receta,
                'doctor' => $doctor,
                'clinica' => $clinica,
            ])->setPaper('letter', 'portrait');
            $fileName=$receta->tituloReceta;
            return $pdf->stream($fileName.'.pdf');
        }

    }

    public function recetaPaciente(Request $request)
    {
       
        $doctor = Doctor::where('id',Auth::user()->doctor_id)->first();
        $especialidad=DoctorEspeciality::leftJoin('specialities','specialities.id','doctor_especialities.especialidad_id')
            ->where('doctor_especialities.doctor_id',$doctor->id)
            ->pluck('specialty_name')
            ->first();
        $doctor->specialty_name=$especialidad;
        $clinica = Clinica_doctor::leftJoin('clinicas','clinicas.id','clinica_doctors.clinica_id')
            ->where('clinica_doctors.doctor_id',$doctor->id)->select('clinicas.*')->first();

        $receta=Receta::create([
            'paciente_id' => $request->paciente_id,
            'tituloReceta' =>$request->titulo,
            'descripcionReceta' => $request->receta,
            'plantilla_id' => $request->plantilla_id,
            'doctor_id' => $doctor->id,
        ]);
        $template=Plantillas_receta::find($request->plantilla_id);
        $paciente=Paciente::find($request->paciente_id);

        $doctor->especialidad = $especialidad;

        $pdf= PDF::loadView('Recetas.plantillasReceta.'.$template->plantilla, [
            'paciente' => $paciente,
            'receta' => $receta,
            'doctor' => $doctor,
            'clinica' => $clinica,
        ])->setPaper('letter', 'portrait');
        $fileName=$receta->tituloReceta;

        return $pdf->stream($fileName.'.pdf');
    }

    public function recetaPrinter($id)
    {

        $consulta=Consulta::find($id);
        if(Receta::where('consulta_id',$consulta->id)->exists())
        {
            $receta=Receta::where('consulta_id',$consulta->id)->first();
            $paciente=Paciente::find($receta->paciente_id);
            $doctor = Doctor::where('user_id',Auth::user()->doctor_id)->first();
            $pdf= PDF::loadView('pacientes.Consultas.recetaMedica', [
                'consulta' => $consulta,
                'receta' => $receta,
                'doctor' => $doctor,
                'paciente' => $paciente,
            ])->setPaper('letter', 'portrait');
            $fileName=$consulta->tituloConsulta;
            return $pdf->stream($fileName.'.pdf');

            $paciente=HistorialClinico::where('consulta_id',$consulta->id)->first();
            return redirect()->route('crearReceta', ['consulta_id' => $consulta->id, 'paciente_id' => $paciente->paciente_id]);

        }

    }

    public function destroy($id)
    {
        $receta=Receta::find($id);
        $receta->delete();
        return back()->with('info', 'La receta se eliminó correctamente');
    }

    public function retornoperfil($user)
    {
        return redirect()->route('pacientes.show', $user)->with('info', 'receta exito');
    }

    public function edit($id)
    {
        $receta = Receta::find($id);
        if(!$receta->paciente_id)
        {
            return view('Recetas.edit', compact('receta'));
        }else{
            $paciente = Paciente::find($receta->paciente_id);
            return view('Recetas.edit', compact('receta','paciente'));
        }
    }

    public function update(Request $request, $id)
    {
        $receta = Receta::find($id);
        $receta->update($request->all());
        return redirect()->route('pacientes.show', $receta->paciente_id)->with('La receta se editó con éxito');
    }

    public function printrecetareceta(Request $request, $id)
    {
        $receta = Receta::find($id);
        $receta->update($request->all());

        $plantilla=Plantillas_receta::find($receta->plantilla_id);
        $doctor = Doctor::find($receta->doctor_id);

        $paciente=Paciente::find($receta->paciente_id);
        $consulta=Consulta::find($receta->consulta_id);

        $especialidad=DoctorEspeciality::leftJoin('specialities','specialities.id','doctor_especialities.especialidad_id')
        ->where('doctor_especialities.doctor_id',$doctor->id)
        ->pluck('specialty_name')
        ->first();
        $doctor->specialty_name=$especialidad;
        $clinica = Clinica_doctor::leftJoin('clinicas','clinicas.id','clinica_doctors.clinica_id')
            ->where('clinica_doctors.doctor_id',$doctor->id)->select('clinicas.*')->first();
            

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

    public function paqueteseleccionado(Request $request){
        $medicamentospaquetes = inventario::Leftjoin('medicamentospaquetes','inventarios.id','medicamentospaquetes.medicamento_id')
        ->where('medicamentospaquetes.combo_id',$request->idd)->get();       
       return response()->Json([
            $medicamentospaquetes
        ]);
    }


}
