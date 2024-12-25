<?php

namespace App\Http\Livewire\Invoices;

use App\Models\User;
use App\Models\Invoice;
use App\Models\Patient;
use App\Models\Product;
use App\Models\Service;
use App\Models\Voucher;
use Livewire\Component;
use App\Models\Marketer;
use App\Models\Emergency;
use App\Models\Department;
use App\Models\LabCategory;
use App\Models\ScanService;
use App\Models\PaymentMethod;

class AddInvoices extends Component
{
    public $patient_key, $patient, $department_id, $items = [],
        $product_id, $notes, $invoice_id, $amount, $total, $cash = 0,
        $bank = 0, $tamara = 0, $tabby = 0, $card = 0, $rest, $discount = 0,
        $status, $dr_id, $tax, $offers_discount, $amount_after_offers_discount,
        $split, $split_number, $total_after_split, $lab_cat_id, $lab_serv_id,
        $scan_services, $scan_serv_i, $installment_company, $visa, $mastercard, $date;
    public $need_to_pay, $emergency;
    public $paid_tax, $marketer_id, $paid_without_tax;

    protected function rules()
    {
        return [
            'patient' => 'required',
            'department_id' => 'required',
            'amount' => 'required',
            'total' => 'required',
            'cash' => 'nullable',
            'bank' => 'nullable',
            'tamara' => 'nullable',
            'tabby' => 'nullable',
            'visa' => 'nullable',
            'mastercard' => 'nullable',
            'card' => 'nullable',
            'rest' => 'required',
            'discount' => 'required|lt:amount',
            'notes' => 'nullable',
            'installment_company' => 'nullable',
            'status' => 'required_without:installment_company',
            'dr_id' => 'nullable',
            'tax' => 'nullable',
            'date' => 'required|date',
            'offers_discount' => 'nullable',
            'paid_tax' => 'nullable',
            'paid_without_tax' => 'nullable',
            'marketer_id' => 'nullable'
        ];
    }

