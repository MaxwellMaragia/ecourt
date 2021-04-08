@extends('user/layouts/app')
@section('main-content')
    <section id="banner">
        <h2>Welcome to Ecourt.</h2>
        <p>Fast, easy and efficient traffic offence handling.</p>
        <ul class="actions">
            <li>
                <a href="{{ route('login') }}" class="button big">Sign in</a>
            </li>
        </ul>
    </section>

    <section id="one" class="wrapper style1 special">
        <div class="container">
            <header class="major">
                <h2>Why Ecourt?</h2>
            </header>
            <div class="row 100%">
                <div class="4u 12u$(medium)">
                    <section class="box">
                        <i class="icon big rounded color1 fa-cloud"></i>
                        <h3>Single platform</h3>
                        <p>All relevant personnel regarding an offence work on one platform</p>
                    </section>
                </div>
                <div class="4u 12u$(medium)">
                    <section class="box">
                        <i class="icon big rounded color9 fa-desktop"></i>
                        <h3>Notifications</h3>
                        <p>Offender receives SMS notifications at each stage of the case.</p>
                    </section>
                </div>
                <div class="4u$ 12u$(medium)">
                    <section class="box">
                        <i class="icon big rounded color6 fa-rocket"></i>
                        <h3>Easy payment</h3>
                        <p>Payment of fines and bail is easier through mobile MPESA.</p>
                    </section>
                </div>
            </div>
        </div>
    </section>

@endsection

