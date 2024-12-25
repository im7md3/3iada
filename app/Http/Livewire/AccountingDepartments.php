<?php

namespace App\Http\Livewire;

use App\Models\Account;
use App\Models\Setting;
use Livewire\Component;

class AccountingDepartments extends Component
{
    public $defaults = [
        'salex_tax' => null,
        'purchases_tax' => null,
        'income' => null,
        'tamara' => null,
        'tabby' => null,
    ], $departments = [], $accounts;

    public function mount()
    {
        $this->accounts = Account::all();
    }
    public function render()
    {
        $setting = Setting::first();
        $this->departments = $setting->accounting_departments ? json_decode($setting->accounting_departments, true) : $this->defaults;
        return view('livewire.accounting-departments')->extends('front.layouts.front')->section('content');
    }

    public function submit()
    {
        $setting = Setting::first();
        $setting->update(['accounting_departments' => json_encode($this->departments)]);
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'تم حفظ الحسابات بنجاح']);
    }
}
