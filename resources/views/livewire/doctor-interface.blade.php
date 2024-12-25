<div class="getHeightContainer bg-white p-3 rounded-2 shadow reset-print">
    <x-alert></x-alert>
    @if ($appointment_id && $last_invoice)
    <div class="alert alert-danger d-flex align-items-center not-print" role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 ms-2"
            style="width: 17px;" viewBox="0 0 16 16" role="img" aria-label="Warning:">
            <path
                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </svg>
        <div>
            هذه الزيارة فاتورة مدفوعة كشف طبي من الموظف {{ $last_invoice->employee?->name }}
        </div>
    </div>
    @endif

    <div class="row">
        @if($selected_appointment)
        <div class="alert alert-danger">
            يجب عليك انهاء الجلسة لحفظ كل بيانات الجلسة من تشخيصات او وصفات طبية
        </div>
        @endif
        <div class="col-lg-3 ps-0 not-print" wire:poll.30000ms>
            <p class="mb-2">{{ __('patients') }} :</p>
            <ul class="list-unstyled main-nav-tap mb-3">
                <li class="nav-item" wire:click='$set("patients_screen","transfers")'>
                    <a class="nav-link active cursor-auto">
                        {{ __('Converters') }}
                        {{-- {{ doctor()->appointments()->Transferred()->today()->count() }} --}}
                        {{ doctor()->appointments()->Transferred()->today()->count() }}
                    </a>
                </li>
            </ul>
            <div class=" main-tab-content">
                <ul class=" d-flex flex-wrap gap-2">
                    {{-- @forelse(doctor()->appointments()->Transferred()->today()->get() as $appointment) --}}
                    @forelse(doctor()->appointments()->Transferred()->today()->get() as $appointment)
                    <li class="right-b color-gr">
                        <a href="#" wire:click="selectPatient({{ $appointment->id }})">
                            {{ $appointment->patient?->name }} <br> {{ $appointment->appointment_date }} |

                            @if($appointment->attended_at)
                            {{ setting()->h12_sys ? date('g:iA', strtotime($appointment->attended_at)) : date('G:iA',
                            strtotime($appointment->attended_at)) }}
                            @else
                            {{ setting()->h12_sys ? date('g:iA', strtotime($appointment->appointment_time)) :
                            date('G:iA', strtotime($appointment->appointment_time)) }}

                            @endif
                        </a>
                    </li>
                    <hr>
                    @empty
                    <li class="color-gr">{{ __('There is no') }}</li>
                    @endforelse
                </ul>
            </div>
            <ul class="mt-3 list-unstyled mb-0">
                <li class="nav-item alt-bg-color">
                    <a href="#" class="nav-link text-white cursor-auto" style="background-color: #f3ba0a !important;">
                        {{ __('Outstanding sessions') }}
                        {{ doctor()->appointments()->Suspend()->count() }}
                    </a>
                </li>
            </ul>
            <div class=" main-tab-content">
                <ul class="">
                    @forelse(doctor()->appointments()->Suspend()->get() as
                    $appointment)
                    <li class="right-b" style="color: #f3ba0a !important;"><a href="#"
                            style="color: #f3ba0a !important;" wire:click="selectPatient({{ $appointment->id }})">
                            {{ $appointment->patient?->name }} <br> {{ $appointment->appointment_date }} |
                            {{ setting()->h12_sys ? date('g:iA', strtotime($appointment->appointment_time)) :
                            date('G:iA', strtotime($appointment->appointment_time)) }}

                        </a>
                    </li>
                    @empty
                    <li class="alt-text-color">{{ __('There is no') }}</li>
                    @endforelse
                </ul>
            </div>
            <ul class="mt-3 list-unstyled mb-0">
                <li class="nav-item alt-bg-color" wire:click='$set("patients_screen","today")'>
                    <a href="#" class="nav-link text-white cursor-auto">
                        {{ __('Today appointments') }}
                        {{ $today_appointments->count() }}
                    </a>
                </li>
            </ul>
            <div class=" main-tab-content">
                <ul class="{{ $patients_screen == 'today' ? '' : '' }}">
                    @forelse($today_appointments as $appointment)
                    <li class="right-b alt-text-color"><a href="#" class="alt-text-color"
                            wire:click="selectPatient({{ $appointment->id }})">
                            {{ $appointment->patient?->name }} <br> {{ $appointment->appointment_date }} |

                            {{ setting()->h12_sys ? date('g:iA', strtotime($appointment->appointment_time)) :
                            date('G:iA', strtotime($appointment->appointment_time)) }}

                            <br>
                            {{ __('Attended at') }} {{ $appointment->attended_at }}
                        </a>

                    </li>
                    @empty
                    <li class="alt-text-color">{{ __('There is no') }}</li>
                    @endforelse
                </ul>
            </div>
        </div>
        <div class="col-lg-9 mt-3 mt-lg-0">
            <div class="d-flex mb-1 align-items-center not-print">
                <p class="mb-0">
                    {{ __('Patient name') }} :
                    {{ $patient->name ?? null }}
                </p>
                @if ($patient->sugar ?? null or $patient->pressure ?? null or $patient->is_pregnant ?? null)

                <div class="alert alert-danger d-flex align-items-center mb-0 py-2 ps-3 pe-2 me-2 ms-auto" role="alert">
                    <svg class="bi flex-shrink-0 ms-2 resize-svg-Bo" role="img" aria-label="Warning:">
                        <path
                            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </svg>
                    <div>
                        {{ __('The patient suffers from') }} :
                        @if ($patient->sugar)
                        <span>{{ __('diabetes') }},</span>
                        @endif
                        @if ($patient->pressure)
                        <span>{{ __('high blood pressure') }}, </span>
                        @endif
                        @if ($patient->is_pregnant)
                        <span>{{ __('pregnant') }}</span>
                        @endif

                    </div>
                </div>
                @endif
                <div class="d-flex align-items-center gap-1 me-auto">
                    @if ($patient)
                    <button type="submit" wire:click="endSession" class="btn btn-sm btn-danger ">
                        {{ __('End Session') }}
                    </button>
                    <a href="{{ route('doctor.patients.show', $patient) }}" target="_blank"
                        class="btn btn-sm btn-purple">
                        {{ __('Patient data') }}
                    </a>
                    <button type="submit" wire:click="$set('screen','treatment-plan')" class="btn btn-sm btn-dark ">
                        {{ __('Therapeutic plan') }}
                    </button>
                    <button type="submit" wire:click="suspendSession" class="btn btn-sm btn-warning">
                        {{ __('Suspension the session') }}
                    </button>
                    <button class="btn trans-btn btn-sm"> {{ __('admin.Book a new appointment') }}</button>
                    @endif
                    @if ($patient)
                    <a target="_blank" class="btn btn-sm btn-success"
                        href="{{ route('doctor.invoices.index', ['patient' => $patient->id]) }}">{{ __('Patient
                        invoices') }}</a>
                    @endif
                </div>

            </div>
            <div class="not-print">
                {{-- alert success --}}
                @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
            </div>

            <ul class="nav nav-pills main-nav-tap mb-3 not-print" style="flex-wrap: wrap !important;">
                <li class="nav-item" wire:click="$set('screen','current')">
                    <a href="#" class="nav-link {{ $screen == 'current' ? 'active' : '' }}">
                        {{ __('current diagnosis') }}
                    </a>
                </li>
                <li class="nav-item" wire:click="$set('screen','medical-describe')">
                    <a href="#" class="nav-link {{ $screen == 'medical-describe' ? 'active' : '' }}">
                        وصفات طبية
                    </a>
                </li>
                {{-- <li class="nav-item" wire:click="$set('screen','pregnancy')">
                    <a href="#" class="nav-link {{ $screen == 'pregnancy' ? 'active' : '' }}">
                        {{ __('Pregnancy follow') }}
                    </a>
                </li> --}}
                {{-- <li class="nav-item" wire:click="$set('screen','treatment-plan')">
                    <a href="#" class="nav-link {{ $screen == 'treatment-plan' ? 'active' : '' }}">
                        {{ __('Therapeutic plan') }}
                    </a>
                </li> --}}
                {{-- <li class="nav-item" wire:click="$set('screen','prescription')">
                    <a href="#" class="nav-link {{ $screen == 'prescription' ? 'active' : '' }} ">
                        {{ __('prescription') }}
                    </a>
                </li> --}}
                <li class="nav-item" wire:click="$set('screen','invoice')">
                    <a href="#" class="nav-link {{ $screen == 'invoice' ? 'active' : '' }}">
                        {{ __('Issuance of invoice') }}
                    </a>
                </li>
                @if(setting()->scan_active)
                <li class="nav-item" wire:click="$set('screen','scan')">
                    <a href="#" class="nav-link {{ $screen == 'scan' ? 'active' : '' }} ">
                        {{ __('Radiology students') }}
                    </a>
                </li>
                @endif
                @if(setting()->lab_active)
                <li class="nav-item" wire:click="$set('screen','lab')">
                    <a href="#" class="nav-link {{ $screen=='lab'?'active':'' }} ">
                        {{ __('Lab')}}
                    </a>
                </li>
                @endif
                @if(doctor()->is_optometrist)
                <li class="nav-item" wire:click="$set('screen','vision')">
                    <a href="#" class="nav-link {{ $screen == 'vision' ? 'active' : '' }}">
                        {{ __('Vision examination') }}
                    </a>
                </li>
                @endif
                <li class="nav-item" wire:click="$set('screen','prev')">
                    <a href="#" class="nav-link  {{ $screen == 'prev' ? 'active' : '' }}">
                        {{ __('previous diagnoses') }}
                    </a>
                </li>
                <li class="nav-item" wire:click="$set('screen','trans')">
                    <a href="#" class="nav-link {{ $screen == 'trans' ? 'active' : '' }}  ">
                        {{ __('Transfer of the patient') }}
                    </a>
                </li>

                @if (env('PHARMACY_ENABLED', false))
                <li class="nav-item" wire:click="$set('screen','pharmacy')">
                    <a href="#" class="nav-link {{ $screen == 'pharmacy' ? 'active' : '' }}  ">
                        {{ __('dispensing medicines') }}
                    </a>
                </li>
                @endif
                <li class="nav-item" wire:click="$set('screen','review')">
                    <a href="#" class="nav-link {{ $screen == 'review' ? 'active' : '' }}">
                        {{ __('admin.review') }}
                    </a>
                </li>


            </ul>
            {{-- @dump($month) --}}
            <div class=" main-tab-content reset-print-border">
                @if ($patient)
                @include('doctor.interfaces.' . $screen)
                @else
                {{ __('Please click on the patients name') }}
                @endif
            </div>
        </div>
    </div>
</div>
@push('js')
<x:pharaonic-select2::scripts />
@endpush