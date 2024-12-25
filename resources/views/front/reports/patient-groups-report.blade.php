@extends('front.layouts.front')
@section('title')
{{ __('Patient groups report') }}
@endsection
@section('content')
    @livewire('reports.patient-groups-report')
@endsection
