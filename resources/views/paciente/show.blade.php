@extends('layouts.lte')

@section('content')
    <div class="user-panel" style="background-image: url('../images/fondopx.png');background-repeat: no-repeat; background-size: cover;">
        <div class="cajon1 mrigth2">
            @foreach ($hc as $datos)
                <img src="{{ $datos->PersonalesFotoUrl }}" class="img-circle fpx tam" alt="User Image" style="width: 100px; height: 100px;">
            @endforeach
        </div>
        <div class="cajon2">
            @foreach ($hc as $datos)
                <p class="colnG">Nombre: {{ $datos->PacienteNombre }}</p>
                <p class="colnM">Fecha de Nacimiento: {{ $datos->PacienteFechaNacimiento }}</p>
                <p class="colnM">Correo: {{ $datos->PacienteCorreo }}</p>
                <p class="colnM">Telefono: {{ $datos->PacienteTelefono }}</p>
            @endforeach
        </div>
    </div>
    <button class="tablink" onclick="openPage('Home', this, '#3C8DBC')" >Informacion</button>
    <button class="tablink" onclick="openPage('News', this, '#3C8DBC')">Notas</button>
    <button class="tablink" onclick="openPage('Contact', this, '#3C8DBC')">Estudios</button>
    <button class="tablink" onclick="openPage('About', this, '#3C8DBC')" id="defaultOpen">Historia Clinica</button>
    <button class="tablink" onclick="openPage('Exp', this, '#3C8DBC')">Signos Vitales</button>

    <div id="Home" class="tabcontent">
        <div class="pa fondob">
            <div class="col-md-6 card2 hi divd">             <!--Diagnostico-->
                <table class="table">
                    <thead>
                        <tr>
                            <th colspan="2" class="colorBlack centext"><img class="iconm" src="../images/estetoscopio.png" width="30" height="30">   Diagnostico</th>
                        </tr>
                    </thead>
                    <tbody class="sizetxpx">
                        @foreach ($hc as $datos)
                            <tr>
                                <td class="colorBlack">Dx Medico: {{ $datos->TtoDxMedico }}</td>
                                <td class="colorBlack">Dx Fisioterapeutico:{{ $datos->TtoDxFisio }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-md-6 card2 hi divd">             <!--Tratamiento y Comentarios del mismo-->
                <table class="table colorw">
                    <thead>
                        <tr>
                            <th class="colorBlack centext" scole="col"><img class="iconm" src="../images/tratamiento.png" width="30" height="30">   Tratamiento</th>
                        </tr>
                    </thead>
                    <tbody class="sizetxpx">
                        @foreach ($hc as $datos)
                            <tr>
                                <td class="colorBlack">{{ $datos->TtoTratamiento }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-md-6 card2">             <!--Signos Vitales-->
                <table class="table colorw">
                    <thead class="centext">
                        <tr>
                            <th class="colorBlack" colspan="2" scope="colgroup"><img class="iconm" src="../images/ritmo.png" width="30" height="30">   Signos Vitales</th>
                        </tr>
                    </thead>
                    <tbody class="centext colorBlack sizetxpx">
                        @foreach ($signos as $sig)
                            <tr>
                                <td class="colorBlack"><img class="iconm" src="../images/corazon.png" width="20" height="20">          {{ $sig->pulso }} bPM </td>
                                <td class="colorBlack"><img class="iconm" src="../images/pulmones.png" width="20" height="20">          {{ $sig->frecuenciaRespiratoria }} rPM </td>
                            </tr>
                            <tr>
                                <td class="colorBlack"><img class="iconm" src="../images/o2.png" width="20" height="20">          {{ $sig->glucosa }}% </td>
                                <td class="colorBlack"><img class="iconm" src="../images/temperatura.png" width="20" height="20">          {{ $sig->temperatura }}°C </td>
                            </tr>
                            <tr>
                                <td class="colorBlack centext"><img class="iconm" src="../images/corazon.png" width="20" height="20">          {{ $sig->presionSistolica }}/{{ $sig->presionDiastolica }}</td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-md-6 card2 hi divd">             <!--Otros Datos-->
                <table class="table colorw">
                    <thead>
                        <tr>
                            <th class="colorBlack centext" scole="col"><img class="iconm" src="../images/otros.png" width="30" height="30">   Otros datos</th>
                        </tr>
                    </thead>
                    <tbody class=" colorBlack sizetxpx">
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

            <div class="col-md-12 card2">             <!--Notas-->
                <table class="table colorw">
                    <thead>
                        <tr>
                            <th class="colorBlack centext" colspan="2" scole="col"><img class="iconm" src="../images/notas.png" width="30" height="30">   Notas</th>
                        </tr>
                    </thead>
                    <tbody class="colorBlack sizetxpx">
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

    <div id="News" class="tabcontent">
        <div class="pa fondob">
            <h2 class="aliizq colorGrey">Notas Terapeuticas</h2>
            <a class="alider" href="#" data-toggle="modal" data-target="#cnote"><i class="btnnw fas fa-notes-medical"></i></a>
            <br><br><br><br>
            @foreach ($notas as $nota)
                <div class="center cardNotes colorBlack divle">
                    <div>
                        <h3 class="aliizq"><i class="mrigth fas fa-notes-medical"></i>Nota</h3>
                        <h3 class="alider">{{ $nota->created_at }} <a href="#" data-toggle="modal" data-target="#editNota{{ $nota->id }}" class="btn btn-dark"><img class="mlefticon" src="../images/editar.png" style="width: 25px; heigth:20px"></a></h3>
                        <div class="modal fade" id="editNota{{ $nota->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4>Editar datos de la Nota</h4>
                                            <button type="button" class="close" data-dismiss="modal">
                                                <span>&times;</span>
                                            </button>
                                        </div>
                                        <form method="POST" action="/nota/update/{{ $nota->id }}">
                                            <div class="modal-body">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="titulo">Nota</label>

                                                    <textarea name="nota"
                                                    class="form-control"
                                                    id="nota"
                                                    placeholder="nota"
                                                    required
                                                    cols="20"
                                                    rows="10">
                                                    {{ $nota->nota }}
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
                        <br><br><br>
                    </div>
                    <hr>
                    <div style="overflow:scroll;height:160px;width:100%;">
                        <h3 class="">{{ $nota->nota }}</h3>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div id="Contact" class="tabcontent">
        <a href="#" data-toggle="modal" data-target="#cestudio"><i class="btnnw fas fa-x-ray"></i><span>Estudios</span></a>
        <div class="accordion-content">
            <table class="table colorBlack">
                <thead>
                    <tr>
                        <th class="centext" colspan="1" scole="col"><img class="iconm mrigth" src="../images/otros.png" width="30" height="30">Nombre</th>
                        <th class="centext" colspan="1" scole="col"><img class="iconm mrigth" src="../images/otros.png" width="30" height="30">Descripcion</th>
                        <th class="centext" colspan="1" scole="col"><img class="iconm mrigth9+" src="../images/otros.png" width="30" height="30">Estudio</th>
                    </tr>
                </thead>
                @foreach ($estudios as $est)
                    <tr>
                        <td class="centext">{{ $est->nombre }}</td>
                        <td class="centext">{{ $est->descripcion }}</td>
                        <td class="centext"><a class="btnOpen centext" href="#" data-toggle="modal" data-target="#verestudio{{ $est->id }}"><span>Ver Estudio</span></a></td>
                        <div class="modal fade" id="verestudio{{ $est->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="colorBlack">{{ $est->nombre }}</h3>
                                        <h5 class="colorBlack">{{ $est->descripcion }}</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <iframe width="100%" height="550px" src="../storage/{{ $est->estudioUrl }}" frameborder="0"></iframe>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btnClose" data-dismiss="modal">
                                            Cerrar Visualizador
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    <div id="About" class="tabcontent">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <h3 class="aliizq colorGrey">LLenar datos de la historia clinica</h3>
        <a class="alider" href="#" data-toggle="modal" data-target="#hcpx"><i class="btnnw">Asignar nueva Historia Clinica</i></a>
        <br><br><br>
        <div class="colorBlack">
            <table class="table">
                @foreach ($hcpxes as $historia)
                    <div class="cardPx padre2 center divle">
                        <div class="hijo2 col-md-12">
                            <h1>{{ $historia->nombre }}</h1>
                            <a href="/paciente/{{ $historia->idPaciente }}/{{ $historia->id }}/new" class="btn btnIndexPx col-md-10 mup2">Ver Preguntas</a><br>
                            <a href="#" data-toggle="modal" data-target="#editPx{{ $historia->id }}" class="btn btnDeletePx col-md-10">Eliminar</a>
                            <div class="modal fade" id="editPx{{ $historia->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4>LLenar Preguntas del Paciente</h4>
                                            <button type="button" class="close" data-dismiss="modal">
                                                <span>&times;</span>
                                            </button>
                                        </div>
                                        <form method="POST" action="/paciente/{{ $historia->idPaciente }}/{{ $historia->id }}">
                                            <div class="modal-body">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="titulo">Nombre</label>
                                                    <input type="text"
                                                        name="nombre"
                                                        class="form-control"
                                                        id="nombre"
                                                        placeholder="Nombre"
                                                        required
                                                        value="{{ $historia->nombre }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                                    <input type="date"
                                                        name="fecha_nacimiento"
                                                        class="form-control"
                                                        id="fecha_nacimiento"
                                                        placeholder="Fecha de Nacimiento"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="correo">Correo</label>
                                                    <input type="text"
                                                        name="correo"
                                                        class="form-control"
                                                        id="correo"
                                                        placeholder="Correo"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="procedencia">Procedencia</label>
                                                    <input type="text"
                                                        name="procedencia"
                                                        class="form-control"
                                                        id="procedencia"
                                                        placeholder="Procedencia"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="telefono">Telefono</label>
                                                    <input type="text"
                                                        name="telefono"
                                                        class="form-control"
                                                        id="telefono"
                                                        placeholder="Telefono"
                                                        required>
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
                    </div>
                @endforeach
            </table>
        </div>

        <form method="POST" action="/paciente/{paciente}/{h_clinica}/new" enctype="multipart/form-data">
            <div class="field_wrapper colorBlack">
                @csrf
                <div>
                    @foreach ($posts2 as $consulta)
                        <div class="card">
                            {{ $consulta }}
                        </div> <br>
                    @endforeach
                </div>
            </div>
            <br>
            <div>
                <input type="submit" class="btn btn-primary" value="Guardar">
            </div>
        </form>
        <script type="text/javascript">
            $(document).ready(function(){
                var maxField = 10; //Input fields increment limitation
                var x = 1; //Initial field counter is 1
                var addButton = $('.add_button'); //Add button selector
                var wrapper = $('.field_wrapper'); //Input field wrapper
                var fieldHTML = '<div><input type="text" name="field_name['+x+']" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/o2.png"/></a></div>'; //New input field html
                $(addButton).click(function(){ //Once add button is clicked
                    if(x < maxField){ //Check maximum number of input fields
                        x++; //Increment field counter
                        $(wrapper).append('<div><input type="text" name="pregunta[]" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/o2.png"/></a></div>'); // Add field html
                    }
                });
                $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
                    e.preventDefault();
                    $(this).parent('div').remove(); //Remove field html
                    x--; //Decrement field counter
                });
            });
        </script>
        <button class="first">Title Only</button>
        <button class="second">Title and Text</button>
        <button class="third">Title, Text and Icon</button>
    </div>

    <div id="Exp" class="tabcontent">
        <h3>About</h3>
        <p>Who we are and what we do.</p>
    </div>

    <div class="content fondob">


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

        <div class="modal fade" id="hcpx">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Asignar Historia Clinica</h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('paciente.hcpx') }}" enctype="multipart/form-data">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="titulo">Escoja la Historia Clinica a Asignar</label>
                                <select class="form-control" type="text" name="idHC" id="idHC" required>
                                    @foreach ($hcp as $historia)
                                        <option>{{ $historia->id }} - {{ $historia->nombre }}</option>
                                    @endforeach
                                </select>
                                @foreach ($hc as $datos)
                                    <input type="text" name="idPx" id="idPx" value="{{ $datos->PacienteId }}">
                                @endforeach
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
