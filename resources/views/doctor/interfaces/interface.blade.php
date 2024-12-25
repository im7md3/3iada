@php
$layout = 'doctor.layouts.index';
if(doctor()->type == 'scan'){
$layout = 'scan.layouts.index';
}elseif(doctor()->type == 'lab'){
$layout = 'lab.layouts.index';
}
@endphp
@extends($layout)
@section('title')
{{ __('admin.doctor interface') }}
@endsection
@section('content')
<div class="container-fluid px-5">
    <h4 class="main-heading mb-4 not-print">{{ __('doctor interface')}}</h4>
    <livewire:doctor-interface />
</div>
@endsection
