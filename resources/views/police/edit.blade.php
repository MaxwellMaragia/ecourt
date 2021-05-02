@extends('police/layouts/app')
@section('meta')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="case listing">
    <meta name="author" content="CODEI SYSTEMS">

    <title>ECOURT | Edit case</title>

@endsection
@section('main-content')

    <main>

        <div class="row justify-content-center">
            <div class="col-lg-6" style="margin-top:100px;">
                <div id="message-contact"></div>

                @include('includes.messages')
                <a href="#" class="btn_support">Edit case for {{ $case->offender_name }}</a>
                <div id="message-support"></div>
                <form method="post" action="{{ route('cases.update',$case->id) }}" enctype="multipart/form-data" autocomplete="off">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group required">
                                <label>Names</label>
                                <input class="form-control" name="names" id="name" value="{{ $case->offender_name }}" placeholder="Names (Christian name followed by surname)" required="required">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group required">
                                <label>Id/passport number</label>
                                <input class="form-control" type="number" name="id" id="id" value="{{ $case->identification }}" placeholder="Identification/passport number" required="required">
                            </div>
                        </div>
                    </div>
                    <!-- /row -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group required">
                                <label>Nationality</label>
                                <input class="form-control" type="text" name="nationality" id="name" value="{{ $case->nationality }}" placeholder="Nationality" required="required">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group required">
                                <label>Address</label>
                                <input class="form-control" type="text" name="address" id="address" value="{{ $case->address }}" placeholder="Address" required="required" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mobile number (254.........)</label>
                                <input class="form-control" type="tel" name="mobile" id="mobile" value="{{ $case->offender_mobile }}" placeholder="Mobile number" readonly="readonly">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Driving licence number</label>
                                <input class="form-control" type="number" name="dl" id="dl" value="{{ $case->license_number }}" placeholder="Driving license number">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Age</label>
                                <select name="age" id="age" class="form-control" >
                                    @if($case->age == 'adult')
                                        <option value="adult">Adult</option>
                                        <option value="child">Underage</option>
                                        @elseif($case->age == 'child')
                                        <option value="child">Underage</option>
                                        <option value="adult">Adult</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Gender</label>
                                <select name="gender" id="gender" class="form-control select2" required="required">
                                    @if($case->gender == 'M')
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                        <option value="Other">Other</option>
                                    @elseif($case->gender == 'F')
                                        <option value="F">Female</option>
                                        <option value="M">Male</option>
                                        <option value="Other">Other</option>
                                    @elseif($case->gender == 'Other')
                                        <option value="Other">Other</option>
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /row -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group required">
                                <label>Car registration number</label>
                                <input class="form-control" type="text" name="car_registration" id="car_registration" value="{{ $case->car_registration }}" placeholder="Car registration number" required="required">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group required">
                                <label>Incident location</label>
                                <input class="form-control" type="text" name="incident_location" id="incident_location" value="{{ $case->offence_location }}" placeholder="Location of incident" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <Label>Exact time of incident</Label>
                        <input class="form-control" type="text" name="time" id="time" required="required" value="{{ $case->time }}" readonly="readonly">
                    </div>
                    <div class="form-group required">
                        <label>Select charge</label>
                        <select name="charge[]" id="multiselect" multiple="multiple" style="height:100px;" class="form-control">
                            @foreach($offences as $offence)
                                <option value="{{ $offence->id }}"
                                    @foreach($case->offences as $offenceCommited)
                                        @if($offenceCommited->id == $offence->id)
                                        selected
                                        @endif
                                    @endforeach>{{ $offence->offence }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group required">
                        <label>Particulars of the offence</label>
                        <textarea class="form-control" id="message_contact" name="particulars" style="height:100px;">
                            {{ $case->particulars }}
                        </textarea>
                    </div>
                    <div class="form-group required">
                        <label>Mitigating circumstances</label>
                        <textarea class="form-control" name="message_contact" id="mitigating" style="height:100px;">
                            {{ $case->mitigating }}
                        </textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Image attachment (optional)</label>
                                <div class="fileupload"><input type="file" name="image" accept="image/*"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Video attachment (optional)</label>
                                <div class="fileupload"><input type="file" name="video" accept="video/*"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkboxes float-left add_bottom_15 add_top_15">
                            <label class="container_check">Suspect to be dismissed with a warning?
                                <input type="checkbox" name="dismissed" value="1" @if($case->dismissed == 1) checked @endif>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group add_top_30 text-center">
                        <input type="submit" value="Submit" class="btn_1 rounded" id="submit-contact">
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection


