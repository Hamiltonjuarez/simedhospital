<?php

namespace App\Http\Controllers;

use App\inventario;
use Illuminate\Http\Request;
use Auth;
use App\entrada_inventario;
use App\salida_inventario;
use App\Paciente;
use App\venta;
use App\Clinica_doctor;
use App\Doctor;
use PDF;
use App\Clinica;
use App\paquetes;
use App\Medicamentospaquetes;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventario = inventario::where('doctor_id',Auth::user()->doctor_id)->get();      
        $pacientes = Paciente::where ('doctor_id',Auth::user()->doctor_id)->get();        
        return view ('Inventario/listadoInventario',compact('inventario','pacientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /* public function create()
    {
       return 
    } */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {     
       $medicamento =  inventario::create([
            'codigo' => $request->codigomedicamento,
            'nombre' => $request->nombremedicamento,
            'Consentracion' => $request->concentracion,
            'fabricante' => $request->fabricantemedicamento,
            'stock' => $request->stock,
            'minimo' => $request->minimo,
            'precio' => $request->precio,
            'precioiva' => $request->precioiva,
            'costo' => $request->costo,
            'fecha_exp' => $request->fechaexp,
            'doctor_id' => $request->doctor_id,
       ]);
       return redirect()->route('inventarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function show(inventario $inventario)
    {      
      $entradas = entrada_inventario::where('medicamento_id',$inventario->id)->orderBy('fecha_ingreso','ASC')
      ->paginate(5,['*'],'entradas');
      
      $salidas = salida_inventario::select('nombre','apellidos','salida_inventarios.*')
      ->Join('pacientes','pacientes.id','=','salida_inventarios.paciente_id')
      ->where('medicamento_id',$inventario->id)
      ->orderBY('created_at', 'DESC')
      ->paginate(5,['*'],'salidas');
      
      

      $medicamento = inventario::where('id',$inventario->id)->first();   
      $id = $medicamento->id;
    
     /*  $salidas = salida_inventario::where('medicamento_id',$inventario->id)->get(); */
      return view('Inventario.showmedicamento',compact('entradas','medicamento','salidas','id'));  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, inventario $inventario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function destroy(inventario $inventario)
    {
        //
    }
    public function listatable()
    {
        
                return datatables()
                ->eloquent(inventario::where('doctor_id',Auth::user()->doctor_id)->orderBy('created_at','DESC'))                            
                ->addColumn('btn', 'Inventario.buttonslista')  
                ->rawColumns(['btn'])  
                ->addColumn('fecha_exp', function($row){
                  return \Carbon\Carbon::parse($row->fecha_exp)->format('d/m/Y');
              })            
                ->toJson();
           
    }
    public function ventamenu()
    {
       $pacientes = Paciente::where('doctor_id',Auth::user()->doctor_id)->get();
       $medicamentos = inventario::where('doctor_id',Auth::user()->doctor_id)->orderBy('nombre','ASC')->get(); 
       $paquetes = Paquetes::where('doctor_id',Auth::user()->doctor_id)->orderBy('nombre','ASC')->get(); 
       $number = 1;    
      return view('Inventario.ventamenu', compact('pacientes','paquetes','medicamentos','number'));

    }
    public function addventajax(Request $request){   
      /* return $request; */
        $suma = 0;
        $doctor = Doctor::where('id',Auth::user()->doctor_id)->first();           
        $clinica = Clinica_doctor::where('doctor_id',Auth::user()->doctor_id)->first(); 
        $clinicaenvio = Clinica::where('id',$clinica->clinica_id)->first();  
      foreach($request->b as $nombre){
        $division = explode('!',$nombre);       

        $maybe = inventario::where('id',$division[0])->first();
        $precio = $maybe->precio;
        $multi = $precio * $division[1];        
        $suma = $suma + $multi;
        
        $stock = $maybe->stock;
        $newstock = $stock-$division[1];
       
        $maybe->update([
          'stock' => $newstock,         
      ]);
       /*  return $maybe; */
       
        if(is_numeric($request->paciente_id)){
          $paciente_id = $request->paciente_id;
          $cliente = null;
        }
        else{
          $paciente_id = null;           
          $cliente = $request->paciente_id;
        }      
      }
      foreach($request->a as $paquete){
       
          $varpaquete = Paquetes::find($paquete);
          $suma = $suma + $varpaquete->precio;
          
          $restastock = Medicamentospaquetes::Join('inventarios','medicamentospaquetes.medicamento_id'
          ,'inventarios.id')->where('medicamentospaquetes.combo_id',$varpaquete->id)->get();
         
          foreach($restastock as $restaa){
           /*  return $restaa; */
            $medicarestar = inventario::find($restaa->medicamento_id);            
            $substrac = $medicarestar->stock - $restaa->cantidad;
            $medicarestar->update([
              'stock' => $substrac
            ]);
          }
      }
        $varventa =  venta::create([
              'paciente_id' => $paciente_id,
              'total_venta' => $suma,
              'clinica_id' => $clinica->clinica_id,
              'cliente' => $cliente   
          ]);
         
          
          foreach($request->b as $nombre){
            $division = explode('!',$nombre);       
    
            $maybe = inventario::where('id',$division[0])->first();
            $medic_id = $maybe->id;
            $cantidad = $division[1];  
            $id_venta = $varventa->id;            
                    
            
            $salida = salida_inventario::create([
                'medicamento_id' => $medic_id,
                'cantidad' => $cantidad,
                'paciente_id' => $paciente_id,
                'venta_id' => $varventa->id
            ]);
          }

          foreach($request->a as $paquete){
       
            $varpaquete = Paquetes::find($paquete);
            $suma = $suma + $varpaquete->precio;
            
            $restastock = Medicamentospaquetes::Join('inventarios','medicamentospaquetes.medicamento_id'
            ,'inventarios.id')->where('medicamentospaquetes.combo_id',$varpaquete->id)->get();
           
            foreach($restastock as $restaa){
             /*  return $restaa; */
              $medicarestar = inventario::find($restaa->medicamento_id);            
                $salida = salida_inventario::create([
                  'medicamento_id' => $medicarestar->id,
                  'cantidad' => $restaa->cantidad,
                  'paciente_id' => $paciente_id,
                  'venta_id' => $varventa->id
              ]);
            }
        }
        
     $medicamentos = Inventario::Join('salida_inventarios','inventarios.id','salida_inventarios.medicamento_id')
     ->select('salida_inventarios.cantidad','inventarios.*')
     ->where('salida_inventarios.venta_id',$varventa->id)->get();

    if($paciente_id != null){
      $paciente = Paciente::where('id',$request->paciente_id)->first();     
    }  
    else{
      $paciente = $cliente;     
    }      

     $totalventa = $varventa->total_venta;
     
   /*   $fecha = $varventa->created_at;
     $fecha->format('yy');
     return $fecha;     
     */
    if($request->nber == 2){
      $pdf = PDF::loadView('Inventario.reciboVenta', [
        'medicamentos' =>$medicamentos,
        'paciente' => $paciente,
        'total' => $totalventa,
        'doc' => $doctor,
        'clinica' => $clinicaenvio
        ])->setPaper('a4','portrait');
        $nombre = 'VENTA DE MEDICAMENTOS';
        return $pdf->stream($nombre.'.pdf');
    }else{
      return redirect()->route('pacientes.show', $paciente->id);
    }

    }
    function ventapaciente($id){
      $paciente = Paciente::find($id);
      $medicamentos = Inventario::where('doctor_id',Auth::user()->doctor_id)->orderBy('nombre','ASC')->get();
      $number = 2;
      $paquetes = Paquetes::where('doctor_id',Auth::user()->doctor_id)->orderBy('nombre','ASC')->get(); 
      return view ('Inventario.ventamenu',compact('paciente','paquetes','medicamentos','number'));
    }
    
    function verventapaciente($id){
       
      $venta = venta::find($id);
      
      $medicamentos = Inventario::Join('salida_inventarios','inventarios.id','salida_inventarios.medicamento_id')
      ->select('salida_inventarios.cantidad','inventarios.*')
      ->where('salida_inventarios.venta_id',$venta->id)->get();
      
     

      $paciente = Paciente::where('id',$venta->paciente_id)->first();
  
      $totalventa = $venta->total_venta;
      

      $doctor = Doctor::where('id',Auth::user()->doctor_id)->first();  
      
      $clinica = Clinica_doctor::where('doctor_id',Auth::user()->doctor_id)->first(); 
      $clinicaenvio = Clinica::where('id',$clinica->clinica_id)->first();  

      $pdf = PDF::loadView('Inventario.reciboVenta', [
      'medicamentos' =>$medicamentos,
      'paciente' => $paciente,
      'total' => $totalventa,
      'doc' => $doctor,
      'clinica' => $clinicaenvio
      ])->setPaper('a4','portrait');
      $nombre = 'VENTA DE MEDICAMENTOS';
      return $pdf->stream($nombre.'.pdf');
    }

    function listaventas(Request $request){
        $ventas = venta::
        select('ventas.*')
        ->where('ventas.paciente_id',$request->idlista)->orderBy('ventas.created_at','DESC')
        ->get();     
        
        $medicamentos = venta::Join('salida_inventarios','ventas.id','salida_inventarios.venta_id')
        ->join('inventarios','salida_inventarios.medicamento_id','inventarios.id')
        ->select('salida_inventarios.*','ventas.id','inventarios.nombre','inventarios.Consentracion')       
        ->get();
       
        /* $contador = 0;
        foreach ($medicamentos as $medicamento){
            $contador = $contador + $medicamento->cantidad;
        } */
        /* return $ventas; */
        $totales = DB::table('salida_inventarios')
                ->select('salida_inventarios.venta_id', DB::raw('SUM(salida_inventarios.cantidad) as total'))
                ->groupBy('venta_id')
                ->get();
       /*  return $totales;    */   
       /* $datos = salida_inventario::select('sum(salida_inventarios.cantidad)')->get()->groupBy('venta_id'); */
       
     
     
        $paciente = Paciente::find($request->idlista);
        return view('Inventario.listaventas',compact('ventas','paciente','totales','medicamentos'));
    }

    function cuantoshay(Request $request){
        $medicamento = Inventario::find($request->idd);
        $stock = $medicamento->stock;
        return response()->json([
            'stock' => $stock,
        ]);
    }
    function medicamentoaeditar(Request $request){
      $medicamento = Inventario::find($request->idd);
      $stock = $medicamento->stock;
      $nombre = $medicamento->nombre;
      $precio = $medicamento->precio;
      $costo = $medicamento->costo;
      $iva = $medicamento->precioiva;
      $minimo = $medicamento->minimo;
      $consentracion = $medicamento->Consentracion;
      $fabricante = $medicamento->fabricante;
      $codigo = $medicamento->codigo;
      $expiracion = $medicamento->fecha_exp;

      return response()->json([
          'stock' => $stock,
          'nombre' => $nombre,
          'precio' => $precio,
          'costo' => $costo,
          'iva' => $iva,
          'minimo' => $minimo,
          'consentracion' => $consentracion,
          'fabricante' => $fabricante,
          'codigo' => $codigo,
          'expiracion' => $expiracion
      ]);
  }

  function editarmedicamento(Request $request){
   
  $medicamento = Inventario::find($request->medicamento_idedit);
 $medicamento->update([
    'codigo' => $request->codigoedit,
    'nombre' => $request->nombreedit,
    'Consentracion' => $request->concentracionedit,
    'fabricante' => $request->fabricanteedit,
    'stock' => $request->stockedit,
    'minimo' => $request->minimo,
    'precio' => $request->precioedit,
    'precioiva' => $request->precioivaedit,
    'costo' => $request->costoedit,
    'fecha_exp' => $request->fechaexpedit
 ]);
 $inventario = inventario::where('doctor_id',Auth::user()->doctor_id)->get();      
 $pacientes = Paciente::where ('doctor_id',Auth::user()->doctor_id)->get();        
 return view ('Inventario/listadoInventario',compact('inventario','pacientes'));
  }


  function eliminarmedicamento(Request $request){
    $medicamento = Inventario::find($request->idaborrar);
    $medicamento->delete();
    return back()->with('exito', 'EL medicamento ha sido eliminado');
   
  }
  
  function agregarcombo(Request $request){
    $request->user(); 
    $id= $request->user()->doctor_id;
    $medicamentos = inventario::where('doctor_id',$id)->get();    
    return view ('Inventario.crearCombo', compact('medicamentos'));
  }

  function createcombo(Request $request){   
    $nombrecombo = $request->comobosend;   
    $costocombo = $request->costocombo;
    $preciocombo = $request->total;
    $doctorid = Auth::user()->doctor_id;
    $paquete = paquetes::create([
      'doctor_id' => $doctorid,
      'nombre' => $nombrecombo,
      'costo' => $costocombo,
      'precio' => $preciocombo,
    ]);
     
    foreach($request->b as $nombre){
      $division = explode('!',$nombre);       

      $medicamentos = inventario::where('id',$division[0])->first();
      $medic_id = $medicamentos->id;
      $cantidad = $division[1];  
      $id_paquete = $paquete->id;            
              
      
      $medicamentospaquete = Medicamentospaquetes::create([
        'medicamento_id' => $medic_id,
        'cantidad' => $cantidad,
        'combo_id' => $id_paquete
      ]);
    }
  
    $selection = Medicamentospaquetes::Join('inventarios','medicamentospaquetes.medicamento_id','inventarios.id')
    ->Join('paquetes','medicamentospaquetes.combo_id','paquetes.id')
    ->select('inventarios.nombre','medicamentospaquetes.cantidad','medicamentospaquetes.combo_id')   
    ->get();
        $combos = paquetes::where('doctor_id',Auth::user()->doctor_id)->get();
       $inventario = inventario::where('doctor_id',Auth::user()->doctor_id)->get();      
        $pacientes = Paciente::where ('doctor_id',Auth::user()->doctor_id)->get();        
        return view('Inventario.listadoInventario',compact('inventario','pacientes','combos'))->with('exito','Se ha creado el paquete');
    
  }

  public function tablapaquetes()
    {        
          return datatables()
          ->eloquent(paquetes::where('doctor_id',Auth::user()->doctor_id)->orderBy('created_at','DESC'))                            
          ->addColumn('btn', 'Inventario.btnlistapaquetes')  
          ->rawColumns(['btn'])  
          /*  ->addColumn('fecha_exp', function($row){
            return \Carbon\Carbon::parse($row->fecha_exp)->format('d/m/Y');
        })  */           
          ->toJson();
           
    }

    public function showcombo(Request $request){

        $doctorid = Auth::user()->doctor_id;
        
      $medicamentos = Paquetes::where('paquetes.doctor_id',$doctorid)
      ->Join('medicamentospaquetes','medicamentospaquetes.combo_id','paquetes.id')
      ->Join('inventarios','medicamentospaquetes.medicamento_id','inventarios.id')
      ->where('paquetes.id',$request->idcombo)
      ->select('inventarios.*','medicamentospaquetes.cantidad','paquetes.precio','paquetes.costo')
      ->get();
      $combo = Paquetes::where('paquetes.id',$request->idcombo)->first();      

        return view('Inventario.ShowCombo',compact('medicamentos','combo'));
    }

    public function deletecombo(Request $request){
      
      $combo = Paquetes::where('id',$request->deletecomboid)->first();
     $medicamentos = Medicamentospaquetes::where('combo_id',$combo->id)->get();
    foreach ($medicamentos as $medicamento) {
      $medicamento->delete();
    }
     $combo->delete();
     return back()->with('exito', 'El paquete ha sido eliminado');
      
    }

    public function editarpaquete(Request $request){

        $paquete = Paquetes::find($request->idpaqueteditar);
       /*  return $paquete; */
        $paquete->update([
          'nombre' => $request->nombrepaqueteeditar,
          'costo' => $request->costopaquete,
          'precio' => $request->preciopaquete
        ]);
        $inventario = inventario::where('doctor_id',Auth::user()->doctor_id)->get();      
        $pacientes = Paciente::where ('doctor_id',Auth::user()->doctor_id)->get();        
        return view ('Inventario/listadoInventario',compact('inventario','pacientes'));
    }

    public function comboaeditar(Request $request){

      $combo = Paquetes::find($request->idd);

      return response()->json([
        'nombre' => $combo->nombre,
        'precio' => $combo->precio,
        'costo' => $combo->costo,       
    ]);
    }

}