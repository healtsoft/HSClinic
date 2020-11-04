@extends('layouts.admin')

@section('content')
    <div class="content fondob">
        <div class="pa fondob">
            <div class="col-md-auto">
                <table class="table">
                    <thead class="">
                        <tr>
                            <th class="centext" scole="col">Nombre</th>
                            <th class="centext" scole="col">Rol</th>
                            <th class="centext" scole="col">E-mail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuario as $user)
                            <tr class="centext">
                                <td class="centext" scole="col">{{ $user->name }}</td>
                                <td class="centext" scole="col">{{ $user->rol }}</td>
                                <td class="centext" scole="col">{{ $user->email }}</td>
                                <td>
                                    <a href="" class="btn btn-dark d-block w-100 mb-2">Editar</a>
                                    <eliminar-usuario
                                        servicio-id={{ $user->id }}
                                    ></eliminar-usuario>
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
