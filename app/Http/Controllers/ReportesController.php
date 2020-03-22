<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Paciente;
use App\Reporte;
use App\HistorialClinico;
use App\DoctorEspeciality;
use App\Consulta;
use App\Mix;
use PDF;
use App\Doctor;
use Auth;
use App\Clinica;
use App\Clinica_doctor;
use Illuminate\Support\Facades\Storage;

class ReportesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$files = Storage::files('avatars');
        //return view('reportes.dropzone');
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
        //

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
        //
    }

    public function generarReporteConsulta($id){

         $query=HistorialClinico::find($id);
        $consulta=Consulta::find($query->consulta_id);
        $paciente=Paciente::find($query->paciente_id);
        $doctor=Doctor::where('id',$paciente->doctor_id)->first();
        $query = Clinica_doctor::where('doctor_id',$doctor->id)->first();
        $clinica = Clinica::find($query->clinica_id);
        $especialidad=DoctorEspeciality::leftJoin('specialities','specialities.id','doctor_especialities.especialidad_id')->where('doctor_especialities.doctor_id',$doctor->id)->pluck('specialty_name')->first();
        $doctor->specialty_name=$especialidad;
        $pdf= PDF::loadView('reportes.consultaPdf', [
            'paciente' => $paciente,
            'consulta' => $consulta,
            'doctor' => $doctor,
            'clinica' => $clinica,
        ])->setPaper('a4', 'portrait');
        $fileName=$paciente->nombre.$paciente->apellidos;
        return $pdf->stream($fileName.'.pdf');
    }
}
