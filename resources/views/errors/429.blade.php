@extends('errors::minimal')

@section('title', __('Too Many Requests'))
@section('code', '429')
@section('message', __('Too Many Requests'))
@section('description','Вы слишком часто обращаетесь к серверу. Отдохните немного и попробуйте снова.')
@section('extra_styles')
    <style>
        .error-gradient-text {
            background-image: url('{{ asset('images/bg-error-404.jpg') }}') !important;
        }
    </style>
@endsection
