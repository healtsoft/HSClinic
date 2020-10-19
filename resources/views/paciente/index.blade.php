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
                            <a href="" class="btn btn-dark">Editar</a>
                            <a href="" class="btn btn-danger">Eliminar</a>
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
