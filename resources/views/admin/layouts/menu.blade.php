<div class="sidebar">
    <div class="tog-active d-none d-lg-block" data-tog="true" data-active=".app">
        <i class="fas fa-bars"></i>
    </div>
    <ul class="list ">
        <li class="list-item {{ request()->routeIs('admin.home') ? 'active' : '' }}">
            <a href="{{ route('admin.home') }}">
                <div>
                    <i class="fa-solid fa-house-user icon"></i>
                    {{ __('home') }}
                </div>
            </a>
        </li>
        <li class="list-item">
            <a target="_blank" href="{{ route('front.home') }}">
                <div>

                    <i class="fa-solid fa-desktop icon"></i>

                    {{ __('interface') }}
                </div>
            </a>
        </li>
        <li class="list-item {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
            <a href="{{ route('admin.settings') }}">
                <div>
                    <i class="fas fa-cog"></i>
                    {{ __('settings') }}
                </div>
            </a>
        </li>
        @if(setting()->whatsapp_status)
        <li class="list-item">
            <a data-bs-toggle="collapse" href="#message-library" aria-expanded="false">
                <div>
                    <i class="fas fa-envelope-open-text icon"></i>
                    رسائل Whatsapp
                </div>
                <i class="fa-solid fa-angle-right arrow"></i>
            </a>
        </li>
        <div id="message-library" class="collapse item-collapse">
            <li class="list-item">
                <a href="{{ route('admin.message_library.images') }}">
                    <div>
                        <i class="fas fa-envelope-open-text icon"></i>
                        مكتبه الرسايل المصورة
                    </div>
                </a>
            </li>
            <li class="list-item">
                <a href="{{ route('admin.message_library.texts') }}">
                    <div>
                        <i class="fas fa-envelope-open-text icon"></i>
                        مكتبه الرسايل النصية
                    </div>
                </a>
            </li>
            <li class="list-item">
                <a href="{{ route('admin.message_library.send_message') }}">
                    <div>
                        <i class="fas fa-envelope-open-text icon"></i>
                        ارسال رسالة
                    </div>
                </a>
            </li>
            <li class="list-item">
                <a href="{{ route('admin.message_library.send_message_settings') }}">
                    <div>
                        <i class="fas fa-envelope-open-text icon"></i>
                        اعدادات الرسائل
                    </div>
                </a>
            </li>

        </div>
        @endif
        <!-- @can('read_roles')
    <li class="list-item {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.roles.index') }}">
                            <div>
                                <i class="fas fa-chart-bar"></i>
                                {{ __('groups') }}
                            </div>
                        </a>
                    </li>
