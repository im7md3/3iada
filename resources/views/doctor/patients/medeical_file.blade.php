@extends('doctor.layouts.index')
@section('title')
{{ __('View the patient is medical file') }} | {{ $patient?->name }}
@endsection
@section('content')
<section class="main-section">
    <div class="container mb-5 mt-5">
        <div class="bg-white p-4 rounded-2 shadow">
            <ul class="nav nav-pills main-nav-tap mb-4" style="flex-wrap: wrap !important;">
                <li class="nav-item">
                    <a href="{{ route('doctor.patients.medical',['patient' => $patient->id,'type' => 'medical_files']) }}" class="nav-link {{ $screen_file == 'medical_files' ? 'active' : '' }}">
                        @lang('medical files') ({{ $patient->medical_files->count() }})
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('doctor.patients.medical',['patient' => $patient->id,'type' => 'sick_leave']) }}" class="nav-link {{ $screen_file == 'sick_leave' ? 'active' : '' }}">
                    @lang('Sick holidays') ({{ $patient->sick_leave_files->count() }})
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('doctor.patients.medical',['patient' => $patient->id,'type' => 'prescription']) }}" class="nav-link {{ $screen_file == 'prescription' ? 'active' : '' }}">
                    @lang('Prescription') ({{ $patient->prescription_files->count() }})
                    </a>
                </li>
            </ul>

            <div class=" main-tab-content">
                @include('doctor.patients.patients_files.' . $screen_file)
            </div>
        </div>
    </div>
</section>

@endsection
