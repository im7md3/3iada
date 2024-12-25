<?php

namespace App\Http\Livewire\Voucher;

use App\Models\User;
use App\Models\Asset;
use App\Models\Account;
use App\Models\Voucher;
use Livewire\Component;
use App\Models\CostCenter;
use App\Models\BankAccount;

class Edit extends Component
{
    public $voucher, $voucher_description, $description, $date, $account_id, $debit, $credit, $totalDebit, $totalCredit;
    public $accounts = [];

    protected function rules()
    {
        return [
            // 'voucher_description' => ['required'],
            'accounts.*.description' => ['required'],
            'date' => ['required'],
            'accounts.*.debit' => ['nullable'],
            'accounts.*.credit' => ['nullable'],
            'accounts.*.account_id' => ['required'],
            'accounts.*.cost_center_id' => ['required'],
            'accounts.*.user_id' => ['nullable'],
        ];
    }

    public function addRow()
    {
        $this->accounts[] = ['account_id' => $this->account_id, 'debit' => $this->debit ?? 0, 'credit' => $this->credit ?? 0, 'description' => $this->description];

        $this->computeAll();
    }

    public function computeAll()
    {
        $this->totalDebit = array_reduce($this->accounts, function ($carry, $item) {
            $carry += $item['debit'] ? $item['debit'] : 0;
            return $carry;
        });
        $this->totalCredit = array_reduce($this->accounts, function ($carry, $item) {
            $carry += $item['credit'] ? $item['credit'] : 0;
            return $carry;
        });
    }

    public function removeRow($key)
    {
        $this->totalDebit -= $this->accounts[$key]['debit'];
        $this->totalCredit -= $this->accounts[$key]['credit'];
        unset($this->accounts[$key]);
    }

    public function submit()
    {
        // dd($this->accounts);
        $data = $this->validate();

        $epsilon = 1e-6;

        // if (abs($this->totalCredit - $this->totalDebit) > $epsilon) {
        //     session()->flash('error', 'يجب ان يكون  المبلغ المدين يساوي المبلغ الدائن');
        //     return back();
        // }

        // $this->voucher->description = $this->voucher_description;
        $this->voucher->date = $this->date;
        $this->voucher->employee_id = auth()->user()->id;
        $this->voucher->save();
        $this->voucher->accounts()->delete();
        $this->voucher->accounts()->createMany($this->accounts);
        return redirect()->route('front.vouchers.index');
    }

    public function mount($voucher)
    {
        $this->voucher = $voucher;
        $this->accounts = $voucher->accounts()->get()->toArray();
        $this->date = $voucher->date;
        // $this->voucher_description = $voucher->description;
        $this->computeAll();
    }
    public function render()
    {
        $all_accounts = Account::query()->get();
        $cost_centers = CostCenter::get(['id', 'name']);
        $users = User::where('type','!=','admin')->pluck('name','id');
        $this->dispatchBrowserEvent('pharaonic.select2.init');
        $this->dispatchBrowserEvent('pharaonic.select2.init');
        return view('livewire.voucher.edit', compact('all_accounts','users','cost_centers'));
    }
}
