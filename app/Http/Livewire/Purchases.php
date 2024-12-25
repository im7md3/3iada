<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Purchase;
use Livewire\WithPagination;

class Purchases extends Component
{
    public $name, $amount, $tax, $purchase, $tax_value, $date,$supplier_id;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected function rules()
    {
        return [
            'supplier_id' => 'nullable',
            'name' => 'required',
            'amount' => 'required',
            'date' => 'required',
            'tax' => 'nullable',
            'tax_value' => 'nullable'
        ];
    }
    public function edit(Purchase $purchase)
    {
        $this->name = $purchase->name;
        $this->supplier_id = $purchase->supplier_id;
        $this->amount = $purchase->amount;
        $this->tax = $purchase->tax;
        $this->date = $purchase->date;
        $this->tax_value = $purchase->tax_value;
        $this->purchase = $purchase;
    }
    public function save()
    {
        $data = $this->validate();
        if ($data['tax']) {
            $before_tax = round($this->amount * 100 / (100 + setting()->tax_rate), 2);
            $data['tax_value'] = round($before_tax * setting()->tax_rate / 100, 2);;
        }
        if ($this->purchase) {
            $this->purchase->update($data);
        } else {
            Purchase::create($data);
        }
        $this->reset();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Saved successfully')]);
    }
    public function delete(Purchase $purchase)
    {
        $purchase->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Successfully deleted')]);
    }

    public function mount()
    {
        $this->date = date('Y-m-d');
    }

    public function render()
    {
        $purchases = Purchase::latest()->paginate(10);
        return view('livewire.purchases', compact('purchases'));
    }

    public function resetForm()
    {
        $this->reset([
            'name',
            'amount',
            'date',
            'tax',
            'tax_value'
        ]);
    }
}
