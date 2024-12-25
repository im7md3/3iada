
<section class="main-section" wire:ignore.self>

    @section('title')
        {{ __('Accounts tree') }}
    @endsection
    <div class="container">
        <x-alert></x-alert>
        <div class="app-tree">
            <nav class="sidebar-app">
                <button data-active=".sidebar-app" class="tog-active close">
                    <i class="fas fa-xmark"></i>
                </button>
                <a class="item set-border" data-bs-toggle="collapse" href="#tree" class="collapsed" aria-expanded="true">
                    <div>
                        <i class="fa-solid fa-timeline icon"></i>
                        شجرة الحسابات
                    </div>
                    <i class="fas fa-angle-right arrow"></i>
                </a>
                <div class="show item-collapse collapse" id="tree">
                    <div class="d-flex justify-content-center px-2">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#add_or_update"
                            class="btn w-100 btn-sm btn-success">اضافة</button>
                    </div>
                    <div class="option-section">
                        @foreach ($parents as $account)
                            <a class="item" data-bs-toggle="collapse" href="#link-{{ $account->id }}">
                                <i class="fas fa-caret-down arrow-after"></i>
                                <i class="arrow-before fas fa-caret-left"></i>
                                <div class="content-item">
                                    <i class="fa-solid fa-list"></i>
                                    {{ $loop->iteration }}-{{ $account->name }}
                                </div>
                            </a>
                            <div class="collapse collapse-border" id="link-{{ $account->id }}">
                                <div class="mar-side">
                                    @foreach ($account->kids as $kid)
                                        <a class="item" data-bs-toggle="collapse" href="#link-{{ $kid->id }}">
                                            <i class="fas fa-caret-down arrow-after"></i>
                                            <i class="arrow-before fas fa-caret-left"></i>
                                            <div class="content-item">
                                                <i class="fa-solid fa-plus"></i>
                                                {{ $loop->parent->iteration }}{{ $loop->iteration }}-{{ $kid->name }}
                                            </div>
                                        </a>
                                        <div class="collapse collapse-border" id="link-{{ $kid->id }}">
                                            <div class="mar-side">
                                                @foreach ($kid->kids as $k)
                                                    <a class="item">
                                                        <div class="content-item">
                                                            <i class="fa-solid fa-plus"></i>
                                                            {{ $loop->parent->parent->iteration }}{{ $loop->parent->iteration }}{{ $loop->iteration }}-{{ $k->name }}
                                                        </div>
                                                    </a>

                                                    <div class="collapse collapse-border" id="link-2">
                                                        <div class="mar-side">
                                                            @foreach ($k->kids as $kk)
                                                                <a class="item">
                                                                    <div class="content-item">
                                                                        <i class="fa-solid fa-plus"></i>
                                                                        {{ $loop->parent->parent->iteration }}{{ $loop->parent->iteration }}{{ $loop->iteration }}-{{ $kk->name }}
                                                                    </div>
                                                                </a>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </nav>
            <button data-active=".sidebar-app" class="tog-active btn-sidebar">
                <i class="fas fa-bars"></i>
            </button>
            <div class="content-app">
            <div class="d-flex mb-3">
                <a href="{{ route('front.accounting') }}" class="btn bg-main-color text-white">
                    <i class="fas fa-angle-right"></i>
                </a>
            </div>
                <h4 class="main-heading mb-4">{{ __('Accounts tree') }}</h4>
                <div class="p-4 bg-white rounded-3 shadow">
                    @if ($filter_id)
                        <button class="btn btn-primary btn-sm" wire:click="$set('filter_id',null)">كل الحسابات</button>
                    @endif
                    <div class="control-option d-flex flex-wrap align-items-center justify-content-end mb-2 gap-1">
                        <button class="btn-main-sm" data-bs-toggle="modal" data-bs-target="#add_or_update">
                            اضافه قسم جديد
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
                                                    <label for="" class="small-label">الاصول الرئيسية</label>
                                                    <select wire:model.defer="parent_id" id=""
                                                        class="main-select w-100">
                                                        <option value="">اختر الاصول الرئيسية</option>
                                                        @foreach ($parentAccounts as $a)
                                                            <option value="{{ $a->id }}">{{ $a->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="inp-holder">
                                                    <label for="" class="small-label">سعر التكلفة</label>
                                                    <input type="number" wire:model.defer="cost" id=""
                                                        class="form-control">
                                                    <small class="text-danger fs-10px d-block">في حال كان القسم له قيمة
                                                        مادية</small>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 d-flex align-items-center">
                                                <div class="inp-holder">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="" wire:model.defer='depreciable'>
                                                    <label class="small-label" for="">
                                                        قابل للإهلاك
                                                    </label>
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
                                    <th>الاقسام الفرعية</th>
                                    <th class="not-print">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accounts as $account)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $account->name }}</td>
                                        <td>{{ $account->created_at }}</td>
                                        <td>
                                            <button wire:click="$set('filter_id',{{ $account->id }})"
                                                class="btn btn-sm btn-primary">{{ $account->kids_count }}</button>
                                        </td>
                                        <td class="not-print">
                                            <div class="d-flex align-items-center justify-content-center gap-1">
                                                <button wire:click="edit({{ $account->id }})" data-bs-toggle="modal"
                                                    data-bs-target="#add_or_update"
                                                    class="btn btn-sm btn-info text-white py-1">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger py-1" data-bs-toggle="modal"
                                                    data-bs-target="#delete{{ $account->id }}">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                                <div class="modal fade" id="delete{{ $account->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">تاكيد الحذف</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                هل أنت متأكد من عملية الحذف؟
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-sm btn-danger"
                                                                    data-bs-dismiss="modal">رجوع</button>
                                                                <button class="btn btn-sm  btn-success"
                                                                    data-bs-dismiss="modal"
                                                                    wire:click="delete({{ $account->id }})">نعم</button>
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
