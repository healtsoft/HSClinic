<?php

namespace App\Http\Controllers;

use App\Estudio;
use App\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class EstudioController extends Controller
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
    public function store(Request $request, Paciente $paciente)
    {
        $ruta_doc = $request['Estudio']->store('upload-estudio', 'public');
        $estudio = new Estudio();
        $estudio->nombre = $request->get('nombre');
        $estudio->descripcion = $request->get('desc');
        $estudio->estudioUrl = $ruta_doc;
        $estudio->idPaciente = $paciente->id;
        $estudio->save();
        //$data = request();
        //DB::table('notas')->insert([
        //    'nota' => $data['nota'],
        //    'user_id' => Auth::user()->id,
        //    'paciente_id' => $data['$idpx'],
        //]);
        return redirect( URL::previous() )->with('success', 'Paciente Creado con Exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Estudio  $estudio
     * @return \Illuminate\Http\Response
     */
    public function show(Estudio $estudio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Estudio  $estudio
     * @return \Illuminate\Http\Response
     */
    public function edit(Estudio $estudio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Estudio  $estudio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estudio $estudio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Estudio  $estudio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estudio $estudio)
    {
        //
    }
}
