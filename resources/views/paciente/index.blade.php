@extends('layouts.pxin')

@section('hero')

    <div class="hero-categorias">
        <form class="container h-100" action={{ route('buscar.show') }}>
            <div class="row h-100 align-items-center">
                <div class="col-md-4 texto-buscar">
                    <p class="display-4">Buscar pacientes por Nombre</p>

                    <input type="search" name="buscar" class="form-control" placeholder="Buscar Paciente" />
                </div>
            </div>
        </form>
    </div>

@endsection

@section('content')

    <div class="col-md-auto">
        <table class="table">
            <thead class="">
                <tr>
                    <th class="centext" scole="col">Nombre</th>
                    <th class="centext" scole="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pacientes as $paciente)
                    <tr class="centext">
                        <td class="centext" scole="col">{{ $paciente->nombre }}</td>
                        <td>
                            <a href="/paciente/{{ $paciente->id }}" class="btn btn-success">Ver</a>
                            <a href="#" data-toggle="modal" data-target="#editPx{{ $paciente->id }}" class="btn btn-dark">Editar</a>
                            <div class="modal fade" id="editPx{{ $paciente->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4>Editar datos del Paciente</h4>
                                            <button type="button" class="close" data-dismiss="modal">
                                                <span>&times;</span>
                                            </button>
                                        </div>
                                        <form method="POST" action="/paciente/update/{{ $paciente->id }}">
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
                                                        value="{{ $paciente->nombre }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                                    <input type="date"
                                                        name="fecha_nacimiento"
                                                        class="form-control"
                                                        id="fecha_nacimiento"
                                                        placeholder="Fecha de Nacimiento"
                                                        required
                                                        value="{{ $paciente->fechaNacimiento }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="correo">Correo</label>
                                                    <input type="text"
                                                        name="correo"
                                                        class="form-control"
                                                        id="correo"
                                                        placeholder="Correo"
                                                        required
                                                        value="{{ $paciente->correo }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="telefono">Telefono</label>
                                                    <input type="text"
                                                        name="telefono"
                                                        class="form-control"
                                                        id="telefono"
                                                        placeholder="Telefono"
                                                        required
                                                        value="{{ $paciente->telefono }}">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" class="btn btn-primary" value="Guardar">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <eliminar-paciente
                                servicio-id={{ $paciente->id }}
                            ></eliminar-paciente>
                        </td>
                    </tr>

                @endforeach
            </tbody>

        </table>
    </div>
    <div class="d-flex justify-content-center mt-5">
        {{ $pacientes->links() }}
    </div>
    @include('paciente.create')
@endsection
