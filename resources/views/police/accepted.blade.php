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
                <a href="#" class="btn_support">This form is for suspect who has accepted the accusation!</a>
                <div id="message-support"></div>
                <form method="post" action="{{ route('cases.store') }}" enctype="multipart/form-data" autocomplete="off">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group required">
                                <input class="form-control" name="names" id="name" value="{{ old('names') }}" placeholder="Names (Christian name followed by surname)" required="required">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group required">
                                <input class="form-control" type="text" name="id" id="id" value="{{ old('id') }}" placeholder="Identification/passport number" required="required">
                            </div>
                        </div>
                    </div>
                    <!-- /row -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group required">
                                <input class="form-control" type="text" name="nationality" id="name" value="{{ old('nationality') }}" placeholder="Nationality" required="required">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group required">
                                <input class="form-control" type="text" name="address" id="address" value="{{ old('address') }}" placeholder="Address" required="required" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group required">
                                <input class="form-control" type="tel" name="mobile" id="mobile" value="{{ old('mobile') }}" placeholder="Mobile number" required="required">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control" type="text" name="dl" id="dl" value="{{ old('dl') }}" placeholder="Driving license number">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Age</label>
                                <select name="age" id="age" class="form-control" >
                                    <option value="adult">Adult</option>
                                    <option value="child">Underage</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Gender</label>
                                <select name="gender" id="gender" class="form-control select2" required="required">
                                    <option value="">Select gender</option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /row -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group required">
                                <input class="form-control" type="text" name="car_registration" id="car_registration" value="{{ old('car_registration') }}" placeholder="Car registration number" required="required">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group required">
                                <input class="form-control" type="text" name="incident_location" id="incident_location" value="{{ old('incident_location') }}" placeholder="Location of incident" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="form-group required">
                        <Label>Exact time of incident</Label>
                        <input class="form-control" type="datetime-local" name="time" id="time" required="required" value="{{ old('time') }}">
                    </div>
                    <div class="form-group required">
                        <label>Select charge</label>
                        <select name="charge[]" id="multiselect" multiple="multiple" style="height:100px;" class="form-control">
                            @foreach($offences as $offence)
                                <option value="{{ $offence->id }}">{{ $offence->offence }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group required">
                        <textarea class="form-control" id="message_contact" name="particulars" style="height:100px;" placeholder="Type in particulars of the offence in detail"></textarea>
                    </div>
                    <div class="form-group required">
                        <textarea class="form-control" name="message_contact" id="mitigating" style="height:100px;" placeholder="Type in any mitigating circumstances that might have led to the offence" ></textarea>
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
                                <input type="checkbox" name="dismissed" value="1">
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


