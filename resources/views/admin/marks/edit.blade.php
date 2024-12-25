@extends('admin.layouts.admin')
@section('title')
{{ __('admin.vital Signs') }}
@endsection
@section('content')

<nav aria-label="breadcrumb ">
	<ol class="breadcrumb bg-light p-3">
		<a href="{{ route('admin.home') }}" class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
		<li class="breadcrumb-item active" aria-current="page">{{ __('Edit vital Signs') }}</li>
	</ol>
</nav>
<div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
	<b>{{ __('Edit vital Signs') }}</b>
	<hr>
	<form class="row" action="{{ route('admin.marks.update',$mark) }}" method="POST">
		@csrf
		@method('PUT')
		<div class="col-md-4">
			<label class="main-lable" for="">{{ __('admin.name') }}</label>
			<input class="form-control" type="text" name="name" value="{{ $mark->name }}">
		</div>
		<div class="col-sm-6 col-md-3">
			<label for="">السماح بالظهور</label>
			<input type="checkbox" name="show"  {{ $mark->show?'checked':'' }} value="1"  >
		</div>
		<div class="col-12 text-center mt-5">
			<button class="btn btn-primary">{{ __('admin.Update') }}</button>
		</div>
	</form>

</div>

@endsection