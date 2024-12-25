<section class="main-section">
    @section('title')
    {{ __('Emergency patients') }}
    @endsection
    <div class="dr-main-section ">
        @if(session()->has('success_message'))
        <div class="alert alert-success">
            {{ session('success_message') }}
        </div>
        @endif
        <div class="container-fluid">
            <h4 class="main-heading mb-4">{{ __('Emergency patients') }}</h4>
            <div class="bg-white p-3 rounded-2 shadow">

                <div class="filter-holder d-flex justify-content-between gap-2 mb-3 ">
                    <div class="d-flex gap-2">
                        <div class="info-data">
                            <label for="duration-from" class="small-label">{{ __('admin.from') }}</label>
                            <input type="date" class="form-control" value="2022-07-12" wire:model="from" id="duration-from" />
                        </div>
                        <div class="info-data">
                            <label for="duration-to" class="small-label">{{ __('admin.to') }}</label>
                            <input type="date" class="form-control" value="2024-03-03" wire:model="to" id="duration-to" />
                        </div>

                        <div class="info d-flex flex-column justify-content-end">
                            <button wire:click="$toggle('seen_filter')" class="btn btn-sm btn-{{!$seen_filter ? 'success' : 'warning'}} py-1">
                                @if(!$seen_filter)
                                {{ __('Number of patients seen') }} : <span class="fw-bold">{{ $exmaEmergencies }}
                                    @else
                                    {{ __('Number of patients not seen') }} : <span class="fw-bold">{{ $nonexmaEmergencies }}
                                        @endif
                                    </span>
                            </button>
                        </div>

                    </div>

                    <div class="d-flex justify-content-start align-items-center gap-1 mb-3">
                        <!-- <a href="{{ route('front.reception') }}" class="btn-main-sm">
                            <i class="fa-solid fa-kit-medical"></i>
                            {{ __('Emergency check') }}
                        </a> -->

                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-10 d-flex flex-column flex-md-row gap-2 px-0">
                        <div dir="ltr" class="input-group mb-md-0">
                            <button id="button-addon2" type="button" class="btn btn-success input-group-addon">
                                {{ __('admin.Search') }}
                            </button>
                            <input dir="rtl" type="text" class="form-control" wire:model='civil' placeholder=" {{ __('admin.ID number search') }}" />
                        </div>

                        <div dir="ltr" class="input-group mb-md-0">
                            <button id="button-addon3" type="button" class="btn btn-success input-group-addon">
                                {{ __('admin.Search') }}
                            </button>
                            <input dir="rtl" type="text" class="form-control" wire:model='phone' placeholder="{{ __('admin.Mobile number search') }}" />
                        </div>

                        <div dir="ltr" class="input-group mb-md-0">
                            <button id="button-addon4" type="button" class="btn btn-success input-group-addon">
                                {{ __('admin.Search') }}
                            </button>
                            <input dir="rtl" type="text" class="form-control" wire:model='patient_id' placeholder="  {{ __('admin.Search by medical number') }}" />
                        </div>
                        <div dir="ltr" class="input-group ms-2 mb-md-0">
                            <button id="button-addon5" type="button" class="btn btn-success input-group-addon">
                                {{ __('admin.Search') }}
                            </button>
                            <input dir="rtl" type="text" class="form-control" wire:model='name' placeholder="  {{ __('admin.Search by firstname') }}" />
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table main-table">
                        <thead>
                            <tr>
                                <th>{{ __('Medical number') }}</th>
                                <th>{{ __('name') }}</th>
                                <th>{{ __('phone') }}</th>
                                <th>{{ __('Age') }}</th>
                                <th>{{ __('Detection status') }}</th>
                                <th>{{ __('Detection time') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Technician') }}</th>
                                <th class="text-center not-print">{{ __('managers') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($emergencies as $e)

                            <tr>
                                <td>{{ $e->patient->id }}</td>
                                <td>{{ $e->patient->name }}</td>
                                <td>{{ $e->patient->phone }}</td>
                                {{-- <td>{{ $e->patient->age }}</td> --}}
                                @if (in_array(setting()->age_or_gender, ['age', 'all']))
                                <th>{{ __($e->patient->age_type) }}</th>
                                @endif
                                <td>
                                    @if($e->status=='pending')
                                    <span class="badge bg-warning">{{ __('pending') }}</span>
                                    @else
                                    <span class="badge bg-success">{{ __('Detected') }}</span>
                                    @endif
                                </td>
                                <td>{{Carbon::parse($e->time)->format('g:i A')  }}</td>
                                <td>{{ $e->date }}</td>
                                <td>{{ $e->tec?->name }}</td>
                                <td class="not-print">
                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                        @if($e->status == 'pending')
                                        <button class="btn btn-sm btn-secondary py-1" wire:click="setEmergency({{$e->id}})" data-bs-toggle="modal" data-bs-target="#Direct">
                                            {{ __('Add Signs') }}
                                        </button> @endif
                                        @if($e->marks)
                                        <button class="btn btn-sm btn-primary py-1" wire:click="setEmergency({{$e->id}})" data-bs-toggle="modal" data-bs-target="#table_agent">
                                            {{ __('Show Signs') }}
                                        </button>
                                        {{-- --}}
                                        {{-- <button type="button" wire:click="transfer({{ $e->patient }})" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ __('Transfer of the patient') }}" class="btn btn-sm btn-primary py-1">--}}
                                        {{-- <i class="fa fa-repeat"></i>--}}
                                        {{-- </button>--}}
                                        @endif

                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#print_agent{{ $e->id }}">
                                            <i class="fa-solid fa-print"></i>
                                        </button>
                                        <button wire:click="setEmergency({{$e->id}})" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#edit_agent">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger py-1" data-bs-toggle="modal" data-bs-target="#delete_agent{{ $e->id }}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                        <!-- Modal Show -->

                                        <!-- Modal Print -->
                                        <div class="modal fade" id="print_agent{{ $e->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">طباعة بيانات المريض</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="print-emergency">

                                                            <div class="holder-logo text-center d-none d-block-print">
                                                                <img src="{{ asset('img/logo-icon.png') }}" alt="logo" class="mb-1" width="80">
                                                                <p class="mb-1 fs-6">رقم الانتظار: 9#</p>
                                                                <p class="mb-0 fs-6">الموظف: خالد علي السيد</p>
                                                                <hr class="my-0">
                                                            </div>
                                                            <table class="table table-hover mb-0">
                                                                <tbody>
                                                                    <tr>
                                                                        <th class="text-center">بيانات المريض</th>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <div class="d-flex align-items">
                                                                <table class="table table-hover mb-0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th>اسم المريض</th>
                                                                            <td>{{ $e->patient->name }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>رقم الجوال</th>
                                                                            <td>{{ $e->patient->phone }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>تاريخ الكشف</th>
                                                                            <td>
                                                                                {{ $e->date }}
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <table class="table table-hover mb-0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th>العمر</th>
                                                                            @if (in_array(setting()->age_or_gender, ['age', 'all']))
                                                                            <td>{{ __($e->patient->age_type) }}</td>
                                                                            @endif
                                                                        </tr>
                                                                        <tr>
                                                                            <th>حالة الكشف</th>
                                                                            <td>
                                                                                @if($e->status=='pending')
                                                                                <span class="badge bg-warning">{{ __('pending') }}</span>
                                                                                @else
                                                                                <span class="badge bg-success">{{ __('Detected') }}</span>
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>الوقت</th>
                                                                            <td>{{ $e->time }}</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <table class="table table-hover mb-0">
                                                                <tbody>
                                                                    <tr>
                                                                        <th class="text-center">العلامات الحرارية</th>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <div class="d-flex align-items">
                                                                <table class="table table-hover mb-0">
                                                                    @php
                                                                    $markss =$e->marks;
                                                                    if ($markss){
                                                                    $first_chunk =array_slice($markss,0,4,true);
                                                                    $second_chunk =array_slice($markss,4,7,true);
                                                                    }
                                                                    @endphp
                                                                    <tbody>
                                                                        @if(isset($second_chunk))
                                                                        @foreach($second_chunk as $key =>$mark)
                                                                        <tr>
                                                                            <th>{{$key }}</th>
                                                                            <td>{{$mark}}</td>
                                                                        </tr>
                                                                        @endforeach
                                                                        @endif
                                                                    </tbody>
                                                                </table>
                                                                <table class="table table-hover mb-0">
                                                                    @if(isset($first_chunk))
                                                                    @foreach($first_chunk as $key =>$mark)
                                                                    <tr>
                                                                        <th>{{$key }}</th>
                                                                        <td>{{$mark}}</td>
                                                                    </tr>
                                                                    @endforeach
                                                                    @endif
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <style>
                                                            @media print {

                                                                .print-emergency table tr td,
                                                                th {
                                                                    font-size: 14px !important;
                                                                    padding: 4px !important;

                                                                }
                                                            }
                                                        </style>
                                                    </div>

                                                    <div class="modal-footer d-flex justify-content-between ">
                                                        <span>
                                                            فني الطوارئ / {{$e->tec?->name}}
                                                        </span>
                                                        <div>
                                                            <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                                                            <a href="{{route('front.emergency-print')}}" class="btn btn-sm btn-warning px-3"><i class="fa-solid fa-print"></i> {{ __('print') }}</a>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Edit -->
                                        <!-- Modal Delete -->
                                        <div class="modal fade" id="delete_agent{{ $e->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="small-heading">
                                                            هل أنت متأكد من عملية الحذف؟
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal">تراجع</button>
                                                        <button class="btn btn-sm btn-success px-3" data-bs-dismiss="modal" wire:click="delete({{ $e->id }})">نعم</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            {{-- Models  --}}
                            <div wire:ignore.self class="modal fade" id="edit_agent" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ __('Edit patient') }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row g-3">
                                                @foreach ($marks as $key=>$mark)
                                                @if($mark->name=="الحمل")
                                                @if($e_patient?->patient->gender == 'female')
                                                <label for="" class="small-label">{{ $mark->name }}</label>
                                                <select class="form-control" wire:model.defer="emergencyMarks.{{ $mark->name }}" id="">
                                                    <option value="">@lang('Select pregnancy status')</option>
                                                    <option value="نعم">@lang('Yes')</option>
                                                    <option value="لا">@lang('No')</option>
                                                </select>
                                                @endif
                                                @else
                                                <div class="col-md-4">
                                                    <label for="{{ $mark }}" class="small-label mb-1">{{ $mark->name }}</label>
                                                    <input wire:model.defer="emergencyMarks.{{ $mark->name }}" type="text" id="{{ $mark }}" class="form-control" value="{{ $mark }}">
                                                </div>
                                                @endif
                                                @endforeach
                                                <label for="" class=" small-label">الملاحظات</label>
                                                <textarea wire:model="notes" id="" rows="2" class="form-control"></textarea>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                                            <button type="button" wire:click="saveMarks({{$e_patient?->id}})" class="btn btn-sm btn-success px-3" data-bs-dismiss="modal">{{ __('Save') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div wire:ignore.self class="modal fade" id="Direct" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">@lang('Show Direct Signs')</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="d-flex mb-1 align-items-center">
                                                <p class="mb-0">
                                                    @lang('Patient name') :
                                                    {{$e_patient?->patient->name}}
                                                </p>
                                            </div>
                                            <ul class="nav nav-pills main-nav-tap mb-3" id="pills-tab" style="flex-wrap: wrap !important;">
                                                <li class="nav-item">
                                                    <button class="nav-link active" id="pills-diagnosis-tab" data-bs-toggle="pill" data-bs-target="#pills-diagnosis" aria-selected="true">
                                                        {{ __('Vital Signs') }}
                                                    </button>
                                                </li>
                                            </ul>
                                            <div class="main-tab-content tab-content" id="pills-tabContent">
                                                <div class="tab-pane fade show active" id="pills-diagnosis">
                                                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mb-3">
                                                        @foreach ($marks as $key=>$mark)
                                                        <div class="col">
                                                            <div class="inp-holder">
                                                                @if($mark->name=="الحمل")
                                                                @if($e_patient?->patient->gender == 'female')
                                                                <label for="" class="small-label">{{ $mark->name }}</label>
                                                                <select class="form-control" wire:model.defer="emergencyMarks.{{ $mark->name }}" id="">
                                                                    <option value="">@lang('Select pregnancy status')</option>
                                                                    <option value="نعم">@lang('Yes')</option>
                                                                    <option value="لا">@lang('No')</option>
                                                                </select>
                                                                @endif
                                                                @else
                                                                <input type="number" wire:model.defer="emergencyMarks.{{ $mark->name }}" id="" class="form-control">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="row g-3">
                                                        <div class="col-12 col-md-12">
                                                            <label for="" class="small-label">@lang('Notes')</label>
                                                            <textarea wire:model.defer="notes" id="" rows="5" class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" data-bs-dismiss="modal" class="btn btn-sm btn-danger">
                                                @lang('cancel')
                                            </button>
                                            <!-- <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal">{{ __('Cancel') }}</button> -->
                                            <button type="submit" class="btn btn-sm btn-success px-4" wire:click="saveMarks({{$e_patient?->id}})">
                                                @lang('Save')
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div wire:ignore.self class="modal fade" id="table_agent" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ __('Show vital signs') }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row g-3">
                                                @if($e_patient?->marks)
                                                @foreach ($e_patient->marks as $key=>$mark)
                                                <div class="col-md-4">
                                                    <label for="{{ $mark }}" class="small-label mb-1">{{ $key }}</label>
                                                    <input readonly type="text" id="{{ $mark }}" class="form-control" value="{{ $mark }}">
                                                </div>
                                                @endforeach
                                                <label for="" class=" small-label">الملاحظات</label>
                                                <textarea wire:model="notes" disabled id="" rows="2" class="form-control"></textarea>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                                            {{-- <button type="button" class="btn btn-sm btn-primary px-3" data-bs-dismiss="modal">{{ __('transfer') }}</button> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </tbody>
                    </table>
                </div>
                @include('front.patients.transfer')

            </div>
        </div>
    </div>
</section>
@push('js')
<script>
    window.livewire.on('trans_modal', function() {
        var myModal = new bootstrap.Modal(document.getElementById("trans"), {});
        myModal.show();
    })
</script>

@endpush