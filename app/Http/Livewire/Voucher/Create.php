<?php

namespace App\Http\Livewire\Voucher;

use App\Models\User;
use App\Models\Asset;
use App\Models\Account;
use App\Models\Voucher;
use Livewire\Component;
use App\Models\CostCenter;
use App\Models\BankAccount;

class Create extends Component
{
    public $voucher, $voucher_description, $description, $date, $account_id, $debit, $credit, $totalDebit, $totalCredit;
    public $accounts = [];

    protected function rules()
    {
        return [
            'date' => ['required'],
            'accounts.*.debit' => ['nullable'],
            'accounts.*.credit' => ['nullable'],
            'accounts.*.description' => ['required'],
            'accounts.*.cost_center_id' => ['required'],
            'accounts.*.account_id' => ['required'],
            'accounts.*.user_id' => ['nullable'],
        ];
    }

    public function addRow()
    {
        $this->accounts[] = [
            // 'parent_account_id' => '',
            'account_id' => '',
            'cost_center_id' => '',
            'user_id' => null,
            'debit' => $this->debit ?? 0,
            'credit' => $this->credit ?? 0,
            'description' => '',
        ];

        $this->computeAll();
    }

    public function updatedVoucherDescription()
    {
        $this->accounts[0]['description'] = '';
    }

    public function computeAll()
    {
        $this->totalDebit = array_reduce($this->accounts, function ($carry, $item) {
            $carry += doubleval($item['debit'] ? $item['debit'] : 0);
            return $carry;
        });
        $this->totalCredit = array_reduce($this->accounts, function ($carry, $item) {
            $carry += doubleval($item['credit'] ? $item['credit'] : 0);
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

        $last_number = Voucher::latest()->first();

        $voucher = new Voucher();
        // $voucher->description = $this->voucher_description;
        $voucher->date = $this->date;
        $voucher->voucher_no = $last_number?->voucher_no + 1;
        $voucher->employee_id = auth()->user()->id;
        $voucher->save();
        $voucher->accounts()->createMany($this->accounts);
        return redirect()->route('front.vouchers.index');
    }


    public function getAccounts($index, $value)
    {
        if ($value) {
            $this->accounts[$index]['all_accounts'] = Account::where('parent_id', $value)->get();
        } else {
            $this->accounts[$index]['all_accounts'] = [];
        }
    }

    public function mount()
    {
        $this->date = now()->format('Y-m-d');
        $this->addRow();
    }

    public function render()
    {
        $all_accounts = Account::query()->get();
        $cost_centers = CostCenter::get(['id', 'name']);
        $users = User::where('type','!=','admin')->pluck('name','id');
        $this->dispatchBrowserEvent('pharaonic.select2.init');
        return view('livewire.voucher.create', compact('all_accounts', 'cost_centers','users'));
    }
}
