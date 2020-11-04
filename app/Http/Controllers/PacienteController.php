<?php

namespace App\Http\Controllers;

use App\Nota;
use App\Dolor;
use App\Paciente;
use App\SignosVital;
use App\HistoriaClinica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PacienteController extends Controller
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
    public function index(Request $request)
    {
        $usuario = auth()->user();

        // Recetas con paginación
        $pacientes = Paciente::where('idEspecialista', $usuario->id)
            ->orderBy('id','desc')
            ->paginate(5);

        return view('paciente.index')
            ->with('pacientes', $pacientes)
            ->with('usuario', $usuario);
    }

    public function search(Request $request)
    {
        $usuario = auth()->user();
        // $busqueda = $request['buscar'];
        $busqueda = $request->get('buscar');

        $pacientes = Paciente::where('idEspecialista', $usuario->id)
            ->orderBy('created_at','desc')
            ->where('nombre', 'like', '%' . $busqueda . '%')
            ->paginate(5);
        $pacientes->appends(['buscar' => $busqueda]);
        //$events = Event::all()->toJson();

        return view('busquedas.show', compact('pacientes', 'busqueda'));
    }

    public function model()
    {
        $pacientes = DB::table('pacientes')->get()->pluck('nombre', 'fechaNacimiento', 'telefono');

        return view('paciente.models')->with('pacientes', $pacientes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pacientes = DB::table('pacientes')->get()->pluck('id');

        return view('paciente.create')->with('pacientes', $pacientes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request();
        DB::table('pacientes')->insert([
            'nombre' => $data['nombre'],
            'fechaNacimiento' => $data['fecha_nacimiento'],
            'correo' => $data['correo'],
            'telefono' => $data['telefono'],
            'idEspecialista' => Auth::user()->id
        ]);

        /*almacenar en la BD(con modelo)
        auth()->user()->pacientes()->create([
            'nombre' => $data['nombre'],
            'fechaNacimiento' => $data['fecha_nacimiento'],
            'correo' => $data['correo'],
            'telefono' => $data['telefono'],
        ]);*/

        return redirect( URL::previous() )->with('success', 'Paciente Creado con Exito');
    }

    public function registroNuevo(Request $request)
    {
        $data = request();
        DB::table('users')->insert([
            'name' => $data['name'],
            'rol' => $data['rol'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        return redirect( URL::previous() )->with('success', 'Paciente Creado con Exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Paciente  $paciente
     * @param  \App\Nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function show(Paciente $paciente, Nota $nota)
    {
        $hc = Paciente::select(
            'pacientes.id as PacienteId',
            'pacientes.nombre as PacienteNombre',
            'pacientes.fechaNacimiento as PacienteFechaNacimiento',
            'pacientes.correo as PacienteCorreo',
            'pacientes.telefono as PacienteTelefono',
            'pacientes.idEspecialista as PacienteIdEspecialista',
            'datos_personals.id as PersonalesId',
            'datos_personals.fotoUrl as PersonalesFotoUrl',
            'datos_personals.domicilio as PersonalesDomicilio',
            'datos_personals.sexo as PersonalesSexo',
            'datos_personals.estadoCivil as PersonalesEstadoCivil',
            'datos_personals.ocupacion as PersonalesOcupacion',
            'datos_personals.estudios as PersonalesEstudios',
            'datos_personals.tipoSangre as PersonalesTipoSangre',
            'historia_clinicas.id as idHC',
            'datos_patologicos.id as idPatologicos',
            'datos_patologicos.enfermedades as PatologicosEnfermedades',
            'datos_patologicos.heredofamiliares as PatologicosHeredofamiliares',
            'datos_patologicos.medicamentos as PatologicosMedicamentos',
            'datos_patologicos.cirugias as PatologicosCirugias',
            'datos_patologicos.tipoBandera as PatologicosTipoBandera',
            'datos_patologicos.alcohol as PatologicosAlcohol',
            'datos_patologicos.cigarro as PatologicosCigarro',
            'datos_patologicos.drogas as PatologicosDrogas',
            'datos_patologicos.fracturas as PatologicosFracturas',
            'datos_consultas.id as idConsulta',
            'datos_consultas.motivoConsulta as ConsultaMotivoConsulta',
            'datos_consultas.causaMolestia as ConsultaCausaMolestia',
            'datos_consultas.inicioMolestia as ConsultaInicioMolestia',
            'datos_consultas.ttoPrevio as ConsultaTtoPrevio',
            'datos_consultas.causaAumento as ConsultaCausaAumento',
            'datos_consultas.causaDisminuye as ConsultaCausaDisminuye',
            'datos_consultas.nivelDolor as ConsultaNivelDolor',
            'datos_consultas.alteracionesMarcha as ConsultaAlteracionesMarcha',
            'datos_consultas.disposotivoAsistencia as ConsultaDispositivoAsistencia',
            'datos_ttos.id as idTto',
            'datos_ttos.dxMedico as TtoDxMedico',
            'datos_ttos.dxFisio as TtoDxFisio',
            'datos_ttos.codigoCie as TtoCodigoCie',
            'datos_ttos.tratamiento as TtoTratamiento',
            'datos_ttos.objetivoTto as TtoObjetivoTto',
            'datos_ttos.comentarios as TtoComentarios',
            'datos_ttos.numeroSesiones as TtoNumeroSesiones'
        )
            ->join('datos_personals', 'datos_personals.idPaciente', '=', 'pacientes.id')
            ->join('historia_clinicas', 'pacientes.id', '=', 'historia_clinicas.idPaciente')
            ->join('datos_patologicos', 'historia_clinicas.idPatologicos', '=', 'datos_patologicos.id')
            ->join('datos_consultas', 'datos_consultas.id', '=', 'historia_clinicas.idConsulta')
            ->join('datos_ttos', 'datos_ttos.id', '=', 'historia_clinicas.idTto')
            ->where('pacientes.id', '=', $paciente->id)
            ->orderby('historia_clinicas.created_at','DESC')
            ->take(1)
            ->get();

        $notas = Nota::select(
            'notas.id',
            'notas.nota',
            'notas.created_at'
        )
            ->where('notas.idPaciente', '=', $paciente->id)
            ->orderby('created_at','DESC')
            ->take(3)
            ->get();

        $dolor = Dolor::select(
            'dolors.nivelDolor',
        )
            ->where('dolors.idPaciente', '=', $paciente->id)
            ->orderby('created_at','DESC')
            ->take(1)
            ->get();

        $signos = SignosVital::select(
            'signos_vitals.id',
            'signos_vitals.temperatura',
            'signos_vitals.pulso',
            'signos_vitals.frecuenciaRespiratoria',
            'signos_vitals.presionSistolica',
            'signos_vitals.presionDiastolica',
            'signos_vitals.glucosa',
            'signos_vitals.created_at'
        )
            ->where('signos_vitals.idPaciente', '=', $paciente->id)
            ->orderby('created_at','DESC')
            ->take(1)
            ->get();

        return view('paciente.show', [
            'report' => $paciente
        ])->with('hc', $hc)->with('notas', $notas)->with('signos', $signos)->with('dolor', $dolor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function edit(Paciente $paciente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paciente $paciente)
    {
        $cambio = request()->only(['nombre','fechaNacimiento','correo','telefono']);

        $respuesta = Paciente::where('id',$paciente->id)->update($cambio);
        return redirect( URL::previous() )->with('success', 'Paciente Creado con Exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paciente $paciente)
    {
        $paciente->delete();

        return redirect( URL::previous() )->with('success', 'Paciente Creado con Exito');
    }

    public function destroyUser(User $user)
    {
        $user->delete();

        return redirect( URL::previous() )->with('success', 'Paciente Creado con Exito');
    }
}