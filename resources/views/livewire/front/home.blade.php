<section class="main-section home">
    <div class="container">
        <ul class="nav nav-pills main-nav-tap mb-3 not-print" style="flex-wrap: wrap !important;">
            <li class="nav-item">
                <a href="#" wire:click="$set('screen','latest')" class="nav-link {{ $screen == 'latest' ? 'active' : '' }}">
                    {{ __('Latest statistics') }}
                </a>
            </li>
            @can('read_doctors_statistics')
            <li class="nav-item">
                <a href="#" wire:click="$set('screen','doctors')" class="d-flex align-items-center gap-2 nav-link {{ $screen == 'doctors' ? 'active' : '' }}">
                    {{ __('Doctors statistics') }}
                    <!-- <div class="badge-new">
                            {{ __('New') }}
                        </div> -->
                </a>
            </li>
            @endcan
        </ul>
        @if ($screen == 'latest')
        <div class=" main-tab-content border-0 pt-3 px-2 pb-0">
            <h4 class="small-heading mb-3">{{ __('Clinic statistics') }}</h4>
            <div class="row g-3 mb-4 boxes-info">
                @can('read_patients')
                <div class="col-sm-6 col-lg-3">
                    <a href="{{ route('front.patients.index') }}">
                        <div class="box-info blue">
                            <i class="fas fa-solid fa-bed-pulse bg-icon"></i>
                            <div class="num">{{ App\Models\Patient::count() }}</div>
                            <div class="text">{{ __('admin.All patients') }}</div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <a href="{{ route('front.patients.index', ['toDay' => true]) }}">
                        <div class="box-info green">
                            <i class="fas fa-solid fa-address-card bg-icon"></i>
                            <div class="num">{{ App\Models\Patient::whereDate('created_at', now())->count() }}
                            </div>
                            <div class="text">{{ __('admin.Registered today') }}</div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <a href="{{ route('front.patients.index', ['saudi' => true]) }}">
                        <div class="box-info green">
                            <i class="fas fa-solid fa-address-card bg-icon"></i>
                            <div class="num">{{ App\Models\Patient::where('country_id', 1)->count() }}</div>
                            <div class="text">{{ __('Saudi Patients') }}</div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <a href="{{ route('front.patients.index', ['saudi' => 'false']) }}">
                        <div class="box-info green">
                            <i class="fas fa-solid fa-address-card bg-icon"></i>
                            <div class="num">{{ App\Models\Patient::where('country_id', '<>', 1)->count() }}
                            </div>
                            <div class="text">{{ __('Non-Saudi patients') }}</div>
                        </div>
                    </a>
                </div>
                @endcan



                @can('read_appointments')
                <div class="col-sm-6 col-lg-3">
                    <a href="{{ route('front.appointments.index', ['today' => true]) }}">
                        <div class="box-info pur">
                            <i class="fas fa-solid fa-calendar-check bg-icon"></i>
                            <div class="num">{{ App\Models\Appointment::today()->count() }}</div>
                            <div class="text">{{ __('admin.Today appointments') }}</div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <a href="{{ route('front.appointment.transferred') }}">
                        <div class="box-info pur">
                            <i class="fas fa-solid fa-calendar-check bg-icon"></i>
                            <div class="num">{{ App\Models\Appointment::transferred()->count() }}</div>
                            <div class="text">{{ __('admin.Transferred patients') }}</div>
                        </div>
                    </a>
                </div>
                @endcan
                @can('read_invoices')
                <div class="col-sm-6 col-lg-3">
                    <a href="{{ route('front.pay_visit') }}">
                        <div class="box-info red">
                            <i class="fas fa-solid fa-file-invoice-dollar bg-icon"></i>
                            <div class="num">
                                {{ App\Models\Invoice::whereRelation('employee', 'type', 'dr')->where('status', 'Unpaid')->count() }}
                            </div>
                            <div class="text">{{ __('admin.Pay visits') }}</div>
                        </div>
                    </a>
                </div>
                @endcan

                <div class="col-sm-6 col-lg-3">
                    <a href="{{ route('front.invoices.index', ['status' => 'Unpaid']) }}">
                        <div class="box-info pur">
                            <!-- <i class="fas fa-solid fa-tv bg-icon"></i> -->
                            <i class="fa-solid fa-money-bill-trend-up bg-icon"></i>
                            <div class="num">{{ App\Models\Invoice::where('status', 'Unpaid')->count() }}</div>
                            <div class="text">{{ __('admin.Unpaid bills') }}</div>
                        </div>
                    </a>
                </div>
            </div>
            @can('read_appointments')
            <h4 class="small-heading mb-3">{{ __('admin.Latest appointments') }}</h4>
            <div class="latestAppointments-content bg-white p-3 rounded-2 shadow">
                <div class="table-responsive">
                    <table class="table main-table">
                        <thead>
                            <th>{{ __('admin.patient') }}</th>
                            <th>{{ __('admin.doctor') }}</th>
                            <th>{{ __('admin.clinic') }}</th>
                            <th>{{ __('admin.appointment_status') }}</th>
                            <th>{{ __('admin.appointment_time') }}</th>
                            <th>{{ __('admin.appointment_date') }}</th>

                        </thead>
                        <tbody>
                            @forelse(App\Models\Appointment::today()->get() as $appointment)
                            <tr>
                                <td>{{ $appointment->patient?->name }}</td>
                                <td>{{ $appointment->doctor?->name }}</td>
                                <td>{{ $appointment->clinic?->name }}</td>
                                <td>{{ __($appointment->appointment_status) }}</td>
                                <td>{{ $appointment->appointment_time }}</td>
                                <td>{{ $appointment->appointment_date }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="12">{{ __('There are no appointments') }}</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @endcan
        </div>
        @elseif($screen == 'doctors')
        @can('read_doctors_statistics')
        <div class="main-tab-content border-0 pt-3 px-2 pb-0">
            <h4 class="small-heading mb-3">{{ __('Doctors statistics') }}</h4>
            <div class="row mb-5">
                <div class="col-md-4 d-flex gap-3">
                    <input type="date" wire:model="from" class="form-control" id="from">
                    <input type="date" wire:model="to" class="form-control" id="to">
                </div>
            </div>
            <div class="row g-3 mb-4 boxes-info">
                @foreach ($users as $doctor)
                <div class="col-md-4">
                    <div class="card-doctor">
                        <div class="card-body text-center p-0">
                            <h5 class="option-name mb-0 xl text-white p-2 alt2-bg-color">{{ $doctor->name }}
                            </h5>
                            <div class="p-3">
                                <h6><span class="text-danger">القسم : </span>{{ $doctor->department?->name }}
                                </h6>
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <p><strong class="text-primary">مواعيد اليوم : </strong>
                                            {{ $doctor->appointments()->today()->count() }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong class="text-warning">صالة الإنتظار : </strong>
                                            {{ $doctor->appointments()->today()->where(function ($qu) {
                                                                $qu->where('appointment_status', 'confirmed')->orWhere('appointment_status', 'transferred');
                                                            })->count() }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong class="text-gray">مواعيد المراجعة : </strong>
                                            {{ $doctor->appointments->where('review', 1)->count() }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong class="text-danger">تم الكشف : </strong>
                                            {{ $doctor->appointments->where('appointment_status', 'examined')->count() }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endcan
        @endif

    </div>
</section>