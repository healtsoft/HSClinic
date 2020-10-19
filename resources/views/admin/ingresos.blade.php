@extends('layouts.admin')

@section('content')
    <div class="content fondob">
        <div class="pa fondob">
            <div class="col-md-auto">
                @foreach ($servicios as $cos)
                    <tr class="centext">
                        <td class="centext" scole="col">{{ $cos->costo }}</td>
                    </tr>
                @endforeach
                <table class="table">
                    <thead class="">
                        <tr>
                            <th class="centext" scole="col">Servicios</th>
                            <th class="centext" scole="col">Costo</th>
                            <th class="centext" scole="col">Paciente</th>
                            <th class="centext" scole="col">Especialista</th>
                            <th class="centext" scole="col">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $citas)

                            <tr class="centext">
                                <td class="centext" scole="col">{{ $citas->title }}</td>
                                <td class="centext" scole="col">${{ $citas->costo }}</td>
                                <td class="centext" scole="col">{{ $citas->nombrePaciente }}</td>
                                <td class="centext" scole="col">{{ $citas->nombreEspecialista }}</td>
                                <td class="centext" scole="col">{{ $citas->start }}</td>
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
