<?php

namespace App\Http\Livewire\Front;

use App\Models\Account;
use Livewire\Component;
use App\Models\VoucherAccount;

class AccountStatment extends Component
{
    public $filter_start_date,$filter_end_date,$accounts,$filter_account;
    public function mount()
    {
        $this->accounts = Account::latest()->get();
    }
    public function render()
    {
        $vouchers = VoucherAccount::whereHas('voucher',function($q){
            if($this->filter_start_date && $this->filter_end_date){
                $q->whereBetween('date',[$this->filter_start_date,$this->filter_end_date]);
            }elseif($this->filter_start_date){
                $q->where('date','>',$this->filter_start_date);
            }
        })->where(function($q){
            if($this->filter_account){
                $q->where('account_id',$this->filter_account);
            }
        })->latest()->get();

        return view('livewire.front.account-statment',compact('vouchers'));
    }
}
