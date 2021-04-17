@extends('layouts.lte')

@section('content')
    <div class="">
        <div id="resultados" class="bg-light border">
            <div>
                <h1 class="aliizq">Preguntas</h1>
                <br><br><br><br><br>
                <div class="col-md-8">
                    <form method="POST" action="/paciente/{paciente}/{h_clinica}/new/create" enctype="multipart/form-data">
                        <div class="field_wrapper colorBlack">
                            @csrf
                            <div>
                                @foreach ($posts2 as $consulta)
                                <input class="col-md-4 divle" type="hidden" id="idPaciente" name="idPaciente" value="{{$consulta->idPx}}"/>
                                <input class="col-md-4 divle" type="hidden" id="idEspecialista" name="idEspecialista" value="{{Auth::user()->id}}"/>
                                <input class="col-md-4 divle" type="hidden" id="idHC" name="idHC" value="{{$consulta->idHC}}"/>
                                <input class="col-md-4 divle" type="hidden" id="idPregunta" name="idPregunta" value="{{$consulta->idPregunta}}"/>
                                <input class="col-md-4 divle" type="text" id="Pregunta" name="Pregunta" value="{{$consulta->Preg}}"/>
                                <input class="col-md-4 divle" type="text" id="respuesta" name="respuesta[]" value="Respuesta"/>
                                @endforeach
                                <br>
                            </div>
                        </div>
                        <br>
                        <div>
                            <input type="submit" class="btn btn-primary" value="Guardar">
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
    @include('paciente.create')


@endsection
