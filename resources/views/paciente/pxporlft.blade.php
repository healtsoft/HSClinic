@extends('layouts.app')

@section('botones')
    <a href="{{ route('paciente.create') }}" class="btn btn-primary mr-2 text-white">Crear Paciente</a>
@endsection

@section('content')
    <div>
        <div class="col-md-8 mr-auto bg-white p-3 divle bordertable mdown">
            <table class="table">
                <thead class="bg-primary text-light">
                    <tr>
                        Aqui va la Foto del Px
                    </tr>
                </thead>
                <thead class="bg-    text-light">
                    <tr>
                        y su nombre alv
                    </tr>
                </thead>
            </table>

        </div>
        <div class="col-md-3 ml-auto bg-white p-3 divde bordertable">
            <table class="table">
                <thead class="bg-danger text-light">
                    <tr>
                        <th scole="col">Funciones</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td>
                                <a href="#" class="col-md-12 btn btn-primary mr-2 text-white" data-toggle="modal" data-target="#createPx">
                                Expediente
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#" class="col-md-12 btn btn-primary mr-2 text-white" data-toggle="modal" data-target="#cnote">
                                Nueva Nota
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="{{ url('/paciente/models') }}" class="col-md-12 btn btn-primary mr-2 text-white">Modelos Anatomicos</a>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                <button type="button" class="col-md-12 btn btn-primary mr-2 text-white dropdown-toggle"
                                        data-toggle="dropdown">
                                    Pruebas <span class="caret"></span>
                                </button>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a class="col-md-12 btn btn-primary text-white" href="#">Marcha</a></li>
                                    <li class="dropdown-divider"></li>
                                    <li><a class="col-md-12 btn btn-primary text-white" href="#">Fuerza</a></li>
                                    <li class="dropdown-divider"></li>
                                    <li><a class="col-md-12 btn btn-primary text-white" href="#">Goniometria</a></li>
                                    <li class="dropdown-divider"></li>
                                    <li><a class="col-md-12 btn btn-primary text-white" href="#">Neurologia</a></li>
                                </ul>
                            </td>
                        </tr>   
                        <tr>
                            <td>
                                <a href="#" class="col-md-12 btn btn-primary mr-2 text-white" data-toggle="modal" data-target="#create2">
                                Cardex
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#" class="col-md-12 btn btn-primary mr-2 text-white" data-toggle="modal" data-target="#create2">
                                Estudios
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#" class="col-md-12 btn btn-primary mr-2 text-white" data-toggle="modal" data-target="#create2">
                                Ejercicios en Casa
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#" class="col-md-12 btn btn-primary mr-2 text-white" data-toggle="modal" data-target="#create2">
                                Regresar
                                </a>
                            </td>
                        </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-8 mr-auto bordertable bg-white p-3 divle mmiddle">
            <table class="table">
                <thead class="bg-danger text-light">
                    <tr>
                        <th scole="col">Datos Generales</th>
                        <th scole="col">Tratamiento</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Datos Generales para mostrar en esta zona</td>
                        <td>Tratamiento para mostrar en esta zona</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-8 mr-auto bg-white p-3 divle bordertable">
            <table class="table">
                <thead class="bg-danger text-light">
                    <tr>
                        <th scole="col">Notas Terapeuticas</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Datos Generales para mostrar en esta zona</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @include('paciente.create')
@endsection