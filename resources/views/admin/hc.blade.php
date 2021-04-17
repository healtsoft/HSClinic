@extends('layouts.lte')

@section('content')
    <div class="">
        <div>
            <h1 class="aliizq">Historias Clinicas</h1>
            <a href="#" data-toggle="modal" data-target="#createHC" class="btn btn-primary alider">Crear nueva Historia Clinica</a>
            <br><br><br><br><br>
        </div>
        <div id="resultados" class="bg-light border">
            @include('busquedas.showhc')
        </div>
    </div>
    @include('paciente.create')

<script>
    window.addEventListener('load',function(){
        document.getElementById("texto").addEventListener("keyup", () => {
            fetch(`/buscar/px?texto=${document.getElementById("texto").value}`,{
                    method:'get'
                })
            .then(response => response.text() )
            .then(html => {
                document.getElementById("resultados").innerHTML = html  })
        })
    });
</script>

<div class="modal fade" id="createHC">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
				<h4>Crear nueva Historia Clinica</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
			</div>
			<form method="POST" action="{{ route('hcp.create') }}" enctype="multipart/form-data">
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
				</div>
				<div class="modal-footer">
					<input type="submit" class="btn btn-primary" value="Guardar">
				</div>
			</form>
        </div>
    </div>
</div>
@endsection
