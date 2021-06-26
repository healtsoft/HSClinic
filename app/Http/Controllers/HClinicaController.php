<?php

namespace App\Http\Controllers;

use App\Expediente;
use App\h_clinica;
use App\Http\Controllers\Controller;
use App\Paciente;
use App\phc;
use App\Pregunta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class HClinicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Paciente $paciente)
    {
        $usuario = auth()->user();

        //$hc = Expediente::select(
        //    'expedientes.idHC as HC',
        //    'expedientes.idPregunta as Pregunta',
        //    'expedientes.respuesta as Respuesta'
        //)
        //    ->get();

        //$posts2 = Expediente::
        //    join('h_clinicas', 'h_clinicas.id', '=', 'expedientes.idHC')
        //    ->join('preguntas', 'preguntas.id', '=', 'expedientes.idPregunta')
        //    ->select('preguntas.pregunta', 'h_clinicas.nombre')
        //    ->where('preguntas.idHC', '=', 'h_clinicas.id')
        //    ->get();

        //$posts3 = h_clinica::
        //    join('preguntas', 'preguntas.idHC', '=', 'h_clinicas.id')
        //    ->select('preguntas.pregunta')
        //    ->where('preguntas.idHC', '=', 'h_clinicas.id')
        //    ->get();

        $hcp = h_clinica::select(
            'h_clinicas.id',
            'h_clinicas.nombre'
        )
            ->orderby('created_at','DESC')
            ->get();

        return view("admin.hc")->with('hc', $hcp);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(h_clinica $h_clinica ,Pregunta $pregunta)
    {
        $usuario = auth()->user();
        $hc = Pregunta::select(
            'preguntas.id',
            'preguntas.pregunta',
            'preguntas.idHC'
        )
            ->where('preguntas.idHC', '=', $h_clinica->id)
            ->orderby('created_at','DESC')
            ->get();

        $hc2 = h_clinica::select(
            'h_clinicas.id',
            'h_clinicas.nombre'
        )
            ->where('h_clinicas.id', '=', $h_clinica->id)
            ->orderby('created_at','DESC')
            ->take(1)
            ->get();

        return view("admin.createhc")->with('hc', $hc)->with('hc2', $hc2);

        //return view('admin.createhc', [
        //    'report' => $h_clinica
        //]);
    }

    public function storeNHC(Request $request)
    {
        $hc = new h_clinica();
        $hc->idEspecialista = Auth::user()->id;
        $hc->nombre = $request->nombre;

        $hc->save();

        return redirect( URL::previous() )->with('success', 'Paciente Creado con Exito');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos_a_insertar = array();
        $datos = array();
        foreach ($request->pregunta as $key => $sport)
        {
            $datos_a_insertar[$key]['pregunta'] = $sport;
            $datos[$key]['pregunta'] = $sport;
            $datos[$key]['idHC'] = $request->idHC;
        }
        DB::table('preguntas')->insert($datos);

        return redirect( URL::previous() )->with('success', 'Paciente Creado con Exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\h_clinica  $h_clinica
     * @return \Illuminate\Http\Response
     */
    public function show(h_clinica $h_clinica)
    {
        $usuario = auth()->user();
        $posts2 = phc::
            join('h_clinicas', 'h_clinicas.id', '=', 'phcs.idHC')
            ->join('preguntas', 'preguntas.id', '=', 'phcs.idPregunta')
            ->select('preguntas.pregunta', 'h_clinicas.nombre', 'h_clinicas.id')
            ->where('preguntas.idHC', '=', 1)
            ->get();
        return view("admin.preghc")->with('hc', $posts2);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\h_clinica  $h_clinica
     * @return \Illuminate\Http\Response
     */
    public function edit(h_clinica $h_clinica)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\h_clinica  $h_clinica
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, h_clinica $h_clinica)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\h_clinica  $h_clinica
     * @return \Illuminate\Http\Response
     */
    public function destroy(h_clinica $h_clinica)
    {
        //
    }
}
