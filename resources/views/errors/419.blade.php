@extends('errors::minimal')

@section('title','Сессия истекла')
@section('code', '419')
@section('message', 'Сессия устарела')
@section('description','Обновите страницу и попробуйте снова.')
@section('extra_styles')
    <style>
        .error-gradient-text {
            background-image: url('{{ asset('images/bgError404.jpg') }}') !important;
        }
    </style>
@endsection
