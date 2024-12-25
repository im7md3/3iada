@extends('front.layouts.front')
@section('title')
سند فاتورة
@endsection
@push('css')

@endpush
@section('content')
<section class='main-section'>
    <div class="container">
        <div class="main-content">
            <div class="box">
                <div class="header">
                    <div class="logo">
                        <img src="{{ display_file(setting()->logo) }}" alt="">
                    </div>
                    <h3>{{ setting()->site_name }}</h3>
                    <p>
                        سند الفاتورة - {{ $bond->invoice->id }}
                    </p>
                </div>
                <div class="content row gx-3 gy-2 my-2">
                    <div class="col-12 col-md-6 col-lg-4">
                        <p>
                            {{__("admin.address")}}:
                            <span>
                                {{ setting()->address }}
                            </span>
                        </p>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <p>
                            {{__("admin.phone")}}:
                            <span>
                                {{ setting()->phone }}
                            </span>
                        </p>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <p>
                            {{__("admin.Tax number")}}:
                            <span>
                                {{ setting()->tax_no }}
                            </span>
                        </p>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <p>
                            {{ $bond->created_at->format('Y-m-d') }}
                        </p>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <p>
                            {{__("admin.customer name")}}:
                            <span>
                                {{ $bond->invoice?->patient?->name }}
                            </span>
                        </p>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <p>
                            {{__("admin.File number")}}:
                            <span>
                                {{ $bond->invoice?->patient?->id }}
                            </span>
                        </p>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <p>
                            {{__("admin.Physician")}}:
                            <span>
                                {{ $bond->invoice?->dr?->name }}
                            </span>
                        </p>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <p>
                            الموظف :
                            <span>
                                {{ $bond->user?->name }}
                            </span>
                        </p>
                    </div>
                </div>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    <strong>
                                        المبلغ
                                    </strong>
                                    <br>
                                    <strong>
                                        Amount
                                    </strong>
                                </th>
                                <th>
                                    <strong>
                                        طريقة الدفع
                                    </strong>
                                    <br>
                                    <strong>
                                        Payment Method
                                    </strong>
                                </th>
                                <th>
                                    <strong>
                                        الحالة
                                    </strong>
                                    <br>
                                    <strong>
                                        Status
                                    </strong>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $bond->amount }}</td>
                                <td>{{ __($bond->payment_method) }}</td>
                                <td>{{ __($bond->status) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="foot-text d-flex flex-column align-items-center my-3">
                    <p>
                        {{__("admin.thanks for your visit")}}
                    </p>
                    <div class="qr">
                        {{-- <img class="" src="https://static.vecteezy.com/system/resources/previews/002/557/391/original/qr-code-for-scanning-free-vector.jpg" alt=""> --}}
                        {{-- {!! $qrCode !!} --}}
                    </div>
                </div>
            </div>
            <div class="btn-print d-flex justify-content-center">
                <a class="print not-print mt-4" href="javascript:print()">{{ __('print')}}</a>
            </div>
        </div>
    </div>
</section>
@endsection
