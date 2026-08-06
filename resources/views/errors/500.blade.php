@extends('errors::minimal')

@section('title', 'Ошибка сервера')
@section('code', '500')
@section('message', 'Кажется, система устала')
@section('description', 'Мы скоро всё исправим. Попробуйте зайти позже.')
@section('extra_styles')
    <style>
        .error-gradient-text {
            background-image: url('{{ asset('images/bgError500.jpg') }}') !important;
        }
    </style>
@endsection
