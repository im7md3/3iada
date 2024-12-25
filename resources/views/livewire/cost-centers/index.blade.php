<section class="main-section" wire:ignore.self>
    @section('title')
        {{ __('Cost Centers') }}
    @endsection
    <div class="container">
        <x-alert></x-alert>
        <div class="app-tree">

            <div class="content-app">

                <h4 class="main-heading mb-4">{{ __('Cost Centers') }}</h4>
                <div class="p-4 bg-white rounded-3 shadow">
                    @if ($filter_id)
                        <button class="btn btn-primary btn-sm" wire:click="$set('filter_id',null)">كل المراكز</button>
                    @endif
                    <div class="control-option d-flex flex-wrap align-items-center justify-content-end mb-2 gap-1">
                        <button class="btn-main-sm" data-bs-toggle="modal" data-bs-target="#add_or_update">
                            اضافة مركز تكلفة
                            <i class="icon fa-solid fa-plus me-1"></i>
                        </button>
                        <!-- add or update Modal -->
                        <div class="modal fade" id="add_or_update" aria-labelledby="exampleModalLabel"
                            aria-hidden="true" wire:ignore.self>
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">اضافة - تعديل</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row g-3">
                                            <div class="col-12 col-md-6">
                                                <div class="inp-holder">
                                                    <label for="" class="small-label">الاسم</label>
                                                    <input type="text" wire:model.defer="name" id=""
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="inp-holder">
                                                    <label for="" class="small-label">المركز الرئيسي</label>
                                                    <select wire:model.defer="parent_id" id=""
                                                        class="main-select w-100">
                                                        <option value="">اختر المركز الرئيسي</option>
                                                        @foreach ($all_centers as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-secondary px-3"
                                            data-bs-dismiss="modal">تراجع</button>
                                        <button class="btn btn-sm btn-success px-3" wire:click="submit"
                                            data-bs-dismiss="modal">حفظ</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table main-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الاسم</th>
                                    <th>تاريخ الانشاء</th>
                                    <th>المراكز الفرعية</th>
                                    <th class="not-print">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($centers as $center)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $center->name }}</td>
                                        <td>{{ $center->created_at }}</td>
                                        <td>
                                            <button wire:click="$set('filter_id',{{ $center->id }})"
                                                class="btn btn-sm btn-primary">{{ $center->sub_centers_count }}</button>
                                        </td>
                                        <td class="not-print">
                                            <div class="d-flex align-items-center justify-content-center gap-1">
                                                <button wire:click="edit({{ $center->id }})" data-bs-toggle="modal"
                                                    data-bs-target="#add_or_update"
                                                    class="btn btn-sm btn-info text-white py-1">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger py-1" data-bs-toggle="modal"
                                                    data-bs-target="#delete{{ $center->id }}">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                                <div class="modal fade" id="delete{{ $center->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">تاكيد الحذف</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                هل أنت متأكد من عملية الحذف؟
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-sm btn-danger"
                                                                    data-bs-dismiss="modal">رجوع</button>
                                                                <button class="btn btn-sm  btn-success"
                                                                    data-bs-dismiss="modal"
                                                                    wire:click="delete({{ $center->id }})">نعم</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            // Click tog-active
            if (document.querySelector(".tog-active")) {
                let togglesShow = document.querySelectorAll(".tog-active");
                togglesShow.forEach((e) => {
                    e.addEventListener("click", (evt) => {
                        let divActive = document.querySelector(
                            e.getAttribute("data-active")
                        );
                        divActive.classList.toggle("active");
                    });
                });
            }
        </script>
    @endpush
</section>
