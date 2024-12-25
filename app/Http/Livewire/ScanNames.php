<?php

namespace App\Http\Livewire;

use App\Models\ScanName;
use Livewire\Component;
use Livewire\WithPagination;

class ScanNames extends Component
{
    use WithPagination;
    public $name, $scan_name;
    protected $paginationTheme = 'bootstrap';

    protected function rules()
    {
        return [
            'name' => 'required',
        ];
    }

    public function edit(ScanName $scan_name)
    {
        $this->name              = $scan_name->name;
        $this->scan_name        = $scan_name;
    }


    public function save()
    {
        $data = $this->validate();
        if ($this->scan_name) {
            $this->scan_name->update($data);
        } else {
            ScanName::create($data);
        }
        $this->reset();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Saved successfully')]);
    }

    public function delete(ScanName $scan_name)
    {
        $scan_name->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Successfully deleted')]);
    }

    public function render()
    {
        $scan_names = ScanName::latest()->paginate(10);

        return view('livewire.scan-names', compact('scan_names'));
    }
}
