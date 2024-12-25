<div class="row row-gap-24">
    <div class="form-group col-sm-6 col-md-3">
        <label class="main-lable" for="">تحديد تاريخ العمر</label>
        <select wire:model="birthdate_type" id="" class="main-select w-100">
            <option value="hijri">
                {{ __('Hijri') }}
            </option>
            <option value="gregorian">
                {{ __('Gregorian ') }}
            </option>
        </select>
    </div>
    <div class="form-group col-sm-12 col-md-12">
        <label class="main-lable" for="">{{ __('Activate the date of birth') }}</label>
        <input type="checkbox" wire:model="activate_birthdate" value="1">
    </div>
    <div class="form-group col-12">
        <label for="sex" class="p-2">
            {{ __('Display Gender Fields') }}
            <input type="radio" wire:model="age_or_gender" value="sex" id="sex">
        </label>
        <label for="age" class="p-2">
            {{ __('Display Age Fields') }}
            <input type="radio" wire:model="age_or_gender" value="age" id="age">
        </label>
        <label for="all" class="p-2">
            {{ __('Display Age and Gender') }}
            <input type="radio" wire:model="age_or_gender" value="all" id="all">
        </label>
    </div>

    <div class="form-group col-12 col-md-12">
        <label class="main-lable" for="">{{ __('Showing complaint field and clinical detection in diagnosis') }}</label>
        <input type="checkbox" wire:model="complaint" value="1" {{ setting()->complaint ? 'checked' : '' }}>
    </div>
    <div class="form-group col-12 col-md-12">
        <label class="main-lable" for="">{{ __('admin.Delete transfer patients') }}</label>
        <input type="checkbox" wire:model="delete_transfer" @if (setting()->delete_transfer) checked @endif>
    </div>
    <div class="form-group col-12 col-md-12">
        <label class="main-lable" for="">{{ __('Activation of Thermal Printer') }}</label>
        <input type="checkbox" wire:model="new_invoice_form" value="1">
    </div>
    <div class="form-group col-12 col-md-12">
        <label class="main-lable" for="">{{ __('Activate Printing Patient Transfer') }}</label>
        <input type="checkbox" wire:model="active_transfer_print" value="1">
    </div>

    <div class="form-group col-12 col-md-12">
        <label class="main-lable" for="">{{ __('Repeat Phone') }}</label>
        <input type="checkbox" wire:model="repeat_phone" value="1">
    </div>
    <div class="form-group col-md-12">
        <label class="main-lable" for="">اظهار الضريبة في شاشة البيع</label>
        <input id="show_invoice_tax" type="checkbox" wire:model.live="show_invoice_tax" class="form-check">
    </div>
    <div class="d-flex justify-content-center ">
        <button type="submit" wire:click="save" class="btn btn-primary">{{ __('admin.Save') }}</button>
    </div>
</div>
