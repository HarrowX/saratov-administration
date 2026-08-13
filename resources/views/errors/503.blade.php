@extends('errors::minimal',  [
    'disabledHomeLink' => true
    ])

@section('title', 'Технические работы')
@section('code', '503')
@section('message', 'Скоро вернёмся')
@section('description','Мы проводим технические работы. Загляните позже, будет интересно.')
@section('extra_styles')
    <style>
        .error-gradient-text {
            background-image: url('{{ asset('images/bgError500.jpg') }}') !important;
        }
    </style>
@endsection
