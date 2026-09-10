@extends('errors::minimal')

@section('title', __('Payment Required'))
@section('code', '402')
@section('message', __('Payment Required'))
@section('description',__('Payment Required'))
@section('extra_styles')
    <style>
        .error-gradient-text {
            background-image: url('{{ asset('images/bg-error-404.jpg') }}') !important;
        }
    </style>
@endsection
