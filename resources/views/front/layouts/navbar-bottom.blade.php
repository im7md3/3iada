<nav class="bottom-nav not-print">
    <div class="container">
        <a href="#" class="tog-show" data-show=".bottom-nav .list-item"><i class="fa-solid fa-bars"></i></a>
        <div class="nav-holder d-flex align-items-center justify-content-between">
            <ul class="list-item">
                <li>
                    <a class="item" href="{{ route('front.home') }}">
                        {{ __('admin.home') }}
                        <i class="i-item fa-solid fa-house"></i>
                    </a>
                </li>
                @can('read_patients')
                <li>
                    <a class="item" href="{{ route('front.patients.index') }}">
                        {{ __('admin.patients') }}
                        <i class="i-item fa-solid fa-users"></i>
                    </a>
                </li>
                @endcan
                @can('create_patients')
                <li>
                    <a class="item" href="{{ route('front.patients.create') }}">
                        {{ __('admin.Add patient') }}
                        <i class="i-item fa-solid fa-hospital-user"></i>
                    </a>
                </li>
                @endcan
                <li>
                    <a class="item" href="{{ route('front.appointments.index') }}">
                        {{ __('admin.Appointments') }}
                        <i class="i-item fa-solid fa-calendar-days"></i>
                    </a>
                </li>
                @if (App\Models\Setting::first()->emergency_active)
                @can('read_emergency')
                <li>
                    <a class="item" href="{{ route('front.emergencies') }}">
                        {{ __('Emergency patients') }}
                        <i class="i-item fa-solid fa-kit-medical"></i>
                    </a>
                </li>
                @endcan
                @endif
                @can('read_appointments')
                <li>
                    <a class="item" href="{{ route('front.appointments.today_appointments') }}">
                        {{ __('admin.today_appointments') }}
                        <i class="i-item fa-solid fa-calendar-days"></i>
                    </a>
                </li>
                @endcan

                @can('read_invoices')
                <li>
                    <a class="item" href="{{ route('front.invoices.index') }}">
                        {{ __('admin.invoices') }}
                        <i class="i-item fa-solid fa-file-invoice"></i>
                    </a>
                </li>
                <li>
                    <a class="item" href="{{ route('front.invoices.all_bonds') }}">
                        {{ __('admin.bonds') }}
                        <i class="i-item fa-solid fa-file-invoice"></i>
                    </a>
                </li>
                @endcan
                @if(setting()->pregnancy_follow)
                @can('read_pregnancy')
                <li>
                    <a class="item" href="{{route('front.pregnant')}}">
                        {{ __('Pregnancy follow') }}
                        <i class="i-item fa-solid fa-file-invoice"></i>
                        <div class="badge-count">
                            0 </div>
                    </a>
                </li>
                @endcan
                @endif
                @can('pay_visit_invoices')
                <li>
                    <a class="item" href="{{ route('front.pay_visit') }}">
                        {{ __('admin.Pay a visit') }}
                        <i class="i-item fa-solid fa-money-check-dollar"></i>
                        <div class="badge-count">
                            {{ App\Models\Invoice::whereRelation('employee', 'type', 'dr')->where('status', 'Unpaid')->where('type', 'visit')->count() }}
                        </div>
                    </a>
                </li>
                <li>
                    <a class="item" href="{{ route('front.pay_plan') }}">
                        {{ __('admin.Pay a Plan') }}
                        <i class="i-item fa-solid fa-money-check-dollar"></i>
                        <div class="badge-count">
                            {{ App\Models\Invoice::whereRelation('employee', 'type', 'dr')->where('status', 'Unpaid')->where('type', 'plan')->count() }}
                        </div>
                    </a>
                </li>
                @endcan
            </ul>
        </div>
    </div>
</nav>
