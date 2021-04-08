@extends('agent/layouts/app')
@section('main-content')

    <section id="main" class="wrapper">
        <div class="container">
            <header class="major">
                <h2>Select option</h2>
                <a href="{{ url('accepts') }}" class="btn btn-success">Accussed accepts charge</a>
                <a href="{{ url('denies') }}" class="btn btn-warning">Accussed denies charge</a>
            </header>
        </div>
    </section>
    <script>
        $('#human').change(function(){
            if($(this).is(":checked")) {

                $('div.check').removeClass("d-none");

            } else {

                $('div.check').addClass("d-none");

            }
        });

        $('#court').change(function(){
            var cid = $(this).val();
            if(cid){
                $.ajax({
                    type:"get",
                    url:"{{ url('/getProsecutor')}}/"+cid,
                    success:function(res)
                    {
                        if(res)
                        {
                            $("#prosecutor").empty();
                            $("#prosecutor").append('<option>Select Prosecutor</option>');
                            $.each(res,function(key,value){
                                $("#prosecutor").append('<option value="'+key+'">'+value+'</option>');
                            });
                        }
                    }

                });
            }
        });



    </script>
@endsection


