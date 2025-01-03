<?php

namespace App\Http\Livewire;

use App\Models\Account;
use App\Models\PaymentMethod;
use App\Traits\livewireResource;
use Livewire\Component;

class PaymentMethods extends Component
{
    use livewireResource;

    public $name, $account_id, $is_active = true;

    public function rules()
    {
        return [
            'name' => 'required',
            'account_id' => 'required',
            'is_active' => 'boolean',
        ];
    }

    public function render()
    {
        $payment_methods = PaymentMethod::paginate(10);
        $accounts = Account::all();
        return view('livewire.payment-methods', compact('payment_methods', 'accounts'));
    }
}
