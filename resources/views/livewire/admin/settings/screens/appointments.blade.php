<div class="row row-gap-24">
    <div class="col-md-12 text-center mt-3">
        <h5 class="mx-auto w-fit line-bottom-blue mb-4">
            {{ __('admin.Morning and evening settings') }}
        </h5>
    </div>
    <div class="col-12 col-12 m-0">
        <div class="alert alert-info" role="alert">
            {{ __('Timing must be set to be determined based on working times') }}
        </div>
        <div class="alert alert-info" role="alert">
            في حالة احتياجك لاختيار فترة واحدة فقط يمكنك تعطيل الفترة المسائية واختيار اي وقت على مدار اليوم من الفترة الصباحية علما باخت الاختيار يكون من ضمن 12 صباحا ل 11:59 صباحا او 12 مساء و 11:59 مساء
        </div>
    </div>
    <div class="form-group col-md-4">
        <div class="mt-4">
            <label class="main-lable" for="">{{ __('admin.evening_status') }}</label>
            <input id="evening_status" type="checkbox" wire:model.live="evening_status" class="form-check">
        </div>
    </div>
    <div class="form-group col-md-4">

        <div class="mt-4">
            <label class="main-lable" for="">{{ __('admin.12_hours') }}</label>
            <input id="h12_sys" type="checkbox" wire:model.live="h12_sys" class="form-check">
        </div>
    </div>
    <div class="form-group col-md-4">

        <div class="mt-4">
            <label class="main-lable" for="">{{ __('admin.end_time_status') }}</label>
            <input id="end_time_status" type="checkbox" wire:model.live="end_time_status" class="form-check">
        </div>
    </div>
    <div class="form-group col-md-6">
        <h6 class="text-center mb-3">{{ __('admin.Morning time') }}</h6>
        <div class="row">
            <div class="col-md-6">
                <label class="main-lable" for="">{{ __('admin.from') }}</label>
                <input type="time" wire:model="from_morning" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="main-lable" for="">{{ __('admin.to') }}</label>
                <input type="time" wire:model="to_morning" class="form-control">
            </div>
        </div>
    </div>
    @if($this->evening_status)
    <div class="form-group col-md-6 ">
        <h6 class="text-center mb-3">{{ __('admin.Evening time') }}</h6>
        <div class="row">
            <div class="col-md-6">
                <label class="main-lable" for="">{{ __('admin.from') }}</label>
                <input type="time" wire:model="from_evening" id="from_evening" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="main-lable" for="">{{ __('admin.to') }}</label>
                <input type="time" wire:model="to_evening" id="to_evening" class="form-control">
            </div>

        </div>
    </div>
    @endif

    <div class=" mt-5">
        <div class="d-flex justify-content-center ">
            <button type="submit" wire:click="save" class="btn btn-primary">{{ __('admin.Save') }}</button>
        </div>
    </div>
</div>
