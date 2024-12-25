<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\LabRequest;
use App\Models\ScanRequest;

class ScanLabRequests extends Component
{
    public $screen;
    public $status, $from, $to;
    public $scanCount,
        $labCount;

    public function mount()
    {
            $this->screen = request('screen') ?? 'scan';
        if ($this->screen == 'scan') {
            if (!setting()->scan_active) {
                abort(403);
            }
        }
        if ($this->screen == 'lab') {
            if (!setting()->lab_active) {
                abort(403);
            }
        }

    }


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
        $data = [];
        if ($this->screen == 'scan') {
            $data = ScanRequest::latest()->where(function ($q) {
                $this->between($q);
                if ($this->status) {
                    $q->where('status', $this->status);
                }
            })->paginate(10);
        } elseif ($this->screen == 'lab') {
            $data = LabRequest::latest()->where(function ($q) {
                $this->between($q);
                if ($this->status) {
                    $q->where('status', $this->status);
                }
            })->paginate(10);
        }
        return view('livewire.scan-lab-requests', compact('data'));
    }

}
