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
<div class="form-group col-sm-6 col-md-3 col-lg-4">
    <label class="small-label" for="">
        <input type="checkbox" class="form-check" wire:model="whatsapp_status" {{ setting()->whatsapp_status ? 'checked' : '' }}>
        تفعيل خدمة ارسال الرسائل بالواتساب
    </label>
</div>
<div class="col-12 text-center mt-5">
    <button type="submit" wire:click="save" class="btn btn-primary">{{ __('admin.Save') }}</button>
</div>
