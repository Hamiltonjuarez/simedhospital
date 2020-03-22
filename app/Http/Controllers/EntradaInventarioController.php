<?php

namespace App\Http\Controllers;
use App\inventario;
use App\entrada_inventario;
use Illuminate\Http\Request;
use Carbon\Carbon;
class EntradaInventarioController extends Controller
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

        $entrada = entrada_inventario::create([
        'medicamento_id' => $request->medicamento_id,
        'cantidad' => $request->cantidad,
        'proveedor' => $request->proveedor,
        'fechaexp' => $request->fechaexp,
        'fecha_ingreso' => $request->fechain,
        ]);        
        $cantidadmedicamento = inventario::where('id',$request->medicamento_id)->select('stock')->first();          
        $suma = $cantidadmedicamento->stock + $request->cantidad; 

        $medicamento = inventario::find($request->medicamento_id);
        $fecha =  Carbon::parse($medicamento->fecha_exp);
        $now = Carbon::now();
        $dias =  $fecha->diffInDays($now);
        
        $fechaentrada = $entrada->fechaexp;
        $fecha2 = Carbon::parse($fechaentrada);
        $dias2 = $fecha2->diffInDays($now);
       
        if($dias2< $dias){
           
            $update = inventario::find($request->medicamento_id);
            $update->update([
                'stock' => $suma,
                'fecha_exp' => Carbon::parse($fecha2)->toDateTimeString(),
            ]);
        }
        else{            
            $update = inventario::find($request->medicamento_id);
            $update->update([
                'stock' => $suma,
            ]);
        }
       
        return redirect()->route('inventarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\entrada_inventario  $entrada_inventario
     * @return \Illuminate\Http\Response
     */
    public function show(entrada_inventario $entrada_inventario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\entrada_inventario  $entrada_inventario
     * @return \Illuminate\Http\Response
     */
    public function edit(entrada_inventario $entrada_inventario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\entrada_inventario  $entrada_inventario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, entrada_inventario $entrada_inventario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\entrada_inventario  $entrada_inventario
     * @return \Illuminate\Http\Response
     */
    public function destroy(entrada_inventario $entrada_inventario)
    {
        //
    }
}
