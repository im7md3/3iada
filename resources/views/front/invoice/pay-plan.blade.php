@extends('front.layouts.front')
@section('title')
    {{ __('invoices') }}
@endsection
@section('content')
    @livewire('invoices.pay-plan')
@endsection
