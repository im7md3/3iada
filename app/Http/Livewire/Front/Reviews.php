<?php

namespace App\Http\Livewire\Front;

use Carbon\Carbon;
use App\Models\Account;
use Livewire\Component;

class Reviews extends Component
{
    public $date, $from, $to;

    public function render()
    {
        $accounts = Account::parents();

        return view('livewire.front.reviews', compact('accounts'));
    }

    public function mount()
    {
        $this->date = Carbon::now()->format('Y');
        if ($year = cache('accounting_year')) {
            $this->from = Carbon::parse($year . '-01-01')->format('Y-m-d');
            $this->to = Carbon::parse($year . '-12-31')->format('Y-m-d');
            $this->date = $year;
        } else {
            $this->date = Carbon::now()->format('Y');
        }
    }

    public function resetFromTo()
    {
        $this->reset(['from', 'to']);
        $this->date = Carbon::now()->format('Y');
    }
}
