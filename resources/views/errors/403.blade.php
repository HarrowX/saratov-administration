@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
@section('description', __('Forbidden'))
@section('extra_styles')
    <style>
        .error-gradient-text {
            background-image: url('{{ asset('images/bg-error-404.jpg') }}') !important;
        }
    </style>
@endsection
