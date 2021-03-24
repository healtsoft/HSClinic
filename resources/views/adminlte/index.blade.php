@extends('layouts.lte')

@section('content')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <h1>Dashboard</h1>
    <form method="POST" action="/admin/hcn" enctype="multipart/form-data">
        <div class="field_wrapper">
            @csrf
            <div>
                <input type="text" name="idHC" value="1"/>
                <input type="text" name="pregunta[]" value=""/>
                <input type="text" name="respuesta[]" value=""/>
                <a href="javascript:void(0);" class="add_button" title="Add field"><img src="../images/notas.png"/></a>
            </div>
        </div>
        <div>
            <input type="submit" class="btn btn-primary" value="Guardar">
        </div>
    </form>
    <script type="text/javascript">
        $(document).ready(function(){
            var maxField = 10; //Input fields increment limitation
            var x = 1; //Initial field counter is 1
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML = '<div><input type="text" name="field_name['+x+']" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="../images/o2.png"/></a></div>'; //New input field html
            $(addButton).click(function(){ //Once add button is clicked
                if(x < maxField){ //Check maximum number of input fields
                    x++; //Increment field counter
                    $(wrapper).append('<div><input type="text" name="pregunta[]" value=""/><input type="text" name="respuesta[]" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="../images/o2.png"/></a></div>'); // Add field html
                }
            });
            $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
    </script>
@endsection
