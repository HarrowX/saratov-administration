@extends('errors::minimal')

@section('title', 'Не авторизован')
@section('code', '401')
@section('message', 'Вход не выполнен')
@section('description', 'Пожалуйста, войдите в систему, чтобы продолжить.')
@section('extra_styles')
    <style>
        .error-gradient-text {
            background-image: url('{{ asset('images/bg-error-404.jpg') }}') !important;
        }
    </style>
@endsection
