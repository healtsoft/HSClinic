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
            'pacientes.idEspecialista as PacienteIdEspecialista',
            'datos_personals.id as PersonalesId',
            'datos_personals.fotoUrl as PersonalesFotoUrl',
            'datos_personals.domicilio as PersonalesDomicilio',
            'datos_personals.sexo as PersonalesSexo',
            'datos_personals.estadoCivil as PersonalesEstadoCivil',
            'datos_personals.ocupacion as PersonalesOcupacion',
            'datos_personals.estudios as PersonalesEstudios',
            'datos_personals.tipoSangre as PersonalesTipoSangre'

        )
            ->join('datos_personals', 'datos_personals.idPaciente', '=', 'pacientes.id')
            ->where('pacientes.idEspecialista', '=', $usuario->id)
            ->orderby('pacientes.id','DESC')
            ->get();

        return view('paciente.index')
            ->with('pacientes', $pacientes)
            ->with('dp', $dp)
            ->with('usuario', $usuario);
    }

    public function buscador(Request $request){
        $usuario = auth()->user();
        $dp = Paciente::select(
            'pacientes.id as PacienteId',
            'pacientes.nombre as PacienteNombre',
            'pacientes.fechaNacimiento as PacienteFechaNacimiento',
            'pacientes.procedencia as PacienteProcedencia',
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
            'datos_personals.tipoSangre as PersonalesTipoSangre'

        )
            ->join('datos_personals', 'datos_personals.idPaciente', '=', 'pacientes.id')
            ->where('pacientes.idEspecialista', '=', $usuario->id)
            ->where('nombre', 'like', '%' . $request->texto . '%')
            ->orderby('pacientes.id','DESC')
            ->get();

        return view("busquedas.show",compact("dp"));
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

    public function storeHCPX(Request $request)
    {
        $idHC = request()->get('idHC');
        $idHC = intval(preg_replace('/[^0-9]+/', '', $idHC), 10);

        $hcpx = new HCPX();
        $hcpx->idPaciente = $request->idPx;
        $hcpx->idEspecialista = Auth::user()->id;
        $hcpx->idHC = $idHC;

        $hcpx->save();

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

        $idPx = $pacientes->id;

        $ruta_imagen = ('../images/sf.jpg');
        $datosPersonales = new DatosPersonal(); # Crear nuevo modelo
        # Ponerle los datos para guardar
        $datosPersonales->fotoUrl = $ruta_imagen;
        $datosPersonales->domicilio = "Sin datos";
        $datosPersonales->sexo = "Sin datos";
        $datosPersonales->estadoCivil = "Sin datos";
        $datosPersonales->ocupacion = "Sin datos";
        $datosPersonales->estudios = "Sin datos";
        $datosPersonales->tipoSangre = "Sin datos";
        $datosPersonales->idPaciente = $idPx;
        # Guardar en BD
        $datosPersonales->save();
        # ==================================
        # Aquí tenemos el id recién guardado :)
        # ==================================
        $idDatosPersonales = $datosPersonales->id;

        #Datos patologicos
        $datosPatologicos = new DatosPatologico(); # Crear nuevo modelo
        # Ponerle los datos para guardar
        $datosPatologicos->enfermedades = "Sin datos";
        $datosPatologicos->heredofamiliares = "Sin datos";
        $datosPatologicos->medicamentos = "Sin datos";
        $datosPatologicos->cirugias = "Sin datos";
        $datosPatologicos->tipoBandera = "Sin datos";
        $datosPatologicos->alcohol = "Sin datos";
        $datosPatologicos->cigarro = "Sin datos";
        $datosPatologicos->drogas = "Sin datos";
        $datosPatologicos->fracturas = "Sin datos";
        # Guardar en BD
        $datosPatologicos->save();
        # ==================================
        # Aquí tenemos el id recién guardado :)
        # ==================================
        $idDatosPatologicos = $datosPatologicos->id;

        #Datos de consulta
        $datosConsulta = new DatosConsulta(); # Crear nuevo modelo
        # Ponerle los datos para guardar
        $datosConsulta->motivoConsulta = "Sin datos";
        $datosConsulta->causaMolestia = "Sin datos";
        $datosConsulta->inicioMolestia = "Sin datos";
        $datosConsulta->ttoPrevio = "Sin datos";
        $datosConsulta->causaAumento = "Sin datos";
        $datosConsulta->causaDisminuye = "Sin datos";
        $datosConsulta->nivelDolor = "Sin datos";
        $datosConsulta->alteracionesMarcha = "Sin datos";
        $datosConsulta->disposotivoAsistencia = "Sin datos";
        # Guardar en BD
        $datosConsulta->save();
        # ==================================
        # Aquí tenemos el id recién guardado :)
        # ==================================
        $idDatosConsulta = $datosConsulta->id;

        #Datos Tto
        $datosTto = new DatosTto(); # Crear nuevo modelo
        # Ponerle los datos para guardar
        $datosTto->dxMedico = "Sin datos";
        $datosTto->dxFisio = "Sin datos";
        $datosTto->codigoCie = "Sin datos";
        $datosTto->tratamiento = "Sin datos";
        $datosTto->objetivoTto = "Sin datos";
        $datosTto->comentarios = "Sin datos";
        $datosTto->numeroSesiones = "0";
        # Guardar en BD
        $datosTto->save();
        # ==================================
        # Aquí tenemos el id recién guardado :)
        # ==================================
        $idDatosTto = $datosTto->id;

         #Historia Clinica
         $hc = new HistoriaClinica(); # Crear nuevo modelo
         # Ponerle los datos para guardar
         $hc->idPaciente = $idPx;
         $hc->idPatologicos = $idDatosPatologicos;
         $hc->idConsulta = $idDatosConsulta;
         $hc->idTto = $idDatosTto;
         # Guardar en BD
         $hc->save();
         # ==================================
         # Aquí tenemos el id recién guardado :)
         # ==================================
         $idHC = $hc->id;

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
        $usuario = auth()->user();
        //dd($paciente);
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

        $dolor = Dolor::select(
            'dolors.nivelDolor'
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
            'h_c_p_x_e_s.idPaciente'
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
        ->with('signos', $signos)->with('dolor', $dolor)->with('hcp', $hcp)
        ->with('posts2', $posts2)->with('consulta', $consulta)
        ->with('hcpxes', $hcpxes);
    }

    public function showhcp(Paciente $paciente, h_clinica $h_clinica, Nota $nota)
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

        $posts2 = Pregunta::select(
            'preguntas.id as idPregunta',
            'preguntas.pregunta as Preg',
            'h_clinicas.id as idHC',
            'h_c_p_x_e_s.idPaciente as idPx'
        )
            ->join('h_clinicas', 'h_clinicas.id' , '=', 'preguntas.idHC')
            ->join('h_c_p_x_e_s', 'h_clinicas.id' , '=', 'h_c_p_x_e_s.idHC')
            ->where('preguntas.idHC', '=', $h_clinica->id)
            ->where('h_c_p_x_e_s.idPaciente', '=', $paciente->id)
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

        $datos_a_insertar = array();
        $datos = array();
        foreach ($request->respuesta as $key => $sport)
        {
            $datos_a_insertar[$key]['respuesta'] = $sport;
            $datos[$key]['respuesta'] = $sport;
            $datos[$key]['idPaciente'] = $request->idPaciente;
            $datos[$key]['idEspecialista'] = $request->idEspecialista;
            $datos[$key]['idHC'] = $request->idHC;
            $datos[$key]['idPregunta'] = $request->idPregunta;
        }
        DB::table('expedientes')->insert($datos);

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
