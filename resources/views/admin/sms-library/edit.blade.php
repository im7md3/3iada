@extends('admin.layouts.admin')
@section('title')
    {{ __('admin.edit_sms_library') }}
@endsection
@section('content')

    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <a href="{{ route('admin.home') }}" class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
            <li class="breadcrumb-item active" aria-current="page">{{ __('admin.edit_sms_library') }} - SMS</li>
        </ol>
    </nav>
    <div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
        <b>{{ __('Edit vital Signs') }}</b>
        <hr>
        <form class="row" action="{{ route('admin.sms_messages.update',$sms_message) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="col-md-4">
                <label class="main-lable" for="">{{ __('admin.title') }}</label>
                <input class="form-control" type="text" name="title" value="{{ $sms_message->title }}">
            </div>

            <div class="col-md-4">
                <label class="main-lable" for="">{{ __('admin.content') }}</label>
                <textarea class="form-control" type="text" name="content">{{ $sms_message->content }}</textarea>
            </div>

            <div class="col-12 text-center mt-5">
                <button class="btn btn-primary">{{ __('admin.Update') }}</button>
		</div>
	</form>

</div>

@endsection
