@extends('layouts.admin')

@section('content')
    <div class="content fondob">
        <div class="pa fondob">
            <div class="col-md-auto">
                <table class="table">
                    <thead class="">
                        <tr>
                            <th class="centext" scole="col">Servicios</th>
                            <th class="centext" scole="col">Costo</th>
                            <th class="centext" scole="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($servicios as $servicio)
                            <tr class="centext">
                                <td class="centext" scole="col">{{ $servicio->servicio }}</td>
                                <td class="centext" scole="col">${{ $servicio->costo }}</td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#editUs{{ $servicio->id }}" class="btn btn-dark d-block w-100 mb-2">Editar</a>
                                    <div class="modal fade" id="editUs{{ $servicio->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4>Editar datos del Servicio</h4>
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="/servicio/update/{{ $servicio->id }}">
                                                    <div class="modal-body">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="servicio">Servicio</label>
                                                            <input type="text"
                                                                name="servicio"
                                                                class="form-control"
                                                                id="servicio"
                                                                placeholder="Servicio"
                                                                required
                                                                value="{{ $servicio->servicio }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="descripcion">Descripcion</label>
                                                            <input type="text"
                                                                name="descripcion"
                                                                class="form-control"
                                                                id="descripcion"
                                                                placeholder="Descripcion"
                                                                required
                                                                value="{{ $servicio->descripcion }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="costo">Costo</label>
                                                            <input type="text"
                                                                name="costo"
                                                                class="form-control"
                                                                id="costo"
                                                                placeholder="Costo"
                                                                required
                                                                value="{{ $servicio->costo }}">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="submit" class="btn btn-primary" value="Actualizar">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <eliminar-servicio
                                        servicio-id={{ $servicio->id }}
                                    ></eliminar-servicio>
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cservicio">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Nuevo Servicio</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form method="POST" action="/admin/servicio" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="servicio" class="form-control" id="servicio"
                                    placeholder="Servicio" required value={{ old('servicio') }}>
                        </div>
                        <div class="form-group">
                            <textarea type="text" name="descripcion" class="form-control" id="descripcion"
                                placeholder="Descripcion del Servicio" required value={{ old('descripcion') }} cols="30" rows="3">
                            </textarea>
                        </div>
                        <div class="form-group">
                            <input type="text" name="costo" class="form-control" id="costo"
                                    placeholder="Costo" required value={{ old('costo') }}>
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
@endsection
