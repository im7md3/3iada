<ul class="nav nav-pills main-nav-tap mb-4" style="flex-wrap: wrap !important;">
    <li class="nav-item">
        <button wire:click='$set("patientFilesType","dentist")' type="button" class="nav-link {{ $patientFilesType == 'dentist' ? 'active' : '' }}">
            @lang('Teeth')
        </button>
    </li>
    <li class="nav-item">
        <button wire:click='$set("patientFilesType","dermatologist")' type="button" class="nav-link {{ $patientFilesType == 'dermatologist' ? 'active' : '' }}">
            @lang('Dermatology')
        </button>
    </li>


    @if(setting()->pregnancy_follow && $patient->gender == 'female')
    <li class="nav-item">
        <button wire:click='$set("patientFilesType","serv3")' type="button" class="nav-link {{ $patientFilesType == 'serv3' ? 'active' : '' }}">
            @lang('Pregnancy follow')
        </button>
    </li>
    @endif
    @if(setting()->beautification)
    <li class="nav-item">
        <button wire:click='$set("patientFilesType","serv4")' type="button" class="nav-link {{ $patientFilesType == 'serv4' ? 'active' : '' }}">
            @lang('Beautification')
        </button>
    </li>
    @endif

</ul>

@if($patientFilesType == 'selectSrv')
<div class="box d-flex  justify-content-center  align-items-center h-100 ">
    <h3 class="">
        @lang('Please choose the appropriate section to display the results')
    </h3>
</div>

@elseif($patientFilesType == 'dentist')
<div class="d-flex justify-content-start mt-3">

</div>
<div class="table-responsive mt-2">
    <table class="table main-table">
        <thead>
            <tr>
                <th># </th>
                <th>@lang('Plan name') </th>
                <th>@lang('Date') </th>
                <th>@lang('Physician') </th>
                <th>@lang('Control') </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patient->treatment_plans ?? [] as $item)

            <tr>
                <td>{{ $loop->iteration }}</td>
                {{-- <td>{{ $item->plan_name }}</td> --}}
                <td>خطة علاجية رقم # {{ $item?->id }}</td>

                <td>{{ $item->created_at->format('Y-m-d') }}</td>
                <td>{{ $item->dr?->name }}</td>
                <td>
                    <a href="#">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>

<section class="select-teeth">
    <div class="toothArray content ">
        <img class="img-teeth" src="{{ asset('img/num.png') }}" alt="" />
        @foreach (getToothNumbers() as $tooth)
        <button class="btn-select" data-bs-toggle="modal" data-bs-target="#modal-select">
        </button>
        @endforeach
    </div>
</section>
<div class="row g-3">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-nowrap">{{ __('Teeth number') }}</th>
                <th>{{ __('Note') }}</th>
                <th>{{ __('products') }}</th>
                <th class="text-nowrap">{{ __('Processed') }}</th>
                <th>{{ __('total') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patient->treatment_plans ?? [] as $item)
            <tr>
                <td>{{ $item->tooth }}</td>
                <td class="text-nowrap">{{ $item->note }}</td>
                <td>
                    <div class="d-flex align-items-center flex-wrap gap-1">
                        @foreach ($item->products as $product)
                        <span class="badge bg-secondary">{{ $product->name }}</span>
                        @endforeach
                    </div>
                </td>
                <td>
                    @if ($item->is_treated)
                    <span class="badge bg-success">{{ __('Yes') }}</span>
                    @else
                    <span class="badge bg-danger">@lang('No')</span>
                    @endif
                </td>
                <td class="text-nowrap">{{ $item->amount }}</td>
            </tr>
            @endforeach
            <tr>
                <td>{{ __('total') }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $patient->treatment_plans->sum('amount') }}</td>
            </tr>
        </tbody>
    </table>
</div>

@elseif($patientFilesType == 'dermatologist')
<div class="d-flex justify-content-start mt-3">

