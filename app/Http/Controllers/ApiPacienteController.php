<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paciente;
use Auth;

class ApiPacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json('hola mundo');
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
        $cadena = explode('||',$request->dui);
        $uno = str_replace('/','-',$cadena[9]);
        $edad = \Carbon\Carbon::parse($uno)->format('Y-m-d');
        
        $paciente = Paciente::create([
            'dui' => $cadena[0],
            'nombre' => $cadena[2],
            'apellidos' => $cadena[1],
            'sexo' => $cadena[8],
            'nacimiento' => $edad,
            'doctor_id' => Auth::user()->doctor_id
        ]);

        return response()->json([
            'dui' => $cadena[0],
            'nombre' => $cadena[2],
            'apellidos' => $cadena[1],
            'sexo' => $cadena[8],
            'nacimiento' => $edad,
            'doctor_id' => Auth::user()->doctor_id
            ]  );
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

}
