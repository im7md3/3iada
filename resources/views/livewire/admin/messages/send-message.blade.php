<div>
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <a href="{{ route('admin.home') }}" class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
            <li class="breadcrumb-item active" aria-current="page">ارسال الرسائل</li>
        </ol>
    </nav>
    <x-message-admin></x-message-admin>
    <div class="row g-3">
        <div class="col-12 col-md-4 col-lg-3">
            <label for="">اختر المريض</label>
            <select wire:model="patient_id" class="form-control">
                <option value="">أختر</option>
                <option value="all">كل المرضى</option>
                @foreach ($all_patients as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <label for="">حدد نوع الرسالة</label>
            <select wire:model.live="msg_type" class="form-control">
                <option value="">أختر</option>
                <option value="1">نصية</option>
                <option value="2">صورة</option>
            </select>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <label for="">أختر من مكتبة الرسائل</label>
            <select wire:model="message_id" class="form-control">
                <option value="">أختر</option>
                @foreach ($msgs as $m)
                    <option value="{{ $m->id }}">{{ $m->content }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-12 col-md-4 col-lg-3">
            <label for=""> ارسل سابقا</label>
            <input type="checkbox" wire:model="prev">
        </div>
        <div class="col-12">
            <div class="btn-holder">
                <button type="button" class="main-btn px-4" wire:click='submit'>ارسال</button>
            </div>
        </div>
    </div>
</div>
