<h3 class="mb-3">{{$report ? __('Edit') : __('Add')}} @lang('Report') </h3>
<div class="mb-4">
    <div class="row gy-3">
        <div class="col-12 ">
            <label class="form-label">@lang('Send to (the party that requested the report)')</label>
            <input class="form-control" wire:model="recipient" placeholder="@lang('Send to')">
        </div>
        <div class="col-12  ">
            <label class="form-label">@lang('Report details in Arabic')</label>

            <textarea class="form-control" wire:model="details" rows="5" placeholder="@lang('Report details')">

            </textarea>
        </div>
        <div class="col-12 ">
            <label class="form-label">@lang('Report details in English')</label>

            <textarea class="form-control" wire:model="details_en" rows="5" placeholder="@lang('Report details in English')">

            </textarea>
        </div>
    </div>
    <button wire:click="storeReport" class="btn btn-success mt-3">@lang('Save')</button>

</div>
