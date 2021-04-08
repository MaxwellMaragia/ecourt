@extends('agent/layouts/app')
@section('main-content')

    <section id="main" class="wrapper">
        <div class="container">
            <header class="major">
                <h2>Create case</h2>
                <p>All fields marked with <span class="text-danger">*</span> are required</p>
            </header>
            <div class="container">
                <section>
                    <form method="post" action="#">
                        <div class="row uniform 50%">
                            <div class="6u 12u$(4)">
                                <input type="text" name="names" id="name" value="" placeholder="Names (Christian name followed by surname)" />
                            </div>
                            <div class="6u$ 12u$(4)">
                                <input type="number" name="id" id="id" value="" placeholder="Identification/passport number" />
                            </div>
                            <div class="6u 12u$(4)">
                                <input type="number" name="license" id="name" value="" placeholder="Nationality" />
                            </div>
                            <div class="6u$ 12u$(4)">
                                <input type="text" name="car" id="email" value="" placeholder="Address" />
                            </div>
                            <div class="6u 12u$(4)">
                                <input type="number" name="names" id="name" value="" placeholder="Mobile number" />
                            </div>
                            <div class="6u$ 12u$(4)">
                                <input type="text" name="id" id="id" value="" placeholder="Driving license number" />
                            </div>

                            <div class="6u 12u$(4)">
                                <label for="offence">Age</label>
                                <select name="offence" id="offence">
                                    <option value="">Adult</option>
                                    <option value="">Underage</option>
                                </select>
                            </div>
                            <div class="6u$ 12u$(4)">
                                <label for="offence">Gender</label>
                                <select name="offence" id="offence">
                                    <option value="">Select gender</option>
                                    <option value="">Male</option>
                                    <option value="">Female</option>
                                    <option value="">Bi</option>
                                </select>
                            </div>
                            <div class="6u 12u$(4)">
                                <input type="text" name="names" id="name" value="" placeholder="Car registration number" />
                            </div>
                            <div class="6u$ 12u$(4)">
                                <input type="text" name="id" id="id" value="" placeholder="Location of incident" />
                            </div>
                            <div class="12u0">
                                <Label>Exact time of incident</Label>
                                <input type="datetime-local" name="time" id="email" value="" />
                            </div>
                            <div class="12u$">
                                <div class="select-wrapper">
                                    <label for="offence">Select charge</label>
                                    <select name="offence" id="multiselect" multiple="multiple" style="height:100px;">
                                        @foreach($offences as $offence)
                                            <option value="{{ $offence->id }}">{{ $offence->offence }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="12u$">
                                <textarea name="description" id="message" placeholder="Particulars of the offence" rows="6"></textarea>
                            </div>

                            <div class="6u 12u$(4)">
                                <label>Image attachment</label>
                                <input type="file" name="image" class="form-control"/>
                            </div>
                            <div class="6u$ 12u$(4)">
                                <label>Video attachment</label>
                                <input type="file" name="video" class="form-control"/>
                            </div>

                            <div class="12u$">
                                <Label>Date of arrest</Label>
                                <input type="datetime-local" name="time" id="email" value="" />
                            </div>

                            <div class="12u0">
                                <label for="">Bond or bail amount</label>
                                <input type="number" name="time" id="email" value="" placeholder="Bond or bail amount"/>
                            </div>
                            <div class="12u$">
                                <div class="select-wrapper">
                                    <label for="offence">Is application issue to summon</label>
                                    <select name="court" id="court">
                                        <option value="">- Select option -</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="12u0">
                                <label for="Complainant and address"></label>
                                <input type="text" name="time" id="email" value="" placeholder="Complainant and address"/>
                            </div>
                            <div class="12u$">
                                <label>List of witnesses (Optional)</label>
                                <textarea name="description" id="message" placeholder="Witnesses" rows="6"></textarea>
                            </div>
                            <div class="12u$">
                                <div class="select-wrapper">
                                    <label for="offence">Select court</label>
                                    <select name="court" id="court">
                                        <option value="">- Court -</option>
                                        @foreach($courts as $court)
                                            <option value="{{ $court->id }}">{{ $court->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="12u$">
                                <Label>Date to appear in court</Label>
                                <input type="datetime-local" name="time" id="email" value="" />
                            </div>
                            <div class="12u$">
                                <div class="select-wrapper">
                                    <label for="offence">Select prosecutor</label>
                                    <select name="prosecutor" id="prosecutor">
                                    </select>
                                </div>
                            </div>

                            <div class="12u$">
                                <ul class="actions">
                                    <li><input type="submit" value="Submit" class="special" /></li>
                                    <li><input type="reset" value="Reset" /></li>
                                </ul>
                            </div>


                        </div>
                    </form>
                </section>
            </div>
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


