<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Paciente;
use App\Procedimiento;
use App\Biopsia;
use App\HistorialClinico;
use App\Consulta;
use App\Mix;
use App\Clinica;
use App\Procedimiento_tipo;
use PDF;
use App\Doctor;
use App\Speciality;
use App\DoctorEspeciality;
use Auth;
use Illuminate\Support\Facades\Storage;
use App\DoctorProcedimientos;
use App\PlantillaProcedimiento;
use App\InfoProcedimiento;

class ProcedimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pdf=PDF::loadView('procedimientos.plantilla.1')->setPaper('letter');
        return $pdf->stream('reporte.pdf');
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
        //
        
        ///return view('reportes/dropzone', compact('id', 'model'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $historial=HistorialClinico::find($id);

        $doctor=Doctor::find($historial->doctor_id);
        $clinica = Clinica::join('clinica_doctors As c','clinicas.id','c.clinica_id')
            ->select('clinicas.*')->where('c.doctor_id',$doctor->id)->first();


        $pacientes=Paciente::find($historial->paciente_id);
            $edad=Mix::edad($pacientes->nacimiento);

        $procedimiento=Procedimiento::find($historial->procedimiento_id);
            $fecha = Mix::fecha($procedimiento->created_at);
            $des=explode('=', $procedimiento->descripcion);
            $tipo=Procedimiento_tipo::find($procedimiento->procedimiento_tipo_id);
            
        if(InfoProcedimiento::where('procedimiento_id',$procedimiento->id)->exists()){
            $infoproc = InfoProcedimiento::where('procedimiento_id',$procedimiento->id)->first();
        }else{
            $infoproc = '';
        }

        $plantilla = PlantillaProcedimiento::find($procedimiento->plantilla);
        /* return view('pacientes.pdfultrasonografia', compact('pacientes')); */
        $dir = public_path().'/capturas/'.$historial->procedimiento_id.'/';
        $archivos = scandir($dir); //obtenemos todos los nombres de los ficheros
        foreach($archivos as $file){
            if(is_file($dir.$file)){
                $img[]=$file;
            }
        }
        
        $especialidad = DoctorEspeciality::select('specialities.specialty_name')->join('specialities','specialities.id','doctor_especialities.especialidad_id')->where('doctor_id',$doctor->id)->first();
        
        $doc = explode(' ', $doctor->tituloDoctor);
        $pdf = PDF::loadView('procedimientos.plantilla.'.$plantilla->plantillaNombre, [
            'tipo' => $tipo,
            'historial' => $historial,
            'pacientes' => $pacientes,
            'clinica' => $clinica,
            'procedimiento' => $procedimiento,
            'doctor' => $doctor,
            'edad' => $edad,
            'fecha' => $fecha,
            'des' => $des,
            'img' => $img,
            'infoproc' => $infoproc,
            'especialidad' => $especialidad,
            'doc' => $doc,
            ])->setPaper('letter');
        $fileName=$pacientes->nombre.' '.$pacientes->apellidos;
        return $pdf->stream($fileName.'.pdf');


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->hasPermission('edit_procedimientos')){
            $historial=HistorialClinico::find($id);

            $doctor=Doctor::find($historial->doctor_id);

            $paciente=Paciente::find($historial->paciente_id);
                $paciente['edad']=Mix::edad($paciente->nacimiento);

            $procedimiento=Procedimiento::leftJoin('procedimiento_tipos as t', 'procedimientos.procedimiento_tipo_id', 't.id')
            ->find($historial->procedimiento_id);
            
            if(InfoProcedimiento::where('procedimiento_id',$historial->procedimiento_id)->exists()){
                $infoproc = InfoProcedimiento::where('procedimiento_id',$historial->procedimiento_id)->first();
            }else{
                $infoproc = '';
            }
            

            $dir = public_path().'/capturas/'.$historial->procedimiento_id.'/';
            $archivos = scandir($dir); //obtenemos todos los nombres de los ficheros
            foreach($archivos as $file){
                if(is_file($dir.$file)){
                    $img[]=$file;
                }
            }
            
            if(Biopsia::where('procedimiento_id', $procedimiento->id)->exists()){
                $procedimiento['precioBipsia']=Biopsia::where('procedimiento_id', $procedimiento->id)->first()->precioBiopsia;
            }
                $des=explode('=', $procedimiento->descripcion);
                //$tipo=Procedimiento_tipo::find($procedimiento->procedimiento_tipo_id);
            
            return view('procedimientos.editar', compact('historial', 'doctor', 'des', 'procedimiento', 'paciente', 'img','infoproc'));
        }else{
            abort(403);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $historial=HistorialClinico::find($id);
        $procedimiento=Procedimiento::find($historial->procedimiento_id);

        $dir = public_path().'/capturas/'.$historial->procedimiento_id.'/';
        $archivos = scandir($dir); //obtenemos todos los nombres de los ficheros
        foreach($archivos as $file){
            if(is_file($dir.$file)){
                unlink($dir.$file); //elimino el fichero
            }
        }

        if ($procedimiento->delete()){
            return back()->with('info', 'se elimino el procedimiento');
        } else {
            return back()->with('info', 'no se pudo eliminar el procedimiento');
        }
        
    }

    public function tipo($id)
    {
        if (Auth::user()->hasPermission('tipo_procedimiento')){
            $doctor = Doctor::where('user_id',Auth::user()->id)->pluck('id')->first();
            $procedimientos=DoctorProcedimientos::where('doctor_id', '=', $doctor)
            ->leftJoin('procedimiento_tipos', 'procedimiento_tipos.id', 'doctor_procedimientos.procedimiento_tipo_id')
            ->select('procedimiento_tipos.procedimiento_nombre', 'procedimiento_tipos.id')->get();
            return view('procedimientos.tipo', compact('procedimientos', 'id'));
        }else{
            abort(403);
        }
        
    }


    public function plantillas($tipo, $id)
    {
        if(Auth::user()->hasPermission('templates_procedimientos')){
            $procedimiento=Procedimiento_tipo::find($tipo);
            $doctor = Doctor::where('user_id',Auth::user()->id)->pluck('id')->first();
            $plantillas = PlantillaProcedimiento::where('doctor_id', '=', $doctor)->get();
           /*  return $plantillas;   */          
            return view('procedimientos.plantillas', compact('procedimiento', 'id', 'plantillas'));
        }else{
            abort(403);
        }
    }


    public function generar($tipo, $plantilla, $id)
    {
        
        $doctor = Doctor::where('user_id',Auth::user()->id)->pluck('id')->first();
        
        $historial=Procedimiento::leftJoin('historial_clinicos As hc', 'procedimientos.id', 'hc.procedimiento_id')
        ->where([['procedimientos.procedimiento_tipo_id', $tipo], ['hc.doctor_id', $doctor]])->orderBy('hc.created_at', 'DESC')->first();

        
        //$contenido=Procedimiento::find($historial->procedimiento_id);
        $cod = array();
        if(isset($historial)){
            $cod = explode('=', $historial->descripcion);
        }

        $procedimiento=Procedimiento_tipo::find($tipo);
        $paciente=Paciente::find($id);
        $paciente['edad']=Mix::edad($paciente->nacimiento);


        return view('procedimientos.generar', compact('procedimiento', 'plantilla', 'paciente', 'historial', 'cod'));
    }

    public function dropzone(Request $request, $tipo, $plantilla, $id)
    {
        $doctor=Doctor::where('user_id',Auth::user()->id)->pluck('id')->first();
        if ($request->hasFile('file'))
        {
            $files=$request->file('file');
            if (count($files)<=9){

                //$serach=Procedimiento::where();

                $procedimiento=Procedimiento::create([
                    'procedimiento_tipo_id' => $tipo,
                    'plantilla' => $plantilla,
                    'precioProcedimiento' => $request->precio,
                    'contenido' => $request->contenido,
                    'descripcion' => $request->text1.'='.$request->text2.'='.$request->text3.'='.$request->text4.'='.$request->text5.'='.$request->text6.'='.$request->text7.'='.$request->text8.'='.$request->text9
                ]);
                
                if(Auth::user()->doctor_id == 12 && $plantilla == 84){
                   $infoproc = InfoProcedimiento::create([
                        'expediente' => $request->expediente,
                        'procedencia' => $request->procedencia,
                        'diagnostico_clinico' => $request->diagnostico_clinico,
                        'intervencion' => $request->intervencion,
                        'anestesiologo' => $request->anestesiologo,
                        'anestesia' => $request->anestesia,
                        'equipo' => $request->equipo,
                        'procedimiento_id' => $procedimiento->id,
                    ]);
                }
                

                if ($procedimiento){
                    $idRep=$procedimiento->id;

                    if ($request->preciob>0){
                        Biopsia::create([
                            'precioBiopsia' => $request->preciob,
                            'procedimiento_id' => $idRep,
                        ]);
                    }
                    
                    $historial=HistorialClinico::create([
                        'paciente_id' => $id,
                        'doctor_id' => $doctor,
                        'procedimiento_id' => $idRep
                    ]);
                    $dir = public_path().'/capturas/'.$idRep.'/';
                    foreach ($files as $key => $file) {
                        $file->move($dir, 'capture'.$key.'.jpg');
                    }
                    return $historial->id;
                } else {
                    return 'error';
                }
            }   
            
        }
        

    }

    public function dropzoneEdit(Request $request, $id)
    {
        $historial=HistorialClinico::find($id);

        $procedimiento=Procedimiento::find($historial->procedimiento_id)->update(
            [
                'precioProcedimiento' => $request->precio,
                'contenido' => $request->contenido,
                'descripcion' => $request->text1.'='.$request->text2.'='.$request->text3.'='.$request->text4.'='.$request->text5.'='.$request->text6.'='.$request->text7.'='.$request->text8.'='.$request->text9
            ]);
        $proc = Procedimiento::find($historial->procedimiento_id);
        
         if(Auth::user()->doctor_id == 12 && $proc->plantilla == 84){
           $infoproc = InfoProcedimiento::where('procedimiento_id',$proc->id)->update([
                'expediente' => $request->expediente,
                'procedencia' => $request->procedencia,
                'diagnostico_clinico' => $request->diagnostico_clinico,
                'intervencion' => $request->intervencion,
                'anestesiologo' => $request->anestesiologo,
                'anestesia' => $request->anestesia,
                'equipo' => $request->equipo,
                'procedimiento_id' => $proc->id,
            ]);
        }

        
        if (Biopsia::where('procedimiento_id', $historial->procedimiento_id)->exists()){
            $biopsia = Biopsia::where('procedimiento_id', $historial->procedimiento_id)->first();
            if ($request->preciob>0){
                $biopsia->update([
                    'precioBiopsia'=> $request->preciob
                ]);
            } else {
                $biopsia->delete();
            }
        } else {
            if ($request->preciob>0){
                Biopsia::create([
                    'precioBiopsia'=> $request->preciob,
                    'procedimiento_id' => $historial->procedimiento_id
                ]);
            }
        }

        if ($request->hasFile('file'))
        {
            $files=$request->file('file');
            if (count($files)>=4){

                $dir = public_path().'/capturas/'.$historial->procedimiento_id.'/';
                $archivos = scandir($dir); //obtenemos todos los nombres de los ficheros
                foreach($archivos as $file){
                    if(is_file($dir.$file)){
                        unlink($dir.$file); //elimino el fichero
                    }
                }

                foreach ($files as $key => $file) {
                    $file->move($dir, date('YmdHis').$key.'.jpg');
                }
//                return $request->user()->doctor_id.'doctor'.$request->hallazgos.'/'.$request->diagnostico;
            }
        }

        return $id;        

    }

    
}
