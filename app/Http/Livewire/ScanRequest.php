<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\ScanRequest as ModelsScanRequest;

class ScanRequest extends Component
{
    public $selected_request, $scan_content, $file, $screen = 'index', $scan_name, $dr_content, $scanned_at, $delivered_at;
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public function rules()
    {
        return [
            'file' => 'required',
            'scan_content' => 'required',
        ];
    }
    public function show(ModelsScanRequest $request)
    {
        $this->selected_request = $request;
        $this->screen = 'show';
    }
    public function edit(ModelsScanRequest $request)
    {
        $this->selected_request = $request;
        $this->scan_name = $request->scan_name->name;
        $this->dr_content = $request->dr_content;
    }

    public function submit()
    {
        $data = $this->validate();
        $data['file'] = store_file($this->file, 'scans');
        $data['scanned_at'] = now()->format('Y-m-d');
        $data['delivered_at'] = now()->format('Y-m-d');
        $data['scan_tec_id'] = auth()->user()->id;
        $data['status'] = 'done';
        $this->selected_request->update($data);
        $this->selected_request = null;
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Saved successfully')]);
        $this->reset();
    }
    public function delete(ModelsScanRequest $request)
    {
        $request->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Successfully deleted')]);
    }
    public function render()
    {
        $requests = ModelsScanRequest::with(['doctor', 'patient', 'clinic', 'product'])->whereHas('appointment', function ($q) {
            $q->whereHas('invoice', function ($invoice) {
                $invoice->where('status', 'Paid');
            });
        })->latest()->paginate(10);
        return view('livewire.scan-request', compact('requests'));
    }
}
