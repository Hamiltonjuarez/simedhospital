<?php

namespace App\Http\Controllers\PanelAdministrativo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArchivosController extends Controller
{
    public function index(){
        return view('panel.Archivos.index');
    }
}