</div>
{{-- <div class="table-responsive mt-2">
    <table class="table main-table">
        <thead>
            <tr>
                <th># </th>
                <th>@lang('Plan name') </th>
                <th>@lang('Date') </th>
                <th>@lang('Physician') </th>
                <th>@lang('Control') </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>--</td>
                <td>--</td>
                <td>--</td>
                <td>--</td>
                <td>
                    <a href="btn btn-sm btn-primary">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</div> --}}
<div class="table-responsive mt-2">
    <table class="table main-table">
        <thead>
            <tr>
                <th># </th>
                <th>@lang('Plan name') </th>
                <th>@lang('Date') </th>
                <th>@lang('Physician') </th>
                <th>@lang('Control') </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patient->treatment_plans ?? [] as $item)

            <tr>
                <td>{{ $loop->iteration }}</td>
                {{-- <td>{{ $item->name }}</td> --}}
                <td>خطة علاجية رقم # {{ $item?->id }}</td>

                <td>{{ $item->created_at->format('Y-m-d') }}</td>
                <td>{{ $item->dr?->name }}</td>
                <td>
                    <a href="btn btn-sm btn-primary">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
<section class="select-teeth">
    <div class="d-flex align-items-center justify-content-center">
        <div class="content-section p-3 body-point">
            <div class="header mb-3">
                <div class="row">
                    <div class="col-6 px-0">
                        <div class="right-side text-start">
                            <img src="{{ asset('img/human/right_side.png') }}" alt="">
                            @foreach ([2,4,6,8,10] as $point)
                            <input type="checkbox" wire:model='body.{{ $point }}' class="check-body">
                            {{-- wire:change='addBodyPoint({{ $point }})' --}}
                            @endforeach
                        </div>
                    </div>
                    <div class="col-6 px-0">
                        <div class="left-side">
                            <img src="{{ asset('img/human/left_side.png') }}" alt="">
                            @foreach ([1,3,5,7,9] as $point)
                            <input type="checkbox" wire:model='body.{{ $point }}' class="check-body">
                            {{-- wire:change='addBodyPoint({{ $point }})' --}}
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-6 ">
                        <div class="body-back text-start">
                            <img src="{{ asset('img/human/body-back.png') }}" alt="">
                            @for ($point = 26;$point < 39;$point++) <input type="checkbox" wire:model='body.{{ $point }}' class="check-body">
                                {{-- wire:change='addBodyPoint({{ $point }})' --}}
                                @endfor

                        </div>

                    </div>
                    <div class="col-6 ">
                        <div class="body-front">
                            <img src="{{ asset('img/human/body-front.png') }}" alt="">
                            @for ($point = 11;$point < 26;$point++) <input type="checkbox" wire:model='body.{{ $point }}' class="check-body">
                                {{-- wire:change='addBodyPoint({{ $point }})' --}}
                                @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@elseif($patientFilesType == 'serv3')
@if($patient->pregnancySession()->count())
<div class="d-flex justify-content-center gap-3 mt-4">
    @foreach ($patient->pregnancySession as $button)
    <button class="btn btn-{{ $button->is_compeleted ? 'success' : 'secondary' }} btn-sm {{ $button->id == $pregnancyId ? 'active' : '' }}" wire:click='setPregnancy({{ $button->id }})' type="button">
        متابعة {{ $loop->index + 1 }}
        <i class="fa-solid fa-folder-open text-light "></i>
    </button>
    @endforeach
</div>

