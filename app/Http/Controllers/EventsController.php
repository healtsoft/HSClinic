<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Event;
use App\Paciente;
use App\Servicio;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $pacientes = DB::table('pacientes')->get()
            ;

        $usuarios = User::select('id', 'name', 'rol')
            ->get()
            ;

        $servicios = Servicio::select('id', 'servicio')
            ->get()
            ;

        $exist = true;
        
        if (count($pacientes) > 0) {
            return view('events.index')
                ->with('pacientes', $pacientes)
                ->with('exist', $exist)
                ->with('usuarios', $usuarios)
                ->with('servicios', $servicios);
        } else {
            $exist = false;
            return view('events.index')
                ->with('pacientes', $pacientes)
                ->with('exist', $exist)
                ->with('usuarios', $usuarios)
                ->with('servicios', $servicios);
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
        
        $idServicio = request()->get('title');
        $idPaciente = request()->get('paciente');
        $idTerapeuta = request()->get('terapeuta');
        $description = request()->get('description');
        $color = request()->get('color');
        $textColor = request()->get('textColor');
        $start = (request()->get('start'));
        $end = (request()->get('end'));

        $idServicio = intval(preg_replace('/[^0-9]+/', '', $idServicio), 10); 
        $idPaciente = intval(preg_replace('/[^0-9]+/', '', $idPaciente), 10); 
        $idTerapeuta = intval(preg_replace('/[^0-9]+/', '', $idTerapeuta), 10); 

        $start2 = Carbon::parse($start)->timestamp;
        $end2 = Carbon::parse($end)->timestamp;

        for ($i = $start2; $i <= $end2; $i += 86400) {

            $diff = $end2 - $start2;
            $diff = $diff % 86400;
            $start3 = date('Y/m/d H:i:s', $i);
            $end3 = $i + $diff;
            $end3 = date('Y/m/d H:i:s', $end3);

            DB::table('events')->insert(['title' => $idServicio, 'idPaciente' => $idPaciente, 'idEspecialista' => $idTerapeuta, 'description' => $description, 'color' => $color, 'textColor' => $textColor, 'start' => $start3, 'end' => $end3]);

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

        $user = auth()->user()->id;
        $rol = auth()->user()->rol;
        if ($rol == 'Admin' || $rol == 'Administrativo') {
            $events = Event::select('events.id', 'events.title as idServicio', 'servicios.servicio as title','pacientes.nombre as nombrePaciente','users.name as nombreEspecialista','pacientes.telefono as telPaciente','users.name as nomEsp','events.start','events.end','events.color','events.description')
                ->join('pacientes', 'events.idPaciente', '=', 'pacientes.id')
                ->join('users', 'events.idEspecialista', '=', 'users.id')
                ->join('servicios', 'servicios.id', '=', 'events.title')
                ->get();
        }else{
            $events = Event::select('events.id', 'events.title as idServicio', 'servicios.servicio as title','pacientes.nombre as nombrePaciente','users.name as nombreEspecialista','pacientes.telefono as telPaciente','users.name as nomEsp','events.start','events.end','events.color','events.description')
                ->join('pacientes', 'events.idPaciente', '=', 'pacientes.id')
                ->join('users', 'events.idEspecialista', '=', 'users.id')
                ->join('servicios', 'servicios.id', '=', 'events.title')
                ->where('users.id', '=', $user)
                ->get();
        }

        return $events;
        
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
        $datosEvento = request()->only(['title','description','color','textColor','start','end']);
        
        $idServicio = request()->get('title');
        $description = request()->get('description');
        $color = request()->get('color');
        $textColor = request()->get('textColor');
        $start = (request()->get('start'));
        $end = (request()->get('end'));

        $idServicio = intval(preg_replace('/[^0-9]+/', '', $idServicio), 10);

        $datosEvento = ['title' => $idServicio,'description' => $description,'color' => $color,'textColor' => $textColor,'start' => $start,'end' => $end];

        $respuesta = Event::where('id',$id)->update($datosEvento);
        
        return response()->json($respuesta);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Event::destroy($id);

        return response()->json($id);
    }
}