    public function get_patient()
    {
        if ($this->emergency) {
            $this->patient = $this->emergency->patient;
        } else {
            $this->patient = Patient::where('id', $this->patient_key)->orWhere('civil', $this->patient_key)->first();
            if ($this->patient) {
                $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Patient data has been retrieved successfully')]);
            } else {
                $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('No results found')]);
            }
        }
    }

    public function add_product()
    {
        if ($this->patient) {
            $product = null;
            if ($this->product_id) {
                $product = Product::with('department')->find($this->product_id);
                $this->department_id = $this->department_id ? $this->department_id : $product->department_id;
                if ($product and $product->department_id == $this->department_id) {
                    $tax = 0;
                    if (setting()->tax_enabled and $this->patient->country_id != 1) {
                        $tax = $product->price * (setting()->tax_rate / 100);
                    }
                    $discount = 0;
                    $offer = null;
                    if (!$this->patient->group) {
                        if ($product->offer) {
                            $discount = $product->price * ($product->offer->rate / 100);
                            $offer = $product->offer->id;
                        }
                    } else {
                        if ($this->patient->group->discounts->count()) {
                            // $this->discount = array_reduce($this->items, function ($carry, $item) {
                            $discountAmount = $this->patient->group->discounts()->where('product_id', $product->id)->first();
                            // $product = Product::find($item['product_id']);
                            if ($discountAmount) {
                                $discount = $product->price * ($discountAmount->rate / 100);
                            }
                            // return $carry;
                            // });
                        }
                    }
                    $total = $product->price - $discount + $tax;
                    // dd($product);
                    if (!$this->itemProductExists($product)) {
                        $this->items[] = ['invoice_id' => $this->invoice_id, 'product_id' => $product->id, 'product_name' => $product->name, 'price' => $product->price, 'discount' => $discount, 'quantity' => 1, 'sub_total' => $total, 'department_id' => $product->department->id, 'department' => $product->department->name, 'is_lab' => $product->department->is_lab, 'is_scan' => $product->department->is_scan, 'tax' => $tax, 'offer_id' => $offer, 'patient_group_discount_id' => $discountAmount ?? null];
                    }
                    $this->computeForAll();
                    $this->product_id = null;
                } else {
                    $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('رقم الخدمة المدخل لا يتوفر في هذا القسم')]);
                    $this->product_id = null;
                }
                $this->emit('$refresh');
            }
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('Please select the patient first')]);
        }
    }

    public function itemProductExists($product)
    {
        foreach ($this->items as $key => $item) {
            if ($item['product_id'] == $product->id) {
                $qty = $this->items[$key]['quantity'] + 1;
                $this->items[$key]['quantity'] = $qty;
                $this->items[$key]['sub_total'] = $this->items[$key]['price'] * $qty;
                return $this->items[$key];
            }
        }

        return false;
    }

    public function delete_item($key)
    {
        unset($this->items[$key]);
        $this->computeForAll();
    }

    public function computeForAll()
    {

        $this->amount = array_reduce($this->items, function ($carry, $item) {
            $price = $item['price'] ? $item['price'] * $item['quantity'] : 0;
            $carry += $price;
            return $carry;
        });


        /* $this->tax = array_reduce($this->items, function ($carry, $item) {
        if (!$this->installment_company) {
        $carry += $item['tax'];
        return $carry;
        }
        }); */

        if (!$this->patient->group) {
            $this->offers_discount = array_reduce($this->items, function ($carry, $item) {
                $carry += $item['discount'];
                return $carry;
            });
        }

        if ($this->patient->group) {
            if (!$this->patient->group->discounts->count()) {
                if ($this->patient->group->rate > 0) {
                    $this->discount = $this->amount * $this->patient->group->rate / 100;
                }
            } else {
                $this->discount = array_reduce($this->items, function ($carry, $item) {
                    $discount = $this->patient->group->discounts()->where('product_id', $item['product_id'])->first();
                    // $product = Product::find($item['product_id']);
                    if ($discount) {
                        $carry += $item['price'] * ($discount->rate / 100);
                    }
                    return $carry;
                });
            }
        }

        $sub_total = $this->amount - $this->discount - $this->offers_discount;

        if (!$this->installment_company) {
            if (setting()->tax_enabled and $this->patient->country_id != 1) {
                $this->tax = $sub_total * (setting()->tax_rate / 100);
            }
        }

        //$this->total = $this->amount + $this->tax - $this->discount - $this->offers_discount;

        $this->amount_after_offers_discount = $this->amount - $this->offers_discount - $this->discount;
        if ($this->split_number == "" or $this->split_number == 0) {
            $this->split_number = 1;
        }
        $this->total_after_split = $this->total / $this->split_number;
        /* $this->discount = array_reduce($this->items, function ($carry, $item) {
        $carry += $item['discount'];
        return $carry;
        }); */

        $this->total = $this->amount + $this->tax - $this->discount - $this->offers_discount;
        $this->rest = 0;
        $this->cash = $this->total;
        $this->need_to_pay = round($this->total, 2);
        $this->paid_tax = round($this->tax, 2);
        $this->paid_without_tax = round($this->total - $this->tax, 2);
        $this->calculateNet();
    }

    public function calculateNet()
    {
        $this->card = $this->card == "" ? 0 : $this->card;
        $this->cash = $this->cash == "" ? 0 : $this->cash;
        $this->bank = $this->bank == "" ? 0 : $this->bank;
        $this->tamara = $this->tamara == "" ? 0 : $this->tamara;
        $this->tabby = $this->tabby == "" ? 0 : $this->tabby;
        $this->mastercard = $this->mastercard == "" ? 0 : $this->mastercard;
        $this->visa = $this->visa == "" ? 0 : $this->visa;
        $this->discount = $this->discount == "" ? 0 : $this->discount;
        $this->rest
            = ($this->total)
            - ($this->card + $this->cash + $this->bank + $this->tamara + $this->tabby + $this->visa + $this->mastercard);
    }

    public function updatedCash()
    {
        $this->calculateMethods();
    }

    public function updatedCard()
    {
        $this->calculateMethods();
    }

    public function updatedVisa()
    {
        $this->calculateMethods();
    }

    public function updatedBank()
    {
        $this->calculateMethods();
    }

    public function updatedTamara()
    {
        $this->calculateMethods();
    }

    public function updatedTabby()
    {
        $this->calculateMethods();
    }

    public function updatedMastercard()
    {
        $this->calculateMethods();
    }

    public function updatedDiscount()
    {
        if ($this->discount > $this->total) {
            $this->discount = 0;
        }
        $this->computeForAll();
        $this->calculateMethods();
    }

    public function changeItemTotal($key)
    {
        $price = $this->items[$key]['price'] ? $this->items[$key]['price'] * $this->items[$key]['quantity'] : 0;
        // $this->items[$key]['price'] = $price;
        if (setting()->tax_enabled and $this->patient->country_id != 1) {
            $this->items[$key]['tax'] = $price * (setting()->tax_rate / 100);
        }
        $this->items[$key]['sub_total'] = $price + $this->items[$key]['tax'];
        $this->computeForAll();
    }

    public function submit()
    {
        $data = $this->validate();

        if ($this->status) {
            if ($this->status == 'Paid') {
                if ($this->rest != 0) {
                    $this->addError('rest', 'لا يمكن عمل الحاله مسدده مع وجود متبقي مبلغ');
                    $errors = $this->getErrorBag();
                    $errors->add('rest', 'لا يمكن عمل الحاله مسدده مع وجود متبقي مبلغ');
                    return redirect()->back();
                }
            }
            if ($this->status == 'tmara') {
                $data['installment_company'] = 1;
                $data['status'] = 'Paid';
                $installment_company_tax = $this->total * (setting()->installment_company_tax / 100);
                $data['installment_company_tax'] = $installment_company_tax;
                if ($this->total > 2500) {
                    $installment_company_amount_tax = $this->total * (setting()->installment_company_max_amount_tax / 100);
                    $data['installment_company_max_amount_tax'] = $installment_company_amount_tax;
                    $data['installment_company_min_amount_tax'] = 0;
                } else {
                    $installment_company_amount_tax = $this->total * (setting()->installment_company_min_amount_tax / 100);
                    $data['installment_company_max_amount_tax'] = 0;
                    $data['installment_company_min_amount_tax'] = $installment_company_amount_tax;
                }
                $data['installment_company_rest'] = $this->total - $installment_company_tax - $installment_company_amount_tax;
                $data['tax'] = 0;
            }
            if ($this->status == 'tab') {
                $data['tab'] = 1;
            }
        }
        $data['invoice_number'] = $this->invoice_id;
        $data['patient_id'] = $this->patient->id;
        $data['employee_id'] = auth()->id();
        $data['marketer_id'] = isset($data['marketer_id']) && $data['marketer_id'] != '' ? $data['marketer_id'] :  null;

        $data['total'] = $this->total;
        if (!isset($data['tax'])) {
            $data['tax'] = 0;
        }
        for ($i = 1; $i <= $this->split_number; $i++) {
            $invoice = Invoice::create($data);
        }

        $this->invoiceVouchers($invoice);

        // dd($this->items);
        $invoice->products()->createMany($this->items);
        if ($this->status == 'Paid') {
            foreach ($this->items as $item) {
                if ($item['is_lab']) {
                    $this->patient->labRequests()->create(['product_id' => $item['product_id'], 'doctor_id' => auth()->id(), 'clinic_id' => $item['department_id']]);
                }
                if ($item['is_scan']) {
                    $this->patient->scanRequests()->create(['product_id' => $item['product_id'], 'dr_id' => auth()->id(), 'clinic_id' => $item['department_id']]);
                }
            }
        }
        if ($this->emergency) {
            $this->emergency->invoice_id = $invoice->id;
            $this->emergency->save();
        }

        return redirect()->route('front.invoices.index')->with('success', __('Saved successfully'));
    }


    public function invoiceVouchers($invoice)
    {
        $accounting_departments = json_decode(setting()->accounting_departments, true);
        if (!$accounting_departments && !isset($accounting_departments['income'])) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'يجب تحديد حساب إيرادات العيادة من الاعدادات أولا']);
            return back();
        }

        $first_voucher = Voucher::create([
            'date' => date('Y-m-d'),
            'description' => 'فاتورة رقم ' . $invoice?->id . ' للعميل ' . $this->patient->name . ' - عيادة',
            'invoice_id' => $invoice->id,
        ]);

        $first_voucher->accounts()->createMany(
            [
                [
                    'account_id' => $accounting_departments['income'],
                    'credit' => $this->amount,
                    'debit' => 0,
                    'description' =>  $first_voucher->description,
                ],
                [
                    'account_id' => $accounting_departments['salex_tax'],
                    'credit' => $this->tax,
                    'debit' => 0,
                    'description' => $first_voucher->description,
                ],
                [
                    'account_id' => $this->patient->account_id,
                    'credit' => 0,
                    'debit' => $this->total,
                    'description' => $first_voucher->description,
                ]
            ]

        );

        /* if (count($this->payments) > 0) {
            foreach ($this->payments as $key => $payment) {
                $payment_method = PaymentMethod::find($payment['payment_method_id']);
                $voucher = Voucher::create([
                    'date' => date('Y-m-d'),
                    'description' => 'سداد فاتورة رقم ' . $invoice?->id . ' - ' . $payment_method?->name,
                    'invoice_id' => $invoice->id,
                ]);

                $voucher->accounts()->createMany(
                    [
                        [
                            'account_id' => $payment_method?->account_id,
                            'credit' => 0,
                            'debit' => $payment['amount'],
                            'description' =>  $voucher->description,
                        ],
                        [
                            'account_id' => $this->patient->account_id,
                            'credit' => $payment['amount'],
                            'debit' => 0,
                            'description' => $voucher->description,
                        ]
                    ]

                );
            }
        } */
    }

    public function updatedStatus()
    {
        if ($this->status == 'tmara') {
            $this->cash = 0;
            $this->bank = 0;
            $this->visa = 0;
            $this->mastercard = 0;
            $this->card = 0;
        }
    }

    public function mount()
    {
        if (auth()->user()->type == 'dr') {
            abort(403);
        }
        $this->emergency = request('emergency_id') ? Emergency::find(request('emergency_id')) : null;
        if ($this->emergency) {
            if ($this->emergency->invoice()->exists()) {
                abort(404);
            }
            $this->patient = $this->emergency->patient;
            $this->patient_key = $this->emergency->patient_id;
            $this->status = 'Paid';
        }

        $invoice = Invoice::latest()->first();
        $this->invoice_id = $invoice ? $invoice->id + 1 : 1;
        $this->scan_services = ScanService::all();
        $this->cash = 0;
        $this->card = 0;
        $this->bank = 0;
        $this->tabby = 0;
        $this->tamara = 0;
        $this->visa = 0;
        $this->rest = 0;
        $this->date = date('Y-m-d');
        if (request('patient_id')) {
            $this->patient_key = request('patient_id');
            $this->get_patient();
        }
    }

    public function render()
    {
        $departments = Department::get();
        $lab_categories = LabCategory::all();
        $lab_services = Service::where('category_id', $this->lab_cat_id)->get();
        $doctors = User::doctors()->whereHas('departments', function ($q) {
            $q->where('departments.id', $this->department_id);
        })->get();
        $products = Product::where('department_id', $this->department_id)->get();
        $marketers = Marketer::get();
        return view('livewire.invoices.add-invoices', compact('doctors', 'departments', 'products', 'lab_categories', 'lab_services', 'marketers'));
    }

    protected function calculateMethods()
    {
        $total = (((float)$this->card) + ((float)$this->cash) + ((float)$this->mastercard) + ((float)$this->bank) + ((float)$this->tamara) + ((float)$this->tabby) + ((float)$this->visa));
        //dd($total,$this->total);
        if ($total > $this->total) {
            // do {
            if ($this->card != 0) {
                $this->card = 0;
            } elseif ($this->cash != 0) {
                $this->cash = 0;
            } elseif ($this->mastercard != 0) {
                $this->mastercard = 0;
            } elseif ($this->bank != 0) {
                $this->bank = 0;
            } elseif ($this->tamara != 0) {
                $this->tamara = 0;
            } elseif ($this->tabby != 0) {
                $this->tabby = 0;
            } elseif ($this->visa != 0) {
                $this->visa = 0;
            }
            // } while ($total > $this->total);
        }
        $total = (((float)$this->card) + ((float)$this->cash) + ((float)$this->mastercard) + ((float)$this->bank) + ((float)$this->tamara) + ((float)$this->tabby) + ((float)$this->visa));

        //$this->rest = ((float) $this->total) - (float) $total;

        $tax = 0;
        if (setting()->tax_enabled and $this->patient->country_id != 1) {
            $tax = $this->amount_after_offers_discount * (setting()->tax_rate / 100);
        }

        if ((float)$total > $this->total) {

            $this->cash = 0;
            $this->card = 0;
            $this->bank = 0;
            $this->tabby = 0;
            $this->tamara = 0;
            $this->visa = 0;
            $this->rest = $this->total;
            $this->tax = 0;
            $this->need_to_pay = 0;
        } else {

            $this->paid_tax = $this->patient->country_id != 1 ? round($total - ($total * 100) / (100 + setting()->tax_rate), 2) : 0;

            $this->paid_without_tax = round($total - $this->paid_tax, 2);
            $discount = (float) $this->discount;
            $this->tax = $tax;
            $this->total =  $this->amount + $tax - $discount - $this->offers_discount;
            $this->rest = round($this->total - $total, 2);
            $this->need_to_pay = round($total, 2);
        }
    }

    public function manualCalculate()
    {
        $this->calculateMethods();
    }
}
