<?php

namespace App\Http\Livewire;

use App\Models\Mark;
use Livewire\Component;
use Livewire\WithPagination;

class Marks extends Component
{
    use WithPagination;
    public $name, $scan_names;
    public $mark;
    protected $paginationTheme = 'bootstrap';

    protected function rules()
    {
        return [
            'name' => 'required',
        ];
    }

    public function edit(Mark $mark)
    {
        $this->name              = $mark->name;
        $this->scan_names        = $mark;
    }


    public function save()
    {
        $data = $this->validate();
        if ($this->mark) {
            $this->mark->update($data);
        } else {
            Mark::create($data);
        }
        $this->reset();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Saved successfully')]);
    }

    public function delete(Mark $mark)
    {
        $mark->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Successfully deleted')]);
    }

    public function render()
    {
        $marks = Mark::latest()->paginate(10);
        // dd( $marks);

        return view('livewire.marks', compact('marks'));
    }
}
