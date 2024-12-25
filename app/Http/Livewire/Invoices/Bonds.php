<?php

namespace App\Http\Livewire\Invoices;

use App\Models\Invoice;
use Livewire\Component;
use App\Models\InvoiceBond;
use Livewire\WithPagination;

class Bonds extends Component
{

    public $invoice_id, $amount, $bond, $patient, $rest, $invoice, $status, $user_id, $invoice_rest, $payment_method, $tax;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected function rules()
    {
        return [
            'invoice_id' => 'required',
            'amount' => 'required|numeric',
            'tax' => 'required',
            'status' => 'required',
            'payment_method' => 'required'
        ];
    }


    public function updatedAmount()
    {
        if ($this->amount > 0) {
            $tax = 0;
            if (setting()->tax_enabled and $this->invoice->patient->country_id != 1) {
                // $tax = $this->amount  * (setting()->tax_rate / 100);
                $tax = round($this->amount - ($this->amount * 100) / (100 + setting()->tax_rate), 2);
            }
            $this->tax = $tax;
        } else {
            $this->tax = 0;
        }
    }

    public function edit(InvoiceBond $bond)
    {
        $this->invoice_id = $bond->invoice_id;
        $this->amount = $bond->amount;
        $this->tax = $bond->tax;
        $this->patient = $this->invoice->patient->name;
        $this->status = $bond->status;
        $this->payment_method = $bond->payment_method;
        $this->bond = $bond;
    }
    public function save()
    {
        $data = $this->validate();
        $data['user_id'] = $this->user_id;
        if ($this->amount > $this->invoice->rest) {
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'المبلغ المكتوب أكبر من المبلغ المتبقي للفاتورة']);
        } else {
            $payment_method = $this->payment_method;
            if ($this->status == 'creditor') {
                $status = '';
                if ($this->invoice->rest - $this->amount <= 0) {
                    $status = 'Paid';
                } else {
                    $status = 'Partially Paid';
                }
                if ($payment_method == 'tab' || $payment_method == 'tmara') {
                    $this->invoice->update([
                        'rest' => $this->invoice->rest - $this->amount,
                        'status' => $status
                    ]);
                } else {
                    $this->invoice->update([
                        'rest' => $this->invoice->rest - $this->amount,
                        $payment_method => $this->invoice->$payment_method + $this->amount,
                        'status' => $status
                    ]);
                }
            } else {
                if ($payment_method == 'tab' || $payment_method == 'tmara') {
                    $this->invoice->update([
                        'rest' => $this->invoice->rest + $this->amount,
                        'status' => 'Partially retrieved'
                    ]);
                } else {
                    $this->invoice->update([
                        'rest' => $this->invoice->rest + $this->amount,
                        $payment_method => $this->invoice->$payment_method - $this->amount,
                        'status' => 'Partially retrieved'
                    ]);
                }
            }
            $data['rest'] = $this->invoice->rest;
            if ($this->bond) {
                $this->invoice->update([
                    'rest' => $this->invoice->rest + $this->amount,
                ]);

                $this->invoice->update([
                    'rest' => $this->invoice->rest - $this->rest,
                ]);

                $this->bond->update($data);
            } else {
                InvoiceBond::create($data);
            }
        }
        $this->reset('amount', 'tax');
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Saved successfully')]);
    }
    public function delete(InvoiceBond $bond)
    {
        $this->invoice->update([
            'rest' => $this->invoice->rest + $bond->amount,
            'status' => 'Partially Paid'
        ]);
        $bond->delete();

        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Successfully deleted')]);
    }

    public function mount()
    {
        $this->invoice_id = $this->invoice->id;
        $this->user_id = auth()->id();
        $this->patient = $this->invoice->patient->name;


        $this->status = 'creditor';
    }
    public function render()
    {
        $this->invoice_rest = $this->invoice->rest;
        $bonds = $this->invoice->bonds()->latest('id')->paginate(10);
        return view('livewire.invoices.bonds', compact('bonds'));
    }
}
