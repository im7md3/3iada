@extends('admin.layouts.admin')
@section('title')
{{ __('admin.edit branch') }}
@endsection
@section('content')

<nav aria-label="breadcrumb ">
    <ol class="breadcrumb bg-light p-3">
        <a href="{{ route('admin.home') }}" class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
        <li class="breadcrumb-item active" aria-current="page">{{ __('admin.edit branch') }}</li>
    </ol>
</nav>
<div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
    <b>{{ __('admin.edit branch') }}</b>
    <hr>
    <form class="row" action="{{ route('admin.branches.update',$branch) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.branches.form')
        <div class="col-12 text-center mt-5">
            <button class="btn btn-primary">{{ __('admin.Update') }}</button>
        </div>
    </form>

</div>

@endsection
