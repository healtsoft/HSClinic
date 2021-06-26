@extends('layouts.lte')

@section('content')
    <div class="">
        <div id="resultados" class="bg-light border">
            <div>
                <h1 class="aliizq">Preguntas 2</h1>
                <br><br><br><br><br>
                <div class="col-md-8">
                    @foreach ($posts2 as $consulta)
                    <form method="POST" action="/paciente/{paciente}/{h_clinica}/{hcpx}/new/create" enctype="multipart/form-data">
                        <div class="field_wrapper colorBlack">
                            @csrf
                            <div>
                                <input class="col-md-4 divle" type="hidden" id="idPregunta" name="idPregunta" value="{{$consulta->idPregunta}}"/>
                                <input class="col-md-4 divle" type="hidden" id="hcpx" name="hcpx" value="{{$consulta->hcpx}}"/>
                                <input class="col-md-4 divle" type="hidden" id="idhc" name="idhc" value="{{$consulta->idhc}}"/>
                                <input class="col-md-4 divle" type="text" id="Pregunta" name="Pregunta" value="{{$consulta->Preg}}"/>
                                <input class="col-md-4 divle" type="text" id="respuesta" name="respuesta[]" value="{{$consulta->resp}}"/>
                            </div>
                            <br>
                            <div>
                                <input type="submit" class="btn btn-primary" value="Guardar">
                            </div>
                        </form>
                    @endforeach
                </div>

            </div>

        </div>
    </div>
    @include('paciente.create')


@endsection
