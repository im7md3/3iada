@extends('front.layouts.front')
@section('title')
{{ __('Prescriptions')}}
@endsection
@section('content')
@livewire('front.reports.prescriptions')

@endsection
