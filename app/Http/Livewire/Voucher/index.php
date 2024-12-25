<?php

namespace App\Http\Livewire\Voucher;

use App\Models\User;
use App\Models\Voucher;
use Livewire\Component;
use Livewire\WithPagination;

class index extends Component
{
    public $employee_id, $from, $to, $voucher_no, $search;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    function delete(Voucher $voucher)
    {
        $voucher->delete($voucher);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'تم حذف السند بنجاح']);
    }



    public function between($query)
    {
        if ($this->from && $this->to) {
            $query->whereBetween('date', [$this->from, $this->to]);
        } elseif ($this->from) {
            $query->where('date', '>=', $this->from);
        } elseif ($this->to) {
            $query->where('date', '<=', $this->to);
        } else {
            $query;
        }
    }


    public function render()
    {
        $all_vouchers = Voucher::when($this->search, function ($q) {
            $q->where('description', 'LIKE', "%$this->search%");
        })->when($this->voucher_no, function ($q) {
            $q->where('voucher_no', $this->voucher_no);
        })->when($this->employee_id, function ($q) {
            $q->where('employee_id', $this->employee_id);
        })->where(function ($q) {
            $this->between($q);
        })->latest()->paginate(15);

        $users = User::whereIn('type', ['admin', 'accountant', 'recep'])->get();

        return view('livewire.voucher.index', compact('all_vouchers', 'users'));
    }
}
