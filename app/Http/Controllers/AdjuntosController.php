<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Paciente;
use Illuminate\Support\Facades\Storage;
use Image;
use Auth;
use PDF;
use App\Doctor;
use App\AdjuntoPaciente;

class AdjuntosController extends Controller
{
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
        $carpeta = 'adjuntospaciente/paciente'.$request->paciente_id;
        if($request->file('file'))
        {
            $path = $request->file('file')->store($carpeta);
            $name = collect(explode('/', $path))->last();
            if($request->tipoarchivo == 'imagen'){
                $this->resize($path,$request->tipodispositivo);
            }
            
            $adjunto = AdjuntoPaciente::create([
                'paciente_id' => $request->paciente_id,
                'adjunto' => $carpeta.'/'.$name,
                'descripcion' => $request->descripcion,
            ]);
        }

        return back()->with('info','El adjunto se subio correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $adjunto = AdjuntoPaciente::find($id);
        return Storage::download($adjunto->adjunto);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $adjunto = AdjuntoPaciente::find($id);
        Storage::delete($adjunto->adjunto);
        $adjunto->delete();
        return back()->with('info','El archivo ha sido eliminado correctamente!');
    }

    public function print($id){
        $adjunto = AdjuntoPaciente::find($id);
        $paciente = Paciente::find($adjunto->paciente_id);
        $doctor = Doctor::find($paciente->doctor_id);

        $tipoarchivo = collect(explode('.',$adjunto->adjunto))->last();

        if($tipoarchivo != 'pdf'){
                $pdf = PDF::loadView('pacientes.Consultas.mostrarArchivo', [
                    'adjunto' => $adjunto,
                    'paciente' => $paciente,
                    'doctor' => $doctor         
                ])->setPaper('letter');
            $fileName=$paciente->nombre.' '.$paciente->apellidos;
            return $pdf->stream($fileName.'.pdf');
        }else{
            return Storage::response($adjunto->adjunto);
        }
    }

    public function resize($ruta, $tipo){
        $image = Image::make(Storage::get($ruta));

        $image->resize(1280, null, function($constraint){
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        if($tipo == 'movil'){
            $image->rotate(-90);
        }

        Storage::put($ruta, (string) $image->encode('png', 75));
    }
}
