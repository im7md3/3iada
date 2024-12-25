<div class="dr-main-section">
    <div class="container">
        <h4 class="main-heading mb-4">{{ __('admin.home') }}</h4>

        <ul class="nav nav-pills main-nav-tap mb-3 not-print" style="flex-wrap: wrap !important;">
            <li class="nav-item">
                <a href="#" wire:click="$set('screen','latest')"
                    class="nav-link {{ $screen == 'latest' ? 'active' : '' }}">
                    {{ __('Latest statistics') }}
                </a>
            </li>
            @can('read_doctors_statistics')
                <li class="nav-item">
                    <a href="#" wire:click="$set('screen','doctors')"
                        class="d-flex align-items-center gap-2 nav-link {{ $screen == 'doctors' ? 'active' : '' }}">
                        {{ __('Doctors statistics') }}
                        <div class="badge-new">
                            {{ __('New') }}
                        </div>
                    </a>
                </li>
            @endcan
        </ul>

        @if ($screen == 'latest')
            <div class=" main-tab-content border-0 pt-3 px-2 pb-0">
                <h4 class="small-heading mb-3">{{ __('Clinic statistics') }}</h4>
                <div class="boxes-info-5 mb-4">
                    <a href="{{ route('doctor.patients.index') }}">
                        <div class="box-info blue">
                            <i class="fas fa-user-injured bg-icon"></i>
                            {{-- <div class="num">{{ doctor()->appointments()->examined()->count() }}</div> --}}
                            <div class="num">{{ App\Models\Patient::count() }}</div>

                            <div class="text">{{ __('All patients') }}</div>
                        </div>
                    </a>
                    <a href="{{ route('doctor.appointments.today_appointments') }}">
                        <div class="box-info green">
                            <i class="far fa-calendar-alt bg-icon"></i>
                            <div class="num">
                                <div class="num">{{ doctor()->appointments()->today()->count() }}</div>
                            </div>
                            <div class="text">{{ __('Today appointments') }}</div>
                        </div>
                    </a>
                    <a href="{{ route('doctor.interface') }}">
                        <div class="box-info pur">
                            <i class="fas fa-user-injured bg-icon"></i>
                            <div class="num">
                                {{ doctor()->appointments()->thisHour()->count() +doctor()->appointments()->Transferred()->count() }}
                            </div>
                            <div class="text">{{ __('online patients') }}</div>
                        </div>
                    </a>
                    <a href="{{ route('doctor.invoices.index') }}">
                        <div class="box-info red">
                            <i class="fas fa-file-invoice-dollar bg-icon"></i>
                            <div class="num">{{ doctor()->invoices()->count() }}</div>
                            <div class="text">{{ __('All Invoices') }}</div>
                        </div>
                    </a>
                    {{-- <a href="{{ route('doctor.invoices.index',['status' => 'unpaid']) }}"> --}}
                    <a href="{{ route('front.invoices.index', ['status' => 'Unpaid']) }}">

                        {{-- {{ route('front.invoices.index',['status'=>'Unpaid']) }} --}}
                        <div class="box-info orange">
                            <i class="fas fa-file-invoice bg-icon"></i>
                            <div class="num">{{ doctor()->invoices()->unpaid()->count() }}</div>
                            <div class="text">{{ __('Unpaid bills') }}</div>
                        </div>
                    </a>
                </div>
                <h4 class="small-heading mb-4">{{ __('Today appointments') }}</h4>
                <div class="tabla-content p-4 bg-white shadow rounded-3">
                    <div class="table-responsive">
                        <table class="table main-table mb-0">
                            <thead>
                                <th>{{ __('admin.patient') }}</th>
                                <th>{{ __('admin.appointment_status') }}</th>
                                <th>{{ __('admin.appointment_time') }}</th>
                                <th>{{ __('admin.appointment_date') }}</th>
                                <th>{{ __('actions') }}</th>
                            </thead>
                            <tbody>
                                @forelse ($appoints as $appoint)
                                    <tr>
                                        <td>{{ $appoint->patient ? $appoint->patient->name : 'المريض غير محدد' }}</td>
                                        <td>{{ __($appoint->appointment_status) }}</td>
                                        <td>{{ $appoint->appointment_time }}</td>
                                        <td>{{ $appoint->appointment_date }}</td>
                                        <td>

                                            @if ($appoint->appointment_status == 'pending')
                                                <button class="btn btn-sm btn-info"
                                                    wire:click="cancel({{ $appoint->id }})">{{ __('Cancel') }}</button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="12" class="small-label">
                                            {{ __('admin.Sorry, there are no results') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
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
                        <div class="col-md-4">
                            <div class="card">
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
                                                    {{ $doctor->appointments->where('review', 1)->count() }} </p>
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
                    </div>
                </div>
            @endcan
        @endif
    </div>
</div>
