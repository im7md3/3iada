@extends('doctor.layouts.index')
@section('title')
    {{ __('Vital Signs') }}
@endsection
@section('content')
    <section class="main-section users">
        <div class="container">
            <div class="d-flex align-items-center gap-4 felx-wrap justify-content-between mb-3">
                <h4 class="main-heading mb-0">{{ __('admin.Marks') }}</h4>
            </div>
            <div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
                <a href="{{ route('doctor.marks.create') }}" class="btn mb-3 btn-primary">{{ __('admin.Add') }}</a>
                <table class="table main-table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('admin.name') }}</th>
                            <th scope="col">{{ __('admin.managers') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($marks as $mark)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ __($mark->name) }}</td>
                                <td>
                                    <a class="btn btn-info btn-sm"
                                        href="{{ route('doctor.marks.edit', $mark) }}">{{ __('admin.Update') }}</a>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#delete_agent{{ $mark->id }}"><i></i>
                                        {{ __('admin.Delete') }}
                                    </button>
                                    @include('doctor.marks.delete')
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $marks->links() }}

            </div>
        </div>
    </section>
@endsection
