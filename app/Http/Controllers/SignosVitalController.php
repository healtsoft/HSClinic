<?php

namespace App\Http\Controllers;

use App\Paciente;
use App\SignosVital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class SignosVitalController extends Controller
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
    public function create(Paciente $paciente)
    {
        return view('paciente.create', [
            'report' => $paciente
          ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Paciente $paciente)
    {
        #Datos de consulta
        $signos = new SignosVital(); # Crear nuevo modelo
        # Ponerle los datos para guardar
        $signos->temperatura = $request->temperatura;
        $signos->pulso = $request->pulso;
        $signos->frecuenciaRespiratoria = $request->fr;
        $signos->presionSistolica = $request->ps;
        $signos->presionDiastolica = $request->pd;
        $signos->glucosa = $request->glucosa;
        $signos->idPaciente = $paciente->id;

        # Guardar en BD
        $signos->save();
        #regresamosm el arreglo del registro que se acaba de crear
        return redirect( URL::previous() );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SignosVital  $signosVital
     * @return \Illuminate\Http\Response
     */
    public function show(SignosVital $signosVital)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SignosVital  $signosVital
     * @return \Illuminate\Http\Response
     */
    public function edit(SignosVital $signosVital)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SignosVital  $signosVital
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SignosVital $signosVital)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SignosVital  $signosVital
     * @return \Illuminate\Http\Response
     */
    public function destroy(SignosVital $signosVital)
    {
        //
    }
}
