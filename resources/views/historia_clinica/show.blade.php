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

            <div id="container-main sizetxpx">

                @csrf
                <h2 class="text-center mb-5">Expediente Clinico</h2>
                <div class="accordion-container">                   <!-- Historia Clinica -->
                    <a href="" class="accordion-titulo">Historias Clinica<span class="toggle-icon"></span></a>     
                    <div class="accordion-content"> 
                        @foreach ($hc as $datos)

                        <div class="accordion-container">			<!-- Fecha de cada HC -->
                            <a href="" class="accordion-titulo">{{$datos->fechaHC}}<span class="toggle-icon"></span></a>
                            <div class="accordion-content">
                                <div class="accordion-container">			<!-- Datos Personales -->
                                    <a href="" class="accordion-titulo">Datos Personales<span class="toggle-icon"></span></a>
                                    <div class="accordion-content">
                                        <div class="form-group">
                                            <label>Direccion: {{ $datos->PersonalesDomicilio }}</label>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label>Sexo: {{ $datos->PersonalesSexo }}</label>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label>Estado Civil: {{ $datos->PersonalesEstadoCivil }}</label>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label>Ocupacion: {{ $datos->PersonalesOcupacion }}</label>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label>Estudios: {{ $datos->PersonalesEstudios }}</label>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label>Tipo de Sangre: {{ $datos->PersonalesTipoSangre }}</label>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="accordion-container">			<!-- Datos Patologicos -->
                                    <a href="#" class="accordion-titulo">Datos Patologicos<span class="toggle-icon"></span></a>
                                    <div class="accordion-content">
                                        <div class="form-group">
                                            <label>Enfermedades: {{ $datos->PatologicosEnfermedades }}</label>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label>Antecedentes Heredofamiliares: {{ $datos->PatologicosHeredofamiliares }}</label>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label>Medicamentos: {{ $datos->PatologicosMedicamentos }}</label>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label>Cirugias: {{ $datos->PatologicosCirugias }}</label>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label>Tipo de Bandera: {{ $datos->PatologicosTipoBandera }}</label>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label>¿Consume Alcohol?: {{ $datos->PatologicosAlcohol }}</label>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label>¿Fuma?: {{ $datos->PatologicosCigarro }}</label>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label>¿Consume Drogas?: {{ $datos->PatologicosDrogas }}</label>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label>¿Ha tenido fracturas?: {{ $datos->PatologicosFracturas }}</label>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="accordion-container">			<!-- Datos de Consulta -->
                                    <a href="#" class="accordion-titulo">Datos de Consulta<span class="toggle-icon"></span></a>
                                    <div class="accordion-content">
                                        <div class="form-group">
                                            <label>Motivo de Consulta: {{ $datos->ConsultaMotivoConsulta }}</label>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label>Causa de la Molestia: {{ $datos->ConsultaCausaMolestia }}</label>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label>Inicio de la Molestia: {{ $datos->ConsultaInicioMolestia }}</label>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label>Tratamiento Previos: {{ $datos->ConsultaTtoPrevio }}</label>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label>¿Accion que aumente la Molestia?: {{ $datos->ConsultaCausaAumento }}</label>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label>¿Accion que disminuye la Molestia?: {{ $datos->ConsultaCausaDisminuye }}</label>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label>Nivel de Dolor: {{ $datos->ConsultaNivelDolor }}</label>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label>Alteraciones de la Marcha: {{ $datos->ConsultaAlteracionesMarcha }}</label>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label>¿Ingresa con algun Dispositivo de Asistencia?: {{ $datos->ConsultaDispositivoAsistencia }}</label>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="accordion-container">			<!-- Diagnostico y Tratamiento -->
                                    <a href="#" class="accordion-titulo">Diagnostico y Tratamiento<span
                                            class="toggle-icon"></span></a>
                                    <div class="accordion-content">
                                        <div class="form-group">
                                            <label>Tratamiento Medico: {{ $datos->TtoDxMedico }}</label>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label>Tratamiento Fisioterapeutico: {{ $datos->TtoDxFisio }}</label>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label>Codigo CIE10: {{ $datos->TtoCodigoCie }}</label>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label>Tratamiento: {{ $datos->TtoTratamiento }}</label>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label>Objetivo del Tratamiento: {{ $datos->TtoObjetivoTto }}</label>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label>Comentarios del Tratamiento: {{ $datos->TtoComentarios }}</label>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label>Numero de Sesiones: {{ $datos->TtoNumeroSesiones }}</label>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div>
                            
                                            
                        @endforeach
                    </div>
                </div>
                    
                
                <div class="accordion-container">			<!-- Notas Expediente -->
                    <a href="" class="accordion-titulo">Notas Terapeuticas<span class="toggle-icon"></span></a>
                    <div class="accordion-content">
                        @foreach ($notas as $nota)
                        <div class="form-group">
                            <label>Fecha: {{ $nota->created_at }}</label>
                        </div>
                        <div class="form-group">
                            <label>Nota: {{ $nota->nota }}</label> 
                        </div>
                        <hr>
                        @endforeach
                    </div>
                </div>      
                
                <div class="accordion-container">			<!-- Signos Vitales -->
                    <a href="" class="accordion-titulo">Signos Vitales<span class="toggle-icon"></span></a>
                    <div class="accordion-content">
                        <div class="col-md-12 hi divd">             <!--Signos Vitales-->
                            <table class="table colorw">
                                <thead class="centext">
                                    <tr>
                                        <th colspan="2" scope="colgroup">Signos Vitales</th>
                                    </tr>
                                </thead>
                                <tbody class="centext sizetxpx">
                                    @foreach ($signos as $sig)
                                        <tr>
                                            <td colspan="2">Fecha: {{ $sig->created_at }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ $sig->pulso }} bPM </td>
                                            <td>{{ $sig->frecuenciaRespiratoria }} rPM </td>
                                        </tr>
                                        <tr>
                                            <td>{{ $sig->glucosa }}% </td>
                                            <td>{{ $sig->temperatura }}°C </td>
                                        </tr>
                                        <tr>
                                            <td class="centext">{{ $sig->presionSistolica }}/{{ $sig->presionDiastolica }}</td>
                                        </tr>
                                        
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> 
                
                <div class="accordion-container">			<!-- Estudios -->
                    <a href="" class="accordion-titulo">Estudios<span class="toggle-icon"></span></a>
                    <div class="accordion-content">
                        <div class="col-md-12 hi divd">             <!--Signos Vitales-->
                            @foreach ($report->estudios as $est)
                                <tr>
                                    <iframe width="400" height="400" src="/storage/{{ $est->estudioUrl }}" frameborder="0"></iframe>
                                </tr>
                            @endforeach
                        </div>
                    </div>
                </div> 
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