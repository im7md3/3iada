@extends('front.layouts.front')
@section('title')
{{ __('Patient group Discounts : :group',['group'=>$patient_group?->name]) }}
@endsection
@section('content')
@livewire('patient-group-discounts',['group' => $patient_group])
@endsection
