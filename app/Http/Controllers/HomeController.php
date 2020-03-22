<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doctor_asistente;
use Auth;
use App\User;
use App\Doctor;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        //return redirect('/');
        return view('home');
    }

    public function changedoctor(){
        if (auth()->user()->hasRole('Asistente'))
        {
            $doctores = User::leftJoin('doctor_asistentes','users.id','doctor_asistentes.user_id')
                ->leftJoin('doctors','doctor_asistentes.doctor_id','doctors.id')
                ->select('doctors.nombreDoctor','doctors.id')
                ->where('doctor_asistentes.user_id',Auth::user()->id)
                ->get();
                
            return $doctores;
        }
    }

    public function cambiardoctor(Request $request)
    {
        $user = User::find(Auth::user()->id)->update([
            'doctor_id' => $request->doctor_id,
        ]);
        return back();
    }
    public function doctor(){
        $user = Auth::user()->doctor_id;
        return $user;
    }
    public function doctorselect(){
       $user = Doctor::find(Auth::user()->doctor_id);
       return $user->nombreDoctor.' '.$user->apellidosDoctor;
    }
}
