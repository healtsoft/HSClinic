<?php

namespace App\Http\Controllers;

use App\Dolor;
use App\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class DolorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Paciente $paciente)
    {
        return view('paciente.dolor', [
            'report' => $paciente
        ]);
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
        $dolor = new Dolor();
        $dolor->nivelDolor = $request->get('dolor');
        $dolor->zonaDolor = $request->get('zona');
        $dolor->idPaciente = $paciente->id;
        $dolor->save();
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
     * @param  \App\Dolor  $dolor
     * @return \Illuminate\Http\Response
     */
    public function show(Dolor $dolor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dolor  $dolor
     * @return \Illuminate\Http\Response
     */
    public function edit(Dolor $dolor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dolor  $dolor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dolor $dolor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dolor  $dolor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dolor $dolor)
    {
        //
    }
}
