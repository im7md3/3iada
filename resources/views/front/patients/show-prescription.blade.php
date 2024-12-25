@extends('front.layouts.front')
@section('title')
    بيانات الوصفة الطبية
@endsection
@section('content')
    <section class="main-section">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
                <h4 class="main-heading mb-0">بيانات الوصفة الطبية</h4>
                <div class="btn-holder">
                    <button class="btn btn-sm btn-warning px-3" id="btn-prt-content">{{ __('print') }} <i
                            class="fa-solid fa-print"></i></button>
                </div>
            </div>
            <div class="section-content bg-white rounded-3 shadow p-4">
                <div id="prt-content">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="box-invoice">
                                <div class="row align-items-center">
                                    <div class="col-md-4 p-3">
                                        <p>
                                            <b> اسم العيادة: </b> {{ setting()->site_name }}
                                        </p>
                                        <p>
                                            <b> العنوان: </b>{{ setting()->address }}
                                        </p>
                                        <p><b> جوال: </b>{{ setting()->phone }}</p>
                                    </div>
                                    <div class="text-center col-md-4 p-3 d-flex align-items-center justify-content-center">
                                        <img width="110"
                                            src="http://crgo.const-tech.biz/uploads/settings/1694331704logo.png"
                                            alt="">
                                    </div>
                                    <div class="col-md-4 p-3">
                                        <h6><b>بيانات المريض:-</b></h6>
                                        <p><b>الرقم الطبي: {{ $orthodontic->patient->id }}</b></p>
                                        <p><b>الاسم : </b>{{ $orthodontic->patient->name }} </p>
                                        <p>
                                            <b>رقم الجوال: {{ $orthodontic->patient->phone }}</b>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="scrl">
                                <table class="table table-invoice mb-0">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom">
                                                رقم الوصفة
                                            </th>
                                            <th class="border-bottom">
                                                التاريخ
                                            </th>
                                            <th class="border-bottom">
                                                الوقت
                                            </th>
                                            <th class="border-bottom">
                                                العيادة
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $orthodontic->id }}</td>
                                            <td>{{ $orthodontic->created_at->format('Y-m-d') }}</td>
                                            <td>{{ $orthodontic->created_at->format('H:i A') }}</td>
                                            <td>{{ setting()->site_name }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="col-12">
                            <div class="scrl">
                                <table class="table table-invoice mb-0">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom text-center">
                                                الوصفة الطبية
                                            </th>
                                            <th class="border-bottom text-center">
                                                القوة
                                            </th>
                                            <th class="border-bottom text-center">
                                                الملاحظات
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orthodontic->prescriptions as $prescription)
                                            <tr>
                                                <td class="text-center">{{ $prescription->name }}</td>
                                                <td class="text-center">{{ $prescription->strength }}</td>
                                                <td class="text-center">{{ $prescription->notes }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <h6 class="fw-bold mb-0 mt-3 fs-15px">الطبيب المعالج: {{ $orthodontic->dr->name }}</h6>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
