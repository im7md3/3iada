@extends('front.layouts.front')

@section('title')
    {{ __('admin.Invoice Bonds') }}
@endsection
@section('content')
    @livewire('invoices.all-bonds')
@endsection
