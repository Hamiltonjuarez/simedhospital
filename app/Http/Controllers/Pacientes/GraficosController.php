<?php

namespace App\Http\Controllers\Pacientes;

use Illuminate\Http\Request;
use \Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\HistorialClinico;
use App\Consulta;
use App\Doctor_asistente;
use App\Procedimiento;
use App\Paciente;
use App\Biopsia;
use Auth;
use App\Doctor;
use Illuminate\Support\Facades\DB;
use App\Procedimiento_tipo;
class GraficosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        if (Auth::user()->hasPermission('diario_graficos'))
        {
            $doctor=Doctor::find(Auth::user()->doctor_id);
            $fecha = Carbon::now()->format('Y-m-d');

         /*    $generado = DB::select(DB::raw('SELECT sum(c.precioConsulta) AS genconsulta, sum(p.precioProcedimiento) As genprocedimiento, sum(b.precioBiopsia) As genbiopsia FROM 
                historial_clinicos AS hc LEFT JOIN consultas AS c ON hc.consulta_id = c.id LEFT JOIN procedimientos AS p ON hc.procedimiento_id = p.id 
                LEFT JOIN biopsias AS b ON p.id = b.procedimiento_id WHERE p.status = :estproc AND DATE(hc.created_at) =  :fecha AND hc.doctor_id = :id  AND c.status = :estbiopsia'),['id' => $doctor->id, 'fecha' => $fecha, 'estbiopsia' => 'no-cancelado','estproc' => 'no-cancelado']);
                return $generado; */

            $generadoConsulta=HistorialClinico::leftJoin('consultas','historial_clinicos.consulta_id','consultas.id')
                ->where('historial_clinicos.doctor_id',$doctor->id) 
                ->whereDate('historial_clinicos.created_at',\Carbon\Carbon::now())
                ->sum('precioConsulta');

            $cobradoConsulta=HistorialClinico::leftJoin('consultas','historial_clinicos.consulta_id','consultas.id')
                ->where('historial_clinicos.doctor_id',$doctor->id)
                ->where('consultas.status','cancelado')
                ->whereDate('historial_clinicos.created_at',\Carbon\Carbon::now())
                ->sum('precioConsulta');

            $generadoProcedimiento=HistorialClinico::leftJoin('procedimientos','historial_clinicos.procedimiento_id','procedimientos.id')
                ->where('historial_clinicos.doctor_id',$doctor->id)
                ->whereDate('historial_clinicos.created_at',\Carbon\Carbon::now())
                ->sum('procedimientos.precioProcedimiento');

            $cobradoProcedimiento=HistorialClinico::leftJoin('procedimientos','historial_clinicos.procedimiento_id','procedimientos.id')
                ->where('historial_clinicos.doctor_id',$doctor->id)
                ->whereDate('historial_clinicos.created_at',\Carbon\Carbon::now())
                ->where('procedimientos.status','cancelado')
                ->sum('procedimientos.precioProcedimiento');

            $generadoBiopsia=HistorialClinico::leftJoin('procedimientos','historial_clinicos.procedimiento_id','procedimientos.id')
                ->leftJoin('biopsias','procedimientos.id','biopsias.procedimiento_id')
                ->whereNull('historial_clinicos.consulta_id')
                ->where('historial_clinicos.doctor_id',$doctor->id)
                ->whereDate('historial_clinicos.created_at',\Carbon\Carbon::now())
                ->sum('biopsias.precioBiopsia');

            $cobradoBiopsia=HistorialClinico::leftJoin('procedimientos','historial_clinicos.procedimiento_id','procedimientos.id')
                ->leftJoin('biopsias','procedimientos.id','biopsias.procedimiento_id')
                ->where('historial_clinicos.doctor_id',$doctor->id)
                ->whereDate('historial_clinicos.created_at',\Carbon\Carbon::now())
                ->where('biopsias.status','cancelado')
                ->sum('biopsias.precioBiopsia');
                
            $query = DB::select(DB::raw('SELECT count(p.id) as proce, pt.procedimiento_nombre from procedimiento_tipos as pt
                inner join procedimientos as p on pt.id = p.procedimiento_tipo_id inner join historial_clinicos as hc on hc.procedimiento_id = 
                p.id where DATE(hc.created_at) =  :fecha and hc.doctor_id = :id group by pt.procedimiento_nombre'),['id' => $doctor->id, 'fecha' => Carbon::now()->format('Y-m-d')]);

            $secondquery = HistorialClinico::select('precioConsulta as precioconsulta','consultas.status as estadoconsulta','procedimientos.precioProcedimiento as 
                precioproc','procedimientos.status as estadoproc','biopsias.precioBiopsia as preciobiopsia','biopsias.status as estadobiopsia','pacientes.nombre','pacientes.apellidos','procedimiento_tipos.procedimiento_nombre as procnombre')
                ->leftJoin('consultas','consultas.id','historial_clinicos.consulta_id')
                ->leftJoin('procedimientos','procedimientos.id','historial_clinicos.procedimiento_id')
                ->leftJoin('biopsias','procedimientos.id','biopsias.procedimiento_id')
                ->join('pacientes','historial_clinicos.paciente_id','pacientes.id')
                ->leftJoin('procedimiento_tipos','procedimientos.procedimiento_tipo_id','procedimiento_tipos.id')
                ->whereDate('historial_clinicos.created_at',Carbon::now())
                ->where('historial_clinicos.doctor_id',Auth::user()->doctor_id)
                ->orderBy('historial_clinicos.created_at','DESC')
                ->paginate(10);
                

            return view('pacientes.Graficos.graficoConsultas', compact('generadoConsulta','cobradoConsulta',
                        'generadoProcedimiento','cobradoProcedimiento','generadoBiopsia','cobradoBiopsia','query','secondquery'));
        }
    }

    public function graficoMensual()
    {
        if (Auth::user()->hasPermission('mensual_graficos'))
        {
            $doctor=Doctor::find(Auth::user()->doctor_id);
            $fecha = \Carbon\Carbon::now()->month;

            $secondquery = HistorialClinico::select('precioConsulta as precioconsulta','consultas.status as estadoconsulta','procedimientos.precioProcedimiento as 
                precioproc','procedimientos.status as estadoproc','biopsias.precioBiopsia as preciobiopsia','biopsias.status as estadobiopsia','pacientes.nombre','pacientes.apellidos','procedimiento_tipos.procedimiento_nombre as procnombre')
                ->leftJoin('consultas','consultas.id','historial_clinicos.consulta_id')
                ->leftJoin('procedimientos','procedimientos.id','historial_clinicos.procedimiento_id')
                ->leftJoin('biopsias','procedimientos.id','biopsias.procedimiento_id')
                ->join('pacientes','historial_clinicos.paciente_id','pacientes.id')
                ->leftJoin('procedimiento_tipos','procedimientos.procedimiento_tipo_id','procedimiento_tipos.id')
                ->whereMonth('historial_clinicos.created_at',\Carbon\Carbon::now()->month)
                ->where('historial_clinicos.doctor_id',Auth::user()->doctor_id)
                ->orderBy('historial_clinicos.created_at','DESC')
                ->paginate(10);

                $query = DB::select(DB::raw('SELECT count(p.id) as proce, pt.procedimiento_nombre from procedimiento_tipos as pt
                inner join procedimientos as p on pt.id = p.procedimiento_tipo_id inner join historial_clinicos as hc on hc.procedimiento_id = 
                p.id where MONTH(hc.created_at) =  :fecha  and hc.doctor_id = :id group by pt.procedimiento_nombre'),['id' => $doctor->id, 'fecha' => $fecha]);

            $generadoConsulta=HistorialClinico::leftJoin('consultas','historial_clinicos.consulta_id','consultas.id')
                ->where('historial_clinicos.doctor_id',$doctor->id)
                ->whereMonth('historial_clinicos.created_at',\Carbon\Carbon::now()->month)
                ->sum('precioConsulta');

            $cobradoConsulta=HistorialClinico::leftJoin('consultas','historial_clinicos.consulta_id','consultas.id')
                ->where('historial_clinicos.doctor_id',$doctor->id)
                ->where('consultas.status','cancelado')
                ->whereMonth('historial_clinicos.created_at',\Carbon\Carbon::now()->month)
                ->sum('precioConsulta');

            $generadoProcedimiento=HistorialClinico::leftJoin('procedimientos','historial_clinicos.procedimiento_id','procedimientos.id')
                ->where('historial_clinicos.doctor_id',$doctor->id)
                ->whereMonth('historial_clinicos.created_at',\Carbon\Carbon::now()->month)
                ->sum('procedimientos.precioProcedimiento');

            $cobradoProcedimiento=HistorialClinico::leftJoin('procedimientos','historial_clinicos.procedimiento_id','procedimientos.id')
                ->where('historial_clinicos.doctor_id',$doctor->id)
                ->whereMonth('historial_clinicos.created_at',\Carbon\Carbon::now()->month)
                ->where('procedimientos.status','cancelado')
                ->sum('procedimientos.precioProcedimiento');

            $generadoBiopsia=HistorialClinico::leftJoin('procedimientos','historial_clinicos.procedimiento_id','procedimientos.id')
                ->leftJoin('biopsias','procedimientos.id','biopsias.procedimiento_id')
                ->whereNull('historial_clinicos.consulta_id')
                ->whereMonth('historial_clinicos.created_at',\Carbon\Carbon::now()->month)
                ->sum('biopsias.precioBiopsia');

            $cobradoBiopsia=HistorialClinico::leftJoin('biopsias','biopsias.procedimiento_id','historial_clinicos.procedimiento_id')
                ->where('biopsias.status','cancelado')
                ->whereNotNull('historial_clinicos.procedimiento_id')
                ->where('historial_clinicos.doctor_id',$doctor->id)
                ->whereMonth('historial_clinicos.created_at',\Carbon\Carbon::now()->month)
                ->sum('biopsias.precioBiopsia');

            return  view('pacientes.Graficos.graficosMensual',
                    compact('generadoConsulta','cobradoConsulta',
                    'generadoProcedimiento','cobradoProcedimiento',
                    'generadoBiopsia','cobradoBiopsia','query','secondquery'));
        }
    }

    public function graficoAnual()
    {
        if (Auth::user()->hasPermission('anual_graficos'))
        {
                $doctor=Doctor::find(Auth::user()->doctor_id);
                $fecha = \Carbon\Carbon::now()->year;

                $query = DB::select(DB::raw('SELECT count(p.id) as proce, pt.procedimiento_nombre from procedimiento_tipos as pt
                inner join procedimientos as p on pt.id = p.procedimiento_tipo_id inner join historial_clinicos as hc on hc.procedimiento_id = 
                p.id where YEAR(hc.created_at) =  :fecha  and hc.doctor_id = :id group by pt.procedimiento_nombre'),['id' => $doctor->id, 'fecha' => $fecha]);

            $generadoConsulta=HistorialClinico::leftJoin('consultas','historial_clinicos.consulta_id','consultas.id')
                ->where('historial_clinicos.doctor_id',$doctor->id)
                ->whereYear('historial_clinicos.created_at',\Carbon\Carbon::now()->year)
                ->sum('precioConsulta');

            $cobradoConsulta=HistorialClinico::leftJoin('consultas','historial_clinicos.consulta_id','consultas.id')
                ->where('historial_clinicos.doctor_id',$doctor->id)
                ->where('consultas.status','cancelado')
                ->whereYear('historial_clinicos.created_at',\Carbon\Carbon::now()->year)
                ->sum('precioConsulta');

            $generadoProcedimiento=HistorialClinico::leftJoin('procedimientos','historial_clinicos.procedimiento_id','procedimientos.id')
                ->where('historial_clinicos.doctor_id',$doctor->id)
                ->whereYear('historial_clinicos.created_at',\Carbon\Carbon::now()->year)
                ->sum('procedimientos.precioProcedimiento');

               /*  return $generadoProcedimiento; */
            $cobradoProcedimiento=HistorialClinico::leftJoin('procedimientos','historial_clinicos.procedimiento_id','procedimientos.id')
                ->where('historial_clinicos.doctor_id',$doctor->id)
                ->whereYear('historial_clinicos.created_at',\Carbon\Carbon::now()->year)
                ->where('procedimientos.status','cancelado')
                ->sum('procedimientos.precioProcedimiento');

            $generadoBiopsia=HistorialClinico::leftJoin('procedimientos','historial_clinicos.procedimiento_id','procedimientos.id')
                ->leftJoin('biopsias','procedimientos.id','biopsias.procedimiento_id')
                ->where('historial_clinicos.doctor_id',$doctor->id)
                ->whereYear('historial_clinicos.created_at',\Carbon\Carbon::now()->year)
                ->sum('biopsias.precioBiopsia');

            $cobradoBiopsia=HistorialClinico::leftJoin('procedimientos','historial_clinicos.procedimiento_id','procedimientos.id')
                ->leftJoin('biopsias','procedimientos.id','biopsias.procedimiento_id')
                ->where('historial_clinicos.doctor_id',$doctor->id)
                ->whereYear('historial_clinicos.created_at',\Carbon\Carbon::now()->year)
                ->where('biopsias.status','cancelado')
                ->sum('biopsias.precioBiopsia');

            return  view('pacientes.Graficos.graficosAnual',
                    compact('generadoConsulta','cobradoConsulta',
                    'generadoProcedimiento','cobradoProcedimiento',
                    'generadoBiopsia','cobradoBiopsia','query'));
        }
    }

    public function graficoSemanal()
    {
        if(Auth::user()->hasPermission('semanal_graficos'))
        {
            $now = Carbon::now();
            $weekStartDate = $now->startOfWeek()->format('Y-m-d');
            $weekEndDate = $now->endOfWeek()->format('Y-m-d ');

            $doctor=Doctor::find(Auth::user()->doctor_id);

            $secondquery = HistorialClinico::select('precioConsulta as precioconsulta','consultas.status as estadoconsulta','procedimientos.precioProcedimiento as 
                precioproc','procedimientos.status as estadoproc','biopsias.precioBiopsia as preciobiopsia','biopsias.status as estadobiopsia','pacientes.nombre','pacientes.apellidos','procedimiento_tipos.procedimiento_nombre as procnombre')
                ->leftJoin('consultas','consultas.id','historial_clinicos.consulta_id')
                ->leftJoin('procedimientos','procedimientos.id','historial_clinicos.procedimiento_id')
                ->leftJoin('biopsias','procedimientos.id','biopsias.procedimiento_id')
                ->join('pacientes','historial_clinicos.paciente_id','pacientes.id')
                ->leftJoin('procedimiento_tipos','procedimientos.procedimiento_tipo_id','procedimiento_tipos.id')
                ->whereDate('historial_clinicos.created_at','>=', $weekStartDate)
                ->whereDate('historial_clinicos.created_at','<=', $weekEndDate)
                ->where('historial_clinicos.doctor_id',Auth::user()->doctor_id)
                ->orderBy('historial_clinicos.created_at','DESC')
                ->paginate(10);

            $query = DB::select(DB::raw('SELECT count(p.id) as proce, pt.procedimiento_nombre from procedimiento_tipos as pt
            inner join procedimientos as p on pt.id = p.procedimiento_tipo_id inner join historial_clinicos as hc on hc.procedimiento_id = 
            p.id where DATE(hc.created_at) >=  :fechainicio and DATE(hc.created_at) <= :fechafin and hc.doctor_id = :id group by pt.procedimiento_nombre'),['id' => $doctor->id, 'fechainicio' => $weekStartDate,'fechafin' => $weekEndDate]);

            $generadoConsulta=HistorialClinico::leftJoin('consultas','historial_clinicos.consulta_id','consultas.id')
                ->where('historial_clinicos.doctor_id',$doctor->id)
                ->whereDate('historial_clinicos.created_at','>=', $weekStartDate)
                ->whereDate('historial_clinicos.created_at','<=', $weekEndDate)
                ->sum('consultas.precioConsulta');

            $cobradoConsulta=HistorialClinico::leftJoin('consultas','historial_clinicos.consulta_id','consultas.id')
                ->where('historial_clinicos.doctor_id',$doctor->id)
                ->whereDate('historial_clinicos.created_at','>=', $weekStartDate)
                ->whereDate('historial_clinicos.created_at','<=', $weekEndDate)
                ->where('status','cancelado')->sum('consultas.precioConsulta');

            $generadoProcedimiento=HistorialClinico::leftJoin('procedimientos','historial_clinicos.procedimiento_id','procedimientos.id')
                ->where('historial_clinicos.doctor_id',$doctor->id)
                ->whereDate('historial_clinicos.created_at','>=', $weekStartDate)
                ->whereDate('historial_clinicos.created_at','<=', $weekEndDate)
                ->sum('procedimientos.precioProcedimiento');

            $cobradoProcedimiento=HistorialClinico::leftJoin('procedimientos','historial_clinicos.procedimiento_id','procedimientos.id')->where('historial_clinicos.doctor_id',$doctor->id)->whereDate('historial_clinicos.created_at','>=', $weekEndDate)->whereDate('historial_clinicos.created_at','<', $weekStartDate)
                ->where('status','cancelado')
                ->sum('precioProcedimiento');

            $generadoBiopsia=HistorialClinico::leftJoin('procedimientos','historial_clinicos.procedimiento_id','procedimientos.id')
                ->leftJoin('biopsias','procedimientos.id','biopsias.procedimiento_id')
                ->where('historial_clinicos.doctor_id',$doctor->id)
                ->whereDate('historial_clinicos.created_at','>=', $weekStartDate)
                ->whereDate('historial_clinicos.created_at','<=', $weekEndDate)
                ->sum('biopsias.precioBiopsia');

            $cobradoBiopsia=HistorialClinico::leftJoin('procedimientos','historial_clinicos.procedimiento_id','procedimientos.id')
                ->leftJoin('biopsias','procedimientos.id','biopsias.procedimiento_id')
                ->where('historial_clinicos.doctor_id',$doctor->id)
                ->whereDate('historial_clinicos.created_at','>=', $weekStartDate)
                ->whereDate('historial_clinicos.created_at','<=', $weekEndDate)
                ->where('biopsias.status','cancelado')->sum('biopsias.precioBiopsia');

           return   view('pacientes.Graficos.graficosSemanal',
                    compact('generadoConsulta','cobradoConsulta',
                    'generadoProcedimiento','cobradoProcedimiento',
                    'generadoBiopsia','cobradoBiopsia','query','secondquery'));
        }
    }

    public function tableCobros()
    {
        if(Auth::user()->hasPermission('index_cobros'))
        {
            $consultas = HistorialClinico::join('consultas','historial_clinicos.consulta_id','consultas.id')
            ->join('pacientes','historial_clinicos.paciente_id','pacientes.id')
            ->select('historial_clinicos.id As historia', 'pacientes.nombre','pacientes.apellidos','consultas.precioConsulta','consultas.status')
            ->whereNull('historial_clinicos.procedimiento_id')
            ->where('historial_clinicos.doctor_id',Auth::user()->doctor_id)
            ->whereDate('historial_clinicos.created_at', \Carbon\Carbon::now())
            ->get();

            $procedimientos = HistorialClinico::join('procedimientos','historial_clinicos.procedimiento_id','procedimientos.id')
                ->join('pacientes','historial_clinicos.paciente_id','pacientes.id')
                ->leftJoin('biopsias','procedimientos.id','biopsias.procedimiento_id')
                ->join('procedimiento_tipos','procedimientos.procedimiento_tipo_id','procedimiento_tipos.id')
                ->select('procedimientos.precioProcedimiento','procedimiento_tipos.procedimiento_nombre','pacientes.nombre','pacientes.apellidos','procedimientos.status','historial_clinicos.id As historia','biopsias.precioBiopsia')
                ->whereNull('historial_clinicos.consulta_id')
                ->where('historial_clinicos.doctor_id',Auth::user()->doctor_id) 
                ->whereDate('historial_clinicos.created_at',\Carbon\Carbon::now())
                ->get();
                
                return view('pacientes.Graficos.tablaCobros', compact('consultas','procedimientos'));
        }else{
            abort(403);
        }
    }

    public function storeCobros(Request $request)
    {
        if(Auth::user()->hasPermission('store_cobros'))
        {
           $historia = HistorialClinico::find($request->historia);
           if($request->tipo == 'consulta')
           {
               $consulta = Consulta::find($historia->consulta_id);
               $consulta->update([
                   'status' => 'cancelado',
               ]);

               return back()->with('success', 'El cobro se realizo con éxito');
           }
           else if($request->tipo == 'procedimiento')
           {
               $procedimiento = Procedimiento::find($historia->procedimiento_id);
               $procedimiento->update([
                   'status' => 'cancelado',
               ]);

               $existe= Biopsia::where('procedimiento_id', $procedimiento->id)->exists();
               if($existe == true){
                   $biopsia = Biopsia::where('procedimiento_id', $procedimiento->id);
                   $biopsia->update([
                       'status' => 'cancelado',
                   ]);
               }

               return back()->with('success', 'El cobro se realizo con éxito');
           }
        }else{
            abort(403);
        }
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

    public function chartNow()
    {
        if(Auth::user()->hasPermission('diario_graficos'))
        {
            $doctor=Doctor::find(Auth::user()->doctor_id);

            $consultas=HistorialClinico::where('historial_clinicos.doctor_id',$doctor->id)
                ->whereNotNull('consulta_id')
                ->whereDate('created_at',\Carbon\Carbon::now())
                ->count();

            $procedimientos=HistorialClinico::where('historial_clinicos.doctor_id',$doctor->id)
                ->whereNotNull('procedimiento_id')
                ->whereDate('historial_clinicos.created_at',\Carbon\Carbon::now())
                ->count();

            $biopsias=HistorialClinico::leftJoin('biopsias','biopsias.procedimiento_id','historial_clinicos.procedimiento_id')
                ->whereNotNull('historial_clinicos.procedimiento_id')
                ->where('historial_clinicos.doctor_id',$doctor->id)
                ->whereDate('biopsias.created_at',\Carbon\Carbon::now())
                ->count();

            

            $array[]=[
                'consultas'=>$consultas,
                'procedimientos' =>$procedimientos,
                'biopsia'=>$biopsias,
            ];
            return response()->json($array);
        }
    }
    public function chartMensual()
    {
        if(Auth::user()->hasPermission('mensual_graficos'))
        {
            $doctor=Doctor::find(Auth::user()->doctor_id);

            $consultas=HistorialClinico::where('historial_clinicos.doctor_id',$doctor->id)
                ->whereNotNull('consulta_id')
                ->whereMonth('created_at',\Carbon\Carbon::now()->month)
                ->count();

            $procedimientos=HistorialClinico::where('historial_clinicos.doctor_id',$doctor->id)
                ->whereNotNull('procedimiento_id')
                ->whereMonth('historial_clinicos.created_at',\Carbon\Carbon::now()->month)
                ->count();
            $biopsias=HistorialClinico::leftJoin('biopsias','biopsias.procedimiento_id','historial_clinicos.procedimiento_id')
                ->whereNotNull('historial_clinicos.procedimiento_id')
                ->where('historial_clinicos.doctor_id',$doctor->id)
                ->whereMonth('biopsias.created_at',\Carbon\Carbon::now()->month)
                ->count();

            $array[]=[
                'consultas'=>$consultas,
                'procedimientos' =>$procedimientos,
                'biopsia'=>$biopsias,
            ];

            return response()->json($array);
        }
    }
    public function chartAnual()
    {
        if(Auth::user()->hasPermission('anual_graficos'))
        {
            $doctor=Doctor::find(Auth::user()->doctor_id);

            $consultas=HistorialClinico::where('historial_clinicos.doctor_id',$doctor->id)
                ->whereNotNull('consulta_id')->whereYear('created_at',\Carbon\Carbon::now()->year)
                ->count();
            $procedimientos=HistorialClinico::where('historial_clinicos.doctor_id',$doctor->id)
                ->whereNotNull('procedimiento_id')
                ->whereYear('historial_clinicos.created_at',\Carbon\Carbon::now()->year)
                ->count();
            $biopsias=HistorialClinico::leftJoin('biopsias','biopsias.procedimiento_id','historial_clinicos.procedimiento_id')
                ->whereNotNull('historial_clinicos.procedimiento_id')
                ->where('historial_clinicos.doctor_id',$doctor->id)
                ->whereYear('biopsias.created_at',\Carbon\Carbon::now()->year)
                ->count();

            $array[]=[
                'consultas'=>$consultas,
                'procedimientos' =>$procedimientos,
                'biopsia'=>$biopsias,
            ];

            return response()->json($array);
        }
    }
    public function chartSemanal()
    {

        if(Auth::user()->hasPermission('semanal_graficos'))
        {
            $doctor=Doctor::find(Auth::user()->doctor_id);

            $now = Carbon::now();
            $weekStartDate = $now->startOfWeek()->format('Y-m-d H:i');
            $weekEndDate = $now->endOfWeek()->format('Y-m-d H:i');

            $consultas=HistorialClinico::where('historial_clinicos.doctor_id',$doctor->id)
                ->whereNotNull('historial_clinicos.consulta_id')
                ->whereDate('created_at','>=', $weekStartDate)
                ->whereDate('created_at','<', $weekEndDate)
                ->count();

            $procedimientos=HistorialClinico::where('historial_clinicos.doctor_id',$doctor->id)
                ->whereNotNull('historial_clinicos.procedimiento_id')
                ->whereDate('created_at','>=', $weekStartDate)
                ->whereDate('created_at','<', $weekEndDate)
                ->count();

            $biopsias=HistorialClinico::leftJoin('procedimientos','procedimientos.id','historial_clinicos.procedimiento_id')
                ->leftJoin('biopsias','biopsias.procedimiento_id','procedimientos.id')
                ->where('historial_clinicos.doctor_id',$doctor->id)
                ->whereNull('historial_clinicos.consulta_id')
                ->whereDate('biopsias.created_at','>=', $weekStartDate)
                ->whereDate('biopsias.created_at','<', $weekEndDate)
                ->count();

            $array[]=[
                'consultas'=>$consultas,
                'procedimientos' =>$procedimientos,
                'biopsia'=>$biopsias,
            ];

            return response()->json($array);
        }
    }
}
