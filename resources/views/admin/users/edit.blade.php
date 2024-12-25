@extends('admin.layouts.admin')
@section('title')
{{ __('admin.Edit user') }}
@endsection
@section('content')
<nav aria-label="breadcrumb ">
    <ol class="breadcrumb bg-light p-3">
        <a href="{{ route('admin.home') }}" class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
        <li class="breadcrumb-item active" aria-current="page">{{ __('admin.Edit user') }}</li>
    </ol>
</nav>
<div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
    <b>{{ __('admin.Edit user') }}</b>
    <hr>
    <form class="row row-gap-24" action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="col-sm-6 col-md-3">
            <label for="">{{ __('admin.name') }}</label>
            <input class="form-control" type="text" name="name" value="{{ $user->name }}">
        </div>

        <div class="col-sm-6 col-md-3">
            <label for="">{{ __('admin.email') }}</label>
            <input class="form-control" type="email" name="email" value="{{ $user->email }}">
        </div>

        <div class="col-sm-6 col-md-3">
            <label for="">{{ __('admin.type') }}</label>
            <select class="main-select w-100" name="type" id="">
                <option value="">{{ __('admin.select type') }}</option>
                <option value="recep" {{ $user->type == 'recep' ? 'selected' : '' }}>{{ __('admin.recep') }}</option>
                <option value="dr" {{ $user->type == 'dr' ? 'selected' : '' }}>{{ __('admin.dr') }}</option>
                <option value="scan" {{ $user->type == 'scan' ? 'selected' : '' }}>{{ __('scan') }}</option>
                <option value="lab" {{ $user->type == 'lab' ? 'selected' : '' }}>{{ __('lab') }}</option>
                <option value="accountant" {{ $user->type == 'accountant' ? 'selected' : '' }}>
                    {{ __('admin.accountant') }}
                </option>
                <option value="emergency" {{ $user->type == 'emergency' ? 'selected' : '' }}>{{ __('Emergency reception') }}</option>
                <option value="admin" {{ $user->type == 'admin' ? 'selected' : '' }}>{{ __('Management') }}</option>
            </select>
        </div>

        <div class="col-sm-6 col-md-3">
            <label for="">{{ __('admin.group') }}</label>
            <select class="main-select w-100" name="group" id="">
                <option value="">{{ __('admin.select group') }}</option>
                @foreach ($roles as $role)
                <option {{ $user->role?->id == $role->id ? 'selected' : '' }} value="{{ $role->id }}">
                    {{ $role->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="col-sm-6 col-md-3">
            <label for="">{{ __('admin.department') }} <span class="text-danger">( يمكنك إختيار اكثر من قسم للموظف )</span></label>
            <select class="main-select w-100 " id='multi-select' name="departments[]" id="" multiple="multiple">
{{--                <option value="">{{ __('admin.Choose the department') }}</option>--}}
                @foreach ($departments as $department)
                <option class="" {{ in_array($department->id,$user->departments()->pluck('departments.id')->toArray()) ? 'selected' : '' }} value="{{ $department->id }}">
                    {{ $department->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="col-sm-6 col-md-4">
            <label class="main-lable" for="">{{ __('admin.session_duration') }}</label>
            <input class="form-control" type="text" name="session_duration" value="{{ $user->session_duration }}">
        </div>

        <div class="col-sm-6 col-md-3">
            <label for="">{{ __('admin.salary') }}</label>
            <input class="form-control" type="number" name="salary" value="{{ $user->salary }}">
        </div>


        <div class="col-sm-6 col-md-3">
            <label for="">{{ __('Ratio type') }}</label>
            <select class="form-control" name="rate_type" id="rate_type">
                <option {{ $user->rate_type == 'without_rate' ? 'selected' : '' }} value="without_rate">
                    {{ __('Salary without pedigree') }}
                </option>
                <option {{ $user->rate_type == 'rating_after_salary' ? 'selected' : '' }} value="rating_after_salary">
                    {{ __('Proportion after salary') }}
                </option>
                <option {{ $user->rate_type == 'rating_starting_salary' ? 'selected' : '' }} value="rating_starting_salary">{{ __('Descent from the beginning') }}</option>
            </select>
        </div>

        <div class="col-sm-6 col-md-4 {{ $user->rate_type == 'rating_after_salary' ? '' : 'd-none' }}" id="target">
            <label class="main-lable" for="">{{ __('Target') }}</label>
            <input class="form-control" type="number" step="0.1" name="target" placeholder="0" value="{{ $user->target }}">
        </div>

        <div class="col-sm-6 col-md-3">
            <label for="">{{ __('admin.rate') }}</label>
            <input class="form-control" type="number" name="rate" value="{{ $user->rate }}">
        </div>



        <div class="col-sm-6 col-md-3">
            <label for="">{{ __('admin.password') }}</label>
            <input class="form-control" type="password" name="password">
        </div>

        {{-- <div class="col-sm-6 col-md-4">--}}
        {{-- <div class="alert alert-primary p-1 mb-1 fs-11">--}}
        {{-- {{ __('It can be determined which sections the employee can issue invoices') }}--}}
        {{-- </div>--}}
        {{-- <label class="main-lable" for="">{{ __('offer services') }}:</label>--}}
        {{-- @foreach ($departments as $department)--}}
        {{-- <label for="">{{ $department->name }}</label>--}}
        {{-- <input {{ in_array($department->id, $user->show_department_products ?? []) ? 'checked' : '' }} type="checkbox" value="{{ $department->id }}" name="show_department_products[]">--}}
        {{-- @endforeach--}}
        {{-- </div>--}}

        <div class="col-12 mt-5 text-center">
            <button class="btn btn-primary">{{ __('admin.Update') }}</button>
        </div>
    </form>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#multi-select').select2();
    });
</script>
<link rel="stylesheet" href="https://unpkg.com/multiple-select@1.7.0/dist/multiple-select.min.css">
@push('js')

<script>
    $('#rate_type').change(function() {
        if ($(this).val() == 'rating_after_salary') {
            $('#target').removeClass('d-none');
        } else {
            $('#target').addClass('d-none');
        }
    })
</script>
@endpush
@endsection
