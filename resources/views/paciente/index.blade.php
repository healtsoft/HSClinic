@extends('layouts.lte')

@section('content')
    <div class="col-8">
        <div class="input-group">
            <input type="text" class="form-control" id="texto" placeholder="Ingrese nombre">
            <div class="input-group-append"><span class="input-group-text">Buscar</span></div>
        </div>
        <div id="resultados" class="bg-light border">
            @include('busquedas.show')
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
