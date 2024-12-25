<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\VacationRequest;

class VacationRequests extends Component
{
    use WithFileUploads, WithPagination;
    public $screen = 'index';
    public $attachment, $date, $duration, $reason, $duration_time;
    public function render()
    {
        $vacations = auth()->user()->vacationRequests()->latest()->paginate(10);
        return view('livewire.front.vacation-requests', compact('vacations'));
    }

    public function submit()
    {
        // $data = $this->validate([
        //     'date' => 'required',
        //     'duration' => 'required',
        //     'duration_time' => 'required_if:duration,part',
        //     'reason' => 'required',
        //     'attachment' => 'nullable|file',

        // ]);
        $data = $this->validate([
            'date' => 'required',
            'duration' => 'required',
            'duration_time' => 'required_if:duration,part',
            'reason' => 'required',
            'attachment' => 'nullable|file',
        ], [
            'duration_time.required_if' => __('حقل الوقت بالساعة مطلوب في حال كان وقت الاستئذان هو :part', ['part' => __('جزء من الدوام')]),
        ]);
        // dd($data);
        if (isset($data['attachment'])) {
            $data['attachment'] = store_file($data['attachment'], 'vacations');
        } else {
            unset($data['attachment']);
        }
        auth()->user()->vacationRequests()->create($data);
        $this->reset([
            'date',
            'duration',
            'reason',
            'attachment',
        ]);
        $this->screen = 'index';
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Successfully added')]);
    }

    public function delete(VacationRequest $vacation)
    {
        $vacation->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Successfully deleted' )]);
    }

}
