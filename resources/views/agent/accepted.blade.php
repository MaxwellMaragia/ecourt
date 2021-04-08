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
                    <form method="post" action="{{ route('cases.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @include('includes.messages')
                        <div class="row uniform 50%">
                            <div class="6u 12u$(4)">
                                <input type="text" name="names" id="name" value="" placeholder="Names (Christian name followed by surname)" required="required"/>
                            </div>
                            <div class="6u$ 12u$(4)">
                                <input type="number" name="id" id="id" value="" placeholder="Identification/passport number" required="required" />
                            </div>
                            <div class="6u 12u$(4)">
                                <input type="text" name="nationality" id="name" value="" placeholder="Nationality" required="required"/>
                            </div>
                            <div class="6u$ 12u$(4)">
                                <input type="text" name="address" id="email" value="" placeholder="Address" required="required" />
                            </div>
                            <div class="6u 12u$(4)">
                                <input type="number" name="mobile" id="name" value="" placeholder="Mobile number" required="required"/>
                            </div>
                            <div class="6u$ 12u$(4)">
                                <input type="text" name="dl" id="id" value="" placeholder="Driving license number" required="required"/>
                            </div>

                            <div class="6u 12u$(4)">
                                <label for="offence">Age</label>
                                <select name="age" id="offence">
                                    <option value="adult">Adult</option>
                                    <option value="child">Underage</option>
                                </select>
                            </div>
                            <div class="6u$ 12u$(4)">
                                <label for="offence">Gender</label>
                                <select name="gender" id="offence">
                                    <option value="">Select gender</option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="6u 12u$(4)">
                                <input type="text" name="car_registration" id="name" value="" placeholder="Car registration number" required="required"/>
                            </div>
                            <div class="6u$ 12u$(4)">
                                <input type="text" name="incident_location" id="id" value="" placeholder="Location of incident" required="required"/>
                            </div>
                            <div class="12u0">
                                <Label>Exact time of incident</Label>
                                <input type="datetime-local" name="time" id="email" required="required"/>
                            </div>
                            <div class="12u$">
                                <div class="select-wrapper">
                                    <label for="offence">Select charge</label>
                                    <select name="charge[]" id="multiselect" multiple="multiple" style="height:100px;">
                                        @foreach($offences as $offence)
                                            <option value="{{ $offence->id }}">{{ $offence->offence }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="12u$">
                                <textarea name="particulars" id="message" placeholder="Particulars of the offence" rows="6" required="required"></textarea>
                            </div>
                            <div class="12u$">
                                <textarea name="mitigating" id="message" placeholder="Mitigating circumstances" rows="6" required="required"></textarea>
                            </div>
                            <div class="6u 12u$(4)">
                                <label>Image attachment</label>
                                <input type="file" name="image" class="form-control" accept="image/*"/>
                            </div>
                            <div class="6u$ 12u$(4)">
                                <label>Video attachment</label>
                                <input type="file" name="video" class="form-control" accept="video/*"/>
                            </div>
                            <div class="12u$">
                                <input type="checkbox" id="human" name="dismissed" value="1">
                                <label for="human">Suspect to be dismissed with a warning?</label>
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

@endsection