@endcan -->

        @can('read_departments')
        <li class="list-item {{ request()->routeIs('admin.departments.*') ? 'active' : '' }}">
            <a href="{{ route('admin.departments.index') }}">
                <div>
                    <i class="fa-solid fa-puzzle-piece"></i>
                    {{ __('admin.departments') }}
                </div>
            </a>
        </li>
        @endcan
        @can('read_users')
        <li class="list-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <a href="{{ route('admin.users.index') }}">
                <div>
                    <i class="fa-solid fa-user-tie"></i> {{ __('admin.users') }}
                </div>
            </a>
        </li>
        @endcan
        @if(setting()->marketers_status)
        <li class="list-item {{ request()->routeIs('admin.marketers') ? 'active' : '' }}">
            <a href="{{ route('admin.marketers') }}">
                <div>
                    <i class="fa-solid fa-user-tie"></i> المسوقين
                </div>
            </a>
        </li>
        @endif
        <li class="list-item {{ request()->routeIs('admin.marks.*') ? 'active' : '' }}">
            <a href="{{ route('admin.marks.index') }}">
                <div>
                    <i class="fa-solid fa-user-tie"></i> {{ __('Vital Signs') }}
                </div>
            </a>
        </li>
        @can('read_cities')
        <li class="list-item {{ request()->routeIs('admin.cities.*') ? 'active' : '' }}">
            <a href="{{ route('admin.cities.index') }}">
                <div>
                    <i class="fa-solid fa-building-wheat"></i> {{ __('admin.cities') }}

                </div>
            </a>
        </li>
        @endcan

        @if (App\Models\Setting::first()->message_active)
        <li class="list-item">
            <a href="{{ route('admin.sms_messages.index') }}">
                <div>
                    <i class="fas fa-envelope-open-text icon"></i>
                    {{ __('admin.sms_library') }}
                </div>
            </a>
        </li>

        <li class="list-item">
            <a href="{{ route('admin.massage.index') }}">
                <div>
                    <i class="fa-solid fa-address-card"></i> {{ __('admin.SMS_settings') }}
                </div>
            </a>
        </li>
        @endif
        <li class="list-item {{ request()->routeIs('admin.branches.*') ? 'active' : '' }}">
            <a href="{{ route('admin.branches.index') }}">
                <div>
                    <i class="fa-solid fa-puzzle-piece"></i>
                    {{ __('admin.branches') }}
                </div>
            </a>
        </li>
        @can('read_patients')

        <li class="list-item">
            <a data-bs-toggle="collapse" href="#settings" aria-expanded="false">
                <div>
                    <i class="fa-solid fa-hospital-user"></i>
                    {{ __('admin.patients') }}
                </div>
                <i class="fa-solid fa-angle-right arrow"></i>
            </a>
        </li>
        <div class="collapse item-collapse" id="settings">
            @can('read_patients')
            <li class="list-item">
                <a href="{{ route('admin.patients.index') }}">
                    <div>
                        <i class="fa-solid fa-hospital-user"></i> {{ __('admin.patients') }}
                    </div>
                </a>
            </li>
            @endcan

            @can('read_countries')
            <li class="list-item">
                <a href="{{ route('admin.countries.index') }}">
                    <div>
                        <i class="fa-solid fa-address-card"></i> {{ __('admin.countries') }}
                    </div>
                </a>
            </li>
            @endcan


            @can('read_relationships')
            <li class="list-item">
                <a href="{{ route('admin.relationships.index') }}">
                    <div>
                        <i class="fa-solid fa-users"></i> {{ __('admin.relationships') }}
                    </div>
                </a>
            </li>
            @endcan

            @can('read_diagnoses')
            <li class="list-item">
                <a href="{{ route('admin.diagnoses.index') }}">
                    <div>
                        <i class="fa-solid fa-comment-medical"></i> {{ __('admin.Diagnoses') }}
                    </div>
                </a>
            </li>
            @endcan

        </div>
        @endcan

        @can('read_forms')
        <li class="list-item {{ request()->routeIs('admin.forms.*') ? 'active' : '' }}">
            <a href="{{ route('admin.forms.index') }}">
                <div>
                    <i class="fa-solid fa-file-signature"></i> {{ __('admin.Forms') }}
                </div>
            </a>
        </li>
        @endcan

        @can('read_appointments')
        <li class="list-item {{ request()->routeIs('admin.appointments.*') ? 'active' : '' }}">
            <a href="{{ route('admin.appointments.index') }}">
                <div>
                    <i class="fa-solid fa-calendar-days"></i> {{ __('admin.appointments') }}
                </div>
            </a>
        </li>
        @endcan

        @can('read_invoices')
        <li class="list-item {{ request()->routeIs('admin.invoices.*') ? 'active' : '' }}">
            <a href="{{ route('admin.invoices.index') }}">
                <div>
                    <i class="fa-solid fa-file-invoice-dollar"></i> {{ __('admin.invoices') }}
                </div>
            </a>
        </li>
        @endcan

        @can('read_products')
        <li class="list-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
            <a href="{{ route('admin.products.index') }}">
                <div>
                    <i class="fa-solid fa-handshake-angle"></i> {{ __('admin.Therapeutic services') }}
                </div>
            </a>
        </li>
        @endcan

        <li class="list-item {{ request()->routeIs('admin.prescriptions.index') ? 'active' : '' }}">
            <a href="{{ route('admin.prescriptions.index') }}">
                <div>
                    <i class="fa-solid fa-file-waveform"></i> {{ __('Prescription') }}
                </div>
            </a>
        </li>

        @can('read_insurances')
        <li class="list-item {{ request()->routeIs('admin.insurances.*') ? 'active' : '' }}">
            <a href="{{ route('admin.insurances.index') }}">
                <div>
                    <i class="fa-solid fa-building"></i> {{ __('admin.insurances') }}
                </div>
            </a>
        </li>
        @endcan


        <li class="list-item">
            <a data-bs-toggle="collapse" href="#message-library" aria-expanded="false">
                <div>
                    <i class="fas fa-envelope-open-text icon"></i>
                    مكتبه الرسائل
                </div>
                <i class="fa-solid fa-angle-right arrow"></i>
            </a>
        </li>
        <div id="message-library" class="collapse item-collapse">
            <li class="list-item">
                <a href="{{ route('admin.message_library.images') }}" wire:navigate>
                    <div>
                        <i class="fas fa-envelope-open-text icon"></i>
                        مكتبه الرسايل المصورة
                    </div>
                </a>
            </li>
            <li class="list-item">
                <a href="{{ route('admin.message_library.texts') }}" wire:navigate>
                    <div>
                        <i class="fas fa-envelope-open-text icon"></i>
                        مكتبه الرسايل النصية
                    </div>
                </a>
            </li>
            <li class="list-item">
                <a href="{{ route('admin.message_library.send_message') }}" wire:navigate>
                    <div>
                        <i class="fas fa-envelope-open-text icon"></i>
                        ارسال رسالة
                    </div>
                </a>
            </li>
        </div>

        {{-- <li class="list-item {{ request()->routeIs('admin.vacations') ? 'active' : '' }}">
            <a href="{{ route('admin.vacations') }}">
                <div>
                    <i class="fa-solid fa-building"></i> {{ __('Vacation Requests') }}
                </div>
            </a>
        </li> --}}
        {{-- <li class="list-item {{ request()->routeIs('admin.user-manuals.*') ? 'active' : '' }}">
            <a href="{{ route('admin.user-manuals.index') }}">
                <div>
                    <i class="fa-solid fa-building"></i> {{ __('admin.user-manuals')}}
                </div>
            </a>
        </li> --}}
    </ul>
</div>