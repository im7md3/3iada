<section class="main-section users">
    <!-- @if ($errors->any())
@foreach ($errors->all() as $error)
<div class="alert alert-warning">{{ $error }}</div>
@endforeach
@endif -->
    <x-alert></x-alert>
    <div class="container">
        <h4 class="main-heading">{{ __('admin.View patient') }}</h4>
        <div class="row row-gap-24">
            <div class="col-lg-3">
                <div class="list-group main-list-group">
                    <button wire:click='$set("screen","data")' type="button"
                        class="list-group-item list-group-item-action {{ $screen == 'data' ? 'active' : '' }}">
                        {{ __('admin.Patient data') }}
                    </button>

                    @can('read_invoices')
                        <button wire:click='$set("screen","invoices")' type="button"
                            class="list-group-item list-group-item-action {{ $screen == 'invoices' ? 'active' : '' }}">
                            {{ __('Patient invoices') }}
                            <div class="badge-count">
                                {{ $patient->invoices()->count() }}
                            </div>
                        </button>
                    @endcan

                    <button wire:click='$set("screen","appointments")' type="button"
                        class="list-group-item list-group-item-action {{ $screen == 'appointments' ? 'active' : '' }}">
                        {{ __('admin.Patient appointments') }}
                        <div class="badge-count">
                            {{ $patient->appointments()->count() }}
                        </div>
                    </button>
                    @if (auth()->user()->is_orthodontics)
                        <button wire:click='$set("screen","orthodontics")' type="button"
                            class="list-group-item list-group-item-action {{ $screen == 'orthodontics' ? 'active' : '' }}">
                            {{ __('admin.Patient diagnoses') }}
                            <div class="badge-count">
                                {{ $patient->orthodontics()->count() }}
                            </div>
                        </button>
                    @else
                        <button wire:click='$set("screen","diagnoses")' type="button"
                            class="list-group-item list-group-item-action {{ $screen == 'diagnoses' ? 'active' : '' }}">
                            {{ __('admin.Patient diagnoses') }}
                            <div class="badge-count">
                                {{ $patient->diagnoses()->count() }}
                            </div>
                        </button>
                    @endif

                    <a href="{{ route('doctor.patients.medical', $patient) }}"
                        class="list-group-item list-group-item-action">
                        ملفات المريض <div class="badge-count">
                            {{ $patient->files()->count() }}
                        </div>
                    </a>
                    <button wire:click='$set("screen","treatment-plan")' type="button"
                        class="list-group-item list-group-item-action {{ $screen == 'treatment-plan' ? 'active' : '' }}">
                        {{ __('Therapeutic plan') }}
                        <div class="badge-count">
                            {{ $patient->treatment_plans()->count() }}
                        </div>
                    </button>

                    @can('read_scan_requests')
                        <button wire:click='$set("screen","scan-requests")' type="button"
                            class="list-group-item list-group-item-action {{ $screen == 'scan-requests' ? 'active' : '' }}">
                            {{ __('Radiology Requests') }}
                            <div class="badge-count">
                                {{ $patient->scanRequests()->count() }}
                            </div>
                        </button>
                    @endcan

                    @can('read_lab_requests')
                        <button wire:click='$set("screen","labs")' type="button"
                            class="list-group-item list-group-item-action {{ $screen == 'labs' ? 'active' : '' }}">
                            {{ __('Lap Requests') }}
                            <div class="badge-count">
                                {{ $patient->labRequests()->count() }}
                            </div>
                        </button>
                    @endcan
                    <button wire:click='$set("screen","reports")' type="button"
                        class="list-group-item list-group-item-action {{ $screen == 'reports' ? 'active' : '' }}">
                        {{ __('Reports') }}
                        <div class="badge-count">
                            {{ $patient->reports()->count() }}
                        </div>
                    </button>
                    <button wire:click='$set("screen","contact")' type="button"
                        class="list-group-item list-group-item-action {{ $screen == 'contact' ? 'active' : '' }}">
                        {{ __('Contact data') }}
                    </button>
                </div>
            </div>

            <div class="col-lg-9">
                @include('doctor.patients.show-screens.' . $screen)
                <div class="row">
                    <div class="col-4">
                        {{ __('Number') }}:
                        <span class="text-main-color">{{ $patient->id }}</span>
                    </div>
                    <div class="col-4">
                        {{ __('admin.employee') }}:
                        <span class="text-main-color">{{ $patient->user?->name }}</span>
                    </div>
                    <div class="col-4">
                        {{ __('Latest employee update:') }}
                        <span class="text-main-color">{{ $patient->user?->name }}</span>
                    </div>
                </div>
                @can('profile_patients')
                    <div class="btn_holder d-flex align-items-center justify-content-center my-3">
                        <a href="{{ route('doctor.patientFile', $patient->id) }}" class="btn btn-sm btn-purple">
                            <i class="fa fa-eye"></i>
                            {{ __('View the patient is medical file') }}
                        </a>
                    </div>
                @endcan

            </div>
        </div>
    </div>
</section>
