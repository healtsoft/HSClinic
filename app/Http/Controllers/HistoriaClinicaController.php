<?php

namespace App\Http\Controllers;

use App\Nota;
use App\User;
use App\DatosTto;
use App\Paciente;
use App\SignosVital;
use App\DatosConsulta;
use App\DatosPersonal;
use App\DatosPatologico;
use App\HistoriaClinica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Intervention\Image\Facades\Image;

class HistoriaClinicaController extends Controller
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
        return view('historia_clinica.create', [
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
        #Guardamos la imagen y le damos un rezize para que no pese mucho
        $ruta_imagen = $request['PersonalesFotoUrl']->store('upload-foto', 'public');
        $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(550, 550);
        $img->save();
        #Datos personales
        $datosPersonales = new DatosPersonal(); # Crear nuevo modelo
        # Ponerle los datos para guardar
        $datosPersonales->fotoUrl = $ruta_imagen;
        $datosPersonales->domicilio = $request->PersonalesDomicilio;
        $datosPersonales->sexo = $request->PersonalesSexo;
        $datosPersonales->estadoCivil = $request->PersonalesEstadoCivil;
        $datosPersonales->ocupacion = $request->PersonalesOcupacion;
        $datosPersonales->estudios = $request->PersonalesEstudios;
        $datosPersonales->tipoSangre = $request->PersonalesTipoSangre;
        $datosPersonales->idPaciente = $request->idPaciente;
        # Guardar en BD
        $datosPersonales->save();
        # ==================================
        # Aquí tenemos el id recién guardado :)
        # ==================================
        $idDatosPersonales = $datosPersonales->id;

        #Datos patologicos
        $datosPatologicos = new DatosPatologico(); # Crear nuevo modelo
        # Ponerle los datos para guardar
        $datosPatologicos->enfermedades = $request->PatologicosEnfermedades;
        $datosPatologicos->heredofamiliares = $request->PatologicosHeredofamiliares;
        $datosPatologicos->medicamentos = $request->PatologicosMedicamentos;
        $datosPatologicos->cirugias = $request->PatologicosCirugias;
        $datosPatologicos->tipoBandera = $request->PatologicosTipoBandera;
        $datosPatologicos->alcohol = $request->PatologicosAlcohol;
        $datosPatologicos->cigarro = $request->PatologicosCigarro;
        $datosPatologicos->drogas = $request->PatologicosDrogas;
        $datosPatologicos->fracturas = $request->PatologicosFracturas;
        # Guardar en BD
        $datosPatologicos->save();
        # ==================================
        # Aquí tenemos el id recién guardado :)
        # ==================================
        $idDatosPatologicos = $datosPatologicos->id;

        #Datos de consulta
        $datosConsulta = new DatosConsulta(); # Crear nuevo modelo
        # Ponerle los datos para guardar
        $datosConsulta->motivoConsulta = $request->ConsultaMotivoConsulta;
        $datosConsulta->causaMolestia = $request->ConsultaCausaMolestia;
        $datosConsulta->inicioMolestia = $request->ConsultaInicioMolestia;
        $datosConsulta->ttoPrevio = $request->ConsultaTtoPrevio;
        $datosConsulta->causaAumento = $request->ConsultaCausaAumento;
        $datosConsulta->causaDisminuye = $request->ConsultaCausaDisminuye;
        $datosConsulta->nivelDolor = $request->ConsultaNivelDolor;
        $datosConsulta->alteracionesMarcha = $request->ConsultaAlteracionesMarcha;
        $datosConsulta->disposotivoAsistencia = $request->ConsultaDispositivoAsistencia;
        # Guardar en BD
        $datosConsulta->save();
        # ==================================
        # Aquí tenemos el id recién guardado :)
        # ==================================
        $idDatosConsulta = $datosConsulta->id;

        #Datos Tto
        $datosTto = new DatosTto(); # Crear nuevo modelo
        # Ponerle los datos para guardar
        $datosTto->dxMedico = $request->TtoDxMedico;
        $datosTto->dxFisio = $request->TtoDxFisio;
        $datosTto->codigoCie = $request->TtoCodigoCie;
        $datosTto->tratamiento = $request->TtoTratamiento;
        $datosTto->objetivoTto = $request->TtoObjetivoTto;
        $datosTto->comentarios = $request->TtoComentarios;
        $datosTto->numeroSesiones = $request->TtoNumeroSesiones;
        # Guardar en BD
        $datosTto->save();
        # ==================================
        # Aquí tenemos el id recién guardado :)
        # ==================================
        $idDatosTto = $datosTto->id;

         #Historia Clinica
         $hc = new HistoriaClinica(); # Crear nuevo modelo
         # Ponerle los datos para guardar
         $hc->idPaciente = $request->idPaciente;
         $hc->idPatologicos = $idDatosPatologicos;
         $hc->idConsulta = $idDatosConsulta;
         $hc->idTto = $idDatosTto;
         # Guardar en BD
         $hc->save();
         # ==================================
         # Aquí tenemos el id recién guardado :)
         # ==================================
         $idHC = $hc->id;
        //return redirect(route('paciente.show', $paciente->id));
        return redirect( URL::previous() )->with('success', 'Paciente Creado con Exito');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\HistoriaClinica  $historiaClinica
     * @return \Illuminate\Http\Response
     */
    public function show(HistoriaClinica $historiaClinica, Paciente $paciente, DatosPersonal $datosPersonal)
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
            ->get();

        $notas = Nota::select(
            'notas.id',
            'notas.nota',
            'notas.created_at'
        )
            ->where('notas.idPaciente', '=', $paciente->id)
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
            ->get();

        return view('historia_clinica.show', [
            'report' => $paciente
        ])->with('hc', $hc)->with('notas', $notas)->with('signos', $signos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HistoriaClinica  $historiaClinica
     * @return \Illuminate\Http\Response
     */
    public function edit(HistoriaClinica $historiaClinica)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HistoriaClinica  $historiaClinica
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HistoriaClinica $historiaClinica)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HistoriaClinica  $historiaClinica
     * @return \Illuminate\Http\Response
     */
    public function destroy(HistoriaClinica $historiaClinica)
    {
        //
    }
}
