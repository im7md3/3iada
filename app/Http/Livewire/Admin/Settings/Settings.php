<?php

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;
use Livewire\WithFileUploads;

class Settings extends Component
{
    use WithFileUploads;
    public $screen = 'general';
    public $site_name, $url, $sms_status, $phone, $sms_username, $sms_sender,
        $sms_password, $email, $tax_enabled, $tax_rate,
        $tax_no, $address, $build_num, $unit_num, $postal_code, $extra_number, $logo, $icon, $capital, $status,
        $birthdate_type,
        $activate_birthdate,
        $age_or_gender,
        $complaint,
        $delete_transfer,
        $new_invoice_form, $active_transfer_print, $message_status,
        $whatsapp_token, $whatsapp_instance_id, $whatsapp_status, $installment_company_name, $installment_company_tax, $installment_company_min_amount_tax, $installment_company_max_amount_tax,
        $tabby_tax, $payment_gateways, $from_morning, $to_morning, $marketers_status, $from_evening, $to_evening, $evening_status, $repeat_phone, $h12_sys, $active_tamara = false, $active_tabby = false;


    public $rules = [
        'site_name' => 'nullable',
        'url' => 'nullable',
        'sms_status' => 'nullable',
        'phone' => 'nullable',
        'sms_username' => 'nullable',
        'sms_sender' => 'nullable',
        'sms_password' => 'nullable',
        'email' => 'nullable',
        'tax_enabled' => 'nullable',
        'tax_rate' => 'nullable',
        'tax_no' => 'nullable',
        'address' => 'nullable',
        'build_num' => 'nullable',
        'unit_num' => 'nullable',
        'postal_code' => 'nullable',
        'extra_number' => 'nullable',
        'status' => 'nullable',
        'birthdate_type' => 'nullable',
        'activate_birthdate' => 'nullable',
        'age_or_gender' => 'nullable',
        'complaint' => 'nullable',
        'delete_transfer' => 'nullable',
        'new_invoice_form' => 'nullable',
        'active_transfer_print' => 'nullable',
        'message_status' => 'nullable',

        'whatsapp_token' => 'nullable',
        'whatsapp_instance_id' => 'nullable',
        'whatsapp_status' => 'nullable',

        'logo' => 'nullable|image',
        'icon' => 'nullable|image',
        //'maintainance_message' => 'nullable',
        'installment_company_name' => 'nullable',
        'installment_company_tax' => 'nullable|numeric',
        'installment_company_min_amount_tax' => 'nullable|numeric',
        'installment_company_max_amount_tax' => 'nullable|numeric',
        'tabby_tax' => 'nullable|numeric',
        'payment_gateways' => 'nullable',
        'from_morning' => 'nullable',
        'to_morning' => 'nullable',
        'from_evening' => 'nullable',
        'to_evening' => 'nullable',
        'evening_status' => 'nullable',
        'repeat_phone' => 'nullable',
        'emergencies_price' => 'nullable',
        'h12_sys' => 'nullable',
        'end_time_status' => 'nullable',
        'show_invoice_tax' => 'nullable',
        'active_tamara' => 'nullable',
        'active_tabby' => 'nullable',
        'marketers_status' => 'nullable'
    ];
    public $files = [
        'logo',
        'icon'
    ];

    public function render()
    {
        return view('livewire.admin.settings.settings');
    }

    public function mount()
    {
        $this->setScreenData();
    }

    public function setScreenData()
    {
        $keys = array_keys($this->rules);
        foreach ($keys as $item) {
            if (!in_array($item, $this->files)) {
                $this->{$item} = setting()->$item;
            } else {
                $this->{'show_' . $item} = setting()->$item;
            }
        }
    }

    public function save()
    {
        $data = $this->validate();
        // dd($data);

        if ($this->logo) {
            delete_file(setting()->logo);
            $data['logo'] = store_file($this->logo, 'settings');
        } else {
            $data['logo'] = setting()->logo;
        }

        if ($this->icon) {
            delete_file(setting()->icon);
            $data['icon'] = store_file($this->icon, 'settings');
        } else {
            $data['icon'] = setting()->icon;
        }

        $data['show_invoice_tax'] = $data['show_invoice_tax'] ? 1 : 0;
        // dd($data);
        setting()->update($data);

        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('تم الحفظ.')]);
    }
}
