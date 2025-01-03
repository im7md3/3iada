@extends('admin.layouts.admin')
@section('title')
{{ __('admin.sms_library') }}
@endsection
@section('content')

<nav aria-label="breadcrumb ">
	<ol class="breadcrumb bg-light p-3">
		<a href="{{ route('admin.home') }}" class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
		<li class="breadcrumb-item active" aria-current="page">{{ __('admin.add_sms_library') }} - SMS</li>
	</ol>
</nav>
<div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
	<b>{{ __('admin.sms_library') }} - SMS</b>
	<hr>
	<form class="row " action="{{ route('admin.sms_messages.store') }}" method="POST">
		@csrf
		<div class="col-md-4">
			<label class="main-lable" for="">{{ __('admin.title') }}</label>
			<input class="form-control" type="text" name="title">
		</div>

		<div class="col-md-4">
			<label class="main-lable" for="">{{ __('admin.content') }}</label>
            <textarea class="form-control" name="content"></textarea>
    </div>

		<div class="col-12  mt-5 text-center">

			<button class="btn btn-primary">{{ __('admin.Add') }}</button>
		</div>
	</form>

</div>

@endsection
