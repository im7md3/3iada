@extends('admin.layouts.admin')
@section('title')
{{ __('Vital Signs') }}
@section('content')

    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <a href="{{ route('admin.home') }}" class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Vital Signs') }}</li>
        </ol>
    </nav>
    <div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
        <a href="{{ route('admin.mark.create') }}"  class="btn mb-2 btn-primary">{{ __('admin.Add') }}</a>
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('admin.name') }}</th>
                    <th scope="col " class="text-center">{{ __('admin.managers') }}</th>
                </tr>
            </thead>
            <tbody>

                    <tr>
                        <th scope="row">1</th>
                        <th></th>


                        <td class="text-center">
                            <a class="btn btn-info btn-sm text-light" href="">{{ __('admin.Update') }}</a>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target=""><i></i>
                                {{ __('admin.Delete') }}
                            </button>

                        </td>
                    </tr>

            </tbody>
        </table>

    </div>

@endsection
