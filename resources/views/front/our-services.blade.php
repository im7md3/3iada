@extends('front.layouts.front')
@section('title')
    {{ __('our services') }}
@endsection
@section('content')
    <section class="main-section home">

        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="main-heading">خدماتنا</h4>
                <a href="{{ route('front.home') }}" class="btn btn-dark btn-sm">رجوع</a>
            </div>
            <div class="alert alert-info">
                في حال رغبتكم في اضافه خدمة يمكنكم التواصل معنا عبر البريد أو الجوال <a href="tel:0506499275"
                    class="text-decoration-underline">0506499275</a>
            </div>

            <div class="table-responsive ">
                <table class="table main-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الخدمة</th>
                            <th>وصف الخدمة</th>
                            <th class="text-cenetr">طلب الخدمة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $services = \App\Models\OurService::latest()->get();
                        @endphp
                        @forelse ($services as $service)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $service->name }}</td>
                                {{-- <td>{{ $service->price == 0 ? '' : $service->price }}</td> --}}
                                <td>
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#desc{{ $service->id }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <div class="modal fade" id="desc{{ $service->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-wrap text-end">
                                                    {{ $service->description }}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        data-bs-dismiss="modal">رجوع</button>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                        <a target="_blank" href="https://wa.me/+966506499275" class="btn btn-sm btn-success">
                                            طلب الخدمة
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">لا يوجد خدمات </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
                <div class="mt-2 alert alert-info">
                    تعرف كل البرامج التي نقدمها لجميع العملاء
                    <a href="https://www.const-tech.org/products" target="_blank">من هنا</a>
                </div>
            </div>
        </div>
    </section>
@endsection
