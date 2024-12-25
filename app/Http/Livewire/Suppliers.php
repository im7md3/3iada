<?php

namespace App\Http\Livewire;

use App\Models\Supplier;
use App\Traits\livewireResource;
use Livewire\Component;

class Suppliers extends Component
{
    public $name,$phone,$building_no,$city_id,$tax_no,$obj,$screen='index';
    public function rules()
    {
        return [
            'name' => 'required',
            'phone' => 'required',
            'building_no' => 'required',
            'city_id' => 'required',
            'tax_no' => 'required',
        ];
    }
    public function render()
    {
        $suppliers = Supplier::latest()->paginate(10);
        return view('livewire.suppliers',compact('suppliers'));
    }

    public function submit()
    {
        $data = $this->validate();
        if ($this->obj){
            $this->obj->update($data);
        }else{
            Supplier::create($data);
        }
        $this->reset();
        $this->dispatchBrowserEvent('alert',['type'=>'success','message'=>'تم اضافة المورد.']);
    }

    public function edit($id)
    {
        $this->obj = Supplier::find($id);
        $this->name = $this->obj->name;
        $this->phone = $this->obj->phone;
        $this->building_no = $this->obj->building_no;
        $this->city_id = $this->obj->city_id;
        $this->tax_no = $this->obj->tax_no;
        $this->screen ='edit';

    }

    public function delete($id)
    {
        Supplier::findOrFail($id)->delete();
        $this->dispatchBrowserEvent('alert',['type'=>'success','message'=>'تم حذف المورد.']);

    }
    public function deleteConfirm($id)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => 'هل انت متاكد',
            'text' => '',
            'id' => $id
        ]);
    }


}
