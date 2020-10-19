<div class="modal fade" id="createPx">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
				<h4>Crear Nuevo Paciente</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
			</div>
			<form method="POST" action="{{ route('paciente.store') }}" enctype="multipart/form-data">
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
							value={{ old('nombre') }} >
					</div>
					<div class="form-group">
						<label for="fecha_nacimiento">Fecha de Nacimiento</label>
						<input type="date"
							name="fecha_nacimiento"
							class="form-control"
							id="fecha_nacimiento"
							placeholder="Fecha de Nacimiento"
							required
							value={{ old('fecha_nacimiento') }}>
					</div>
					<div class="form-group">
						<label for="correo">Correo</label>
						<input type="text"
							name="correo"
							class="form-control"
							id="correo"
							placeholder="Correo"
							required
							value={{ old('correo') }}>
					</div>
					<div class="form-group">
						<label for="telefono">Telefono</label>
						<input type="text"
							name="telefono"
							class="form-control"
							id="telefono"
							placeholder="Telefono"
							required
							value={{ old('telefono') }}>
					</div>
				</div>
				<div class="modal-footer">
					<input type="submit" class="btn btn-primary" value="Guardar">
				</div>
			</form>
        </div>
    </div>
</div>

