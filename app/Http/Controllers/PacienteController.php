<?php

namespace App\Http\Controllers;

use App\Nota;
use App\Dolor;
use App\Paciente;
use App\SignosVital;
use App\DatosConsulta;
use App\DatosPersonal;
use App\DatosPatologico;
use App\DatosTto;
use App\Estudio;
use App\Expediente;
use App\Pregunta;
use App\h_clinica;
use App\HCPX;
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

        $dp = Paciente::select(
            'pacientes.id as PacienteId',
            'pacientes.nombre as PacienteNombre',
            'pacientes.fechaNacimiento as PacienteFechaNacimiento',
            'pacientes.procedencia as PacienteProcedencia',
            'pacientes.correo as PacienteCorreo',
            'pacientes.telefono as PacienteTelefono',
            'pacientes.idEspecialista as PacienteIdEspecialista'

        )
            ->where('pacientes.idEspecialista', '=', $usuario->id)
            ->orderby('pacientes.id','DESC')
            ->get();

        return view('paciente.index')
            ->with('pacientes', $pacientes)
            ->with('dp', $dp)
            ->with('usuario', $usuario);
    }


    public function model()
    {
        $pacientes = DB::table('pacientes')->get()->pluck('nombre', 'fechaNacimiento', 'telefono');

        return view('paciente.models')->with('pacientes', $pacientes);
    }

    public function allUsers()
    {
        return Paciente::all();
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

    public function storeHCPX(Request $request)
    {
        $idHC = request()->get('idHC');
        $idHC = intval(preg_replace('/[^0-9]+/', '', $idHC), 10);

        $hcpx = new HCPX();
        $hcpx->idPaciente = $request->idPx;
        $hcpx->idEspecialista = Auth::user()->id;
        $hcpx->idHC = $idHC;

        $hcpx->save();

        $idhcpx = $hcpx->id;

        $respF = "N/A";
        $resultados2 = 0;
        $consulta2 = Pregunta::select(
            'preguntas.id'
        )
            ->join('h_clinicas', 'h_clinicas.id' , '=', 'preguntas.idHC')
            ->where('preguntas.idHC', '=', $idHC)
            ->pluck('id');

        $count = Pregunta::count();
        foreach($consulta2 as $id){
            $expedientes = new Expediente;
            $expedientes->idPregunta = $id;
            $expedientes->respuesta = "N/A";
            $expedientes->idHCPX = $idhcpx;

            $expedientes->save();
        }

        return redirect( URL::previous() )->with('success', 'Paciente Creado con Exito');

    }

    public function storeNPx(Request $request)
    {
        $ruta_imagen = ('../images/sf.jpg');

        $pacientes = new Paciente();
        $pacientes->nombre = $request->nombre;
        $pacientes->fechaNacimiento = "Sin datos";
        $pacientes->correo = "Sin datos";
        $pacientes->procedencia = "Sin datos";
        $pacientes->seguro = "Sin datos";
        $pacientes->telefono = $request->telefono;
        $pacientes->fotoUrl = $ruta_imagen;
        $pacientes->domicilio = "Sin datos";
        $pacientes->sexo = "Sin datos";
        $pacientes->estadoCivil = "Sin datos";
        $pacientes->ocupacion = "Sin datos";
        $pacientes->estudios = "Sin datos";
        $pacientes->tipoSangre = "Sin datos";
        $pacientes->idEspecialista = Auth::user()->id;

        $pacientes->save();

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
        $ruta_imagen = ('../images/sf.jpg');

        $pacientes = new Paciente();
        $pacientes->nombre = $request->nombre;
        $pacientes->fechaNacimiento = "Sin datos";
        $pacientes->correo = "Sin datos";
        $pacientes->procedencia = "Sin datos";
        $pacientes->seguro = "Sin datos";
        $pacientes->telefono = $request->telefono;
        $pacientes->fotoUrl = $ruta_imagen;
        $pacientes->domicilio = "Sin datos";
        $pacientes->sexo = "Sin datos";
        $pacientes->estadoCivil = "Sin datos";
        $pacientes->ocupacion = "Sin datos";
        $pacientes->estudios = "Sin datos";
        $pacientes->tipoSangre = "Sin datos";
        $pacientes->idEspecialista = Auth::user()->id;

        $pacientes->save();



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
        $usuario = auth()->user();
        //dd($paciente);
        $hc = Paciente::select(
            'pacientes.id as PacienteId',
            'pacientes.nombre as PacienteNombre',
            'pacientes.fechaNacimiento as PacienteFechaNacimiento',
            'pacientes.correo as PacienteCorreo',
            'pacientes.telefono as PacienteTelefono',
            'pacientes.idEspecialista as PacienteIdEspecialista'
        )
            ->where('pacientes.id', '=', $paciente->id)
            ->where('pacientes.idEspecialista', $usuario->id)
            ->take(1)
            ->get();

        $notas = Nota::select(
            'notas.id',
            'notas.nota',
            'notas.created_at'
        )
            ->where('notas.idPaciente', '=', $paciente->id)
            ->orderby('created_at','DESC')
            ->take(6)
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

        $estudios = Estudio::select(
            'estudios.id',
            'estudios.nombre',
            'estudios.descripcion',
            'estudios.estudioUrl'
        )
            ->where('estudios.idPaciente', '=', $paciente->id)
            ->orderby('created_at','DESC')
            ->take(6)
            ->get();

        $hcp = h_clinica::select(
            'h_clinicas.id',
            'h_clinicas.nombre'
        )
            ->orderby('created_at','DESC')
            ->get();

        $hcpxes = h_clinica::select(
            'h_clinicas.id',
            'h_clinicas.nombre',
            'h_c_p_x_e_s.idPaciente',
            'h_c_p_x_e_s.id as idhcp'
        )
            ->join('h_c_p_x_e_s', 'h_c_p_x_e_s.idHC' , '=', 'h_clinicas.id')
            ->where('h_c_p_x_e_s.idPaciente', '=', $paciente->id)
            ->get();

        $posts2 = Pregunta::select(
            'preguntas.pregunta as Preg'
        )
            ->join('h_c_p_x_e_s', 'h_c_p_x_e_s.idHC' , '=', 'preguntas.idHC')
            ->join('h_clinicas', 'h_clinicas.id' , '=', 'preguntas.idHC')
            ->where('h_c_p_x_e_s.idPaciente', '=', $paciente->id)
            ->where('h_c_p_x_e_s.idHC', '=', 'preguntas.idHC')
            ->get();

        $idpa = $paciente->id;
        //$consulta = DB::select("select p.pregunta from preguntas p inner join h_c_p_x_e_s hc on p.idHC = hc.idHC where hc.idHC = p.idHC AND hc.idPaciente = 43;");
        //$sql = "select hc.nombre from h_clinicas hc inner join h_c_p_x_e_s hcp on hc.id = hcp.idHC where hcp.idPaciente = ?";
        $consulta = DB::select('select p.pregunta from preguntas p inner join h_c_p_x_e_s hc on p.idHC = hc.idHC where hc.idHC = p.idHC AND hc.idPaciente = 43');

        return view('paciente.show', [
            'report' => $paciente
        ])->with('hc', $hc)->with('estudios', $estudios)->with('notas', $notas)
        ->with('signos', $signos)->with('hcp', $hcp)
        ->with('posts2', $posts2)->with('consulta', $consulta)
        ->with('hcpxes', $hcpxes);
    }

    public function showhcp(Paciente $paciente, h_clinica $h_clinica, Nota $nota, HCPX $hcpx)
    {
        $usuario = auth()->user();


        $hcpxes = h_clinica::select(
            'h_clinicas.id',
            'h_clinicas.nombre',
            'h_c_p_x_e_s.idPaciente'
        )
            ->join('h_c_p_x_e_s', 'h_c_p_x_e_s.idHC' , '=', 'h_clinicas.id')
            ->where('h_c_p_x_e_s.idPaciente', '=', $paciente->id)
            ->get();

        $idhcpx2 = Pregunta::select(
            'expedientes.idHCPX as idhc',
            'h_c_p_x_e_s.id'
        )
            ->join('h_clinicas', 'h_clinicas.id' , '=', 'preguntas.idHC')
            ->join('h_c_p_x_e_s', 'h_c_p_x_e_s.idHC' , '=', 'h_clinicas.id')
            ->join('expedientes', 'expedientes.idHCPX' , '=', 'h_c_p_x_e_s.id')
            ->where('h_c_p_x_e_s.idPaciente', '=', $paciente->id)
            ->where('preguntas.idHC', '=', $h_clinica->id)
            ->distinct()
            ->get();

        $posts2 = Pregunta::select(
            'preguntas.id as idPregunta',
            'preguntas.pregunta as Preg',
            'h_c_p_x_e_s.id as hcpx',
            'expedientes.idHCPX as idhc',
            'expedientes.respuesta as resp'
        )
            ->join('h_clinicas', 'h_clinicas.id' , '=', 'preguntas.idHC')
            ->join('h_c_p_x_e_s', 'h_c_p_x_e_s.idHC' , '=', 'h_clinicas.id')
            ->join('expedientes', 'expedientes.idHCPX' , '=', 'h_c_p_x_e_s.id')
            ->where('h_c_p_x_e_s.idPaciente', '=', $paciente->id)
            ->where('preguntas.idHC', '=', $h_clinica->id)
            ->where('expedientes.idHCPX', '=', $hcpx->id)
            ->distinct()
            ->get();


        $preguntas = Pregunta::select(
            'preguntas.id as idPregunta',
            'preguntas.pregunta as Preg',
            'h_clinicas.id as idHC'
        )
            ->join('h_clinicas', 'h_clinicas.id' , '=', 'preguntas.idHC')
            ->where('preguntas.idHC', '=', $h_clinica->id)
            ->get();


        $idpa = $paciente->id;
        //$consulta = DB::select("select p.pregunta from preguntas p inner join h_c_p_x_e_s hc on p.idHC = hc.idHC where hc.idHC = p.idHC AND hc.idPaciente = 43;");
        //$sql = "select hc.nombre from h_clinicas hc inner join h_c_p_x_e_s hcp on hc.id = hcp.idHC where hcp.idPaciente = ?";
        $consulta = DB::select('select p.pregunta from preguntas p inner join h_c_p_x_e_s hc on p.idHC = hc.idHC where hc.idHC = p.idHC AND hc.idPaciente = 43');

        return view('paciente.llenadoPreguntas', [
            'report' => $paciente
        ])
        ->with('posts2', $posts2)->with('consulta', $consulta)
        ->with('hcpxes', $hcpxes);
    }

    public function hcpxcreate(Request $request)
    {

        $titlename = $request->respuesta;

        for($i=0; $i < count($titlename);$i++) {
            DB::table('expedientes')
                ->join('h_c_p_x_e_s', 'expedientes.idHCPX' , '=', 'h_c_p_x_e_s.id')
                ->join('preguntas', 'expedientes.idPregunta' , '=', 'preguntas.id')
                ->where('expedientes.idHCPX', '=', $request->hcpx)
                ->where('expedientes.idPregunta', '=', $request->idPregunta)
                ->distinct()
                ->update(['respuesta' => strtolower(str_replace('.', '' , $titlename[$i]))]);
            }

        //$datos_a_insertar = array();
        //$datos = array();
        //foreach ($request->respuesta as $key => $sport)
        //{
        //    $datos_a_insertar[$key]['respuesta'] = $sport;
        //    $datos[$key]['respuesta'] = $sport;
        //}
        //DB::table('expedientes')->update($datos);

        return redirect( URL::previous() )->with('success', 'Paciente Creado con Exito');
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
        $cambio = request()->only(['nombre','fechaNacimiento','correo', 'procedencia','telefono']);

        $respuesta = Paciente::where('id',$paciente->id)->update($cambio);
        return redirect( URL::previous() )->with('success', 'Paciente Creado con Exito');
    }

    public function updateUser(Request $request, User $user)
    {
        $cambio = request()->only(['name','rol','email']);

        $respuesta = User::where('id',$user->id)->update($cambio);
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
