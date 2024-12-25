<div class="row row-gap-24">
    @if (auth()->user()->type == 'company')
    <div class="col-md-12 text-center mt-3">
        <h5 class="mx-auto w-fit line-bottom-blue mb-4">إعدادات الواتس اب</h5>
    </div>
    <div class="form-group col-sm-6 col-md-3">
        <label class="main-lable" for="">TOKEN</label>
        <input type="text" wire:model="whatsapp_token" placeholder="TOKEN" class="form-control">
    </div>
    <div class="form-group col-sm-6 col-md-3">
        <label class="main-lable" for="">INSTANCE_ID</label>
        <input type="text" wire:model="whatsapp_instance_id" placeholder="INSTANCE_ID" class="form-control">
    </div>
    @endif
    <div class="form-group col-12">
        <label class="main-lable" for="">{{ __('Activate payment gates') }}</label>
        <input type="checkbox" wire:model="payment_gateways" value="1">
    </div>
    <div class="form-group col-12">
        <label class="main-lable" for="">{{ __('Activate Tamara') }}</label>
        <input type="checkbox" wire:model="active_tamara">
    </div>
    <div class="form-group col-12">
        <label class="main-lable" for="">{{ __('Activate Tabby') }}</label>
        <input type="checkbox" wire:model="active_tabby">
    </div>
    <div class="col-md-12 text-center mt-3">
        <h5 class="mx-auto w-fit line-bottom-blue mb-4">{{ __('Tamara Company Settings') }}</h5>
    </div>
    <div class="form-group col-sm-6 col-md-3">
        <label class="main-lable" for="">{{ __('Administrative operations fees') }}</label>
        <input type="number" wire:model="installment_company_tax" placeholder="{{ __('Administrative operations fees') }}" class="form-control" step="0.01">
    </div>
    <div class="col-md-12 text-center mt-3">
        <h5 class="mx-auto w-fit line-bottom-blue mb-4">إعدادات شركة تابي</h5>
    </div>
    <div class="form-group col-sm-6 col-md-3">
        <label class="main-lable" for="">رسوم العمليات الادارية</label>
        <input type="number" wire:model="tabby_tax" placeholder="رسوم العمليات الادارية" class="form-control" step="0.01">
    </div>
    <div class="d-flex justify-content-center ">
        <button type="submit" wire:click="save" class="btn btn-primary">{{ __('admin.Save') }}</button>
    </div>
</div>