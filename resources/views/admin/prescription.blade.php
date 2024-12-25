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
        <a href="{{ route('admin.prescriptions.export') }}" class="btn btn-success">تصدير البيانات</a>
        <button class="btn mb-3 btn-primary" data-bs-toggle="modal" data-bs-target="#add-edit">إضافة</button>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#importModal">استيراد</button>

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
                                      <label for="name" class="small-label">الاسم العلمي</label>
                                      <input type="text" name="name" id="name" class="form-control">
                                  </div>
                              </div>
                              <div class="col-12 col-md-12">
                                <div class="inp-holder">
                                    <label for="name" class="small-label">الاسم التجاري</label>
                                    <input type="text" name="commercial_name" id="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-12">
                              <div class="inp-holder">
                                  <label for="name" class="small-label">القوة</label>
                                  <input type="text" name="strength" id="strength" class="form-control">
                              </div>
                          </div>
                          <div class="col-12 col-md-12">
                            <div class="inp-holder">
                                <label for="name" class="small-label">القسم</label>
                                <select class="main-select w-100" name="department_id" id="">
                                    <option value="">{{ __('admin.Choose the department') }}</option>
                                    @foreach (App\Models\Department::all() as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                    </select>
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

        <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">استيراد البيانات</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.prescriptions.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <input type="file" name="import_file" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">الغاء</button>
                            <button class="btn btn-sm btn-primary" type="submit">استيراد</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">الاسم العلمي</th>
                    <th scope="col">الاسم التجاري</th>
                    <th scope="col"> القوة</th>
                    <th scope="col">{{ __('admin.department') }}</th>


                    <th scope="col">العمليات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($prescriptions as $prescription)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $prescription->name }}</td>
                    <td>{{ $prescription->commercial_name }}</td>
                    <td>{{ $prescription->strength }}</td>
                    <td>{{ $prescription->department?->name }}</td>


                    <td>
                        {{-- <a href="{{ route('admin.prescriptions.edit', $prescription) }}" class="btn btn-info btn-sm">تعديل</a> --}}
                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#edit{{ $prescription->id }}">تعديل</button>

                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_{{ $prescription->id }}">حذف</button>
                    </td>
                </tr>
                <div class="modal fade" id="edit{{ $prescription->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">تعديل وصفة طبية</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.prescriptions.update', $prescription->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12 col-md-12">
                                            <div class="inp-holder">
                                                <label for="name" class="small-label">الاسم العلمي</label>
                                                <input type="text" name="name" id="name" class="form-control" value="{{ $prescription->name }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <div class="inp-holder">
                                                <label for="commercial_name" class="small-label">الاسم التجاري</label>
                                                <input type="text" name="commercial_name" id="commercial_name" class="form-control" value="{{ $prescription->commercial_name }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <div class="inp-holder">
                                                <label for="strength" class="small-label">القوة</label>
                                                <input type="text" name="strength" id="strength" class="form-control" value="{{ $prescription->strength }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <div class="inp-holder">
                                                <label for="department_id" class="small-label">القسم</label>
                                                <select class="main-select w-100" name="department_id" id="department_id">
                                                    <option value="">{{ __('admin.Choose the department') }}</option>
                                                    @foreach (App\Models\Department::all() as $department)
                                                        <option value="{{ $department->id }}" {{ $prescription->department_id == $department->id ? 'selected' : '' }}>
                                                            {{ $department->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">الغاء</button>
                                    <button class="btn btn-sm btn-primary" type="submit">حفظ</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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
        {{ $prescriptions->links() }}
    </div>
@endsection


