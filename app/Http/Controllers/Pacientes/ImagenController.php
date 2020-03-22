<?php

namespace App\Http\Controllers\Pacientes;

use App\Paciente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Image;
use Auth;
use App\User;
use App\Doctor;
use \Carbon\Carbon as Fecha;

class ImagenController extends Controller
{
    
    public function changeProfile(Request $request)
    {
        $paciente = Paciente::find($request->paciente);
        $carpeta = 'adjuntospaciente/paciente'.$paciente->id;
        if($request->file('photo'))
        {
            $path = $request->file('photo')->storeAs($carpeta,'avatar.png');
            $name = collect(explode('/', $path))->last();
            $this->resize($path,$request->tipo);
            
            $paciente->update([
                'photo_extension' => $carpeta.'/'.$name,
            ]);
        }

        return back()->with('info','ok');
    }

    public function avatar(Request $request, $id){
        $carpeta = str_replace(' ','','users/'.Auth::user()->name.Auth::user()->id);

        
        $path = $request->file('avatar')->storeAs($carpeta,'avatar.png');

        $fileName = collect(explode('/', $path))->last();

        $this->resize($path,$request->tipo);

        $user = User::find($id);
        $user->update([
            'avatar' => $carpeta.'/'.$fileName,
        ]);

        return back()->with('info','Su foto de pérfil se actualizó correctamente');
    }

    public function changelogo(Request $request, $id){
        $doctor = Doctor::find($id);
        $carpeta = 'adjuntosdoctor/'.$doctor->id.'-'.$doctor->apellidosDoctor;
        $path = $request->file('input-logo')->storeAs($carpeta,'logo.png');

        $name = collect(explode('/',$path))->last();

        $this->resize($path,$request->tipo);

        $doctor->update([
            'logo' => $carpeta.'/'.$name,
        ]);

        return back()->with('info', 'Su logo se actualizó correctamente');
    }

    public function changemarca(Request $request, $id){
        $doctor = Doctor::find($id);
        $carpeta = 'adjuntosdoctor/'.$doctor->id.'-'.$doctor->apellidosDoctor;
        $path = $request->file('input-marca')->storeAs($carpeta,'logo2.png');

        $name = collect(explode('/', $path))->last();

        $this->resize($path,$request->tipo);

        $doctor->update([
            'marca' => $carpeta.'/'.$name,
        ]);

        return back()->with('info', 'Su marca de agua se actualizó correctamente');
    }

    public function resize($ruta,$tipo){
        
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
