<?php

namespace App\Http\Livewire\Reports;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReceptionStaffExport;

class ReceptionStaffReport extends Component
{
    public $receptions, $from, $to, $key;
    public Collection $all_users;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function mount()
    {
        $this->receptions = User::receptions()->withTrashed()->get();
    }
    public function between($query)
    {
        if ($this->from && $this->to) {
            $query->whereDate('created_at', '>=', $this->from)->whereDate('created_at', '<=', $this->to);
        } elseif ($this->from) {
            $query->whereDate('created_at', '>=', $this->from);
        } elseif ($this->to) {
            $query->whereDate('created_at', '<=', $this->to);
        } else {
            $query;
        }
    }
    public function export()
    {
        return Excel::download(new ReceptionStaffExport($this->all_users, $this->from, $this->to), 'reception-staff' . time() . '.xlsx');
    }

    public function render()
    {
        $users = User::receptions()->with(['employee_invoices' => function ($q) {
            $this->between($q);
        }, 'employee_bonds' => function ($q) {
            $this->between($q);
        }])->withCount(['patients' => function ($q) {
            $this->between($q);
        }, 'employee_appointments' => function ($q) {
            $this->between($q);
        }])->where(function ($q) {
            if ($this->key) {
                $q->where('id', $this->key);
            }
        })->withTrashed()->paginate(10);
        $this->all_users = User::receptions()->with(['employee_invoices' => function ($q) {
            $this->between($q);
        }, 'employee_bonds' => function ($q) {
            $this->between($q);
        }])->withCount(['patients' => function ($q) {
            $this->between($q);
        }, 'employee_appointments' => function ($q) {
            $this->between($q);
        }])->where(function ($q) {
            if ($this->key) {
                $q->where('id', $this->key);
            }
        })->withTrashed()->get();
        return view('livewire.reports.reception-staff-report', compact('users'));
    }
}
