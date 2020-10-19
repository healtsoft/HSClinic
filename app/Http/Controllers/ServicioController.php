<?php

namespace App\Http\Controllers;

use App\Event;
use App\Paciente;
use App\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

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

    public function ingresos()
    {
        // Recetas con paginación
        $servicios = Event::select('servicios.costo as costo')
                ->join('pacientes', 'events.idPaciente', '=', 'pacientes.id')
                ->join('users', 'events.idEspecialista', '=', 'users.id')
                ->join('servicios', 'servicios.id', '=', 'events.title')
                ->groupBy('servicios.costo')
                ->get()
                ;
        $events = Event::select('servicios.servicio as title','servicios.costo as costo','pacientes.nombre as nombrePaciente','users.name as nombreEspecialista','events.start')
                ->join('pacientes', 'events.idPaciente', '=', 'pacientes.id')
                ->join('users', 'events.idEspecialista', '=', 'users.id')
                ->join('servicios', 'servicios.id', '=', 'events.title')
                ->get();

        return view('admin.ingresos')
            ->with('events', $events)
            ->with('servicios', $servicios);
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function show(Servicio $servicio)
    {
        //
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
        //
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
