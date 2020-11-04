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
                                    <input id="PersonalesFotoUrl" type="file" class="form-control" name="PersonalesFotoUrl" required autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="PersonalesDomicilio" class="form-control" id="PersonalesDomicilio"
                                        placeholder="Domicilio" required autocomplete="off" autocomplete="off" value={{ old('PersonalesDomicilio') }}>
                                </div>
                                <div class="form-group">
                                    <input type="text" list="sexo" name="PersonalesSexo" class="form-control" id="PersonalesSexo" placeholder="Sexo"
                                        required autocomplete="off" autocomplete="off" value={{ old('PersonalesSexo') }}>
                                    <datalist id="sexo">
                                        <option>Masculino</option>
                                        <option>Femenino</option>
                                    </datalist>
                                </div>
                                <div class="form-group">
                                    <input type="text" list="estadoCivil" name="PersonalesEstadoCivil" class="form-control" id="PersonalesEstadoCivil"
                                        placeholder="Estado Civil" required autocomplete="off" autocomplete="off" value={{ old('PersonalesEstadoCivil') }}>
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
                                        placeholder="Ocupacion" required autocomplete="off" autocomplete="off" value={{ old('PersonalesOcupacion') }}>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="PersonalesEstudios" class="form-control" id="PersonalesEstudios"
                                        placeholder="Grado de Estudios" required autocomplete="off" autocomplete="off" value={{ old('PersonalesEstudios') }}>
								</div>
								<div class="form-group">
                                    <input type="text" list="tsangre" name="PersonalesTipoSangre" class="form-control" id="PersonalesTipoSangre" placeholder="Tipo de Sangre" required autocomplete="off"
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
                                        id="PatologicosEnfermedades" placeholder="Antecedentes Patologicos" required autocomplete="off"
                                        value={{ old('PatologicosEnfermedades') }}>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="PatologicosHeredofamiliares" class="form-control"
                                        id="PatologicosHeredofamiliares" placeholder="Enfermedades Heredofamiliares"
                                        required autocomplete="off" value={{ old('PatologicosHeredofamiliares') }}>
								</div>
								<div class="form-group">
                                    <input type="text" name="PatologicosMedicamentos" class="form-control" id="PatologicosMedicamentos"
                                        placeholder="Medicamentos" required autocomplete="off" value={{ old('PatologicosMedicamentos') }}>
                                </div>
								<div class="form-group">
                                    <input type="text" name="PatologicosCirugias" class="form-control" id="PatologicosCirugias"
                                        placeholder="Cirugias" required autocomplete="off" value={{ old('PatologicosCirugias') }}>
                                </div>
                                <div class="form-group">
                                    <input type="text" list="bandera" name="PatologicosTipoBandera" class="form-control" id="PatologicosTipoBandera"
                                        placeholder="Tipo de Bandera" required autocomplete="off" value={{ old('PatologicosTipoBandera') }}>
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
                                        placeholder="¿Consume Alcohol?" required autocomplete="off" value={{ old('PatologicosAlcohol') }}>
								</div>
								<div class="form-group">
                                    <input type="text" name="PatologicosCigarro" class="form-control" id="PatologicosCigarro"
                                        placeholder="¿Fuma?" required autocomplete="off" value={{ old('PatologicosCigarro') }}>
								</div>
								<div class="form-group">
                                    <input type="text" name="PatologicosDrogas" class="form-control" id="PatologicosDrogas"
                                        placeholder="¿Consume Drogas?" required autocomplete="off" value={{ old('PatologicosDrogas') }}>
								</div>
								<div class="form-group">
                                    <input type="text" name="PatologicosFracturas" class="form-control" id="PatologicosFracturas"
                                        placeholder="¿Ha tenido alguna Fractura?" required autocomplete="off" value={{ old('PatologicosFracturas') }}>
								</div>
                            </div>
                        </div>

                        <div class="accordion-container">			<!-- Datos de Consulta -->
                            <a href="#" class="accordion-titulo">Datos de Consulta<span class="toggle-icon"></span></a>
                            <div class="accordion-content">
                                <div class="form-group">
                                    <input type="text" name="ConsultaMotivoConsulta" class="form-control" id="ConsultaMotivoConsulta"
                                        placeholder="Motivo de Consulta" required autocomplete="off" value={{ old('ConsultaMotivoConsulta') }}>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="ConsultaCausaMolestia" class="form-control" id="ConsultaCausaMolestia"
                                        placeholder="Causa de la Molestia" required autocomplete="off" value={{ old('ConsultaCausaMolestia') }}>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="ConsultaInicioMolestia" class="form-control" id="ConsultaInicioMolestia"
                                        placeholder="Inicio de la Molestia" required autocomplete="off" value={{ old('ConsultaInicioMolestia') }}>
								</div>
								<div class="form-group">
                                    <input type="text" name="ConsultaTtoPrevio" class="form-control" id="ConsultaTtoPrevio"
                                        placeholder="Tratamiento Previo" required autocomplete="off" value={{ old('ConsultaTtoPrevio') }}>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="ConsultaCausaAumento" class="form-control" id="ConsultaCausaAumento"
                                        placeholder="Accion que aumenta el Dolor" required autocomplete="off" value={{ old('ConsultaCausaAumento') }}>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="ConsultaCausaDisminuye" class="form-control" id="ConsultaCausaDisminuye"
                                        placeholder="Accion que disminuye el Dolor" required autocomplete="off" value={{ old('ConsultaCausaDisminuye') }}>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="ConsultaAlteracionesMarcha" class="form-control" id="ConsultaAlteracionesMarcha"
                                        placeholder="Alteraciones de la Marcha" required autocomplete="off" value={{ old('ConsultaAlteracionesMarcha') }}>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="ConsultaDispositivoAsistencia" class="form-control" id="ConsultaDispositivoAsistencia"
                                        placeholder="El paciente acude con algun Dispositivo de Asistencia" required autocomplete="off" value={{ old('ConsultaDispositivoAsistencia') }}>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-container">			<!-- Diagnostico y Tratamiento -->
                            <a href="#" class="accordion-titulo">Diagnostico y Tratamiento<span
                                    class="toggle-icon"></span></a>
                            <div class="accordion-content">
                                <div class="form-group">
                                    <input type="text" name="TtoDxMedico" class="form-control"
                                        id="TtoDxMedico" placeholder="Diagnostico Medico" required autocomplete="off"
                                        value={{ old('TtoDxMedico') }}>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="TtoDxFisio" class="form-control"
                                        id="TtoDxFisio" placeholder="Diagnostico Fisioterapeutico"
                                        required autocomplete="off" value={{ old('TtoDxFisio') }}>
								</div>
								<div class="form-group">
                                    <input type="text" name="TtoCodigoCie" class="form-control" id="TtoCodigoCie"
                                        placeholder="Codigo CIE10" required autocomplete="off" value={{ old('TtoCodigoCie') }}>
                                </div>
								<div class="form-group">
                                    <input type="text" name="TtoTratamiento" class="form-control" id="TtoTratamiento"
                                        placeholder="Tratamiento" required autocomplete="off" value={{ old('TtoTratamiento') }}>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="TtoObjetivoTto" class="form-control" id="TtoObjetivoTto"
                                        placeholder="Objetivos de Tratamiento" required autocomplete="off" value={{ old('TtoObjetivoTto') }}>
								</div>
								<div class="form-group">
                                    <input type="text" name="TtoComentarios" class="form-control" id="TtoComentarios"
                                        placeholder="Comentarios del Tratamiento" required autocomplete="off" value={{ old('TtoComentarios') }}>
								</div>
								<div class="form-group">
                                    <input type="text" name="TtoNumeroSesiones" class="form-control" id="TtoNumeroSesiones"
                                        placeholder="Numero de Sesiones" required autocomplete="off" value={{ old('TtoNumeroSesiones') }}>
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
                                placeholder="Nota Terapeutica" required autocomplete="off" value={{ old('nota') }} cols="30" rows="6">
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
    
    <div class="modal fade" id="cdolor">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Registro de Dolor</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form method="POST" action="/paciente/{{ $report->id }}/dolor" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <label>Nivel del Dolor (Escala ENA)</label>
                        <div class="form-group">
                            <input type="button" name="testradios" class="form-control colorb col-md-1 divle btn1" id="radio1"
                            value="1">
                            <input type="button" name="testradios" class="form-control colorb col-md-1 divle btn1" id="radio2"
                            value="2">
                            <input type="button" name="testradios" class="form-control colorb col-md-1 divle btn1" id="radio3"
                            value="3">
                            <input type="button" name="testradios" class="form-control colorb col-md-1 divle btn1" id="radio4"
                            value="4">
                            <input type="button" name="testradios" class="form-control colorb col-md-1 divle btn2" id="radio5"
                            value="5">
                            <input type="button" name="testradios" class="form-control colorb col-md-1 divle btn2" id="radio6"
                            value="6">
                            <input type="button" name="testradios" class="form-control colorb col-md-1 divle btn2" id="radio7"
                            value="7">
                            <input type="button" name="testradios" class="form-control colorb col-md-1 divle btn3" id="radio8"
                            value="8">
                            <input type="button" name="testradios" class="form-control colorb col-md-1 divle btn3" id="radio9"
                            value="9">
                            <input type="button" name="testradios" class="form-control colorb col-md-1 btn3" id="radio10"
                            value="10">
                            <input type="hidden" name="dolor" id="dolor">
                        </div>
                        <script type="text/javascript">
                            $(document).ready(function()
                                {
                                    $("#radio1").click(function () {	 
                                        $("#dolor").val($("#radio1").val());
                                        $("#formulario").submit();
                                    });
                                    $("#radio2").click(function () {	 
                                        $("#dolor").val($("#radio2").val());
                                        $("#formulario").submit();
                                    });
                                    $("#radio3").click(function () {	 
                                        $("#dolor").val($("#radio3").val());
                                        $("#formulario").submit();
                                    });
                                    $("#radio4").click(function () {	 
                                        $("#dolor").val($("#radio4").val());
                                        $("#formulario").submit();
                                    });
                                    $("#radio5").click(function () {	 
                                        $("#dolor").val($("#radio5").val());
                                        $("#formulario").submit();
                                    });
                                    $("#radio6").click(function () {	 
                                        $("#dolor").val($("#radio6").val());
                                        $("#formulario").submit();
                                    });
                                    $("#radio7").click(function () {	 
                                        $("#dolor").val($("#radio7").val());
                                        $("#formulario").submit();
                                    });
                                    $("#radio8").click(function () {	 
                                        $("#dolor").val($("#radio8").val());
                                        $("#formulario").submit();
                                    });
                                    $("#radio9").click(function () {	 
                                        $("#dolor").val($("#radio9").val());
                                        $("#formulario").submit();
                                    });
                                    $("#radio10").click(function () {	 
                                        $("#dolor").val($("#radio10").val());
                                        $("#formulario").submit();
                                    });
                                 });
                        </script>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" id="boton" class="btn btn-primary" value="Guardar">
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
                                placeholder="Nombre" required autocomplete="off" value={{ old('nombre') }}>
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="desc">Descripcion</label>
                            <textarea type="text" name="desc" class="form-control" id="desc"
                                placeholder="Descripcion" required autocomplete="off" value={{ old('desc') }}>
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="Estudio"><b>Archivo: </b></label><br>
                            <input type="file" name="Estudio" required autocomplete="off">
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
                                placeholder="Temperatura" required autocomplete="off" value={{ old('temperatura') }}>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="pulso">Pulso</label>
                            <input type="text" name="pulso" class="form-control" id="pulso" placeholder="Pulso" required autocomplete="off"
                                value={{ old('pulso') }}>

                        </div>
                        <div class="form-group col-md-12">
                            <label for="fr">Frecuencia Respiratoria</label>
                            <input type="text" name="fr" class="form-control"
                                id="fr" placeholder="Frecuencia Respiratoria" required autocomplete="off"
                                value={{ old('fr') }}>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="glucosa">Glucosa</label>
                            <input type="text" name="glucosa" class="form-control" id="glucosa" placeholder="Glucosa"
                                required autocomplete="off" value={{ old('glucosa') }}>
                        </div>
                        <div class="form-group col-md-auto">
                            Presion Sanguinea
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" name="ps" class="form-control" id="ps"
                                placeholder="Sistolica" required autocomplete="off" value={{ old('ps') }}>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" name="pd" class="form-control" id="pd"
                                placeholder="Diastolica" required autocomplete="off" value={{ old('pd') }}>
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