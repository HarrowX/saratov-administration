@extends('errors::minimal')

@section('title', 'Страница не найдена')
@section('code', '404')
@section('message', 'Кажется, вы свернули не туда')
@section('description', 'Здесь ничего нет, но на главной точно есть что посмотреть')
@section('extra_styles')
    <style>
        .error-gradient-text {
            background-image: url('{{ asset('images/bg-error-404.jpg') }}') !important;
        }
    </style>
@endsection
