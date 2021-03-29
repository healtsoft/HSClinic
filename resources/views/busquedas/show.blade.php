<div class="col-md-auto">
    <table class="table">
        @foreach ($dp as $paciente)
            <div class="cardPx padre2 center divle">
                <div class="hijo2 col-md-5">
                    <img src="{{ $paciente->PersonalesFotoUrl }}" class="imgRedonda" alt="User Image" style="width: 100px; height: 100px;">
                    <h3>{{ $paciente->PacienteNombre }}</h3>
                    <h4>{{ $paciente->PacienteFechaNacimiento }}</h4>
                    <h4>{{ $paciente->PacienteCorreo }}</h4>
                    <h4>{{ $paciente->PacienteTelefono }}</h4>
                </div>
                <div class="hijo2 col-md-6 mle2">
                    <a href="/paciente/{{ $paciente->PacienteId }}" class="btn btnIndexPx col-md-10 mup2">Detalle Clinico</a><br>
                    <a href="#" data-toggle="modal" data-target="#editPx{{ $paciente->PacienteId }}" class="btn btnIndexPx col-md-10">Editar</a>
                    <a href="#" data-toggle="modal" data-target="#editPx{{ $paciente->PacienteId }}" class="btn btnDeletePx col-md-10">Eliminar</a>
                    <div class="modal fade" id="editPx{{ $paciente->PacienteId }}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4>Editar datos del Paciente</h4>
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <form method="POST" action="/paciente/update/{{ $paciente->PacienteId }}">
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
                                                value="{{ $paciente->PacienteNombre }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                            <input type="date"
                                                name="fecha_nacimiento"
                                                class="form-control"
                                                id="fecha_nacimiento"
                                                placeholder="Fecha de Nacimiento"
                                                required
                                                value="{{ $paciente->PacienteFechaNacimiento }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="correo">Correo</label>
                                            <input type="text"
                                                name="correo"
                                                class="form-control"
                                                id="correo"
                                                placeholder="Correo"
                                                required
                                                value="{{ $paciente->PacienteCorreo }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="procedencia">Procedencia</label>
                                            <input type="text"
                                                name="procedencia"
                                                class="form-control"
                                                id="procedencia"
                                                placeholder="Procedencia"
                                                required
                                                value="{{ $paciente->PacienteProcedencia }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="telefono">Telefono</label>
                                            <input type="text"
                                                name="telefono"
                                                class="form-control"
                                                id="telefono"
                                                placeholder="Telefono"
                                                required
                                                value="{{ $paciente->PacienteTelefono }}">
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
