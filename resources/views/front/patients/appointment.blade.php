@extends('front.layouts.front')
@section('title')
{{ __("Show appointments") }}
@endsection
@section('content')
<section class="main-section">
    <div class="container mb-5 mt-5">
        <div class="d-flex justify-content-between mb-3 align-items-center">
            <div class="print-btn btn btn-sm btn-warning" id="btn-prt-content">
                <i class="fa-solid fa-print"></i>
            </div>
            <a class="btn btn-sm btn-secondary mb-2" href="{{url()->previous()}}">
                رجوع
                <i class="fa fa-arrow-left"></i>
            </a>
        </div>
        <div id="prt-content">
            <div class="bg-white p-4 rounded-2 shadow">
                <div class="table-responsive">
                    <table class="table main-table table-print">
                        <thead>
                            <tr>
                                <th>{{ __('admin.Medical number') }}</th>
                                <th>{{ __('admin.name') }}</th>
                                <th>{{ __('admin.Civil number') }}</th>
                                <th>{{ __('Created Date') }}</th>
                                <th>{{ __('admin.Country') }}</th>
                                <th>{{ __('group') }}</th>
                                <th>{{ __('admin.Gender') }}</th>
                                <th>{{ __('Date of birth AD') }}</th>
                                {{-- <th>{{ __('admin.Hijri date of birth') }}</th> --}}
                                <th>{{ __('admin.Age') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $patient->id }}</td>
                                <td>{{ $patient->name }}</td>
                                <td>{{ $patient->civil }}</td>
                                <td>{{ $patient->created_at->format('Y-m-d') }}</td>
                                <td>{{ $patient->country->name ?? null }}</td>

                                <td>{{ $patient->group->name ?? null }}</td>
                                <td>{{ __($patient->gender) }}</td>
                                <td>{{ $patient->birthdate }}</td>
                                {{-- <td>{{ $patient->birthdate?
                                Carbon::parse($patient->birthdate)->toHijri()->isoFormat('DD-MMMM-YYYY'): '' }}
                                </td> --}}
                                <td>{{ $patient->age }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table main-table">
                        <thead>
                            <tr>
                                <th>{{ __('admin.phone') }}</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $patient->phone }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="bg-white p-4 rounded-2 shadow mt-3">
                @if($diagnose)
                <div class="row row-gap-24">
                    <div class="col-12 col-md-6">
                        <label for="Chief_complain" class="option-name mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">{{
                        __('Chief complain') }}
                            :</label>
                        <textarea readonly class="w-100 form-control" id="Chief_complain">{{ $diagnose->chief_complain }}</textarea>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="sign_and_symptom" class="option-name mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">{{
                        __('Sign and symptom') }}
                            :</label>
                        <textarea readonly class="w-100 form-control" id="sign_and_symptom">{{ $diagnose->sign_and_symptom }}</textarea>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="taken" class="option-name mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">{{
                        __('diagnoses') }}
                            :</label>
                        <textarea readonly class="w-100 form-control" id="taken">{{ $diagnose->taken }}</textarea>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="treatment" class="option-name mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">{{
                        __('Treatment done') }}
                            :</label>
                        <textarea readonly class="w-100 form-control" id="treatment">{{ $diagnose->treatment }}</textarea>
                    </div>
                    <div class="col-12">
                        <label for="other" class="option-name mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">{{
                        __('admin.other') }}
                            :</label>
                        <textarea readonly class="w-100 form-control" id="other">{{ $diagnose->other }}</textarea>
                    </div>
                    @if ($diagnose->tooth)
                    <div class="col-12">
                        <section class="num-teeth">
                            <div class="toothArray content ">
                                <img class="img-teeth" src="{{ asset('img/num.png') }}" alt="" />
                                @for ($i = 18; $i >= 11; $i--)
                                <input disabled type="checkbox" {{in_array($i,$diagnose->tooth) ? 'checked' : ''}} id="" value="{{ $i }}">
                                @endfor

                                @for ($i = 21; $i <= 28; $i++) <input disabled type="checkbox" {{in_array($i,$diagnose->
                                tooth) ? 'checked' : ''}} id="" value="{{ $i }}">
                                    @endfor

                                    @for ($i = 38; $i >= 31; $i--)
                                    <input disabled type="checkbox" {{in_array($i,$diagnose->tooth) ? 'checked' : ''}} id="" value="{{ $i }}">
                                    @endfor

                                    @for ($i = 41; $i <= 48; $i++) <input disabled type="checkbox" {{in_array($i,$diagnose->
                                    tooth) ? 'checked' : ''}} id="" value="{{ $i }}">
                                        @endfor
                            </div>
                        </section>
                    </div>
                    @endif
                </div>
                @else
                <div class="alert alert-warning">
                    لا يوجد تشخيص حتي الان
                </div>
                @endif
            </div>
            <div class="bg-white p-4 rounded-2 shadow mt-3">
                @if($treatmentPlans->count())
                @php
                $selectedTooth = $treatmentPlans->pluck('tooth')->toArray();
                @endphp
                <section class="select-teeth">
                    <div class="toothArray content ">
                        <img class="img-teeth" src="{{ asset('img/num.png') }}" alt="" />
                        @foreach (getToothNumbers() as $tooth)
                        <button class="btn-select" data-bs-toggle="modal" data-bs-target="#modal-select">
                            @if(in_array($tooth,$selectedTooth))
                            <i class="fa fa-check" style="font-size:20px"></i>
                            @endif
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
                            @foreach ($treatmentPlans ?? [] as $item)
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
                                <td>{{ $treatmentPlans->sum('amount') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @else
                <div class="alert alert-warning">
                    لا يوجد خطط علاجية حتي الان
                </div>
                @endif

            </div>
        </div>
    </div>
</section>

@endsection