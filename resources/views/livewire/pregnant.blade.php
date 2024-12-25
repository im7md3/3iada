<section class="main-section users">
    <div class="container-fluid" id="data-table">
        <div class="d-flex align-items-center gap-4 felx-wrap justify-content-between mb-3">
            <h4 class="main-heading mb-0">{{ __('Pregnancy follow') }}</h4>
        </div>
        <div class="bg-white shadow p-4 rounded-3">
            <div class="amountPatients-holder gap-2 d-flex align-items-start align-items-md-center justify-content-between flex-column flex-md-row">
                {{-- <div class="d-flex flex-column flex-md-row">
                    <div class="py-2 px-3 bg-info rounded text-white ">
                        {{ __('Saudi patients') }} : 0
            </div>
            <div class="py-2 px-3 bg-info rounded text-white mx-0 my-2 my-md-0 mx-md-2">
                {{ __('Non-Saudi Patients') }} : 0
            </div>
            <div class="py-2 px-3 bg-info rounded text-white" style="cursor: pointer" wire:click='$toggle("filter_visit")'>
                {{ __('Registered Visitor') }} : 0
            </div>
        </div> --}}
        <div class="btn-holders">
            {{-- <button type="button" class="btn btn-outline-secondary btn-sm rounded-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="{{ __('Visitor registrars are those who have made reservations over the phone or via the website and their data is completed when they attend the clinic') }}">
            <i class="fa-solid fa-question"></i>
            </button> --}}
            <button id="btn-prt-content" class="print-btn btn btn-sm btn-warning py-1">
                <i class="fa-solid fa-print"></i>
            </button>
        </div>
    </div>
    <div class="">
        {{-- <div class="row my-3">
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
    </div> --}}
    <div id="prt-content">
        <div class="d-block-print  d-none">
            <div class="d-flex justify-content-between p-3 my-3 rounded" style='border-radius: 10px;border: 2px solid #ddd;'>
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
                        <th>#</th>
                        <th>@lang('patient')</th>
                        {{-- <th>@lang('the Doctor')</th>  --}}
                        <th>@lang('children')</th>
                        <th>@lang('last_childbirth')</th>
                        <th>@lang('diabetes')</th>
                        <th>@lang('pressure')</th>
                        <th>@lang('last_menstrual_period')</th>
                        <th>@lang('child_gender')</th>
                        <th>@lang('Status')</th>
                        <th>@lang('actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $cat)
                    <tr>
                        <td>{{ $cat->id }}</td>
                        <td>{{ $cat->patient?->name }}</td>
                        <td>{{ $cat->children }}</td>
                        <td>{{ __($cat->last_childbirth) }}</td>
                        <td>{{ $cat->diabetes ? 'نعم' : 'لا' }}</td>
                        <td>{{ $cat->pressure ? 'نعم' : 'لا' }}</td>
                        <td>{{ $cat->last_menstrual_period }}</td>
                        <td>{{ __($cat->child_gender) }}</td>
                        <td><span class="badge bg-{{ $cat->is_compeleted ? 'success' : 'warning' }}">{{ $cat->is_compeleted ? 'إنتهي' :'جاري'   }}</span></td>
                        <td class="not-print">
                            <div class="d-flex align-items-center justify-content-center gap-1">
                                <a href="{{route('front.pregnant.show',$cat->id)}}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ __('admin.View patient') }}" class="btn btn-sm btn-purple py-1">
                                    <i class="fa fa-eye"></i>
                                </a>
                                {{-- <a href="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ __('Edit') }}" class="btn btn-sm btn-info text-white py-1">
                                <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <button class="btn btn-sm btn-danger py-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ __('Delete') }}" data-bs-toggle="modal" data-bs-target="#delete_agent">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button> --}}
                            </div>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        {{ $categories->links() }}
    </div>
    </div>
    </div>
    </div>
</section>
