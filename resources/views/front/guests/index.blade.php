@extends('front.layouts.front')
@section('title')
    {{ __('admin.Add Appointment For Guest') }}
@endsection
@section('content')
@livewire('create-guests')

@endsection
