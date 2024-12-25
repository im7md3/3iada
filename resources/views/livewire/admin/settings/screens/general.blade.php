<div class="row row-gap-24 ">
    <div class="form-group col-sm-6 col-md-3">
        <label class="main-lable" for="">{{ __('admin.Site name') }}</label>
        <input type="text" wire:model="site_name" placeholder="{{ __('admin.Site name') }}" class="form-control">
    </div>
    <div class="form-group col-sm-6 col-md-3">
        <label class="main-lable" for="">{{ __('admin.url') }}</label>
        <input type="url" wire:model="url" placeholder="{{ __('admin.url') }}" class="form-control">
    </div>
    <div class="form-group col-sm-6 col-md-3">
        <label class="main-lable" for="">{{ __('admin.SMS status') }}</label>
        <select wire:model="sms_status" id="" class="main-select w-100">
            <option value="open" {{ setting()->sms_status == 'open' ? 'selected' : '' }}>
                {{ __('admin.open') }}
            </option>
            <option value="close" {{ setting()->sms_status == 'close' ? 'selected' : '' }}>
                {{ __('admin.close') }}
            </option>
        </select>
    </div>
    <div class="form-group col-sm-6 col-md-3">
        <label class="main-lable" for="">{{ __('admin.phone') }}</label>
        <input type="text" wire:model="phone" placeholder="{{ __('admin.phone') }}" class="form-control">
    </div>
    <div class="form-group col-sm-6 col-md-3">
        <label class="main-lable" for="">{{ __('admin.SMS Username') }}</label>
        <input type="text" wire:model="sms_username" placeholder="{{ __('admin.SMS Username') }}" class="form-control">
    </div>
    {{-- <div class="form-group col-sm-6 col-md-3">
        <label class="main-lable" for="">{{ __('admin.SMS Sender') }}</label>
        <input type="text" wire:model="sms_sender" placeholder="{{ __('admin.SMS Sender') }}" class="form-control">
    </div>

    <div class="form-group col-sm-6 col-md-3">
        <label class="main-lable" for="">{{ __('admin.SMS Password') }}</label>
        <input type="text" wire:model="sms_password" placeholder="{{ __('admin.SMS Password') }}" class="form-control">
    </div> --}}
    <div class="form-group col-sm-6 col-md-3">
        <label class="main-lable" for="">{{ __('admin.email') }}</label>
        <input type="email" wire:model="email" placeholder="{{ __('admin.email') }}" class="form-control">
    </div>
    <div class="form-group col-sm-6 col-md-3">
        <label class="main-lable" for="">{{ __('admin.Tax enabled') }}</label>
        <select wire:model="tax_enabled" id="" class="main-select w-100">
            <option value="1" {{ setting()->tax_enabled == 1 ? 'selected' : '' }}>
                {{ __('admin.Yes') }}
            </option>
            <option value="0" {{ setting()->tax_enabled == 0 ? 'selected' : '' }}>
                {{ __('admin.No') }}
            </option>
        </select>
    </div>
    <div class="form-group col-sm-6 col-md-3">
        <label class="main-lable" for="">{{ __('admin.Tax rate') }}</label>
        <input type="number" wire:model="tax_rate" placeholder="{{ __('admin.Tax rate') }}" class="form-control"
            step="0.01">
    </div>
    <div class="form-group col-sm-6 col-md-3">
        <label class="main-lable" for="">{{ __('admin.Tax number') }}</label>
        <input type="text" wire:model="tax_no" placeholder="{{ __('admin.Tax number') }}" class="form-control">
    </div>
    <div class="form-group col-sm-6 col-md-3">
        <label class="main-lable" for="">{{ __('admin.address') }}</label>
        <input type="text" wire:model="address" placeholder="{{ __('admin.address') }}" class="form-control">
    </div>
    <div class="form-group col-sm-6 col-md-3">
        <label class="main-lable" for="">{{ __('admin.Build number') }}</label>
        <input type="text" wire:model="build_num" placeholder="{{ __('admin.Build number') }}" class="form-control">
    </div>
    <div class="form-group col-sm-6 col-md-3">
        <label class="main-lable" for="">{{ __('admin.Unit number') }}</label>
        <input type="text" wire:model="unit_num" placeholder="{{ __('admin.Unit number') }}" class="form-control">
    </div>
    <div class="form-group col-sm-6 col-md-3">
        <label class="main-lable" for="">{{ __('admin.Postal code') }}</label>
        <input type="text" wire:model="postal_code" placeholder="{{ __('admin.Postal code') }}" class="form-control">
    </div>

    <div class="form-group col-sm-6 col-md-3">
        <label class="main-lable" for="">{{ __('admin.Extra number') }}</label>
        <input type="text" wire:model="extra_number" placeholder="{{ __('admin.Extra number') }}" class="form-control">
    </div>
    <?php $setting = \App\Models\Setting::latest()->first(); ?>
    <div class="form-group col-sm-6 col-md-3">
        <label class="main-lable" for="">{{ __('admin.Logo') }}</label>
        <input type="file" wire:model="logo" placeholder="{{ __('admin.Logo') }}" class="form-control img">
        <img src="{{ display_file(setting()->logo) }}" alt="{{ $setting->logo ?? null }}"
            class="img-thumbnail img-preview" width="100px">
    </div>
    <div class="form-group col-sm-6 col-md-3">
        <label class="main-lable" for="">{{ __('admin.Icon') }}</label>
        <input type="file" wire:model="icon" placeholder="{{ __('admin.Icon') }}" class="form-control">
        <img src="{{ display_file(setting()->icon) }}" alt="{{ $setting->icon ?? null }}"
            class="img-thumbnail img-preview" width="100px">
    </div>
    <div class="form-group col-sm-6 col-md-3">
        <label class="main-lable" for="">{{ __('admin.emergencies_price') }}</label>
        <input type="number" wire:model="emergencies_price" placeholder="{{ __('admin.emergencies_price') }}"
            class="form-control">
    </div>
    <!-- <div class="form-group col-sm-6 col-md-3">
        <label class="main-lable" for="">{{ __('capital') }} </label>
        <input type="number" wire:model="capital" placeholder="{{ __('capital') }}" class="form-control">
    </div> -->

    <!-- <div class="form-group col-sm-6 col-md-3">
        <label class="main-lable" for="">{{ __('Site condition') }}</label>
        <select wire:model="status" id="" class="main-select w-100">
            <option value="open">
                {{ __('admin.site-open') }}
            </option>
            <option value="close">
                {{ __('admin.site-closed') }}
            </option>
        </select>
    </div>
    <div class="form-group col-sm-6 col-md-3">
        <label class="main-lable" for="">{{ __('Date of Birth Type') }}</label>
        <select wire:model="birthdate_type" id="" class="main-select w-100">
            <option value="hijri">
                {{ __('Hijri') }}
            </option>
            <option value="gregorian">
                {{ __('Gregorian ') }}
            </option>
        </select>
    </div>
    <div class="form-group col-sm-6 col-md-3 mt-4">
        <label class="main-lable" for="">{{ __('Activate the date of birth') }}</label>
        <input type="checkbox" wire:model="activate_birthdate" value="1">
    </div>
    <div class="form-group col-sm-6 col-md-6">
        <label for="" class="p-2">
            {{ __('Display Gender Fields') }}
            <input type="radio" wire:model="age_or_gender" value="sex" id="">
        </label>
        <label for="" class="p-2">
            {{ __('Display Age Fields') }}
            <input type="radio" wire:model="age_or_gender" value="age" id="">
        </label>
        <label for="" class="p-2">
            {{ __('Display Age and Gender') }}
            <input type="radio" wire:model="age_or_gender" value="all" id="">
        </label>
    </div>
    <div class="form-group col-12">
        <label class="main-lable"
            for="">{{ __('Showing complaint field and clinical detection in diagnosis') }}</label>
        <input type="checkbox" wire:model="complaint" value="1" {{ setting()->complaint ? 'checked' : '' }}>
    </div>
    <div class="form-group col-12">
        <label class="main-lable" for="">{{ __('admin.Delete transfer patients') }}</label>
        <input type="checkbox" wire:model="delete_transfer" @if (setting()->delete_transfer) checked @endif>
    </div>
    <div class="form-group col-12">
        <label class="main-lable" for="">{{ __('Activation of Thermal Printer') }}</label>
        <input type="checkbox" wire:model="new_invoice_form" value="1">
    </div>
    <div class="form-group col-12">
        <label class="main-lable" for="">{{ __('Activate Printing Patient Transfer') }}</label>
        <input type="checkbox" wire:model="active_transfer_print" value="1">
    </div>

    <div class="form-group col-12">
        <label class="main-lable" for="">{{ __('Repeat Phone') }}</label>
        <input type="checkbox" wire:model="repeat_phone" value="1">
    </div> -->

    <div class="form-group col-sm-6 col-md-3">
        <label class="main-lable" for="">{{ __('Site condition') }}</label>
        <select wire:model="status" id="" class="main-select w-100">
            <option value="open">
                {{ __('admin.site-open') }}
            </option>
            <option value="close">
                {{ __('admin.site-closed') }}
            </option>
        </select>
    </div>
    <div class="form-group col-md-4">

        <div class="mt-4">
            <label class="main-lable" for="">اظهار الضريبة في شاشة البيع</label>
            <input id="show_invoice_tax" type="checkbox" wire:model.live="show_invoice_tax" class="form-check">
        </div>
    </div>
    <div class="form-group col-md-4">

        <div class="mt-4">
            <label class="main-lable" for="">تفعيل المسوقين</label>
            <input id="marketers_status" type="checkbox" wire:model.live="marketers_status" class="form-check">
        </div>
    </div>
    <div class="form-group col-sm-12">
        <label class="main-lable" for="">{{ __('admin.Message status') }}</label>
        <textarea wire:model="message_status" rows="5" class="form-control"
            placeholder="{{ __('admin.Message status') }}"></textarea>
    </div>
    <!-- @if (auth()->user()->type == 'company')
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
    <div class="col-md-12 text-center mt-3">
        <h5 class="mx-auto w-fit line-bottom-blue mb-4">{{ __('Tamara Company Settings') }}</h5>
    </div>
    {{-- <div class="form-group col-sm-6 col-md-3">
<label class="main-lable" for="">{{ __('Company name') }}</label>
<input type="text" wire:model="installment_company_name" placeholder="{{ __('Company name') }}"
class="form-control" value="{{ setting()->installment_company_name }}">
</div> --}}
    <div class="form-group col-sm-6 col-md-3">
        <label class="main-lable" for="">{{ __('Administrative operations fees') }}</label>
        <input type="number" wire:model="installment_company_tax"
            placeholder="{{ __('Administrative operations fees') }}" class="form-control" step="0.01">
    </div>
    {{-- <div class="form-group col-sm-6 col-md-3">
<label class="main-lable" for="">{{ __('Fee Less Amount') }}</label>
<input type="number" wire:model="installment_company_min_amount_tax" placeholder="{{ __('Fee Less Amount') }}"
class="form-control" value="{{ setting()->installment_company_min_amount_tax }}" step="0.01">
</div>
<div class="form-group col-sm-6 col-md-3">
<label class="main-lable" for="">{{ __('Fee Higher Amount') }}</label>
<input type="number" wire:model="installment_company_max_amount_tax" placeholder="{{ __('Fee Higher Amount') }}"
class="form-control" value="{{ setting()->installment_company_max_amount_tax }}" step="0.01">
</div> --}}

    <div class="col-md-12 text-center mt-3">
        <h5 class="mx-auto w-fit line-bottom-blue mb-4">إعدادات شركة تابي</h5>
    </div>

    <div class="form-group col-sm-6 col-md-3">
        <label class="main-lable" for="">رسوم العمليات الادارية</label>
        <input type="number" wire:model="tabby_tax" placeholder="رسوم العمليات الادارية" class="form-control"
            step="0.01">
    </div>

    <div class="form-group col-12">
        <label class="main-lable" for="">{{ __('Activate payment gates') }}</label>
        <input type="checkbox" wire:model="payment_gateways" value="1">
    </div> -->
    <!-- <div class="col-md-12 text-center mt-3">
        <h5 class="mx-auto w-fit line-bottom-blue mb-4">
            {{ __('admin.Morning and evening settings') }}</h5>
    </div>
    <div class="col-12 col-12 m-0">
        <div class="alert alert-info" role="alert">
            {{ __('Timing must be set to be determined based on working times') }}
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

    <div class="form-group col-md-6 ">
        <h6 class="text-center mb-3">{{ __('admin.Evening time') }}</h6>
        <div class="row">
            <div class="col-md-4">
                <label class="main-lable" for="">{{ __('admin.from') }}</label>
                <input type="time" wire:model="from_evening" id="from_evening" class="form-control">

            </div>
            <div class="col-md-4">
                <label class="main-lable" for="">{{ __('admin.to') }}</label>
                <input type="time" wire:model="to_evening" id="to_evening" class="form-control">

            </div>
            <div class="col-md-4">
                <label class="main-lable" for="">{{ __('admin.evening_status') }}</label>
                <input id="evening_status" type="checkbox" wire:model="evening_status" class="form-check">
            </div>
        </div>
    </div> -->
    <div class="col-12 text-center mt-5">
        <button type="submit" wire:click="save" class="btn btn-primary">{{ __('admin.Save') }}</button>
    </div>

</div>