@extends('layouts.admin')

@section('content')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <div class="content fondob">
        <div class="pa fondob">
            <div class="col-md-auto">
                @php
                    $c = 0;
                @endphp
                @foreach ($servicios as $cos)
                    @php
                        $c = $c + $cos->costo;
                    @endphp
                @endforeach
                <script type="text/javascript">
                    function printDiv(areaImprimir) {
                        div = document.getElementById('impre');
                        div.style.display = '';
                        var contenido= document.getElementById(areaImprimir).innerHTML;
                        div.style.display = 'none';
                        var contenidoOriginal= document.body.innerHTML;
                        
                        document.body.innerHTML = contenido;

                        window.print();
                        
                        document.body.innerHTML = contenidoOriginal;
                    }

                    function fec(){
                        var inicio = Date.now();
                        $("#buscar").val(inicio);
                    }
                    
                </script>
                <div id="areaImprimir">
                    
                </div>
                {{-- <input class="btn btn-primary" type="button" onclick="printDiv('areaImprimir')" value="Imprimir Ticket" />
                
                <input class="btn btn-primary" type="button" onclick="mostrar()" value="Ver Grafica 1" /> --}}
                <script type="text/javascript">
                    google.charts.load('current', {'packages':['corechart']});
                    google.charts.setOnLoadCallback(drawChart);
            
                    function drawChart() {
                      var data = google.visualization.arrayToDataTable([
                        ['Fecha', 'Ingreso'],
                        @foreach ($grafica as $citas)
                        ['{{ $citas->fech }}',  {{ $citas->costo }}],
                        @endforeach
                      ]);
            
                      var options = {
                        title: 'Ingresos segun Fecha',
                        curveType: 'function',
                        legend: { position: 'bottom' }
                      };
            
                      var chart = new google.visualization.ColumnChart(document.getElementById('curve_chart2'));
            
                      chart.draw(data, options);
                    }
                </script>
                <script type="text/javascript">
                    google.charts.load('current', {'packages':['corechart']});
                    google.charts.setOnLoadCallback(drawChart);
            
                    function drawChart() {
                      var data = google.visualization.arrayToDataTable([
                        ['Fecha', 'Ingreso'],
                        @foreach ($Total as $ci)
                        ['{{ $ci->Servicio }}',  {{ $ci->Total }}],
                        @endforeach
                      ]);
            
                      var options = {
                        title: 'Ingresos segun Servicio',
                        curveType: 'function',
                        legend: { position: 'bottom' }
                      };
            
                      var chart = new google.visualization.ColumnChart(document.getElementById('curve_chart3'));
            
                      chart.draw(data, options);
                    }
                </script>
                <script type="text/javascript">
                    google.charts.load('current', {'packages':['line']});
                    google.charts.setOnLoadCallback(drawChart);
            
                    function drawChart() {
                      var data = google.visualization.arrayToDataTable([
                        ['Fecha', 'Ingreso'],
                        @foreach ($servicioPedido as $ci)
                        ['{{ $ci->Servicio }}',  {{ $ci->Total }}],
                        @endforeach
                      ]);
            
                      var options = {
                        chart: {
                            title: 'Servicio mas Solicitado en la Clinica',
                            subtitle: 'Dentro de los registrados (MXN)'
                        },
                        width: 1000,
                        height: 500
                      };
            
                      var chart = new google.charts.Line(document.getElementById('curve_chart4'));
            
                      chart.draw(data, google.charts.Line.convertOptions(options));
                    }
                </script>
                <script type="text/javascript">
                    google.charts.load('current', {'packages':['corechart']});
                    google.charts.setOnLoadCallback(drawChart);
            
                    function drawChart() {
                      var data = google.visualization.arrayToDataTable([
                        ['Fecha', 'Ganancias por Dia'],
                        @foreach ($TotalxDia as $ci)
                        ['{{ $ci->Fecha }}',  {{ $ci->Ganancias }}],
                        @endforeach
                      ]);
            
                      var options = {
                        title: 'Ingresos Por Dia',
                        curveType: 'function',
                        legend: { position: 'bottom' }
                      };
            
                      var chart = new google.visualization.LineChart(document.getElementById('curve_chart5'));
            
                      chart.draw(data, options);
                    }
                </script>
                <script type="text/javascript">
                    function mostrar() {
                        div = document.getElementById('g1');
                        div.style.display = '';
                    }
            
                    function cerrar() {
                        div = document.getElementById('g1');
                        div.style.display = 'none';
                    }
                </script>
                
                <div id="curve_chart2" style="width: 1200px; height: 500px"></div>
                <div id="curve_chart3" style="width: 1200px; height: 500px"></div>
                <div id="curve_chart4" style="width: 1200px; height: 500px"></div>
                <div id="curve_chart5" style="width: 1200px; height: 500px"></div>
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
