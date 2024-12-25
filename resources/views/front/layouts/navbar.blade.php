<nav class="top-nav not-print">
    <div class="container">
        <a href="#" class="tog-show" data-show=".top-nav .list-item"><i class="fa-solid fa-bars"></i></a>
        <ul class="list-item">
            <li>
                <div class="dropdown-hover item">
                    <a class="d-flex">{{ __('admin.Administration') }}
                        <div class="arrow-icon me-1">
                            <i class="fa-solid fa-angle-down"></i>
                        </div>
                    </a>
                    <ul class="listis-item " id="dropdown-lang">
                        @can('read_departments')
                            <li class="item-drop">
                                <a href="{{ route('front.departments.index') }}">
                                    <p class="text">{{ __('admin.departments') }}</p>
                                </a>
                            </li>
                        @endcan
                        @can('read_patient_groups')
                            <li class="item-drop">
                                <a href="{{ route('front.patient_groups.index') }}">
                                    <p class="text">{{ __('Patient groups') }}</p>
                                </a>
                            </li>
                        @endcan
                        @can('read_products')
                            <li class="item-drop">
                                <a href="{{ route('front.products.index') }}">
                                    <p class="text">{{ __('admin.Therapeutic services') }}</p>
                                </a>
                            </li>
                        @endcan
                        @can('read_scan_names')
                            <li class="item-drop">
                                <a href="{{ route('front.scan_names.index') }}">
                                    <p class="text">{{ __('Scan names') }}</p>
                                </a>
                            </li>
                        @endcan
                        @can('read_offers')
                            <li class="item-drop">
                                <a href="{{ route('front.offers.index') }}">
                                    <p class="text">{{ __('admin.Offers') }}</p>
                                </a>
                            </li>
                        @endcan
                        @can('read_forms')
                            <li class="item-drop">
                                <a href="{{ route('front.forms.index') }}">
                                    <p class="text">{{ __('admin.Forms') }}</p>
                                </a>
                            </li>
                        @endcan
                        <li class="item-drop">
                            <a href="{{ route('front.message') }}">
                                <p class="text">{{ __('admin.SMS_settings') }}</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('front.payment_methods') }}"
                                class="d-flex">{{ __('admin.payment_methods') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @can('read_reports')
                <li>
                    <a href="{{ route('front.reports') }}" class="d-flex">
                        {{ __('Accounting and reports') }}
                    </a>
                </li>
            @endcan
            @can('read_diagnoses')
                <li>
                    <a class="item" href="{{ route('front.diagnoses.index') }}">
                        {{ __('admin.Diagnoses') }}
                        <!-- <i class="i-item fa-solid fa-money-check-dollar"></i> -->
                    </a>
                </li>
            @endcan
            @can('transfered_appointments')
                <li>
                    <a href="{{ route('front.appointment.transferred') }}" class="d-flex">
                        {{ __('Transferred patients') }}
                        <div class="badge-count me-1 mb-1">
                            {{ App\Models\Appointment::where('appointment_status', 'transferred')->count() }}
                        </div>
                    </a>
                </li>
            @endcan
            @if (setting()->lab_active || setting()->scan_active)
                @canany(['read_scan_requests', 'read_lab_requests'])
                    <li>
                        <div class="dropdown-hover item">
                            <a class="d-flex">{{ __('Laboratory and radiology') }}
                                <div class="arrow-icon me-1">
                                    <i class="fa-solid fa-angle-down"></i>
                                </div>
                            </a>
                            <ul class="listis-item " id="dropdown-lang">
                                @if (setting()->lab_active)
                                    @can('read_lab_requests')
                                        <li class="item-drop">
                                            <a class="d-flex" href="{{ route('front.scan_lab_requests', ['screen' => 'lab']) }}">
                                                <p class="text">{{ __('Lab Requests') }}</p>
                                                <div class="badge-count">
                                                    {{ App\Models\LabRequest::where('status', 'pending')->count() }}
                                                </div>
                                            </a>
                                        </li>
                                    @endcan
                                @endif
                                @if (setting()->scan_active)
                                    @can('read_lab_requests')
                                        <li class="item-drop">
                                            <a class="d-flex"
                                                href="{{ route('front.scan_lab_requests', ['screen' => 'scan']) }}">
                                                <p class="text">{{ __('Scan Request') }}</p>
                                                <div class="badge-count">
                                                    {{ App\Models\ScanRequest::where('status', 'pending')->count() }}
                                                </div>
                                            </a>
                                        </li>
                                    @endcan
                                @endif
                            </ul>
                        </div>
                    </li>
                @endcanany
            @endif
            <li>
                <a href="{{ route('front.guide') }}" class="d-flex">
                    {{ __('User Manual') }}
                </a>
            </li>
            <li>
                <a href="{{ route('front.program_modules') }}" class="d-flex">
                    {{ __('Program additions') }}
                </a>
            </li>

            <li>
                <a href="{{ route('front.our-services') }}" class="d-flex">
                    {{ __('our services') }}
                </a>
            </li>

        </ul>
        <ul class="list-item notification">
            @admin
                <li class="">
                    <a href="{{ route('admin.home') }}" class="item" href="#">
                        {{ __('Dashboard') }}
                    </a>
                </li>
            @endadmin
            @can('read_notifications')
                <li>
                    <a href="{{ route('front.notifications') }}" class="d-flex">
                        <div class=" position-relative d-flex">
                            <i class="i-item fa-solid fa-bell fs-5"></i>
                            <div class="badge-count position-absolute top-0 start-0 translate-middle">
                                {{ App\Models\Notification::whereNull('user_id')->orWhere('user_id', auth()->user()->id)->where('seen', false)->count() }}
                            </div>
                        </div>
                    </a>
                </li>
            @endcan

            <li>
                @if (app()->getLocale() == 'ar')
                    <a href="{{ LaravelLocalization::getLocalizedURL('en') }}" class="d-flex">
                        <i class="fa-solid fa-language fs-5"></i>
                    </a>
                @else
                    <a href="{{ LaravelLocalization::getLocalizedURL('ar') }}" class="d-flex">
                        <i class="fa-solid fa-language fs-5"></i>
                    </a>
                @endif
            </li>
            <li>
                <div class="dropdown-hover" data-show="dropdown-lang">
                    <div class="icon-drop">
                        <i class="fa-solid fa-user icon"></i>
                    </div>
                    <p class="text">{{ auth()->user()->name }}</p>
                    <div class="arrow-icon">
                        <i class="fa-solid fa-angle-down"></i>
                    </div>
                    <ul class="listis-item" id="dropdown-lang">
                        <li class="item-drop">
                            <a href="{{ route('front.profile.vacations') }}">
                                {{ __('Permission requests / vacations') }}
                            </a>
                        </li>
                        <li class="item-drop">
                            <a href="#">
                                <form class="w-100" action="{{ route('logout') }}" method="POST" id="logout-form">
                                    @csrf
                                    <button class="border-0 bg-transparent p-0">
                                        <p class="text  d-flex"> {{ __('log out') }}</p>
                                    </button>
                                </form>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>

    </div>
</nav>
