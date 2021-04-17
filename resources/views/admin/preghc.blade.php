@extends('layouts.lte')

@section('content')
    <div class="">
        <div class="input-group">
            <input type="text" class="form-control" id="texto" placeholder="Ingrese nombre">
            <div class="input-group-append"><span class="input-group-text">Buscar</span></div>
        </div>
        <div id="resultados" class="bg-light border">
            @foreach ($hc as $historia)
            <div class="cardPx padre2 center divle">
                <div class="hijo2 col-md-12">
                    <h1>{{ $historia->nombre }}</h1>
                    <h1>{{ $historia->pregunta }}</h1>
                </div>
            </div>

        @endforeach
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
@endsection
