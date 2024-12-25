<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\PatientGroup;
use Livewire\WithPagination;
use App\Models\PatientGroupDiscount;

class PatientGroupDiscounts extends Component
{

    public $discount,$product_id,$rate;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount(PatientGroup $group)
    {
        $this->patientGroup = $group;
    }
    public function render()
    {
        $discounts = $this->patientGroup->discounts()->where(function(){
           //
        })->paginate(10);
        $alreadyDone = $discounts->pluck('product_id')->toArray();
        $products = Product::latest()->whereNotIn('id',$alreadyDone)->get();
        return view('livewire.patient-group-discounts',compact('discounts','products'));
    }

    protected function rules()
    {
        return [
            'product_id' => 'required',
            'rate' => 'required|numeric',
        ];
    }
    public function edit(PatientGroupDiscount $discount)
    {
        $this->discount = $discount;
        $this->product_id = $discount->product_id;
        $this->rate = $discount->rate;
    }
    public function save()
    {
        $data = $this->validate();
        if ($this->discount) {
            $this->discount->update($data);
        }else{
            $this->patientGroup->discounts()->create($data);
        }
        $this->resetForm();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Saved successfully')]);
    }

    public function delete(PatientGroupDiscount $discount)
    {
        $discount->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Successfully deleted')]);
    }
    public function resetForm()
    {
        $this->reset([
            'product_id',
            'rate',
            'discount'
        ]);
    }
}
