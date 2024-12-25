<?php

namespace App\Http\Livewire\Invoices;

use App\Models\Invoice;
use App\Models\InvoiceBond;
use Livewire\Component;
use Livewire\WithPagination;

class AllBonds extends Component
{

    public $from, $to;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function between($query)
    {
        if ($this->from && $this->to) {
            $query->whereBetween('created_at', [$this->from, $this->to]);
        } elseif ($this->from) {
            $query->where('created_at', '>=', $this->from);
        } elseif ($this->to) {
            $query->where('created_at', '<=', $this->to);
        } else {
            $query;
        }
    }

    public function render()
    {
        $bonds = InvoiceBond::with(['invoice', 'user'])->where(function ($q) {
            $this->between($q);
        })->latest()->paginate(10);
        return view('livewire.invoices.all-bonds', compact('bonds'));
    }
}
