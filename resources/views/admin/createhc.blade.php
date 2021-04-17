@extends('layouts.lte')

@section('content')
    <div class="">
        <div id="resultados" class="bg-light border">
            <div>
                <h1 class="aliizq">Preguntas</h1>
                <a href="#" data-toggle="modal" data-target="#preguntas" class="btn btn-primary alider">Crear/Editar Preguntas</a>
                <br><br><br><br><br>
                <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
                <div class="col-md-8">
                    @foreach ($hc as $historia)
                        <input class="col-md-4 divle" type="text" name="preg" value="{{$historia->pregunta}}"/>
                    @endforeach
                </div>
                <div class="col-md-4 card">
                    <form method="POST" action="/admin/hcn" enctype="multipart/form-data">
                        <div class="field_wrapper colorBlack">
                            @csrf
                            <div>
                                <h3>Crear nuevas preguntas</h3>
                                @foreach ($hc2 as $historia2)
                                    <input type="hidden" name="idHC" value="{{$historia2->id}}"/>
                                @endforeach

                                <input type="text" name="pregunta[]" value=""/>
                                <a href="javascript:void(0);" class="add_button" title="Add field"><img src="/images/notas.png"/></a>
                            </div>
                        </div>
                        <div>
                            <input type="submit" class="btn btn-primary" value="Guardar">
                        </div>
                    </form>
                </div>

                <script type="text/javascript">
                    $(document).ready(function(){
                        var maxField = 10; //Input fields increment limitation
                        var x = 1; //Initial field counter is 1
                        var addButton = $('.add_button'); //Add button selector
                        var wrapper = $('.field_wrapper'); //Input field wrapper
                        var fieldHTML = '<div><input type="text" name="field_name['+x+']" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/o2.png"/></a></div>'; //New input field html
                        $(addButton).click(function(){ //Once add button is clicked
                            if(x < maxField){ //Check maximum number of input fields
                                x++; //Increment field counter
                                $(wrapper).append('<div><input type="text" name="pregunta[]" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/o2.png"/></a></div>'); // Add field html
                            }
                        });
                        $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
                            e.preventDefault();
                            $(this).parent('div').remove(); //Remove field html
                            x--; //Decrement field counter
                        });
                    });
                </script>
            </div>

        </div>
    </div>
    @include('paciente.create')


@endsection
