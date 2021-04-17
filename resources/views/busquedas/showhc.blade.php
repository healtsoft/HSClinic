<div class="col-md-auto">
    <table class="table">
        @foreach ($hc as $historia)
            <div class="cardPx padre2 center divle">
                <div class="hijo2 col-md-12">
                    <h1>{{ $historia->nombre }}</h1>
                    <a href="/hclinica/{{ $historia->id }}/index" class="btn btnIndexPx col-md-10 mup2">Ver Preguntas</a><br>
                    <a href="#" data-toggle="modal" data-target="#editPx{{ $historia->id }}" class="btn btnIndexPx col-md-10">Editar Preguntas</a>
                    <a href="#" data-toggle="modal" data-target="#editPx{{ $historia->id }}" class="btn btnDeletePx col-md-10">Eliminar</a>
                    <div class="modal fade" id="editPx{{ $historia->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4>Editar datos del Paciente</h4>
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <form method="POST" action="/paciente/update/{{ $historia->id }}">
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
