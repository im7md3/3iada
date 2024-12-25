@extends('front.layouts.front')
@section('title')
    {{ __('admin.Expense report') }}
@endsection
@section('content')
@livewire('reports.expenses-report')


@endsection
