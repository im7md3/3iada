@extends('admin.layouts.admin')
@section('title', __('Prescription'))
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light p-3">
        <a href="{{ route('admin.home') }}" class="breadcrumb-item" aria-current="page">{{ __('admin.home') }}</a>
        <li class="breadcrumb-item active" aria-current="page">{{ __('Prescription') }}</li>
    </ol>
</nav>
<div class="w-100 mx-auto p-3 shadow rounded-3 bg-white">
    <button class="btn mb-3 btn-primary" data-bs-toggle="modal" data-bs-target="#add-edit">إضافة</button>
    <div class="modal fade" id="add-edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">اضافة وصفه طبية</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.prescriptions.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="inp-holder">
                                    <label for="name" class="small-label">الاسم</label>
                                    <input type="text" name="name" id="name" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">الغاء</button>
                        <button class="btn btn-sm btn-primary" type="submit" data-bs-dismiss="modal">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">الاسم</th>
                <th scope="col">العمليات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($prescriptions as $prescription)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $prescription->name }}</td>
                <td>
                    <a href="{{ route('admin.prescriptions.edit', $prescription) }}"
                        class="btn btn-info btn-sm">تعديل</a>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_{{ $prescription->id }}">
                        حذف
                    </button>
                </td>
            </tr>
            <!-- Modal for Deletion -->
            <div class="modal fade" id="delete_{{ $prescription->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.prescriptions.destroy', $prescription->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body">
                                هل أنت متأكد من عملية الحذف؟
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">لا</button>
                                <button class="btn btn-sm btn-primary" type="submit" data-bs-dismiss="modal">نعم</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
