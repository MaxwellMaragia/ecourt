@extends('user/layouts/app')
@section('meta')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="case listing">
    <meta name="author" content="CODEI SYSTEMS">
    <title>ECOURT | Traffic offences portal</title>

@endsection
@section('main-content')
    <main>
        <section class="hero_single version_company">
            <div class="wrapper">
                <div class="container">
                    <h3>Ecourt</h3>
                    <p>Fast, easy and efficient traffic offence handling.</p>
                </div>
            </div>
        </section>
        <!-- /hero_single -->

        <div class="bg_color_1">
            <div class="container margin_60_35">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="box_feat">
                            <i class="pe-7s-speaker"></i>
                            <h3><strong>1</strong> One<em>Case recorded</em></h3>
                            <p>Traffic officer quickly records offence details</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="box_feat">
                            <i class="pe-7s-flag"></i>
                            <h3><strong>2</strong> two<em>Legal outcome</em></h3>
                            <p>Legal personnel efficiently gives case verdict</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="box_feat">
                            <i class="pe-7s-mail"></i>
                            <h3><strong>3</strong> three<em>Suspect notified</em></h3>
                            <p>The suspect is notified by SMS through the whole stage</p>
                        </div>
                    </div>
                </div>
                <!-- /row -->

            </div>
            <!-- /container -->
        </div>
        <!-- /bg_color_1 -->

        <div class="feat_blocks">
            <div class="container-fluid h-100">
                <div class="row h-100 justify-content-center align-items-center">
                    <div class="col-md-6 p-0">
                        <div class="block_1"><img src="{{ asset('gavel.jpg') }}" alt="" class="img-fluid"></div>
                    </div>
                    <div class="col-md-6 p-0">
                        <div class="block_2">
                            <h3>Welcome to ECourt</h3>
                            <p>This portal enables quick and easy collaboration between traffic officers and the appropriate legal personnel to solve traffic offences quickly and easily.</p>
                            <a href="{{ route('login') }}" class="btn_1">Staff login</a>
                        </div>
                    </div>

                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /feat_blocks -->

        <div class="bg_color_1">
            <div class="container margin_60_35">
                <div class="margin_60">
                    <h5 class="text-center add_bottom_30">Our partners!</h5>
                    <div id="brands" class="owl-carousel owl-theme">
                        @foreach($partners as $partner)
                            <div class="item">
                                <a href="{{ $partner->url }}" target="_blank"><img src="{{ Storage::url($partner->logo) }}" alt=""></a>
                            </div>
                    @endforeach


                    <!-- /item -->
                    </div>
                    <!-- /carousel -->
                </div>
            </div>
        </div>

        <div class="bg_color_1">
            <div class="container margin_60_35">
                <div class="main_title_2">
                    <h2>Features</h2>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="box_feat_2">
                            <h3><i class="pe-7s-graph3"></i>Analytics</h3>
                            <p>Data regarding traffic offences by time, location can be generated. Also the offence history of a suspect can be searched for and analysed before giving case verdict</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box_feat_2">
                            <h3><i class="pe-7s-wallet"></i>Easy payment</h3>
                            <p>Payment of fines and bonds is now easier using MPESA mobile money platform, Payment history and logs can also be easily viewed for ease of accountability</p>
                        </div>
                    </div>
                </div>
                <!-- /row -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="box_feat_2">
                            <h3><i class="pe-7s-mail"></i>SMS Notifications</h3>
                            <p>The suspect is notified through SMS during each stage of the case recording including legal officers decisions and the fine/bail amount to pay if any</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box_feat_2">
                            <h3><i class="pe-7s-help2"></i>Constant support</h3>
                            <p>Constant technical support is offered whenever required. Additionally there is a help/faq page with lots of commonly requested for information.</p>
                        </div>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /bg_color_1 -->

{{--        <div class="call_section_2">--}}
{{--            <div class="wrapper">--}}
{{--                <div class="container">--}}
{{--                    <h3>Get started now with Vanno...improve your business.</h3>--}}
{{--                    <a class="btn_1 medium" href="pricing.html">Join Vanno Now!</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <!-- /call_section_2 -->

    </main>
@endsection

