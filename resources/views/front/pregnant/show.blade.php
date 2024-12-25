@extends('front.layouts.front')
@section('title')
{{ __("patients") }}
@endsection
@section('content')
<div class="container">
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
</div>
@endsection
