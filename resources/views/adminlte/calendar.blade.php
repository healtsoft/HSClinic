@extends('layouts.lte')

<!-- Styles -->
@section('styles')
    <link rel="stylesheet" href="{{ asset('fullcalendar/core/main.css') }}">
    <link rel="stylesheet" href="{{ asset('fullcalendar/daygrid/main.css') }}">
    <link rel="stylesheet" href="{{ asset('fullcalendar/list/main.css') }}">
    <link rel="stylesheet" href="{{ asset('fullcalendar/timegrid/main.css') }}">
    <link rel="stylesheet" href="{{ asset('fullcalendar/bootstrap/main.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.6/css/all.css">
    <style>
        .fc-event-container a,
        .fc-list-table .fc-list-item {
            cursor: pointer;
        }

    </style>

@endsection

@section('content')
    <div class="col">
        <h3>Dashboard Mensual</h3>
        <div class="padre">
            <div class="card colorBlue hijo">
                <div class="container">
                  <h1 class="colorWhite"><b>150</b></h1>
                  <p class="colorWhite">Citas registradas</p>
                </div>
            </div>
            <div class="card colorYellow hijo">
                <div class="container">
                    <h1 class="colorWhite"><b>53</b></h1>
                    <p class="colorWhite">Citas concluidas</p>
                </div>
            </div>
        </div>
        <div class="padre">
            <div class="card colorGreen hijo">
                <div class="container">
                    <h1 class="colorWhite"><b>44</b></h1>
                    <p class="colorWhite">Nuevos pacientes</p>
                </div>
            </div>
            <div class="card colorRed hijo">
                <div class="container">
                    <h1 class="colorWhite"><b>$6500.00</b></h1>
                    <p class="colorWhite">Ingresos</p>
                </div>
            </div>
        </div>
    </div>

    <br>
    <br>
    <div class="row">

        <div class="col-md-12 col-sx-12 card2">
            <div id="calendar"></div>
        </div>
        @include('paciente.create')
        @include('paciente.createuser')
    </div>

    <!-- Modal -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Nueva Reservacion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="id" id="id">

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="title">Paciente</label>
                            <input class="form-control" list="colores" autocomplete="off" type="text" name="title" id="title" required>
                            <datalist id="colores">
                                @if ($exist ?? '')
                                    @foreach ($pacientes as $paciente)
                                        <option>{{ $paciente->id }} - {{ $paciente->nombre }}</option>
                                    @endforeach
                                @endif
                            </datalist>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="paciente">Servicio</label>
                            <select class="form-control" type="text" name="paciente" id="paciente" required>
                                @if ($exist ?? '')
                                    @foreach ($servicios as $servicio)
                                        <option>{{ $servicio->id }} - {{ $servicio->servicio }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <br>
                            <label >Telefono</label>
                            <input type="show" class="form-control" name="telpx" id="telpx">
                            <input type="hidden" name="nomEsp" id="nomEsp">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="user">Seleccionar al Especialista</label>
                            <input class="form-control" list="esp" type="text" autocomplete="off" name="terapeuta" id="terapeuta" required>
                            <datalist id="esp">
                                @if ($exist ?? '')
                                    @foreach ($usuarios as $usuario)
                                        <option>{{ $usuario->id }} - {{ $usuario->name }} - {{ $usuario->rol }}</option>
                                    @endforeach
                                @endif
                            </datalist>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="start_date">Fecha Inicio</label>
                            <input class="form-control" type="date" name="start_date" id="start_date" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="start_time">Hora Inicio</label>
                            <input class="form-control" type="time" min="01:00 a.m." max="23:59 p.m." step="600"
                                name="start_time" id="start_time" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="end_date">Fecha Fin</label>
                            <input class="form-control" type="date" name="end_date" id="end_date" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="end_time">Hora Fin</label>
                            <input class="form-control" type="time" min="01:00 a.m." max="23:59 p.m." step="600"
                                name="end_time" id="end_time" required>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="color">Color</label>
                            <input class="form-control" list="listacoloresperfil" type="color" name="color" id="color">

                            <datalist id="listacoloresperfil">

                                <option value="#804372">

                                <option value="#F97B4F">

                                <option value="#F3B435">

                                <option value="#FF3C33">

                                <option value="#8DC6BF">

                                <option value="#CADD64">

                            </datalist>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="estatus">Estatus del Pago</label>
                            <select class="form-control" type="text" name="estatus" id="estatus" autocomplete="off" required>
                                <option value="Efectivo">Efectivo</option>

                                <option value="Cheque">Cheque</option>

                                <option value="Transferencia">Transferencia</option>

                                <option value="Tarjeta de débito">Tarjeta de debito</option>

                                <option value="Tarjeta de crédito">Tarjeta de credito</option>

                                <option value="Pagado">Pagado</option>

                                <option value="Paquete de 10 Sesiones">Paquete de 10 Sesiones</option>

                                <option value="Paquete de 20 Sesiones">Paquete de 20 Sesiones</option>
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="description">Descripción</label>
                            <textarea class="form-control" name="description" id="description" cols="30"
                                rows="3"></textarea>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button id="btnAdd" class="btn btn-success">Add</button>
                    <button onclick="mostrar();" id="btnConf" class="btn btn-success">Confirmar Cita</button>
                    <button id="btnEdit" class="btn btn-warning">Edit</button>
                    <button id="btnDelete" class="btn btn-danger">Delete</button>
                    <button id="btnCancel" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('fullcalendar/core/main.js') }}"></script>
    <script src="{{ asset('fullcalendar/locales/es.js') }}"></script>
    <script src="{{ asset('fullcalendar/interaction/main.js') }}"></script>
    <script src="{{ asset('fullcalendar/daygrid/main.js') }}"></script>
    <script src="{{ asset('fullcalendar/list/main.js') }}"></script>
    <script src="{{ asset('fullcalendar/timegrid/main.js') }}"></script>
    <script src="{{ asset('fullcalendar/bootstrap/main.js') }}"></script>

    <script>
        var url_ = "{{ route('events.index') }}";
        var url_show = "{{ route('events.show', 0) }}";

    </script>

    <script>
        function mostrar() {
            var x = $("#telpx").val();
            var n = $("#nomEsp").val();
            var f = $("#start_date").val();
            var h = $("#start_time").val();
            location.href = ("https://api.whatsapp.com/send?phone=52" + x +
                "&text=Hola!,%20buen%20dia,%20el%20especialista%20" + n +
                "%20le%20recuerda%20su%20cita%20con%20fecha%20" + f + "%20a%20las%20" + h + "%20hrs");
            //alert(x + n);
        }
    </script>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>

@endsection
