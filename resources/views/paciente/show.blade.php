@extends('layouts.px')

@section('content')

    <div class="content fondob">
        <div class="pa fondob">
            <div class="col-md-6 hi divd">             <!--Diagnostico-->
                <table class="table">
                    <thead>
                        <tr>
                            <th colspan="2" class="centext"><img class="iconm" src="../images/estetoscopio.png" width="30" height="30">   Diagnostico</th>
                        </tr>
                    </thead>
                    <tbody class="sizetxpx">
                        @foreach ($hc as $datos)
                            <tr>
                                <td class="">Dx Medico: {{ $datos->TtoDxMedico }}</td>
                                <td class="">Dx Fisioterapeutico:{{ $datos->TtoDxFisio }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-md-6 hi divd">             <!--Tratamiento y Comentarios del mismo-->
                <table class="table colorw">
                    <thead>
                        <tr>
                            <th class="centext" scole="col"><img class="iconm" src="../images/tratamiento.png" width="30" height="30">   Tratamiento</th>
                        </tr>
                    </thead>
                    <tbody class="sizetxpx">
                        @foreach ($hc as $datos)
                            <tr>
                                <td class="">{{ $datos->TtoTratamiento }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-md-6 hi divd">             <!--Signos Vitales-->
                <table class="table colorw">
                    <thead class="centext">
                        <tr>
                            <th colspan="2" scope="colgroup"><img class="iconm" src="../images/ritmo.png" width="30" height="30">   Signos Vitales</th>
                        </tr>
                    </thead>
                    <tbody class="centext sizetxpx">
                        @foreach ($signos as $sig)
                            <tr>
                                <td><img class="iconm" src="../images/corazon.png" width="20" height="20">          {{ $sig->pulso }} bPM </td>
                                <td><img class="iconm" src="../images/pulmones.png" width="20" height="20">          {{ $sig->frecuenciaRespiratoria }} rPM </td>
                            </tr>
                            <tr>
                                <td><img class="iconm" src="../images/o2.png" width="20" height="20">          {{ $sig->glucosa }}% </td>
                                <td><img class="iconm" src="../images/temperatura.png" width="20" height="20">          {{ $sig->temperatura }}°C </td>
                            </tr>
                            <tr>
                                <td class="centext"><img class="iconm" src="../images/corazon.png" width="20" height="20">          {{ $sig->presionSistolica }}/{{ $sig->presionDiastolica }}</td>
                            </tr>
                            
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-md-6 hi divd">             <!--Otros Datos-->
                <table class="table colorw">
                    <thead>
                        <tr>
                            <th class="centext" scole="col"><img class="iconm" src="../images/otros.png" width="30" height="30">   Otros datos</th>
                        </tr>
                    </thead>
                    <tbody class="sizetxpx">
                        @foreach ($hc as $datos)
                            <tr>
                                <td class="">Motivo de Consulta: {{ $datos->ConsultaMotivoConsulta }}</td>
                            </tr>
                            <tr>
                                <td class="">Causa de Molestia: {{ $datos->ConsultaCausaMolestia }}</td>
                            </tr>
                        @endforeach
                        @foreach ($dolor as $dol)
                            <tr>
                                <td class="">Nivel de Dolor: {{ $dol->nivelDolor }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-md-12">             <!--Notas-->
                <table class="table colorw">
                    <thead>
                        <tr>
                            <th class="centext" colspan="2" scole="col"><img class="iconm" src="../images/notas.png" width="30" height="30">   Notas</th>
                        </tr>
                    </thead>
                    <tbody class="sizetxpx">
                        @foreach ($notas as $nota)
                            <tr>
                                <td class=""><label cols="40" rows="4">{{ $nota->nota }}</label></td>
                                <td class="">{{ $nota->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



        
    <div>                   <!-- Modales de Signos y Notas -->
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
