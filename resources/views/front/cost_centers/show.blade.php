@extends('front.layouts.front')

@section('title')
    @lang('admin.cost_centers') | {{ $cost_center->name }}
@endsection

@section('content')
    @livewire('cost-centers.show', ['cost_center' => $cost_center], key($cost_center->id))
@endsection
