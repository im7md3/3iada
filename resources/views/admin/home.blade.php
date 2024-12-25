@extends('admin.layouts.admin')
@section('title')
{{ __('admin.home') }}
@endsection
@section('content')
<div class="homePage-content bg-white py-4 px-3">
  <h4 class="main-heading mb-4">{{ __('Clinic Management Program') }}</h4>
  <div class="row g-4">
    @can('read_patients')
    <div class="col-12 col-md-4 col-lg-3">
      <div class="box-data box-blue">
        <div class="bar-name">
          <h5 class="name">{{ __('Total patient') }}</h5>
          <div class="box-icon">
            <i class="fa fa-wheelchair"></i>
          </div>
        </div>
        <h4 class="amount">{{ App\Models\Patient::count() }}</h4>
        <a href="{{ route('admin.patients.index') }}" class="more">
          {{ __('More information') }}
          <i class="fa-solid fa-chevron-left"></i>
        </a>
      </div>
    </div>
    @endcan

    @can('read_users')
    <div class="col-12 col-md-4 col-lg-3">
      <div class="box-data box-orange">
        <div class="bar-name">
          <h5 class="name">{{ __('employees') }}</h5>
          <div class="box-icon">
            <i class="fa fa-users"></i>
          </div>
        </div>
        <h4 class="amount">{{ App\Models\User::where('type', 'recep')->count() }}</h4>
        <a href="{{ route('admin.users.index') }}" class="more">
          {{ __('More information') }}
          <i class="fa-solid fa-chevron-left"></i>
        </a>
      </div>
    </div>
    @endcan
    @can('read_roles')
    <div class="col-12 col-md-4 col-lg-3">
      <div class="box-data box-purple">
        <div class="bar-name">
          <h5 class="name">{{ __('Employee groups') }}</h5>
          <div class="box-icon">
            <i class="fa fa-users"></i>
          </div>
        </div>
        <h4 class="amount">{{ Spatie\Permission\Models\Role::count() }}</h4>
        <a href="{{ route('admin.roles.index') }}" class="more">
          {{ __('More information') }}
          <i class="fa-solid fa-chevron-left"></i>
        </a>
      </div>
    </div>
    @endcan
    @if(auth()->user()->type == 'admin')
    <div class="col-12 col-md-4 col-lg-3">
      <div class="box-data box-main-color">
        <div class="bar-name">
          <h5 class="name">{{ __('Supervisors') }}</h5>
          <div class="box-icon">
            <i class="fa fa-users"></i>
          </div>
        </div>
        <h4 class="amount">{{ App\Models\User::where('type', 'admin')->count() }}</h4>
        <a href="{{ route('admin.users.index') }}" class="more">
          {{ __('More information') }}
          <i class="fa-solid fa-chevron-left"></i>
        </a>
      </div>
    </div>
    @endif
    @can('read_forms')
    <div class="col-12 col-md-4 col-lg-3">
      <div class="box-data box-main-color">
        <div class="bar-name">
          <h5 class="name">{{ __('Forms') }}</h5>
          <div class="box-icon">
            <i class="fa-brands fa-wpforms"></i>
          </div>
        </div>
        <h4 class="amount">{{ App\Models\Form::count() }}</h4>
        <a href="{{ route('admin.forms.index') }}" class="more">
          {{ __('More information') }}
          <i class="fa-solid fa-chevron-left"></i>
        </a>
      </div>
    </div>
    @endcan
    @can('read_departments')
    <div class="col-12 col-md-4 col-lg-3">
      <div class="box-data box-blue">
        <div class="bar-name">
          <h5 class="name">{{ __('Clinic departments') }}</h5>
          <div class="box-icon">
            <i class="fa fa-list-ol"></i>
          </div>
        </div>
        <h4 class="amount">{{ App\Models\Department::count() }}</h4>
        <a href="{{ route('admin.departments.index') }}" class="more">
          {{ __('More information') }}
          <i class="fa-solid fa-chevron-left"></i>
        </a>
      </div>
    </div>
    @endcan
    @can('read_appointments')
    <div class="col-12 col-md-4 col-lg-3">
      <div class="box-data box-red">
        <div class="bar-name">
          <h5 class="name">{{ __('Total appointments') }}</h5>
          <div class="box-icon">
            <i class="fa-solid fa-clock-rotate-left"></i>
          </div>
        </div>
        <h4 class="amount">{{ App\Models\Appointment::count() }}</h4>
        <a href="{{ route('admin.appointments.index') }}" class="more">
          {{ __('More information') }}
          <i class="fa-solid fa-chevron-left"></i>
        </a>
      </div>
    </div>
    @endcan

    @can('waiting_patients_appointments')
    <div class="col-12 col-md-4 col-lg-3">
      <div class="box-data box-orange">
        <div class="bar-name">
          <h5 class="name">{{ __('Appointments Wait') }}</h5>
          <div class="box-icon">
            <i class="fa-solid fa-clock-rotate-left"></i>
          </div>
        </div>
        <h4 class="amount">{{ App\Models\Appointment::where('appointment_status', 'pending')->count() }}</h4>
        <a href="{{ route('admin.appointments.index') }}" class="more">
          {{ __('More information') }}
          <i class="fa-solid fa-chevron-left"></i>
        </a>
      </div>
    </div>
    @endcan
    @can('delete_appointments')
    <div class="col-12 col-md-4 col-lg-3">
      <div class="box-data box-red">
        <div class="bar-name">
          <h5 class="name">{{ __('Appointments - did not attend') }}</h5>
          <div class="box-icon">
            <i class="fa-solid fa-clock-rotate-left"></i>
          </div>
        </div>
        <h4 class="amount">{{ App\Models\Appointment::where('appointment_status', 'cancelled')->count() }}</h4>
        <a href="{{ route('admin.appointments.index') }}" class="more">
          {{ __('More information') }}
          <i class="fa-solid fa-chevron-left"></i>
        </a>
      </div>
    </div>
    @endcan
    @can('read_appointments')
    <div class="col-12 col-md-4 col-lg-3">
      <div class="box-data box-green">
        <div class="bar-name">
          <h5 class="name">{{ __('Appointments - Attend') }}</h5>
          <div class="box-icon">
            <i class="fa-solid fa-clock-rotate-left"></i>
          </div>
        </div>
        <h4 class="amount">{{ App\Models\Appointment::where('appointment_status', 'confirmed')->count() }}
        </h4>
        <a href="{{ route('admin.appointments.index') }}" class="more">
          {{ __('More information') }}
          <i class="fa-solid fa-chevron-left"></i>
        </a>
      </div>
    </div>
    <div class="col-12 col-md-4 col-lg-3">
      <div class="box-data box-blue">
        <div class="bar-name">
          <h5 class="name">{{ __('Appointments - Confirmed') }}</h5>
          <div class="box-icon">
            <i class="fa-solid fa-clock-rotate-left"></i>
          </div>
        </div>
        <h4 class="amount">{{ App\Models\Appointment::where('appointment_status', 'examined')->count() }}</h4>
        <a href="{{ route('admin.appointments.index') }}" class="more">
          {{ __('More information') }}
          <i class="fa-solid fa-chevron-left"></i>
        </a>
      </div>
    </div>
    @endcan

    @can('read_diagnoses')
    <div class="col-12 col-md-4 col-lg-3">
      <div class="box-data box-purple">
        <div class="bar-name">
          <h5 class="name">{{ __('Diagnosis') }}</h5>
          <div class="box-icon">
            <i class="fa fa-wheelchair"></i>
          </div>
        </div>
        <h4 class="amount">{{ App\Models\Diagnose::count() }}</h4>
        <a href="{{ route('admin.diagnoses.index') }}" class="more">
          {{ __('More information') }}
          <i class="fa-solid fa-chevron-left"></i>
        </a>
      </div>
    </div>
    @endcan
    @can('read_invoices')
    <div class="col-12 col-md-4 col-lg-3">
      <div class="box-data box-main-color">
        <div class="bar-name">
          <h5 class="name">{{ __('All Invoices') }}</h5>
          <div class="box-icon">
            <i class="fa-solid fa-copy"></i>
          </div>
        </div>
        <h4 class="amount">{{ App\Models\Invoice::count() }}</h4>
        <a href="{{ route('admin.invoices.index') }}" class="more">
          {{ __('More information') }}
          <i class="fa-solid fa-chevron-left"></i>
        </a>
      </div>
    </div>
    <div class="col-12 col-md-4 col-lg-3">
      <div class="box-data box-blue">
        <div class="bar-name">
          <h5 class="name">{{ __('Paid invoices') }}</h5>
          <div class="box-icon">
            <i class="fa-solid fa-copy"></i>
          </div>
        </div>
        <h4 class="amount">{{ App\Models\Invoice::where('status', 'Paid')->count() }}</h4>
        <a href="{{ route('admin.invoices.index') }}" class="more">
          {{ __('More information') }}
          <i class="fa-solid fa-chevron-left"></i>
        </a>
      </div>
    </div>
    <div class="col-12 col-md-4 col-lg-3">
      <div class="box-data box-red">
        <div class="bar-name">
          <h5 class="name">{{ __('Unpaid invoices') }}</h5>
          <div class="box-icon">
            <i class="fa-solid fa-copy"></i>
          </div>
        </div>
        <h4 class="amount">{{ App\Models\Invoice::where('status', 'Unpaid')->count() }}</h4>
        <a href="{{ route('admin.invoices.index') }}" class="more">
          {{ __('More information') }}
          <i class="fa-solid fa-chevron-left"></i>
        </a>
      </div>
    </div>
    <div class="col-12 col-md-4 col-lg-3">
      <div class="box-data box-orange">
        <div class="bar-name">
          <h5 class="name">{{ __('Invoices Paid - Credit Card') }}</h5>
          <div class="box-icon">
            <i class="fa-brands fa-cc-mastercard"></i>
          </div>
        </div>
        <h4 class="amount">{{ App\Models\Invoice::where('status', 'Paid')->where('card', '>', 0)->count() }}
        </h4>
        <a href="{{ route('admin.invoices.index') }}" class="more">
          {{ __('More information') }}
          <i class="fa-solid fa-chevron-left"></i>
        </a>
      </div>
    </div>
    <div class="col-12 col-md-4 col-lg-3">
      <div class="box-data box-green">
        <div class="bar-name">
          <h5 class="name">{{ __('Paid invoices - Cash') }}</h5>
          <div class="box-icon">
            <i class="fa-solid fa-money-bill-1-wave"></i>
          </div>
        </div>
        <h4 class="amount">{{ App\Models\Invoice::where('status', 'Paid')->where('cash', '>', 0)->count() }}
        </h4>
        <a href="{{ route('admin.invoices.index') }}" class="more">
          {{ __('More information') }}
          <i class="fa-solid fa-chevron-left"></i>
        </a>
      </div>
    </div>
    @endcan

  </div>
</div>
@endsection