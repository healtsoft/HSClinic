@extends('layouts.px')

@section('content')
    <div class="content">
        <div class="colback fondob">
            <h2 class="text-center mb-5">Registro de Dolor</h2> <h2 class="text-center mb-5">Ver niveles Dolor</h2>
                <div id="template" style="display: none;">
                    <form method="POST" action="/paciente/{{ $report->id }}/dolor" enctype="multipart/form-data">
                        <div class="modal-body">
                            @csrf
                            <label>Nivel del Dolor (Escala ENA)</label>
                            <div class="form-group">
                                <button type="submit" value="0" id="dolor" name="myButton">
                                    <img src="/images/dolor/0n.png" width="90" height="125">
                                </button>
                                <button type="submit" value="2" id="dolor" name="dolor">
                                    <img id="1" src="/images/dolor/1n.png" width="90" height="125">
                                </button>
                                <button type="submit" value="4" id="dolor" name="dolor">
                                    <img src="/images/dolor/2n.png" width="90" height="125">
                                </button>
                                <button type="submit" value="6" id="dolor" name="dolor">
                                    <img src="/images/dolor/3n.png" width="90" height="125">
                                </button>
                                <button type="submit" value="8" id="dolor" name="dolor">
                                    <img src="/images/dolor/4n.png" width="90" height="125">
                                </button>
                                <button type="submit" value="10" id="dolor" name="dolor">
                                    <img src="/images/dolor/5n.png" width="90" height="125">
                                </button>
                                <input type="hidden" name="zona" id="zona" value="cabeza">
                            </div>
                        </div>
                    </form>
                </div>
                

            <div id="anterior">
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <input type="image" id="panel" name="panel" src="/images/cuerpo/cara0.png" 
                            width="132" height="140" style="margin-left: 264px">
                        </div>
                        <div class="row">
                            <input type="image" id="panel" name="panel" src="/images/cuerpo/cuelloD.png" 
                            width="110" height="60" style="margin-left: 220px">
                            <input type="image" id="panel" name="panel" src="/images/cuerpo/cuelloI.png" 
                            width="110" height="60">
                        </div>
                        <div class="row">
                            <input type="image" id="panel" name="panel" src="/images/cuerpo/deltI.png" 
                            width="60" height="100" style="margin-left: 160px">
                            <input type="image" id="panel" name="panel" src="/images/cuerpo/pecMI.png" 
                            width="110" height="100">
                            <input type="image" id="panel" name="panel" src="/images/cuerpo/pecMD.png" 
                            width="110" height="100">
                            <input type="image" id="panel" name="panel" src="/images/cuerpo/deltD.png" 
                            width="60" height="100">
                        </div>
                        <div class="row">
                            <input type="image" id="panel" name="panel" src="/images/cuerpo/brazoI.png" 
                            width="80" height="100" style="margin-left: 140px">
                            <input type="image" id="panel" name="panel" src="/images/cuerpo/absI.png" 
                            width="110" height="100">
                            <input type="image" id="panel" name="panel" src="/images/cuerpo/absD.png" 
                            width="110" height="100">
                            <input type="image" id="panel" name="panel" src="/images/cuerpo/brazoID.png" 
                            width="80" height="100">
                        </div>
                        <div class="row">
                            <input type="image" id="panel" name="panel" src="/images/cuerpo/antebrazoD.png" 
                            width="100" height="120" style="margin-left: 110px">
                            <input type="image" id="panel" name="panel" src="/images/cuerpo/absinfI.png" 
                            width="110" height="120" style="margin-left: 6px">
                            <input type="image" id="panel" name="panel" src="/images/cuerpo/absinfD.png" 
                            width="122" height="120">
                            <input type="image" id="panel" name="panel" src="/images/cuerpo/antebrazoI.png" 
                            width="95" height="120">
                        </div>
                        <div class="row">
                            <input type="image" id="panel" name="panel" src="/images/cuerpo/manoD.png" 
                            width="100" height="120" style="margin-left: 60px">
                            <input type="image" id="panel" name="panel" src="/images/cuerpo/muslosupI.png" 
                            width="160" height="120" style="margin-left: 0px">
                            <input type="image" id="panel" name="panel" src="/images/cuerpo/muslosupD.png" 
                            width="164" height="120">
                            <input type="image" id="panel" name="panel" src="/images/cuerpo/manoI.png" 
                            width="110" height="120">
                        </div>
                        <div class="row">
                            <input type="image" id="panel" name="panel" src="/images/cuerpo/musloinfI.png" 
                            width="124" height="120" style="margin-left: 196px">
                            <input type="image" id="panel" name="panel" src="/images/cuerpo/musloinfD.png" 
                            width="124" height="120">
                        </div>
                        <div class="row">
                            <input type="image" id="panel" name="panel" src="/images/cuerpo/rodillaI.png" 
                            width="108" height="120" style="margin-left: 212px">
                            <input type="image" id="panel" name="panel" src="/images/cuerpo/rodillaD.png" 
                            width="108" height="120" style="margin-left: 1px">
                        </div>
                        <div class="row">
                            <input type="image" id="panel" name="panel" src="/images/cuerpo/piernaI.png" 
                            width="100" height="160" style="margin-left: 220px">
                            <input type="image" id="panel" name="panel" src="/images/cuerpo/piernaD.png" 
                            width="100" height="160" style="margin-left: 4px">
                        </div>
                        <div class="row">
                            <input type="image" id="panel" name="panel" src="/images/cuerpo/pieI.png" 
                            width="85" height="100" style="margin-left: 240px">
                            <input type="image" id="panel" name="panel" src="/images/cuerpo/pieD.png" 
                            width="90" height="100" style="margin-left: 2px">
                        </div>
                    </div>
                    <div class="col">
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>

    
    @include('paciente.create')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.nav_btn').click(function() {
                $('.mobile_nav_items').toggleClass('active');
            });
        });

    </script>
@endsection

@section('scripts')
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>
    <script src="{{ asset('js/tip.js') }}"></script>

@endsection