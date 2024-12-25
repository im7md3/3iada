<section class="main-section users">
    <x-alert></x-alert>

    <div class="container-fluid" id="data-table">

        <div class="d-flex align-items-center gap-4 felx-wrap justify-content-between mb-3">
            <h4 class="main-heading mb-0">{{ __('admin.patients') }}</h4>
        </div>
        <div class="bg-white shadow p-4 rounded-3">
            <div class="amountPatients-holder gap-2 d-flex align-items-start align-items-md-center justify-content-between flex-column flex-md-row">
                <div class="d-flex flex-column flex-md-row">
                    <div class="py-2 px-3 bg-info rounded text-white ">
                        {{ __('Saudi patients') }} : {{ App\Models\Patient::where('country_id', 1)->count() }}
                    </div>
                    <div class="py-2 px-3 bg-info rounded text-white mx-0 my-2 my-md-0 mx-md-2">
                        {{ __('Non-Saudi Patients') }} : {{ App\Models\Patient::where('country_id', '<>', 1)->count() }}
                    </div>
                    <div class="py-2 px-3 bg-info rounded text-white" style="cursor: pointer" wire:click='$toggle("filter_visit")'>
                        {{ __('Registered Visitor') }} : {{ App\Models\Patient::where('visitor', 1)->count() }}
                    </div>
                </div>
                <div class="btn-holders">
                    <button type="button" class="btn btn-outline-secondary btn-sm rounded-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="{{ __('Visitor registrars are those who have made reservations over the phone or via the website and their data is completed when they attend the clinic') }}">
                        <i class="fa-solid fa-question"></i>
                    </button>
                    <button id="btn-prt-content" class="print-btn btn btn-sm btn-warning py-1">
                        <i class="fa-solid fa-print"></i>
                    </button>
                    <button wire:click='export' class="print-btn btn btn-sm btn-primary py-1">
                        <i class="fa-solid fa-arrow-down"></i>
                    </button>
                </div>
            </div>

            <div class="">
                <div class="row my-3">
                    <div class="col-md-10 d-flex flex-column flex-md-row gap-2 px-0">
                        <div dir="ltr" class="input-group mb-2 mb-md-0">
                            <button id="button-addon2" type="button" class="btn btn-success input-group-addon">
                                {{ __('admin.Search') }}
                            </button>
                            <input dir="rtl" type="text" class="form-control" wire:model='civil' placeholder=" {{ __('admin.ID number search') }}" />
                        </div>

                        <div dir="ltr" class="input-group mb-2 mb-md-0">
                            <button id="button-addon2" type="button" class="btn btn-success input-group-addon">
                                {{ __('admin.Search') }}
                            </button>
                            <input dir="rtl" type="text" class="form-control" wire:model='phone' placeholder="{{ __('admin.Mobile number search') }}" />
                        </div>

                        <div dir="ltr" class="input-group mb-2 mb-md-0">
                            <button id="button-addon2" type="button" class="btn btn-success input-group-addon">
                                {{ __('admin.Search') }}
                            </button>
                            <input dir="rtl" type="text" class="form-control" wire:model='patient_id' placeholder="  {{ __('admin.Search by medical number') }}" />
                        </div>
                        <div dir="ltr" class="input-group ms-2 mb-2 mb-md-0">
                            <button id="button-addon2" type="button" class="btn btn-success input-group-addon">
                                {{ __('admin.Search') }}
                            </button>
                            <input dir="rtl" type="text" class="form-control" wire:model='first_name' placeholder="  {{ __('admin.Search by firstname') }}" />
                        </div>
                    </div>
                    @can('create_patients')
                    <div class="col-md-2 d-flex align-items-end justify-content-end px-0">
                        <div class="addBtn-holder ">
                            <a href="{{ route('front.patients.create') }}" class="btn-main-sm">
                                {{ __('admin.Add patient') }}
                                <i class="icon fa-solid fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    @endcan
                </div>
                <div id="prt-content">
                    <div class="d-block-print  d-none">
                        <div class="d-flex justify-content-between   p-3 my-3  rounded  " style='border-radius: 10px;border: 2px solid #ddd;'>
                            <div class="client-info">
                                <p class="title mb-2 text-end">{{ setting()->site_name }}</p>
                                <div class="d-flex un-flex flex-column flex-lg-row align-items-center justify-content-start justify-content-md-between gp">
                                    <div class="">
                                        <p class="mb-0">
                                            <span class=""> {{setting()->address}} </span>
                                        </p>
                                        <p class="mb-0">
                                            <span class=""> {{setting()->phone}} </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="logo">
                                <img src="{{ display_file(setting()->logo) }}" alt="" width="100" class="logo-img" />
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table main-table lg-table">
                            <thead>
                                <tr>
                                    <th>{{ __('admin.Medical number') }}</th>
                                    <th>{{ __('admin.name') }}</th>
                                    <th>{{ __('admin.Country') }}</th>
                                    @can('show_phone_patients')
                                    <th>{{ __('admin.phone') }}</th>
                                    @endcan
                                    <th>{{ __('Last Visit at') }}</th>
                                    @if (in_array(setting()->age_or_gender, ['age', 'all']))
                                    <th>{{ __('Age type') }}</th>
                                    @endif
                                    <th>{{ __('admin.Civil number') }}</th>
                                    <th>{{ __('Paid bills') }}</th>
                                    <th>{{ __('Unpaid bills') }}</th>
                                    <!-- <th>{{ __('Partially Paid') }}</th> -->
                                    <th>اخر زيارة</th>
                                    <th>{{ __('admin.Last modified by') }}</th>
                                    <th class="text-center not-print">{{ __('admin.managers') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($patients as $patient)
                                <tr>
                                    <td>{{ $patient->id }}</td>
                                    <td>{{ $patient->name }}</td>
                                    <td>{{ $patient->country?->name ?? null }}</td>
                                    @can('show_phone_patients')
                                    <td>{{ $patient->phone }}</td>
                                    @endcan
                                    {{-- <th>{{ $patient->appointments()->latest()->first()?->appointment_date }}</th> --}}
                                    <th>{{ $patient->invoices()->latest()->first()?->created_at->format('Y-m-d H:i') }}</th>

                                    @if (in_array(setting()->age_or_gender, ['age', 'all']))
                                    <th>{{ __($patient->age_type) }}</th>
                                    @endif
                                    <td>{{ $patient->civil }}</td>
                                    <td>
                                        <a href="{{ route('front.invoices.index', ['patient_id' => $patient->id, 'status' => 'Paid']) }}" class="btn btn-sm btn-outline-secondary">
                                            {{ $patient->invoices()->paid()->count() }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('front.invoices.index', ['patient_id' => $patient->id, 'status' => 'not-paid']) }}" class="btn btn-sm btn-outline-secondary">
                                            {{ $patient->invoices()->whereIn('status',['Unpaid','Partially Paid'])->count() }}
                                        </a>
                                    </td>
                                    <!-- <td>
                                        <a href="{{ route('front.invoices.index', ['patient_id' => $patient->id, 'status' => 'Partially Paid']) }}" class="btn btn-sm btn-outline-secondary">
                                            {{ $patient->invoices()->PartiallyPaid()->count() }}
                                        </a>
                                    </td> -->
                                    <th>{{ $patient->invoices()->latest()->first()?->created_at->format('Y-m-d H:i') }}</th>

                                    <td>{{ $patient->user?->name }}</td>
                                    <td class="not-print">
                                        <div class="d-flex align-items-center justify-content-center gap-1">
                                            <!--btn  Modal repeat-->
                                            {{-- <a href="" class="btn btn-sm btn-success py-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="واتساب">
                                                <i class="fa-brands fa-whatsapp"></i>
                                            </a> --}}
                                            <a target="_blank" href="https://wa.me/+966{{ $patient->phone }}">
                                                <img src="{{ asset('img/whatsapp.png') }}" alt="whatsapp icon" width="33">
                                            </a>
                                            <a href="{{ route('front.invoices.create', ['patient_id' => $patient->id]) }}" class="btn btn-sm btn-success py-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ __('admin.Add invoice') }}">
                                                <i class="fa-solid fa-file-invoice-dollar"></i>
                                            </a>

                                            <!-- <a href="{{ route('front.patients.medical', $patient) }}" class="btn btn-sm btn-primary py-1">
                                            <i class="fa fa-file"></i>
                                        </a> -->
                                            @can('transfer_patients')
                                            @if (App\Models\Setting::first()->emergency_active)
                                            <button type="button" class="btn btn-sm btn-warning py-1" data-bs-placement="top" data-bs-title="{{ __('Emergency Transfer') }}" data-bs-toggle="modal" data-bs-target="#emergency{{ $patient->id }}">
                                                <i class="i-item fa-solid fa-kit-medical"></i>
                                            </button>
                                            <div class="modal fade" id="emergency{{$patient->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore>
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">
                                                                {{ __('Transfer of the patient')}}
                                                                {{$patient->name }}
                                                                {{ __('to the emergency')}}
                                                            </h5>
                                                            <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input name="employee_id" type="hidden" value="{{auth()->id()}}">
                                                            <div class="d-flex gap-3 align-items-center mt-3 ">
                                                                <small class="ms-2">
                                                                    {{ __('Date')}} :
                                                                    <span class="text-main-color">{{date('Y-m-d')}}</span>
                                                                </small>
                                                                <small class="ms-2">
                                                                    {{ __('Day')}} :
                                                                    <span class="text-main-color">{{Carbon::now()->translatedFormat("D")}}</span>
                                                                </small>
                                                                <small>
                                                                    {{ __('Hour')}} :
                                                                    <span class="text-main-color">{{date('H:i')}}</span>
                                                                </small>
                                                            </div>
                                                            <hr />
                                                            <p class="mb-3 text-end">{{ __('emergency Transfer')}}</p>
                                                            <div class="alert alert-danger ">لن تظهر الحالة عند فنى الطوارئ إلا بعد تسديد الفاتورة</div>
                                                            <div class="row g-3 ">
                                                                <div class="col-md-4 text-end">
                                                                    <label for='clinic_id' class="small-label mb-2" for=""> {{ __('Clinic')}} </label>
                                                                    <select wire:model="clinic_id" class="main-select w-100 trans-select-color" id="clinic_id">
                                                                        <option value="">{{ __('admin.Clinic') }}</option>
                                                                        @foreach(\App\Models\Department::all() as
                                                                        $department)
                                                                        <option value="{{$department->id}}">
                                                                            {{$department->name}}
                                                                        </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4 text-end">
                                                                    <label for="emerg_id" class="small-label mb-2" for=""> فني الطواريء </label>
                                                                    <select wire:model='emerg_id' id="emerg_id" class="main-select w-100 trans-select-color">
                                                                        <option value="">@lang('Choose')</option>
                                                                        @foreach (App\Models\User::where('type','emergency')->get() as $drr)
                                                                        <option value="{{ $drr->id }}">{{ $drr->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4 text-end">
                                                                    <label for="appointment_date" class="mb-2 small-label">{{__('Period')}}</label>
                                                                    <select wire:model="appointment_duration" id="appointment_date" class="main-select w-100 trans-select-color">
                                                                        <option value="">{{ __('admin.Period') }}</option>
                                                                        <option value="morning">{{ __('admin.morning') }}</option>
                                                                        @if(setting()->evening_status)
                                                                        <option value="evening">{{ __('admin.evening') }}</option>
                                                                        @endif
                                                                    </select>

                                                                </div>
                                                                <div class="col-sm-3 text-end">
                                                                    <label for='number' class="small-label" for=""> {{ __('waiting number')}} </label>
                                                                    <input type="number" id="number" value="{{ $waiting }}" readonly class="form-control">
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">{{ __('admin.back') }}</button>
                                                            <button class="btn btn-sm  btn-success" data-bs-dismiss="modal" wire:click="emergency({{ $patient }})">{{ __('transfer') }}</button>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>

                                            @endif
                                            <button type="button" wire:click="transfer({{ $patient }})" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ __('Transfer of the patient') }}" class="btn btn-sm btn-primary py-1">
                                                <i class="fa fa-repeat"></i>
                                            </button>

                                            @endcan
                                            <a href="{{ route('front.patients.show', $patient) }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ __('admin.View patient') }}" class="btn btn-sm btn-purple py-1">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            @can('update_patients')
                                            <!-- <a href="{{ route('front.patients.edit', $patient) }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ __('Edit') }}" class="btn btn-sm btn-info text-white py-1">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a> -->
                                            @endcan
                                            @can('delete_patients')
                                            <!-- <button class="btn btn-sm btn-danger py-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ __('Delete') }}" data-bs-toggle="modal" data-bs-target="#delete_agent{{ $patient->id }}">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button> -->

                                            <div class="dropdown drop-table">
                                                <button class="btn btn-outline-secondary btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item text-center" href="{{ route('front.patients.edit', $patient) }}">
                                                            <i class="fa-solid fa-pen-to-square text-dark"></i>
                                                            تعديل
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <button class="dropdown-item text-center text-danger" data-bs-toggle="modal" data-bs-placement="top" data-bs-title="حذف" data-bs-target="#delete_agent{{ $patient->id }}">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                            حذف
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                            @include('front.patients.delete')
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $patients->links() }}
                <!-- All Modal -->
                <!-- Modal repeat -->
            </div>
        </div>
        @include('front.patients.transfer')
        @push('js')
        <script>
            window.livewire.on('trans_modal', function() {
                var myModal = new bootstrap.Modal(document.getElementById("trans"), {});
                myModal.show();
            })
        </script>
        @endpush

    </div>
</section>
