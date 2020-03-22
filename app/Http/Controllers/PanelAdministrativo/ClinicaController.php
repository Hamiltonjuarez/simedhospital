<?php

namespace App\Http\Controllers\PanelAdministrativo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Clinica;
use App\Clinica_doctor;
use App\Doctor;

class ClinicaController extends Controller
{
    /* public function __construct()
    {
        $this->middleware('can:clinicas.index')->only('index');
        $this->middleware('can:clinicas.create')->only(['create','store']);
        $this->middleware('can:clinicas.edit')->only(['edit','update']);
        $this->middleware('can:clinicas.show')->only('show');
        $this->middleware('can:clinicas.destroy')->only('destroy');
        $this->middleware('can:clinicas.adddoctor')->only(['doctor', 'doctoradd']);
    } */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clinicas = Clinica::orderBy('created_at', 'DESC')->paginate(15);
        return view('panel.Clinicas.index', compact('clinicas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.Clinicas.nuevaClinica');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->doctor_id)
        {
            $clinica = Clinica::create($request->all());
            $doctorclinica = Clinica_doctor::create([
                'doctor_id' => $request->doctor_id,
                'clinica_id' => $clinica->id
            ]);
        }
        else{
            $clinica = new Clinica();
            $clinica->create($request->all());
        }
        return redirect()->route('clinicas.index')->with('info', 'se creo con exito la clinica');
    }

    public function doctor($id)
    {
        $clinica = Clinica::find($id);
        $doctores = Clinica_doctor::select('doctors.*')->leftJoin('doctors','clinica_doctors.doctor_id','doctors.id')
            ->where('clinica_doctors.clinica_id',$id)->get();

        $nodoctores = Doctor::get();
        return view('panel.Clinicas.doctor', compact('clinica', 'doctores', 'nodoctores'));
    }

    public function doctoradd(Request $request)
    {
        if(Clinica_doctor::where('doctor_id',$request->doctor_id)->exists())
        {
            return  back()->with('info', 'el doctor ya es parte de la clinica');
        }else{
            $clinicadoctor = Clinica_doctor::create($request->all());
            return back()->with('info', '¡El doctor ha sido añadido correctamente!');
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
        $clinica =  Clinica::find($id);
        return view('panel.Clinicas.show', compact('clinica'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clinica=Clinica::find($id);

        return view('panel.Clinicas.editclinica', compact('clinica'));
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
        $clinica=Clinica::find($id);
        $clinica->update($request->all());

        return back()->with('info','La información de la clínica se actualizó correctamente');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $clinica = Clinica::find($id);
       $clinica->delete();
       return redirect()->route('clinicas.index')->with('info', 'Se ha eliminado correctamente!');
    }

    public function doctorquitar($id)
    {
        $clinicadoctor = Clinica_doctor::where('doctor_id', $id)->delete();
        return  back()->with('info', 'el doctor ha sido removido de la clinica');
    }
}
