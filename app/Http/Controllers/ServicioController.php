<?php

namespace App\Http\Controllers;

use App\Event;
use App\Paciente;
use App\Pregunta;
use App\Servicio;
use Carbon\Carbon;
use Hamcrest\Core\HasToString;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Foundation\Auth\User;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = auth()->user();

        // Recetas con paginación
        $servicios = Servicio::all();

        return view('admin.index')
            ->with('servicios', $servicios)
            ->with('usuario', $usuario);
    }

    public function showUser()
    {
        $usuario = User::all();
        return view('admin.users')
            ->with('usuario', $usuario);
    }

    public function search(Request $request)
    {
        $usuario = auth()->user();
        // $busqueda = $request['buscar'];
        $busqueda = $request->get('buscar');
        $fs = Carbon::now();
        $fs = $fs->format('d-m-Y');
        $fc = Carbon::now();
        $fc = $fc->format('Y-m-d');
        $servicios = Event::select('servicios.costo as costo')
                ->join('pacientes', 'events.idPaciente', '=', 'pacientes.id')
                ->join('users', 'events.idEspecialista', '=', 'users.id')
                ->join('servicios', 'servicios.id', '=', 'events.title')
                ->where(DB::raw("DATE_FORMAT(events.start,'%Y-%m-%d')"), '=', $busqueda)
                ->get()
                ;

        $events = Event::select('servicios.servicio as title','servicios.costo as costo','pacientes.nombre as nombrePaciente','users.name as nombreEspecialista',DB::raw("DATE_FORMAT(events.start,'%d/%m/%Y')as Fecha"))
                ->join('pacientes', 'events.idPaciente', '=', 'pacientes.id')
                ->join('users', 'events.idEspecialista', '=', 'users.id')
                ->join('servicios', 'servicios.id', '=', 'events.title')
                ->where(DB::raw("DATE_FORMAT(events.start,'%Y-%m-%d')"), '=', $busqueda)
                ->get();

        $fech = Event::select(DB::raw("DATE_FORMAT(events.start,'%d-%m-%Y') as Fecha"))
                ->join('pacientes', 'events.idPaciente', '=', 'pacientes.id')
                ->join('users', 'events.idEspecialista', '=', 'users.id')
                ->join('servicios', 'servicios.id', '=', 'events.title')
                ->where(DB::raw("DATE_FORMAT(events.start,'%Y-%m-%d')"), '=', $busqueda)
                ->take(1)
                ->get();

        return view('admin.buscar', compact('events', 'busqueda', 'servicios', 'fech', 'fc'));
    }

    public function search2(Request $request)
    {
        $usuario = auth()->user();
        // $busqueda = $request['buscar'];
        $busqueda = $request->get('buscar');
        $busqueda2 = $request->get('buscar2');
        $fs = Carbon::now();
        $fs = $fs->format('d-m-Y');
        $fc = Carbon::now();
        $fc = $fc->format('Y-m-d');
        $servicios = Event::select('servicios.costo as costo')
                ->join('pacientes', 'events.idPaciente', '=', 'pacientes.id')
                ->join('users', 'events.idEspecialista', '=', 'users.id')
                ->join('servicios', 'servicios.id', '=', 'events.title')
                ->whereBetween(DB::raw("DATE_FORMAT(events.start,'%Y-%m-%d')"), [$busqueda, $busqueda2])
                ->get()
                ;

        $events = Event::select('servicios.servicio as title','servicios.costo as costo','pacientes.nombre as nombrePaciente','users.name as nombreEspecialista',DB::raw("DATE_FORMAT(events.start,'%d/%m/%Y')as Fecha"))
                ->join('pacientes', 'events.idPaciente', '=', 'pacientes.id')
                ->join('users', 'events.idEspecialista', '=', 'users.id')
                ->join('servicios', 'servicios.id', '=', 'events.title')
                ->whereBetween(DB::raw("DATE_FORMAT(events.start,'%Y-%m-%d')"), [$busqueda, $busqueda2])
                ->get();

        $fech = Event::select(DB::raw("DATE_FORMAT(events.start,'%d-%m-%Y') as Fecha"))
                ->join('pacientes', 'events.idPaciente', '=', 'pacientes.id')
                ->join('users', 'events.idEspecialista', '=', 'users.id')
                ->join('servicios', 'servicios.id', '=', 'events.title')
                ->where(DB::raw("DATE_FORMAT(events.start,'%Y-%m-%d')"), '=', $busqueda)
                ->take(1)
                ->get();

        return view('admin.buscar', compact('events', 'busqueda', 'servicios', 'fech', 'fc'));
    }

    public function ingresos()
    {
        // Recetas con paginación
        $fs = Carbon::now();
        $fs = $fs->format('d-m-Y');

        $fc = Carbon::now();
        $fc = $fc->format('Y-m-d');
        $servicios = Event::select('servicios.costo as costo')
                ->join('pacientes', 'events.idPaciente', '=', 'pacientes.id')
                ->join('users', 'events.idEspecialista', '=', 'users.id')
                ->join('servicios', 'servicios.id', '=', 'events.title')
                ->where(DB::raw("DATE_FORMAT(events.start,'%d-%m-%Y')"), '=', $fs)
                ->get()
                ;

        $grafica = Event::select('servicios.costo as costo','events.start as fech')
                ->join('users', 'events.idEspecialista', '=', 'users.id')
                ->join('servicios', 'servicios.id', '=', 'events.title')
                ->distinct('events.start')
                ->get();

        $g2 = Event::select('servicios.servicio as title', 'events.start as fech')
                ->join('users', 'events.idEspecialista', '=', 'users.id')
                ->join('servicios', 'servicios.id', '=', 'events.title')
                ->where('servicios.servicio', '=', 'Fisioterapia Dermatofuncional')
                ->distinct('events.start')
                ->get();

        $Total = DB::table('events')
                ->join('users', 'events.idEspecialista', '=', 'users.id')
                ->join('servicios', 'servicios.id', '=', 'events.title')
                ->select('servicios.servicio as Servicio', DB::raw('SUM(servicios.costo) as Total'))
                ->distinct('servicios.servicio')
                ->groupBy('servicios.id')
                ->get();

        $TotalxDia = DB::table('events')
                ->join('users', 'events.idEspecialista', '=', 'users.id')
                ->join('servicios', 'servicios.id', '=', 'events.title')
                ->select(DB::raw("DATE_FORMAT(events.start,'%d-%m-%Y') as Fecha, SUM(servicios.costo) as Ganancias"))
                ->distinct('Fecha')
                ->groupBy('events.start')
                ->get();

        $servicioPedido = DB::table('events')
                ->join('users', 'events.idEspecialista', '=', 'users.id')
                ->join('servicios', 'servicios.id', '=', 'events.title')
                ->select('servicios.servicio as Servicio', DB::raw('COUNT(servicios.costo) as Total'))
                ->distinct('servicios.servicio')
                ->groupBy('servicios.id')
                ->get();

        $events = Event::select('servicios.servicio as title','servicios.costo as costo','pacientes.nombre as nombrePaciente','users.name as nombreEspecialista',DB::raw("DATE_FORMAT(events.start,'%d/%m/%Y')as Fecha"))
                ->join('pacientes', 'events.idPaciente', '=', 'pacientes.id')
                ->join('users', 'events.idEspecialista', '=', 'users.id')
                ->join('servicios', 'servicios.id', '=', 'events.title')
                ->where(DB::raw("DATE_FORMAT(events.start,'%d-%m-%Y')"), '=', $fs)
                ->get();

        return view('admin.ingresos')
            ->with('events', $events)
            ->with('Total', $Total)
            ->with('servicios', $servicios)
            ->with('grafica', $grafica)
            ->with('g2', $g2)
            ->with('fs', $fs)
            ->with('fc', $fc)
            ->with('TotalxDia', $TotalxDia)
            ->with('servicioPedido', $servicioPedido)
            ;
    }

    public function graficos()
    {
        // Recetas con paginación
        $fs = Carbon::now();
        $fs = $fs->format('d-m-Y');

        $fc = Carbon::now();
        $fc = $fc->format('Y-m-d');
        $servicios = Event::select('servicios.costo as costo')
                ->join('pacientes', 'events.idPaciente', '=', 'pacientes.id')
                ->join('users', 'events.idEspecialista', '=', 'users.id')
                ->join('servicios', 'servicios.id', '=', 'events.title')
                ->where(DB::raw("DATE_FORMAT(events.start,'%d-%m-%Y')"), '=', $fs)
                ->get()
                ;

        $grafica = Event::select('servicios.costo as costo','events.start as fech')
                ->join('users', 'events.idEspecialista', '=', 'users.id')
                ->join('servicios', 'servicios.id', '=', 'events.title')
                ->distinct('events.start')
                ->get();

        $g2 = Event::select('servicios.servicio as title', 'events.start as fech')
                ->join('users', 'events.idEspecialista', '=', 'users.id')
                ->join('servicios', 'servicios.id', '=', 'events.title')
                ->where('servicios.servicio', '=', 'Fisioterapia Dermatofuncional')
                ->distinct('events.start')
                ->get();

        $Total = DB::table('events')
                ->join('users', 'events.idEspecialista', '=', 'users.id')
                ->join('servicios', 'servicios.id', '=', 'events.title')
                ->select('servicios.servicio as Servicio', DB::raw('SUM(servicios.costo) as Total'))
                ->distinct('servicios.servicio')
                ->groupBy('servicios.id')
                ->get();

        $TotalxDia = DB::table('events')
                ->join('users', 'events.idEspecialista', '=', 'users.id')
                ->join('servicios', 'servicios.id', '=', 'events.title')
                ->select(DB::raw("DATE_FORMAT(events.start,'%d-%m-%Y') as Fecha, SUM(servicios.costo) as Ganancias"))
                ->distinct('Fecha')
                ->groupBy('events.start')
                ->get();

        $servicioPedido = DB::table('events')
                ->join('users', 'events.idEspecialista', '=', 'users.id')
                ->join('servicios', 'servicios.id', '=', 'events.title')
                ->select('servicios.servicio as Servicio', DB::raw('COUNT(servicios.costo) as Total'))
                ->distinct('servicios.servicio')
                ->groupBy('servicios.id')
                ->get();

        $events = Event::select('servicios.servicio as title','servicios.costo as costo','pacientes.nombre as nombrePaciente','users.name as nombreEspecialista',DB::raw("DATE_FORMAT(events.start,'%d/%m/%Y')as Fecha"))
                ->join('pacientes', 'events.idPaciente', '=', 'pacientes.id')
                ->join('users', 'events.idEspecialista', '=', 'users.id')
                ->join('servicios', 'servicios.id', '=', 'events.title')
                ->where(DB::raw("DATE_FORMAT(events.start,'%d-%m-%Y')"), '=', $fs)
                ->get();

        return view('admin.graficas')
            ->with('events', $events)
            ->with('Total', $Total)
            ->with('servicios', $servicios)
            ->with('grafica', $grafica)
            ->with('g2', $g2)
            ->with('fs', $fs)
            ->with('fc', $fc)
            ->with('TotalxDia', $TotalxDia)
            ->with('servicioPedido', $servicioPedido)
            ;
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
        $servicio = new Servicio();
        $servicio->servicio = $request->get('servicio');
        $servicio->descripcion = $request->get('descripcion');
        $servicio->costo = $request->get('costo');
        $servicio->save();
        return redirect( URL::previous() )->with('success', 'Paciente Creado con Exito');
    }

    public function storeP(Request $request)
    {
        $data = request();
        $datos_a_insertar = array();
        $datos_a_insertar2 = array();
        $datos = array();
        foreach ($request->pregunta as $key => $sport)
        {
            $datos_a_insertar[$key]['pregunta'] = $sport;
            $datos_a_insertar2[$key]['respuesta'] = $request->respuesta[$key];
            $datos[$key]['pregunta'] = $sport;
            $datos[$key]['respuesta'] = $request->respuesta[$key];
            $datos[$key]['idHC'] = $request->idHC;
        }
        DB::table('preguntas')->insert($datos);


        return redirect( URL::previous() )->with('success', 'Paciente Creado con Exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function show(Servicio $servicio)
    {
        $usuario = auth()->user();

        // Recetas con paginación
        $servicios = Servicio::all();

        return view('adminlte.index')
            ->with('servicios', $servicios)
            ->with('usuario', $usuario);
    }

    public function showCal(Servicio $servicio)
    {
        $usuario = auth()->user();

        // Recetas con paginación
        $servicios = Servicio::all();

        return view('adminlte.calendar')
            ->with('servicios', $servicios)
            ->with('usuario', $usuario);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function edit(Servicio $servicio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Servicio $servicio)
    {
        $cambio = request()->only(['servicio','descripcion','costo']);

        $respuesta = Servicio::where('id',$servicio->id)->update($cambio);
        return redirect( URL::previous() )->with('success', 'Paciente Creado con Exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Servicio $servicio)
    {
        $servicio->delete();

        return redirect( URL::previous() )->with('success', 'Paciente Creado con Exito');
    }
}
