@extends('doctor.layouts.index')
@section('title')
    {{ __('Add vital Signs') }}
@endsection
@section('content')
    <section class="main-section users">
        <div class="container">
            <div class="d-flex align-items-center gap-4 felx-wrap justify-content-between mb-3">
                <h4 class="main-heading mb-0">{{ __('admin.Marks') }}</h4>
            </div>
            <div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
                <b>{{ __('Add vital Signs') }}</b>
                <hr>
                <form class="row " action="{{ route('doctor.marks.store') }}" method="POST">
                    @csrf
                    <div class="col-md-4">
                        <label class="main-lable" for="">{{ __('admin.name') }}</label>
                        <input class="form-control" type="text" name="name">
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <label for="">السماح بالظهور</label>
                        <input type="checkbox" name="show" value="1">
                    </div>
                    <div class="col-12  mt-5 text-center">

                        <button class="btn btn-primary">{{ __('admin.Add') }}</button>
                    </div>
                </form>

            </div>
        </div>
    </section>
@endsection