@if($pregnancy)
<div class=" prefers-reduced-motion" id="collapseWidthExample">
    <div class="table-responsive mt-2">
        <table class="table main-table">
            <thead>
                <tr>
                    <th># </th>
                    <th>@lang('Plan name') </th>
                    <th>@lang('Date') </th>
                    <th>@lang('Physician') </th>
                    <th>@lang('week') </th>
                    <th>@lang('month') </th>
                    {{-- <th>@lang('Control') </th>  --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($pregnancy->pregnancies as $item)
                <tr>
                    <td>{{ $item?->id }}</td>
                    <td>خطة علاجية رقم # {{ $item?->id }}</td>
                    <td>{{ $item?->created_at->format('Y-m-d') }}</td>
                    <td>{{ $item?->appointment?->doctor?->name }}</td>
                    <td>{{ $item?->week }}</td>
                    <td>{{ $item?->month }}</td>
                    {{-- <td>--</td>  --}}
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <section class="p-3">
        <section class="main-data">
            <h6 class="">
                البيانات الاساسية:-
            </h6>
            <section class="table-responsive mt-4">
                <table class="table main-table m-0">
                    <thead>
                        <tr>
                            <th style="width: 20%;">عدد الابناء</th>
                            <th>اخر ولادة</th>
                            <th>مرض مزمن / سكر</th>
                            <th>مرض مزمن / ضغط</th>
                            <th>امراض اخري</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="inp-holder">
                                    <input type="number" value="{{ $pregnancy?->children }}" readonly class="form-control" min='0'>
                                </div>
                            </td>
                            <td>
                                <div class="inp-holder">
                                    <input type="text" value="{{ $pregnancy?->date_of_birth }}" readonly class="form-control">
                                </div>
                            </td>
                            <td>
                                <div class="inp-holder">
                                    <input type="text" value="{{ $pregnancy?->diabetes ? 'نعم' : 'لا' }}" readonly class="form-control">
                                </div>
                            </td>
                            <td>
                                <div class="inp-holder">
                                    <input type="text" value="{{ $pregnancy?->pressure ? 'نعم' : 'لا' }}" readonly class="form-control">
                                </div>
                            </td>
                            <td>
                                <div class="inp-holder">
                                    <textarea class="form-control" rows="2" readonly>{{ $pregnancy?->other_diseases }}</textarea>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </section>
        <section class="">
            <h6 class="py-3">
                متابعة الحمل:-
            </h6>
            <div class="row">
                <div class="col-12">
                    <div class="row g-3">
                        <div class="col-12 col-md-4">
                            <section class="form-group ">
                                <label for="exampleFormControlTextarea1" class="mb-2">اخر دورة شهرية</label>
                                <input type="date" class="form-control" value="{{ $pregnancy?->last_menstrual_period }}" readonly>
                            </section>
                        </div>

                        <div class="col-12 col-md-4 ">
                            <section class="form-group ">
                                <label for="exampleFormControlTextarea1" class="mb-2">جنس المولود</label>
                                <input type="text" value="{{ __($pregnancy?->child_gender) }}" readonly class="form-control">
                            </section>
                        </div>
                        <div class="col-12 col-md-4 ">
                            <section class="form-group ">
                                <label for="exampleFormControlTextarea1" class="mb-2">الموعد المتوقع للولاده</label>
                                <input type="text" value="{{ $pregnancy?->date_of_birth }}" class="form-control" readonly>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="d-flex justify-content-center my-3">
            <button class="btn btn-sm btn-primary" wire:click='scan_request'>{{ __('Save') }}</button>
        </div>
    </section>
</div>
@endif
@else
<div class="alert alert-danger mt-5">
    لا يوجد متابعة حمل للمريض حتي الان
</div>
@endif


@elseif($patientFilesType == 'serv4')
<div class="d-flex justify-content-start mt-3">

</div>
<div class="table-responsive mt-2">
    <table class="table main-table">
        <thead>
            <tr>
                <th># </th>
                <th>@lang('Plan name') </th>
                <th>@lang('Date') </th>
                <th>@lang('Physician') </th>
                <th>@lang('Control') </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patient->treatment_plans ?? [] as $item)

            <tr>
                <td>{{ $loop->iteration }}</td>
                {{-- <td>{{ $item->plan_name }}</td> --}}
                <td>خطة علاجية رقم # {{ $item?->id }}</td>

                <td>{{ $item->created_at->format('Y-m-d') }}</td>
                <td>{{ $item->dr?->name }}</td>
                <td>
                    <a href="btn btn-sm btn-primary">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endif
