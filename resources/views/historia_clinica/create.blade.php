@extends('layouts.px')

@section('content')
    <script type="text/javascript">
        $(function() {
            $(".accordion-titulo").click(function(e) {

                e.preventDefault();

                var contenido = $(this).next(".accordion-content");

                if (contenido.css("display") == "none") { //open		
                    contenido.slideDown(250);
                    $(this).addClass("open");
                } else { //close		
                    contenido.slideUp(250);
                    $(this).removeClass("open");
                }

            });
        });
        a = 0;

        function addCancion() {
            a++;

            var div = document.createElement('div');
            div.setAttribute('class', 'form-inline');
            div.innerHTML =
                '<div style="clear:both" col-md-offset-1 col-md-6"><input class="form-control" placeholder="Pregunta" id="pregunta_' +
                a + '" name="pregunta_' + a + '" type="text"/></div><div class="respuesta_' + a +
                ' col-md-2""><input class="form-control" placeholder="Respuesta"id="respuesta_' + a + '" name="respuesta_' +
                a + '" type="text"/></div>';
            document.getElementById('canciones').appendChild(div);
            document.getElementById('canciones').appendChild(div);
        }

    </script>

    <div class="content">
        <div class="colback fondob">


            {{-- <div class="container col-md-6">				<!-- Preguntas Extras -->

                <div class="row">
                    <h3>Preguntas Extras</h3>
                    <div class="col-md-1"><input type="button" class="btn btn-success" id="add_cancion()"
                            onClick="addCancion()" value="+" /></div>
                </div>
                <!-- El id="canciones" indica que la función de JavaScript dejará aquí el resultado -->
                <div class="row" id="canciones">
                </div>
            </div> --}}


            <div id="container-main">

                <form method="POST" action="{{ route('hc.store', $report->id) }}" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <h2 class="text-center mb-5">Historia Clinica del paciente: {{ $report->nombre }}</h2>

                        <div class="accordion-container">			<!-- Datos Personales -->
                            <a href="" class="accordion-titulo">Datos Personales<span class="toggle-icon"></span></a>
                            <div class="accordion-content">
                                <div class="form-group mt-3">
                                    <label for="PersonalesFotoUrl">Elige la imagen</label>
                                    <input id="PersonalesFotoUrl" type="file" class="form-control" name="PersonalesFotoUrl">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="PersonalesDomicilio" class="form-control" id="PersonalesDomicilio"
                                        placeholder="Domicilio" required value={{ old('PersonalesDomicilio') }}>
                                </div>
                                <div class="form-group">
                                    <input type="text" list="sexo" name="PersonalesSexo" class="form-control" id="PersonalesSexo" placeholder="Sexo"
                                        required value={{ old('PersonalesSexo') }}>
                                    <datalist id="sexo">
                                        <option>Masculino</option>
                                        <option>Femenino</option>
                                    </datalist>
                                </div>
                                <div class="form-group">
                                    <input type="text" list="estadoCivil" name="PersonalesEstadoCivil" class="form-control" id="PersonalesEstadoCivil"
                                        placeholder="Estado Civil" required value={{ old('PersonalesEstadoCivil') }}>
                                    <datalist id="estadoCivil">
                                        <option>Soltero</option>
                                        <option>Casado</option>
                                        <option>Divorciado</option>
                                        <option>Separación en proceso judicial</option>
                                        <option>Viudo</option>
                                        <option>Concubinato</option>
                                    </datalist>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="PersonalesOcupacion" class="form-control" id="PersonalesOcupacion"
                                        placeholder="Ocupacion" required value={{ old('PersonalesOcupacion') }}>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="PersonalesEstudios" class="form-control" id="PersonalesEstudios"
                                        placeholder="Grado de Estudios" required value={{ old('PersonalesEstudios') }}>
								</div>
								<div class="form-group">
                                    <input type="text" list="tsangre" name="PersonalesTipoSangre" class="form-control" id="PersonalesTipoSangre" placeholder="Tipo de Sangre" required
                                        value={{ old('PersonalesTipoSangre') }}>
                                    <datalist id="tsangre">
                                        <option>A+</option>
                                        <option>A-</option>
                                        <option>B+</option>
                                        <option>B-</option>
                                        <option>O+</option>
                                        <option>O-</option>
                                        <option>AB+</option>
                                        <option>AB-</option>
                                    </datalist>
								</div>
								<div class="form-group">
                                    <input type="hidden" name="idPaciente" class="form-control" id="idPaciente"
                                        value={{ $report->id }}>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-container">			<!-- Datos Patologicos -->
                            <a href="#" class="accordion-titulo">Datos Patologicos<span class="toggle-icon"></span></a>
                            <div class="accordion-content">
                                <div class="form-group">
                                    <input type="text" name="PatologicosEnfermedades" class="form-control"
                                        id="PatologicosEnfermedades" placeholder="Antecedentes Patologicos" required
                                        value={{ old('PatologicosEnfermedades') }}>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="PatologicosHeredofamiliares" class="form-control"
                                        id="PatologicosHeredofamiliares" placeholder="Enfermedades Heredofamiliares"
                                        required value={{ old('PatologicosHeredofamiliares') }}>
								</div>
								<div class="form-group">
                                    <input type="text" name="PatologicosMedicamentos" class="form-control" id="PatologicosMedicamentos"
                                        placeholder="Medicamentos" required value={{ old('PatologicosMedicamentos') }}>
                                </div>
								<div class="form-group">
                                    <input type="text" name="PatologicosCirugias" class="form-control" id="PatologicosCirugias"
                                        placeholder="Cirugias" required value={{ old('PatologicosCirugias') }}>
                                </div>
                                <div class="form-group">
                                    <input type="text" list="bandera" name="PatologicosTipoBandera" class="form-control" id="PatologicosTipoBandera"
                                        placeholder="Tipo de Bandera" required value={{ old('PatologicosTipoBandera') }}>
                                    <datalist id="bandera">
                                        <option>Bandera Roja</option>
                                        <option>Bandera Naranja</option>
                                        <option>Bandera Amarilla</option>
                                        <option>Bandera Azul</option>
                                        <option>Bandera Negra</option>
                                        <option>Bandera Rosa</option>
                                    </datalist>
								</div>
								<div class="form-group">
                                    <input type="text" name="PatologicosAlcohol" class="form-control" id="PatologicosAlcohol"
                                        placeholder="¿Consume Alcohol?" required value={{ old('PatologicosAlcohol') }}>
								</div>
								<div class="form-group">
                                    <input type="text" name="PatologicosCigarro" class="form-control" id="PatologicosCigarro"
                                        placeholder="¿Fuma?" required value={{ old('PatologicosCigarro') }}>
								</div>
								<div class="form-group">
                                    <input type="text" name="PatologicosDrogas" class="form-control" id="PatologicosDrogas"
                                        placeholder="¿Consume Drogas?" required value={{ old('PatologicosDrogas') }}>
								</div>
								<div class="form-group">
                                    <input type="text" name="PatologicosFracturas" class="form-control" id="PatologicosFracturas"
                                        placeholder="¿Ha tenido alguna Fractura?" required value={{ old('PatologicosFracturas') }}>
								</div>
                            </div>
                        </div>

                        <div class="accordion-container">			<!-- Datos de Consulta -->
                            <a href="#" class="accordion-titulo">Datos de Consulta<span class="toggle-icon"></span></a>
                            <div class="accordion-content">
                                <div class="form-group">
                                    <input type="text" name="ConsultaMotivoConsulta" class="form-control" id="ConsultaMotivoConsulta"
                                        placeholder="Motivo de Consulta" required value={{ old('ConsultaMotivoConsulta') }}>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="ConsultaCausaMolestia" class="form-control" id="ConsultaCausaMolestia"
                                        placeholder="Causa de la Molestia" required value={{ old('ConsultaCausaMolestia') }}>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="ConsultaInicioMolestia" class="form-control" id="ConsultaInicioMolestia"
                                        placeholder="Inicio de la Molestia" required value={{ old('ConsultaInicioMolestia') }}>
								</div>
								<div class="form-group">
                                    <input type="text" name="ConsultaTtoPrevio" class="form-control" id="ConsultaTtoPrevio"
                                        placeholder="Tratamiento Previo" required value={{ old('ConsultaTtoPrevio') }}>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="ConsultaCausaAumento" class="form-control" id="ConsultaCausaAumento"
                                        placeholder="Accion que aumenta el Dolor" required value={{ old('ConsultaCausaAumento') }}>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="ConsultaCausaDisminuye" class="form-control" id="ConsultaCausaDisminuye"
                                        placeholder="Accion que disminuye el Dolor" required value={{ old('ConsultaCausaDisminuye') }}>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="ConsultaAlteracionesMarcha" class="form-control" id="ConsultaAlteracionesMarcha"
                                        placeholder="Alteraciones de la Marcha" required value={{ old('ConsultaAlteracionesMarcha') }}>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="ConsultaDispositivoAsistencia" class="form-control" id="ConsultaDispositivoAsistencia"
                                        placeholder="El paciente acude con algun Dispositivo de Asistencia" required value={{ old('ConsultaDispositivoAsistencia') }}>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-container">			<!-- Diagnostico y Tratamiento -->
                            <a href="#" class="accordion-titulo">Diagnostico y Tratamiento<span
                                    class="toggle-icon"></span></a>
                            <div class="accordion-content">
                                <div class="form-group">
                                    <input type="text" name="TtoDxMedico" class="form-control"
                                        id="TtoDxMedico" placeholder="Diagnostico Medico" required
                                        value={{ old('TtoDxMedico') }}>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="TtoDxFisio" class="form-control"
                                        id="TtoDxFisio" placeholder="Diagnostico Fisioterapeutico"
                                        required value={{ old('TtoDxFisio') }}>
								</div>
								<div class="form-group">
                                    <input type="text" name="TtoCodigoCie" class="form-control" id="TtoCodigoCie"
                                        placeholder="Codigo CIE10" required value={{ old('TtoCodigoCie') }}>
                                </div>
								<div class="form-group">
                                    <input type="text" name="TtoTratamiento" class="form-control" id="TtoTratamiento"
                                        placeholder="Tratamiento" required value={{ old('TtoTratamiento') }}>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="TtoObjetivoTto" class="form-control" id="TtoObjetivoTto"
                                        placeholder="Objetivos de Tratamiento" required value={{ old('TtoObjetivoTto') }}>
								</div>
								<div class="form-group">
                                    <input type="text" name="TtoComentarios" class="form-control" id="TtoComentarios"
                                        placeholder="Comentarios del Tratamiento" required value={{ old('TtoComentarios') }}>
								</div>
								<div class="form-group">
                                    <input type="text" name="TtoNumeroSesiones" class="form-control" id="TtoNumeroSesiones"
                                        placeholder="Numero de Sesiones" required value={{ old('TtoNumeroSesiones') }}>
								</div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" value="Guardar">
                        </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modales de Signos y Notas -->

    <div class="modal fade" id="cnote">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Nueva Nota</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form method="POST" action="/paciente/{{ $report->id }}/nota" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="titulo">Nota Terapeutica</label>
                            <textarea type="text" name="nota" class="form-control" id="nota"
                                placeholder="Nota Terapeutica" required value={{ old('nota') }} cols="30" rows="6">
                    </textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cestudio">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Subir Estudio</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form method="POST" action="/paciente/{{ $report->id }}/estudio" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <textarea type="text" name="nombre" class="form-control" id="nombre"
                                placeholder="Nombre" required value={{ old('nombre') }}>
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="desc">Descripcion</label>
                            <textarea type="text" name="desc" class="form-control" id="desc"
                                placeholder="Descripcion" required value={{ old('desc') }}>
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="Estudio"><b>Archivo: </b></label><br>
                            <input type="file" name="Estudio" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="sv">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Registro de Signos Vitales</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form method="POST" action="/paciente/{{ $report->id }}/sv">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group col-md-12">
                            <label for="temperatura">Temperatura</label>
                            <input type="text" name="temperatura" class="form-control" id="temperatura"
                                placeholder="Temperatura" required value={{ old('temperatura') }}>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="pulso">Pulso</label>
                            <input type="text" name="pulso" class="form-control" id="pulso" placeholder="Pulso" required
                                value={{ old('pulso') }}>

                        </div>
                        <div class="form-group col-md-12">
                            <label for="fr">Frecuencia Respiratoria</label>
                            <input type="text" name="fr" class="form-control"
                                id="fr" placeholder="Frecuencia Respiratoria" required
                                value={{ old('fr') }}>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="glucosa">Glucosa</label>
                            <input type="text" name="glucosa" class="form-control" id="glucosa" placeholder="Glucosa"
                                required value={{ old('glucosa') }}>
                        </div>
                        <div class="form-group col-md-auto">
                            Presion Sanguinea
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" name="ps" class="form-control" id="ps"
                                placeholder="Sistolica" required value={{ old('ps') }}>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" name="pd" class="form-control" id="pd"
                                placeholder="Diastolica" required value={{ old('pd') }}>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('paciente.create')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.nav_btn').click(function() {
                $('.mobile_nav_items').toggleClass('active');
            });
        });

    </script>
@endsection