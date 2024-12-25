@extends('front.layouts.front')
@section('title')
{{ __('admin.Doctors') }}
@endsection
@section('content')
@livewire('front.doctors')
@endsection
