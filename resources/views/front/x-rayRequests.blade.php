@extends('front.layouts.front')
@section('title')
طلبات الأشعة
@endsection
@section('content')
<section class="main-section notice">
  <div class="container">
      <h4 class="main-heading">طلبات الأشعة</h4>
      <div class="bg-white p-3 rounded-2 shadow">
      <div class="table-responsive">
                <table class="table main-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الطبيب</th>
                            <th>العيادة</th>
                            <th>المريض</th>
                            <th>التاريخ والوقت</th>
                            <th>معاينة</th>
                            <th class="text-center">{{ __('admin.managers') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>
                                    <button class="btn btn-sm btn-primary">
                                        معاينة
                                    </button>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                        <button class="btn btn-sm btn-info text-white ms-1">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                    </tbody>
                </table>
            </div>
      </div>
  </div>
</section>

@endsection
