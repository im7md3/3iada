<div class="">
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <a href="{{ route('admin.home') }}" class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
            <li class="breadcrumb-item active" aria-current="page">الإعدادات</li>
        </ol>
    </nav>
    <div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
        <x-message-admin></x-message-admin>
        <b>{{ __('الإعدادات') }}</b>
        <hr>
        <div class="col-md-4">
            <label class="main-lable" for="">تفعيل قسم الطوارئ</label>
            <input type="checkbox" wire:model.defer="emergency_active">
        </div>
        <div class="col-md-4">
            <label class="main-lable" for="">تفعيل الشجرة المحاسبية</label>
            <input type="checkbox" wire:model.defer="account_tree_active">
        </div>
        <div class="col-md-4">
            <label class="main-lable" for="">تفعيل الرسائل</label>
            <input type="checkbox" wire:model.defer="message_active">
        </div>
        <div class="col-md-4">
            <label class="main-lable" for="">تفعيل متابعة الحمل</label>
            <input type="checkbox" wire:model.defer="pregnancy_follow">
        </div>
        <div class="col-md-4">
            <label class="main-lable" for="">تفعيل التجميل</label>
            <input type="checkbox" wire:model.defer="beautification">
        </div>
        <div class="col-md-4">
            <label class="main-lable" for="">تفعيل قسم الاشعه</label>
            <input type="checkbox" wire:model.defer="scan_active">
        </div>
        <div class="col-md-4">
            <label class="main-lable" for="">تفعيل قسم المختبر</label>
            <input type="checkbox" wire:model.defer="lab_active">
        </div>
        <div class="col-md-4">
            <label class="main-lable" for="">تفعيل اضافة الفروع وعدد الفروع المتاحة</label>
            <div class="d-flex gap-2">
                <input type="checkbox" wire:model.defer="branches_active">
                <input type="number" class="form-control" wire:model.defer="branches_active_count" min="1">
            </div>
        </div>
        <div class="col-md-4">
            <label class="main-lable" for="">تفعيل العلامة المائية</label>
            <div class="d-flex gap-2">
                <input type="checkbox" wire:model.defer="active_water_mark">
                <input type="text" class="form-control" wire:model.defer="water_mark_string">
            </div>
        </div>
        <div class="col-12  mt-5 text-center">
            <button class="btn btn-primary" wire:click='save'>{{ __('admin.Save') }}</button>
        </div>
    </div>
</div>
