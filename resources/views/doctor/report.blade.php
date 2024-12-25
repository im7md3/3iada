@extends('doctor.layouts.index')
@section('title')
{{ __('Reports') }}
@endsection
@section('content')
    @livewire('doctor-report')
@endsection
