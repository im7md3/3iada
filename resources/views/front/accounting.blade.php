@extends('front.layouts.front')
@section('title')
{{ __('Accounting') }}
@endsection
@section('content')
<section class="main-section notice">
    <div class="container">
        <div class="d-flex justify-content-between ">
            <h4 class="main-heading">{{ __('Accounting') }}</h4>
            <a href="{{ route('front.reports') }}" style="height: 35px;" class="btn-main-sm py-0 px-4">
                @lang('Reports')</a>
            <a href="{{ route('front.accounts_settings') }}" style="height: 35px;" class="btn-main-sm py-0 px-4">
                إعدادات الشجرة</a>
        </div>
        <div class="bg-white p-3 rounded-2 shadow">
            <div class="row g-4">
                @if (App\Models\Setting::first()->account_tree_active)
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <a href="{{ route('front.accounts-tree') }}" class="translate">
                        <div class="box-report">
                            <p class="mb-0">{{ __('Accounting tree') }}</p>
                            <img src="{{ asset('img/money-tree.png') }}" alt="report img" class="report-img">
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <a href="{{ route('front.vouchers.index') }}" class="translate">
                        <div class="box-report">
                            <p class="mb-0">{{ __('Restrictions') }}</p>
                            <img src="{{ asset('img/report-9.png') }}" alt="report img" class="report-img">
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <a href="{{ route('front.account-statement') }}" class="translate">
                        <div class="box-report">
                            <p class="mb-0">{{ __('Account statement') }}</p>
                            <img src="{{ asset('img/report-7.png') }}" alt="report img" class="report-img">
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <a href="{{ route('front.cost_centers') }}" class="translate">
                        <div class="box-report">
                            <p class="mb-0">{{ __('Cost center') }}</p>
                            <img src="{{ asset('img/report-6.png') }}" alt="report img" class="report-img">
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-lg-4 col-xl-3">
                    <a href="{{ route('front.review') }}" class="translate">
                        <div class="box-report">
                            <p class="mb-0">@lang('Trial Balance')</p>
                            <img src="{{ asset('img/report-10.png') }}" alt="report img" class="report-img">
                        </div>
                    </a>
                </div>
                @endif

                <div class="col-md-6 col-lg-4 col-xl-3">
                    <a href="{{ route('front.tax.index') }}" class="translate">
                        <div class="box-report">
                            <p class="mb-0">{{ __('Tax declaration') }}</p>
                            <img src="{{ asset('img/report-8.png') }}" alt="report img" class="report-img">
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <a href="{{ route('front.bank-accounts.index') }}" class="translate">
                        <div class="box-report">
                            <p class="mb-0">الحسابات البنكية</p>
                            <img src="{{ asset('img/report-10.png') }}" alt="report img" class="report-img">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection