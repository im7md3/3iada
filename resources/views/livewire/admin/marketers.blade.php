<div class="">
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <a href="{{ route('admin.home') }}" class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
            <li class="breadcrumb-item active" aria-current="page">المسوقين</li>
        </ol>
    </nav>
    @if($screen == 'index')
    <div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
        <x-message-admin></x-message-admin>
        <b>المسوقين</b>
        <hr>
        <button class="btn btn-primary btn-sm mb-3" wire:click='$set("screen","create")'>اضف جديد</button>
        <div class="table-responsive">
            <table class="table table-hover" id="prt-content">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>الإسم</th>
                        <th>التحكم</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($marketers as $marketer)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $marketer->name }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <button class="btn btn-primary btn-sm"><i class="fa fa-cog"></i></button>
                                <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            {{ $marketers->links() }}
        </div>
    </div>
    @else
    <div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
        <x-message-admin></x-message-admin>
        <b>{{ $this->obj ? 'تعديل' : 'إضافة' }} مسوق</b>
        <hr>
        <button class="btn btn-primary btn-sm mb-3" wire:click='$set("screen","index")'>رجوع</button>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">اسم المسوق</label>
                    <input type="text" class="form-control" wire:model='name' id="name">
                </div>
            </div>
            <div class="col-md-12">
                <button class="btn btn-success btn-sm mt-3" wire:click='submit'>حفظ</button>
            </div>
        </div>
    </div>
    @endif
</div>