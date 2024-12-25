@extends('front.layouts.front')
@section('title')
{{ __('View vision examination') }}
@endsection
@section('content')
<section class="main-section">
  <div class="container">
    <div class="d-flex align-items-center gap-4 flex-wrap justify-content-between mb-3">
      <h4 class="main-heading mb-0">{{ __('View vision examination') }}</h4>
      <div class="btn-holder">
        <button class="btn-sm btn-warning px-3" id="btn-prt-content">
            طباعة <i class="fas fa-print"></i>
        </button>
      </div>
    </div>
    <div class="bg-white p-4 rounded-2 shadow">
        <div id="prt-content">
            <x-header-print-patient></x-header-print-patient>
            <div class="d-flex align-items-start">
              <div class="table-responsive w-100">
                <table class="table main-table mb-1">
                  <thead>
                    <tr>
                      <th colspan="12" class="border">العين اليسرى (L)(Left)</th>
                    </tr>
                    <tr>
                      <th>AX</th>
                      <th>CYL</th>
                      <th>SPH</th>
                    </tr>
                  </thead>
                  <tbody>
                  <tr>
                      <td>{{$vision->left_eye_distance_axis ?? 0}}</td>
                      <td>{{$vision->left_eye_distance_cylinder ?? 0}}</td>
                      <td>{{$vision->left_eye_distance_sphere ?? 0}}</td>
                    </tr>
                    <!-- For Near -->
                    <tr>
                      <td class="height-td">{{$vision->left_eye_near_axis ?? 0}}</td>
                      <td class="height-td">{{$vision->left_eye_near_cylinder ?? 0}}</td>
                      <td class="height-td">{{$vision->left_eye_near_sphere ?? 0}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="table-responsive w-100">
                <table class="table main-table mb-1">
                  <thead>
                    <tr>
                      <th colspan="12" class="border">العين اليمنى (R)(Right)</th>
                    </tr>
                    <tr>
                      <th>AX</th>
                      <th>CYL</th>
                      <th>SPH</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                        <td>{{$vision->right_eye_distance_axis ?? 0}}</td>
                        <td>{{$vision->right_eye_distance_cylinder ?? 0}}</td>
                        <td>{{$vision->right_eye_distance_sphere ?? 0}}</td>
                      <td class="border">Diest</td>
                    </tr>
                    <tr>
                        <td>{{$vision->right_eye_near_axis ?? 0}}</td>
                        <td>{{$vision->right_eye_near_cylinder ?? 0}}</td>
                        <td>{{$vision->right_eye_near_sphere ?? 0}}</td>
                      <td class="border">Near</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between mt-4">
                <small class="mb-1 d-block"><b>تاريخ الفحص: </b>{{$vision->created_at?->format('Y-m-d')}}</small>
                <small class="mb-1 d-block text-center">
                    <b>الطبيب</b>
                    <br>
                    {{$vision->dr->name}}
                </small>
            </div>
        </div>
    </div>
  </div>
</section>
@endsection
