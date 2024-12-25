@extends('admin.layouts.admin')
@section('title')
{{ __('admin.add branch') }}
@endsection
@section('content')

<nav aria-label="breadcrumb ">
    <ol class="breadcrumb bg-light p-3">
        <a href="{{ route('admin.home') }}" class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
        <li class="breadcrumb-item active" aria-current="page">{{ __('admin.add branch') }}</li>
    </ol>
</nav>
<div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
    <b>{{ __('admin.add branch') }}</b>
    <hr>
    <form class="row" action="{{ route('admin.branches.store') }}" method="POST">
        @csrf
        @if(setting()->branches_active && $branchesCount < setting()->branches_active_count)
            @include('admin.branches.form')
            <div class="col-12  mt-5 text-center">
                <button class="btn btn-primary">{{ __('admin.Add') }}</button>
            </div>
            @else
            <div class="alert alert-warning">
                لإضافة او تعديل فروع برجاء التواصل معنا لتفعيل الخاصية العدد المتاح لكم الان هو {{ setting()->branches_active_count }}
            </div>
            @endif


    </form>

</div>

@endsection
