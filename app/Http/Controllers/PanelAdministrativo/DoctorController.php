<?php

namespace App\Http\Controllers\PanelAdministrativo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Doctor;
use App\Doctor_asistente;
use App\Clinica;
use App\Clinica_doctor;
use App\User;
use Auth;
use App\Infodoctor;
use Illuminate\Support\Facades\Hash;
use Image;
use Illuminate\Support\Facades\Storage;
use App\Speciality;
use App\DoctorEspeciality;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateDoctorRequest;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $doctores = Doctor::leftJoin('users','doctors.user_id','users.id')->select('doctors.*','users.id As usuario','users.username')->orderBy('created_at','DESC')->paginate(15);
        return view('panel.doctor', compact('doctores'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function nuevo($id)
     {
        $user =  User::find($id);
        return view('panel.Doctores.nuevo', compact('user'));
     }

    public function newAsistente($id)
    {
        $asistentes_doctor = Doctor_asistente::leftJoin('users','doctor_asistentes.user_id','users.id')
            ->select('users.name','users.id')->where('doctor_asistentes.doctor_id',$id)->get();
        $asistentes = Role::find(3)->users;
        $doctor=$id;

        return view('panel.Doctores.nuevaAsistentes', compact('asistentes_doctor','asistentes','doctor'));
    }

    public function agregarAsistente($doctor, $asistente)
    {
        if(!Doctor_asistente::where('doctor_id',$doctor)->where('user_id',$asistente)->exists())
        {
        $newasistente = Doctor_asistente::create([
            'doctor_id' => $doctor,
            'user_id' => $asistente,
        ]);
        $user = User::find($asistente)->update([
            'doctor_id' => $doctor,
        ]);
        return redirect()->route('doctores.newasistente',$doctor);
        }else{
            return back();
        }
    }
    public function quitarAsistente($id)
    {
        $asistente = Doctor_asistente::where('user_id',$id)->delete();
        $user = User::find($id)->update([
            'doctor_id' => '',
        ]);
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function create()
     {
        $users = User::orderBy('name', 'DESC')->get();
       return view('panel.Doctores.create', compact('users'));
     }

    public function store(Request $request)
    {
        $doctor = Doctor::create($request->all());
        $usuario = User::find($request->user_id)->update([
            'doctor_id' => $doctor->id,
        ]);
        return redirect()->route('doctores.logos', $doctor->id)->with('info', 'Se creo el doctor correctamente!');
    }

    public function logos($id)
    {
        $doctor = Doctor::find($id);
        return view('panel.Doctores.logos', compact('doctor'));
    }

    public function logoupload(Request $request)
    {
        $doctor = Doctor::find($request->doctor_id);
        $carpeta = public_path().'/adjuntosdoctor/'.$doctor->id.'-'.$doctor->apellidosDoctor;

        if($request->file('logo') && $request->file('makerwater'))
        {
            $logo = $request->file('logo');
            $name = 'logo.'.$logo->getClientOriginalExtension();
            $logo->move($carpeta, $name);
            $doctor->update([
                'logo' => $name,
            ]);
            $marca = $request->file('makerwater');
            $water = 'logo2.'.$marca->getClientOriginalExtension();
            $marca->move($carpeta, $water);
        }
        return '200';

    }

    public function plantilla()
    {
        $doctores=Doctor::get();
        return view('panel.Doctores.plantilla', compact('doctores'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $doctor = Doctor::find($id);
        $clinicas = Clinica::join('clinica_doctors As c','clinicas.id','c.clinica_id')
            ->where('c.doctor_id', $id)
            ->select('clinicas.*')
            ->get();
        $especialidades = Speciality::join('doctor_especialities As d','d.especialidad_id','specialities.id')
            ->where('d.doctor_id', $id)
            ->select('specialities.*')
            ->get();

        $existe = Infodoctor::where('doctor_id',$id)->exists();

        if($existe == true)
        {
            $informacion = Infodoctor::where('doctor_id',$id)->first();
            return view('panel.Doctores.show', compact('doctor', 'clinicas','especialidades','informacion'));
        }
        else{
            return view('panel.Doctores.show', compact('doctor', 'clinicas','especialidades'));
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
        $doctor = Doctor::find($id);
        $clinicas = Clinica::select('clinicas.id','clinicas.nombreClinica')->orderBy('nombreClinica','ASC')->get();
        $idclinica = Clinica_doctor::where('doctor_id',$doctor->id)->first();
        return view('panel.Doctores.edit', compact('doctor','clinicas','idclinica'));
    }

    public function storeClinica(Request $request)
    {
        $clinica = new Clinica_doctor();
        if($request->varclinica==null)
        {
            $clinica->create([
                'doctor_id' => $request->doctor_id,
                'clinica_id' =>$request->clinica,
            ]);
        }else{
           if ($request->clinica==null) {
               return back();
           }else{
            $clin = Clinica_doctor::find($request->varclinica);
            $clin->update([
                'clinica_id' => $request->clinica,
            ]);
           }
        }

        return back();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDoctorRequest $request, $id)
    {
        $doctor = Doctor::find($id);

        $doctor->update($request->all());
        return back()->with('info','Su información se actualizó correctamente');
    }

    public function perfil($id)
    {
        $doctor =  Doctor::find($id);
        $user = User::find($doctor->user_id);
        $clinica = Clinica_doctor::select('c.*')->join('clinicas As c','clinica_doctors.clinica_id','c.id')
        ->where('clinica_doctors.doctor_id', $doctor->id)->first();
        $speciality = DoctorEspeciality::select('specialities.id','specialities.specialty_name')
            ->join('specialities','doctor_especialities.especialidad_id','specialities.id')
            ->where('doctor_especialities.doctor_id',$doctor->id)
            ->get();

        $especialidades = Speciality::orderBy('specialty_name','ASC')->get();

        $informacion = Infodoctor::where('doctor_id', $doctor->id)->first();

        $asistentes = Doctor_asistente::select('users.*')->join('users','doctor_asistentes.user_id','users.id')
            ->where('doctor_asistentes.doctor_id',$doctor->id)
            ->orderBy('name','ASC')
            ->get();

        return view('panel.Doctores.profile', compact('doctor','user','clinica','especialidades','speciality','informacion','asistentes'));
    }

    public function changeperfil(Request $request, $id)
    {
        if($request->file('file'))
        {
            $doctor =  Doctor::find($id);
            $file =  $request->file('file');
            $carpeta = public_path().'/adjuntosdoctor/'.$doctor->id.'-'.$doctor->apellidosDoctor;
            $name = 'avatar.'.$file->getClientOriginalExtension();
            $file->move($carpeta, $name);
            $doctor->update([
                'perfil' => $name
            ]);

            return '200';
        }
        else
        {
            return '500';
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
        //
    }

    public function changepassword(Request $request, $id)
    {
        $rules = [
            'clave_actual' =>'required',
            'password' => 'required|confirmed|min:8:max:16',
        ];
        $messages = [
            'clave_actual.required' => 'El campo es requerido',
            'password.required' => 'El campo es requerido',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'password.min' => 'El mínimo permitido son 8 caracteres',
            'password.max' => 'El máximo permitido son 16 caracteres',
        ];

        $validator  = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return  back()->withErrors($validator);
        }else{
            if(Hash::check($request->clave_actual, Auth::user()->password))
            {
                $user = User::find(Auth::user()->id)
                ->update([
                    'password' => bcrypt($request->password),
                ]);

                return back()->with('info', 'clave cambiada con exito!');
            }
            else{
                return back()->with('error', 'credenciales incorrectas!');
            }
        }
    }

    public function edicioninfo(Request $request, $id)
    {
        if(Infodoctor::where('doctor_id',$id)->exists()){
            $informacion = Infodoctor::where('doctor_id',$id)->first();
            $informacion->update($request->all());
        }else{
            $informacion = Infodoctor::create([
                'doctor_id' => $id,
                'estudios' => $request->estudios,
                'experiencias' => $request->experiencias,
                'membrecias' => $request->membrecias,
                'servicios' => $request->servicios,
            ]);
        }

        return back()->with('info','Su información se actualizó correctamente');
    }

    public function updateinfo(Request $request, $id)
    {
        $informacion = Infodoctor::where('doctor_id',$id)->exists();
        if($informacion==false)
        {
            $informacion = Infodoctor::create($request->all());
            return redirect()->route('doctores.show', $request->doctor_id);
        }
        else{
            if($request->servicios){
                $informacion = Infodoctor::where('doctor_id',$id)->update([
                    'servicios' => $request->servicios,
                ]);
            }else if($request->membrecias)
            {
                $informacion = Infodoctor::where('doctor_id',$id)->update([
                    'membrecias' => $request->membrecias,
                ]);
            }else if($request->estudios)
            {
                $informacion = Infodoctor::where('doctor_id',$id)->update([
                    'estudios' => $request->estudios,
                ]);
            }else if($request->experiencia)
            {
                $informacion = Infodoctor::where('doctor_id',$id)->update([
                    'experiencia' => $request->experiencia,
                ]);
            }
            
            return redirect()->route('doctores.show', $request->doctor_id);
        }
    }
}
