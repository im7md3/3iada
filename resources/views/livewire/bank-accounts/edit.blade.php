<section class="main-section">
    <div class="container">
        <h4 class="main-heading mb-4">
            تعديل حساب بنكي
        </h4>
        <div class="p-3 shadow rounded-3 bg-white">
            <x-message-admin />
            <form action="" method="POST">
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-3">
                        <input wire:model.defer="account_name" type="text" class="form-control"
                            placeholder="اسم الحساب" name="" id="">
                    </div>
                    <div class="col-12 col-md-3">
                        <input wire:model.defer="account_number" type="number" class="form-control"
                            placeholder="رقم الحساب" name="" id="">
                    </div>
                    <div class="col-12 col-md-3">
                        <input wire:model.defer="balance" type="number" class="form-control"
                            placeholder="الرصيد" name="" id="">
                    </div>
                </div>
                <div class="btn-holder text-center">
                    <button type="button" class="btn btn-sm btn-primary px-3" wire:click="submit">
                        حفظ
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@push('js')
<x:pharaonic-select2::scripts />
@endpush
