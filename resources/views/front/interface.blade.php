@extends('front.layouts.front')
@section('title')
{{ __("patients") }}
@endsection
@section('content')
<div class="main-section py-5">

    <div class="container-fluid px-5">
        <h4 class="main-heading mb-4 not-print">{{ __('doctor interface')}}</h4>
        <div class="getHeightContainer bg-white p-3 rounded-2 shadow reset-print">
            <div class="row">
                <div class="col-lg-3 ps-0 not-print">
                    <p class="mb-2">{{ __('patients') }} :</p>
                    <ul class="list-unstyled main-nav-tap mb-3">
                        <li class="nav-item">
                            <a class="nav-link active cursor-auto">
                                {{ __('Converters') }}
                            </a>
                        </li>
                    </ul>
                    <div class=" main-tab-content">
                        <ul class=" d-flex flex-wrap gap-2">
                            <li class="right-b color-gr">
                                <a href="#">
                                    اسم <br> 2022/2/2 |
                                    12:32pm</a>
                            </li>
                            <hr>
                            <li class="color-gr">{{ __('There is no') }}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 mt-3 mt-lg-0">
                    <div class=" mb-1 align-items-center not-print">
                        <p class="mb-0 d-block">
                            {{ __('Patient name') }}
                        </p>
                        <ul class="nav nav-pills main-nav-tap mb-3 not-print" style="flex-wrap: wrap !important;">
                            <li class="nav-item">
                                <a href="#" class="nav-link active">
                                    {{ __('current diagnosis') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href=" #" class="nav-link ">
                                    {{ __('Issuance of invoice') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href=" #" class="nav-link ">
                                    {{ __('Issuance of invoice') }}
                                </a>
                            </li>
                        </ul>
                        <div class=" main-tab-content reset-print-border">
                            <section>
                                <div class="main-container mb-4 d-flex flex-column flex-md-row align-items-start  justify-content-center">
                                    <div class="right-side w-75 ms-3 mb-4 mb-md-0">
                                        <div class="info-box d-flex flex-column">
                                            <div class="alert alert-info w-fit mx-auto" role="alert">
                                                {{ __('Invoice will be obtained by reception or accountant') }}
                                            </div>

                                            <div class="alert alert-warning">
                                                هذا المريض ينتمي إلى المجموعة (<strong>اسم</strong>) و المجموعة لها نسبة
                                                خصم
                                                (<strong>0 %</strong>)
                                            </div>

                                            <p>{{ __('You can choose services or search by number') }}</p>
                                            <div class="inp-container w-100 mb-3">
                                                <label for="" class="small-label">{{ __('category') }}</label>
                                                <select wire:model="selected_department_id" class="main-select w-100">
                                                    <option value="">{{ __('Choose department') }}</option>
                                                </select>
                                            </div>

                                            <div class="inp-container ms-0 ms-md-2 w-100">
                                                <label for="" class="small-label">{{ __('admin.Date') }}</label>
                                                <input type="date" id="" class="form-control w-100" />
                                            </div>

                                            <div class="inp-container w-100 mb-3">
                                                <label for="" class="small-label">{{ __('service') }}</label>
                                                <select class="main-select w-100">
                                                    <option value="">{{ __('Choose the service') }}</option>
                                                </select>
                                            </div>
                                            <div class="d-flex align-items-end gap-2 mb-3">
                                                <div class="inp-container w-100">
                                                    <label for="" class="small-label">{{ __('Service number search') }}</label>
                                                    <input type="number" class=" form-control">
                                                </div>
                                                <div class="inp-container d-flex w-100 gap-2">
                                                    <a target="_blank" href="{{ route('front.products.index') }}" class="btn btn-sm btn-primary">{{ __('products') }}</a>
                                                    <a data-bs-toggle="modal" data-bs-target="#add_product" class="btn btn-sm btn-success">{{ __('admin.Add product') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="left-side w-50 sw-100">
                                        <div class="output-box d-flex flex- align-items-center justify-content-end mb-2">
                                            <span class="a_word ms-2"> {{ __('admin.amount') }} : </span>
                                            <input type="text" placeholder="0" class="text-center form-control w-50" />
                                        </div>
                                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                                            <span class="a_word ms-2"> {{ __('Discount Offers') }} :</span>
                                            <input type="text" placeholder="0" class="text-center form-control w-50" />
                                        </div>
                                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                                            <span class="a_word ms-2 space-noWrap"> {{ __('Amount after discount of offers') }} :</span>
                                            <input type="text" placeholder="0" class="text-center form-control w-50" />
                                        </div>


                                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                                            <label for="" class="small-label">{{ __('group') }}</label>
                                            <input type="text" value="" id="" class="form-control w-50" />
                                        </div>
                                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                                            <span class="a_word ms-2"> {{ __('admin.discount') }}:</span>
                                            <input type="text" placeholder="0" class="text-center form-control w-50" />
                                        </div>


                                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                                            <span class="a_word ms-2"> {{ __('admin.tax') }} : </span>
                                            <input type="text" placeholder="0" class="text-center form-control w-50" />
                                        </div>
                                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                                            <span class="a_word ms-2 space-noWrap"> {{ __('admin.Total with tax') }} : </span>
                                            <input type="text" placeholder="0" class="text-center form-control w-50" />
                                        </div>
                                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                                            <span class="a_word ms-2"> {{ __('admin.total after split') }} : </span>
                                            <input type="text" placeholder="0" class="text-center form-control w-50" />
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive mt-4">
                                    <table class="table main-table">
                                        <thead>
                                            <tr>
                                                <th>{{ __('admin.department') }}</th>
                                                <th>{{ __('admin.product') }}</th>
                                                <th>{{ __('admin.price') }}</th>
                                                <th>{{ __('admin.actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>--</td>
                                                <td>--</td>

                                                <td><input type="number" id="" class="form-control "></td>
                                                <td>--</td>
                                                <td>
                                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                                        <button class="btn btn-sm btn-danger">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="The-text-area w-100">
                                    <textarea id="" class="form-control w-100 p-2" placeholder="{{ __('admin.notes') }}"></textarea>
                                </div>



                                <div class="submitBtn-holder text-center mt-3">
                                    <button class="btn btn-success w-25" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        {{ __('admin.Save') }}
                                    </button>
                                </div>



                                <ul class="list-unstyled main-nav-tap my-3">
                                    <li class="nav-item  list-unstyled ">
                                        <a class="nav-link active cursor-auto text-center">
                                            {{ __('Converters') }}
                                        </a>
                                    </li>
                                </ul>
                                <div class=" main-tab-content">
                                    <div class="row g-3">
                                        <div class="col-12 col-md-2">
                                            <div class="d-flex justify-content-between  flex-column ">
                                                <label class="form-label text-center me-4" for="">
                                                    خطة
                                                </label>
                                                <input class="form-control " type="text" name="">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <div class="d-flex justify-content-between  flex-column ">
                                                <label class="form-label text-center me-4" for="">
                                                    خطة
                                                </label>
                                                <input class="form-control " type="text" name="">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <div class="d-flex justify-content-between  flex-column ">
                                                <label class="form-label text-center me-4" for="">
                                                    خطة
                                                </label>
                                                <input class="form-control " type="text" name="">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <div class="d-flex justify-content-between  flex-column ">
                                                <label class="form-label text-center me-4" for="">
                                                    خطة
                                                </label>
                                                <input class="form-control " type="text" name="">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <div class="d-flex justify-content-between  flex-column ">
                                                <label class="form-label text-center me-4" for="">
                                                    خطة
                                                </label>
                                                <input class="form-control " type="text" name="">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <div class="d-flex justify-content-between  flex-column ">
                                                <label class="form-label text-center me-4" for="">
                                                    خطة
                                                </label>
                                                <input class="form-control " type="text" name="">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="The-text-area w-100">
                                                <textarea id="" class="form-control w-100 p-2" placeholder="{{ __('admin.notes') }}"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection