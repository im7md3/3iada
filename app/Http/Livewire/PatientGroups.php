<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PatientGroup;
use Livewire\WithPagination;

class PatientGroups extends Component
{
    use WithPagination;
    public $name, $parent, $rate = 0, $patient_group;
    protected $paginationTheme = 'bootstrap';
    protected function rules()
    {
        return [
            'name' => 'required',
            'rate' => 'nullable|numeric',
            'parent' => 'nullable',
        ];
    }

    public function edit(PatientGroup $patient_group)
    {
        $this->name = $patient_group->name;
        $this->rate = $patient_group->rate;
        $this->parent = $patient_group->parent;
        $this->patient_group = $patient_group;
    }

    public function save()
    {
        $data = $this->validate();
        $data['rate'] = isset($data['rate']) ? $data['rate'] : 0;
        if ($this->patient_group) {
            $this->patient_group->update($data);
        }
        else {
            PatientGroup::create($data);
        }
        $this->reset();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Saved successfully')]);
    }

    public function delete(PatientGroup $patient_group)
    {
        $patient_group->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Successfully deleted')]);
    }


    public function render()
    {
        $patient_groups = PatientGroup::with('patients')->latest()->paginate(10);

        return view('livewire.patient-groups', compact('patient_groups'));
    }

    public function resetForm()
    {
        $this->reset([
            'name',
            'rate',
            'parent',
        ]);
        $this->rate = 0;
    }
}
