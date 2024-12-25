@extends('front.layouts.front')
@section('title')
{{ __('Reports') }}
@endsection
@section('content')
<section class="main-section notice">
    <div class="container">
        <div class="d-flex justify-content-between ">
            <h4 class="main-heading">{{ __('Reports') }}</h4>
            <a href="{{route('front.accounting')}}" style="height: 35px;"  class="btn-main-sm py-0 px-4"> @lang('Accounting')</a>
        </div>
        <div class="bg-white p-3 rounded-2 shadow">
            <div class="row g-4">
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <a href="{{ route('front.Financial_report') }}" class="translate">
                        <div class="box-report">
                            <p class="mb-0">{{ __('General account statement') }}</p>
                            <img src="{{ asset('img/report-8.png') }}" alt="report img" class="report-img">
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <a href="{{ route('front.Clidoc_report') }}" class="translate">
                        <div class="box-report">
                            <p class="mb-0">{{ __('clinic and the doctor') }}</p>
                            <img src="{{ asset('img/consultation.png') }}" alt="report img" class="report-img">
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <a href="{{ url('/treasury') }}" class="translate">
                        <div class="box-report">
                            <p class="mb-0">{{ __('Treasury report') }}</p>
                            <img src="{{ asset('img/report-1.png') }}" alt="report img" class="report-img">
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <a href="{{ route('front.installment_company') }}" class="translate">
                        <div class="box-report">
                            <p class="mb-0">{{ __('Installment Companies') }}</p>
                            <img src="{{ asset('img/report-9.png') }}" alt="report img" class="report-img">
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <a href="{{ route('front.purchases_report') }}" class="translate">
                        <div class="box-report">
                            <p class="mb-0">{{ __('Procurement report') }}</p>
                            <img src="{{ asset('img/report-6.png') }}" alt="report img" class="report-img">
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <a href="{{ route('front.insurances_report') }}" class="translate">
                        <div class="box-report">
                            <p class="mb-0">{{ __('Insurance companies') }}</p>
                            <img src="{{ asset('img/hospital.png') }}" alt="report img" class="report-img">
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <a href="{{ route('front.reception_staff_report') }}" class="translate">
                        <div class="box-report">
                            <p class="mb-0">{{ __('reception') }}</p>
                            <img src="{{ asset('img/information-desk.png') }}" alt="report img" class="report-img">
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <a href="{{ route('front.patient_report') }}" class="translate">
                        <div class="box-report">
                            <p class="mb-0">{{ __('Patient report') }}</p>
                            <img src="{{ asset('img/patient-report.png') }}" alt="report img" class="report-img">
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <a href="{{ route('front.not_sudies') }}" class="translate">
                        <div class="box-report">
                            <p class="mb-0">{{ __('Non-Saudi patients') }}</p>
                            <img src="{{ asset('img/patient.png') }}" alt="report img" class="report-img">
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <a href="{{ route('front.salaries.index') }}" class="translate">
                        <div class="box-report">
                            <p class="mb-0">{{ __('Salary report') }}</p>
                            <img src="{{ asset('img/report-10.png') }}" alt="report img" class="report-img">
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-lg-4 col-xl-3">
                    <a href="{{ route('front.expenses_report') }}" class="translate">
                        <div class="box-report">
                            <p class="mb-0">{{ __('Expense report') }}</p>
                            <img src="{{ asset('img/report-7.png') }}" alt="report img" class="report-img">
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <a href="{{ route('front.expenses.index') }}" class="translate">
                        <div class="box-report">
                            <p class="mb-0">{{ __('admin.Expenses') }}</p>
                            <img src="{{ asset('img/report-2.png') }}" alt="report img" class="report-img">
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <a href="{{ route('front.patient_groups_report') }}" class="translate">
                        <div class="box-report">
                            <p class="mb-0">{{ __('Patient groups report') }}</p>
                            <i class="fa-solid fa-hospital-user report-icon"></i>
                            <!-- <img src="{{ asset('img/patient-report.png') }}" alt="report img" class="report-img"> -->
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <a href="{{ route('front.emergency.patients-examination') }}" class="translate">
                        <div class="box-report">
                            <p class="mb-0">{{ __('Emergency patients') }}</p>
                            <i class="fa-regular fa-hospital report-icon"></i>
                            <!-- <img src="{{ asset('img/patient-report.png') }}" alt="report img" class="report-img"> -->
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <a href="{{ route('front.purchases.index') }}" class="translate">
                        <div class="box-report">
                            <p class="mb-0">{{ __('admin.Purchases') }}</p>
                            <i class="fa-regular fa-credit-card report-icon"></i>
                            <!-- <img src="{{ asset('img/report-1.png') }}" alt="report img" class="report-img"> -->
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <a href="{{ route('front.prescriptions') }}" class="translate">
                        <div class="box-report">
                            <p class="mb-0">{{ __('Prescriptions') }}</p>
                            <i class="fa-solid fa-file-medical report-icon"></i>
                            <!-- <img src="{{ asset('img/report-1.png') }}" alt="report img" class="report-img"> -->
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <a href="{{ route('front.employee_discounts') }}" class="translate">
                        <div class="box-report">
                            <p class="mb-0">{{ __('Employee discounts') }}</p>
                            <i class="fas fa-user-tag report-icon"></i>
                            <!-- <img src="{{ asset('img/report-1.png') }}" alt="report img" class="report-img"> -->
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
