@extends('front.layouts.front')
@section('title')
{{ __('Account statement') }}
@endsection
@section('content')
<section class="main-section">
  <div class="container">
    <!-- this's the code should take for backend -->
    <div class="row mb-2">
      <div class="col-12 col-md-4 col-lg-3">
        <div class="inp-holder">
          <label class="small-label">{{ __('Choose a prescription') }}</label>
          <div class="inp-holder">
            <select id="filter-select" multiple></select>
          </div>
        </div>
      </div>
    </div>
    @push('js')
    <script>
    $(document).ready(function() {
      $('#filter-select').select2({
        ajax: {
          url: 'url_to_fetch_data', // استبدلها بعنوان URL الذي يستدعي البيانات
          dataType: 'json',
          delay: 250,
          processResults: function(data) {
            return {
              results: data
            };
          },
          cache: true
        },
        minimumInputLength: 1
      });
    });
    </script>
    @endpush
    <div class="table-responsive">
      <table class="table main-table">
        <thead>
          <tr>
            <th>
              #
            </th>
            <th>{{ __('prescription') }}</th>
            <th>{{ __('Notes') }}</th>
            <th>{{ __('actions') }}</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              1
            </td>
            <td>
              اسم الوصفة الطبية
            </td>
            <td><input type="text" name="" value="" id="" class="form-control"></td>
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
    <div class="btn-holder text-center">
        <button class="btn btn-sm btn-success px-4">{{ __('Save') }}</button>
    </div>
    <!-- this's the code should take for backend -->
  </div>
</section>
@endsection
