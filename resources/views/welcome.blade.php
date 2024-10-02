@extends('layouts.html')

@section('content')
    <div class="text-center">

        <h1>
            Projeto Laravel + Vite!
        </h1>

        <img src="{{ URL::asset('/assets/LOGO_BFN.png') }}" alt="profile Pic" height="200" width="200">

        <img src="{{ URL::asset('https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg') }}"
            width="400" alt="Laravel Logo">

        <img src="{{ URL::asset('https://vitejs.dev/logo.svg') }}" width="110" alt="Vite logo">

    </div>
@endsection