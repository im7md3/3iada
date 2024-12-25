@extends('front.layouts.front')
@section('title')
    {{ __('Vital Signs') }}
@endsection
@section('content')
    @livewire('marks')
@endsection
