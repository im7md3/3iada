@extends('admin.layouts.admin')
@section('title')
{{ __('admin.branches') }}
@endsection
@section('content')
<nav aria-label="breadcrumb ">
    <ol class="breadcrumb bg-light p-3">
        <a href="{{ route('admin.home') }}" class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
        <li class="breadcrumb-item active" aria-current="page">{{ __('admin.branches') }}</li>
    </ol>
</nav>
<div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
    @if(setting()->branches_active && $branchesCount < setting()->branches_active_count)
        <a href="{{ route('admin.branches.create') }}" class="btn mb-3 btn-primary">{{ __('admin.Add') }}</a>
        @else
        <div class="alert alert-warning">
            لإضافة او تعديل فروع برجاء التواصل معنا لتفعيل الخاصية العدد المتاح لكم الان هو {{ setting()->branches_active_count }}
        </div>
        @endif
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('admin.name') }}</th>
                    <th scope="col">{{ __('admin.managers') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($branches as $branch)
                <tr>
                    <th scope="row">{{ $loop->index + 1 }}</th>
                    <td>{{ $branch->name }}</td>
                    <td>

                        <a class="btn btn-info btn-sm" href="{{ route('admin.branches.edit',$branch) }}">{{ __('admin.Update') }}</a>

                        @if($loop->index)
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_agent{{ $branch->id }}"><i></i>
                            {{ __('admin.Delete') }}
                        </button>
                        @include('admin.branches.delete')
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $branches->links() }}

</div>

@endsection
