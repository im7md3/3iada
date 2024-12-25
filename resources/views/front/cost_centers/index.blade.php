@extends('front.layouts.front')

@section('title')
    @lang('admin.cost_centers')
@endsection

@section('content')
    @livewire('cost-centers.index')
@endsection
