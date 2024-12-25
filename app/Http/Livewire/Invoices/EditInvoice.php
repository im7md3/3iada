<?php

namespace App\Http\Livewire\Invoices;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Patient;
use App\Models\Product;
use App\Models\Service;
use App\Models\Voucher;
use Livewire\Component;
use App\Models\Marketer;
use App\Models\Department;
use App\Models\Appointment;
use App\Models\LabCategory;
use App\Models\ScanService;
use Illuminate\Support\Str;
use App\Models\PaymentMethod;

class EditInvoice extends Component
{
    public $invoice, $patient_key, $patient, $department_id, $items = [], $product_id, $notes, $invoice_id, $amount = 0, $total, $cash = 0, $bank = 0, $tamara = 0, $tabby = 0, $card = 0, $rest, $discount = 0, $status, $tasdeed = false, $offers_discount, $amount_after_offers_discount, $split, $split_number, $total_after_split, $lab_cat_id, $lab_serv_id, $scan_services, $scan_serv_id, $installment_company, $visa, $mastercard, $tax, $dr_id, $date, $days = [], $reservedTimes = [], $need_to_pay = 0;
    public $paid_tax, $paid_without_tax, $marketer_id;
    protected function rules()
    {
        return [
            'patient' => 'required',
            'department_id' => 'required',
            'amount' => 'required',
            'total' => 'required',
            'cash' => 'required',
            'bank' => 'required',
            'visa' => 'required',
            'mastercard' => 'required',
            'card' => 'required',
            'tabby' => 'required',
            'tamara' => 'required',
            'rest' => 'required',
            'discount' => 'required|lt:amount',
            'notes' => 'nullable',
            'installment_company' => 'nullable',
            'status' => 'required_without:installment_company',
            'dr_id' => 'nullable',
            'tax' => 'nullable',
            'offers_discount' => 'nullable',
            'date' => 'required|date',
            'paid_tax' => 'nullable',
            'paid_without_tax' => 'nullable',
            'marketer_id' => 'nullable'
        ];
    }
    public function get_patient()
    {
        $this->patient = Patient::where('id', $this->patient_key)->orWhere('civil', $this->patient_key)->first();
        if ($this->patient) {
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Patient data has been retrieved successfully')]);
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('No results found')]);
        }
    }

    /*     public function add_product()
    {
    if($this->patient){
    if ($this->product_id ) {
    $product = Product::with('department')->findOrFail($this->product_id);
    $tax = 0;
    if (setting()->tax_enabled and $this->patient->country_id != 1) {
    $tax = $product->price * (setting()->tax_rate / 100);
    }
    $discount=0;
    $offer=null;
    if($product->offer){
    $discount=$product->price * ($product->offer->rate / 100);
    $offer=$product->offer->id;
    }
    $total=$product->price-$discount+$tax;
    $this->items[] = ['invoice_id' => $this->invoice_id, 'product_id' => $product->id, 'product_name' => $product->name, 'price' => $product->price, 'discount' => $discount, 'quantity' => 1, 'sub_total' => $total, 'department' => $product->department->name, 'tax' => $tax,'offer_id'=>$offer];
    $this->computeForAll();
    $this->product_id = null;
    }
    }else{
    $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => __('Please select the patient first')]);
    }
    } */

    public function add_product()
    {
        if ($this->patient) {
            if ($this->product_id) {
                $product = Product::with('department')->find($this->product_id);
                $this->department_id = $this->department_id ? $this->department_id : $product->department_id;
                if ($product and $product->department_id = $this->department_id) {
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
                    }
                    $total = $product->price - $discount + $tax;
                    $this->items[] = ['invoice_id' => $this->invoice_id, 'product_id' => $product->id, 'product_name' => $product->name, 'price' => $product->price, 'discount' => $discount, 'quantity' => 1, 'sub_total' => $total, 'department_id' => $product->department->id, 'department' => $product->department->name, 'is_lab' => $product->department->is_lab, 'is_scan' => $product->department->is_scan, 'tax' => $tax, 'offer_id' => $offer];
                    $this->computeForAll();
                    $this->product_id = null;
                } else {
                    $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('رقم الخدمة المدخل لا يتوفر في هذا القسم')]);
                    $this->product_id = null;
                }
            }
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('Please select the patient first')]);
        }
    }

    public function add_service()
    {
        if ($this->patient) {
            $serves = null;
            if ($this->lab_serv_id) {
                $serves = Service::with('category')->find($this->lab_serv_id);
            }
            if ($this->scan_serv_id) {
                $serves = ScanService::find($this->scan_serv_id);
            }
            if ($serves) {
                $tax = 0;
                if (setting()->tax_enabled and $this->patient->country_id != 1) {
                    $tax = $serves->price * (setting()->tax_rate / 100);
                }
                $discount = 0;
                $offer = null;
                $total = $serves->price - $discount + $tax;
                $this->items[] = ['invoice_id' => $this->invoice_id, 'product_id' => $serves->id, 'product_name' => $serves->name, 'price' => $serves->price, 'discount' => $discount, 'quantity' => 1, 'sub_total' => $total, 'department' => $this->lab_serv_id ? 'lab' : 'scan', 'tax' => $tax];
                $this->computeForAll();
                $this->lab_serv_id = null;
                $this->scan_serv_id = null;
            }
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('Please select the patient first')]);
            $this->lab_serv_id = null;
            $this->scan_serv_id = null;
        }
    }

    public function delete_item($key)
    {
        unset($this->items[$key]);
        $this->computeForAll();
    }

    // public function computeForAll()
    // {
    //     $this->amount = array_reduce($this->items, function ($carry, $item) {
    //         $price = $item['price'] ? $item['price'] : 0;
    //         $carry += $price;
    //         return $carry;
    //     });

    //     /* $this->tax = array_reduce($this->items, function ($carry, $item) {
    //     if (!$this->installment_company) {
    //     $carry += $item['tax'];
    //     return $carry;
    //     }
    //     return 0;
    //     }); */

    //     if (!$this->patient->group) {
    //         $this->offers_discount = array_reduce($this->items, function ($carry, $item) {
    //             $carry += $item['discount'];
    //             return $carry;
    //         });
    //     }

    //     if ($this->patient->group) {
    //         if ($this->patient->group->rate > 0) {
    //             $this->discount = $this->amount * $this->patient->group->rate / 100;
    //         }
    //     }

    //     $sub_total = $this->amount - $this->discount - $this->offers_discount;

    //     if (!$this->installment_company) {
    //         if (setting()->tax_enabled and $this->patient->country_id != 1) {
    //             $this->tax = $sub_total * (setting()->tax_rate / 100);
    //         }
    //     }

    //     $this->total = $this->amount + $this->tax - $this->discount - $this->offers_discount;

    //     $this->amount_after_offers_discount = $this->amount - $this->offers_discount;
    //     if ($this->split_number == "" or $this->split_number == 0) {
    //         $this->split_number = 1;
    //     }
    //     $this->total_after_split = $this->total / $this->split_number;
    //     /* $this->discount = array_reduce($this->items, function ($carry, $item) {
    //     $carry += $item['discount'];
    //     return $carry;
    //     }); */

    //     /* $this->total = $this->amount + $this->tax - $this->discount; */
    //     $this->rest = $this->total;
    //     $this->calculateNet();
    //     if (count($this->items) == 0) {
    //         $this->amount = 0;
    //         $this->tax = 0;
    //         $this->total = 0;
    //     }
    // }
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
        return 0;
        }); */

        if (!$this->patient->group) {
            $this->offers_discount = array_reduce($this->items, function ($carry, $item) {
                $carry += $item['discount'];
                return $carry;
            });
        }

        if ($this->patient->group) {
            if ($this->patient->group->rate > 0) {
                $this->discount = $this->amount * $this->patient->group->rate / 100;
            }
        }

        $sub_total = $this->amount - $this->discount - $this->offers_discount;

        if (!$this->installment_company) {
            if (setting()->tax_enabled and $this->patient->country_id != 1) {
                $this->tax = $sub_total * (setting()->tax_rate / 100);
            }
        }

        $this->total = $this->amount + $this->tax - $this->discount - $this->offers_discount;

        $this->amount_after_offers_discount = $this->amount - $this->offers_discount - $this->discount;
        if ($this->split_number == "" or $this->split_number == 0) {
            $this->split_number = 1;
        }
        $this->total_after_split = $this->total / $this->split_number;
        /* $this->discount = array_reduce($this->items, function ($carry, $item) {
        $carry += $item['discount'];
        return $carry;
        }); */

        /* $this->total = $this->amount + $this->tax - $this->discount; */
        $this->rest = 0;
        $this->card = 0;
        $this->cash = $this->total;
        $this->need_to_pay = round($this->total, 2);
        $this->paid_tax = round($this->tax, 2);
        $this->paid_without_tax = round($this->total - $this->tax, 2);

        $this->calculateNet();
        if (count($this->items) == 0) {
            $this->amount = 0;
            $this->tax = 0;
            $this->total = 0;
        }
    }

    public function calculateNet()
    {
        $this->card = $this->card == "" ? 0 : $this->card;
        $this->cash = $this->cash == "" ? 0 : $this->cash;
        $this->bank = $this->bank == "" ? 0 : $this->bank;
        $this->tamara = $this->tamara == "" ? 0 : $this->tamara;
        $this->tabby = $this->tabby == "" ? 0 : $this->tabby;
        $this->visa = $this->visa == "" ? 0 : $this->visa;
        $this->mastercard = $this->mastercard == "" ? 0 : $this->mastercard;
        $this->discount = $this->discount == "" ? 0 : $this->discount;
        $this->rest
            = $this->total
            - ($this->card + $this->cash + $this->bank + $this->tamara + $this->tabby + $this->visa + $this->mastercard);
    }

    public function updatedCard()
    {
        $this->calculateMethods();
    }

    public function updatedCash()
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

    public function updatedDiscount()
    {
        if ($this->discount > $this->total) {
            $this->discount = 0;
        }
        $this->computeForAll();
        $this->calculateMethods();
    }

    public function updatedMastercard()
    {
        $this->calculateMethods();
    }

    // public function changeItemTotal($key)
    // {
    //     $price = $this->items[$key]['price'] ? $this->items[$key]['price'] : 0;
    //     $this->items[$key]['price'] = $price;
    //     $this->items[$key]['sub_total'] = $price + $this->items[$key]['tax'];
    //     $this->computeForAll();
    // }
    public function changeItemTotal($key)
    {
        $price = $this->items[$key]['price'] ? $this->items[$key]['price'] : 0;
        $this->items[$key]['price'] = $price;
        $this->items[$key]['sub_total'] = $price + $this->items[$key]['tax'];
        $this->computeForAll();
    }

    public function submit()
    {
        $data = $this->validate();
        unset($data['days']);

        $data['patient_id'] = $this->patient->id;
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

        $data['employee_id'] = auth()->id();
        /* $data['employee_id'] = auth()->id(); */
        $this->invoice->update($data);
        $this->invoice->products()->delete();
        $this->invoice->products()->createMany($this->items);
        // $this->invoice->vouchers()->delete(); // no relation with this model is that error ??

        if ($this->days) {
            foreach ($this->days as $day) {
                $appointment = Appointment::where('appointment_date', $day['appointment_date'])
                    ->where('appointment_time', $day['appointment_time'])
                    ->first();
                if ($appointment) {
                    $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'هناك موعد بهذا التاريخ والوقت']);
                    return;
                }

                $app = Appointment::create([
                    'appointment_date' => $day['appointment_date'] ? $day['appointment_date'] : null,
                    'appointment_time' => $day['appointment_time'] ? $day['appointment_time'] : null,
                    'patient_id' => $day['patient_id'],
                    'employee_id' => auth()->id(),
                    'doctor_id' => $this->invoice->dr?->id,
                    'clinic_id' => $this->invoice->dr?->department_id,
                    'appointment_status' => 'confirmed',
                    'appointment_number' => Str::random(10),
                    'orthodontic_id' => $day['orthodontic_id'],
                    'appointment_id' => $day['appointment_id'],
                    'review' => $day['review'],
                ]);
            }
        }

        $this->invoiceVouchers($this->invoice);

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
        if ($this->tasdeed) {
            return redirect()->route('front.invoices.show', $this->invoice)->with('success', __('تم تسديد الفاتورة'));
        }
        return redirect()->route('front.invoices.index', $this->invoice)->with('success', __('Saved successfully'));
    }

    public function invoiceVouchers($invoice)
    {
        $accounting_departments = json_decode(setting()->accounting_departments, true);
        if (!$accounting_departments && !isset($accounting_departments['income_clinic'])) {
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

    // public function mount()
    // {

    //     if (auth()->user()->type == 'dr') {
    //         abort(403);
    //     }
    //     if (request('tasdeed')) {
    //         $this->tasdeed = true;
    //     }
    //     $this->patient = $this->invoice->patient;
    //     $this->patient_key = $this->invoice->patient->id;
    //     $this->items = $this->invoice->products()->get()->toArray();
    //     $this->amount = $this->invoice->amount;
    //     $this->total = $this->invoice->total;
    //     $this->tax = $this->invoice->tax;
    //     $this->rest = $this->invoice->rest;
    //     $this->discount = $this->invoice->discount;
    //     $this->cash = $this->invoice->cash;
    //     $this->bank = $this->invoice->bank;
    //     $this->tamara = $this->invoice->tamara;
    //     $this->tabby = $this->invoice->tabby;
    //     $this->visa = $this->invoice->visa;
    //     $this->mastercard = $this->invoice->mastercard;
    //     $this->card = $this->invoice->card;
    //     $this->date = $this->invoice->date ? $this->invoice->date : $this->invoice->created_at->format('Y-m-d');
    //     // if ($this->invoice->status == 'Unpaid') {
    //     //     $this->cash = $this->invoice->total;
    //     //     $this->rest = 0;
    //     // } else {
    //     //     $this->cash = $this->invoice->card;
    //     // }
    //     $this->status = $this->invoice->status;
    //     $this->notes = $this->invoice->notes;
    //     $this->installment_company = $this->invoice->installment_company;
    //     $this->dr_id = $this->invoice->dr_id;
    //     $this->offers_discount = $this->invoice->offers_discount;
    //     $this->amount_after_offers_discount = $this->invoice->amount - $this->invoice->products()->sum('discount');
    //     $this->department_id = $this->invoice->department_id;
    //     $this->scan_services = ScanService::all();
    // }
    public function mount()
    {

        //        if (auth()->user()->type == 'dr') {
        //            abort(403);
        //        }
        if (request('tasdeed')) {
            $this->tasdeed = true;
        }
        $this->patient = $this->invoice->patient;
        $this->patient_key = $this->invoice->patient->id;
        $discount = 0;
        foreach ($this->invoice->products()->get() as $product) {
            if ($this->patient->group) {
                if ($this->patient->group->discounts->count()) {
                    $discountAmount = $this->patient->group->discounts()->where('product_id', $product->id)->first();
                    if ($discountAmount) {
                        $discount = $product->price * ($discountAmount->rate / 100);
                    }
                } else {
                    $discountAmount = 1;
                    $discount = $product->price * ($this->patient->group->rate / 100);
                }
            }
            $this->items[] = $product->toArray() + [
                'discount' => $discount
            ];
        }
        $this->amount = $this->invoice->amount;
        $this->total = $this->invoice->total;
        $this->tax = $this->invoice->tax;
        $this->rest = $this->invoice->rest;
        $this->discount = $this->invoice->discount;
        $this->cash = $this->invoice->cash;
        $this->bank = $this->invoice->bank;
        $this->tamara = $this->invoice->tamara;
        $this->tabby = $this->invoice->tabby;
        $this->visa = $this->invoice->visa;
        $this->mastercard = $this->invoice->mastercard;
        $this->card = $this->invoice->card;
        $this->need_to_pay = $this->invoice->cash + $this->invoice->bank + $this->invoice->card;
        $this->date = $this->invoice->date ? $this->invoice->date : $this->invoice->created_at->format('Y-m-d');
        $this->paid_tax = round($this->invoice->paid_tax, 2);
        $this->paid_without_tax = round($this->invoice->paid_without_tax, 2);
        // if ($this->invoice->status == 'Unpaid') {
        //     $this->cash = $this->invoice->total;
        //     $this->rest = 0;
        // }
        $this->marketer_id = $this->invoice->marketer_id;
        $this->status = $this->invoice->status;
        $this->notes = $this->invoice->notes;
        $this->installment_company = $this->invoice->installment_company;
        $this->dr_id = $this->invoice->dr_id;
        $this->offers_discount = $this->invoice->offers_discount;
        $this->amount_after_offers_discount = $this->invoice->amount - $this->offers_discount - $this->discount;
        $this->department_id = $this->invoice->department_id;
        $this->scan_services = ScanService::all();
        // $this->branch_id = $this->invoice->branch_id;
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

    public function addDay()
    {
        $this->days[] = [
            'times' => [],
            'day' => '',
            'appointment_date' => '',
            'appointment_time' => '',
            'patient_id' => $this->patient->id,
            'orthodontic_id' => $this->invoice->appointment->orthodontic_id ?? null,
            'appointment_id' => $this->invoice->appointment->id ?? null,
            'review' => '',
        ];
    }


    public function removeDay($index)
    {
        unset($this->days[$index]);
        $this->days = array_values($this->days);
    }


    public function getTimes($index, $date)
    {
        if (setting()->status24) {
            $this->days[$index]['times'] = [];
            $this->reservedTimes = [];
            for ($i = 0; $i < 24; $i++) {
                $this->days[$index]['times'][] = $i . ':00';
                $this->days[$index]['times'][] = $i . ':30';
            }
        } else {
            if (setting()->from_morning && setting()->to_morning) {
                $this->days[$index]['times'] = [];
                // get only hour from time type
                $from_morning = Carbon::parse(setting()->from_morning)->format('H');
                $to_morning = Carbon::parse(setting()->to_morning)->format('H');
                $this->reservedTimes = [];

                $this->days[$index]['times'] = [];
                for ($i = $from_morning; $i < $to_morning; $i++) {
                    $this->days[$index]['times'][] = $i . ':00';
                    $this->days[$index]['times'][] = $i . ':30';
                }
                $this->reservedTimes = Appointment::where('appointment_date', $date)
                    ->where('appointment_time', '>=', $from_morning)
                    ->where('appointment_time', '<=', $to_morning)
                    ->pluck('appointment_time')->toArray();

                $this->days[$index]['day'] = Carbon::parse($date)->isoFormat('dddd');
            } else {
                $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'يجب تحديد المواعيد من الاعدادات أولاً']);
            }
        }
    }

    public function render()
    {
        $departments = Department::get();
        $lab_categories = LabCategory::all();
        $lab_services = Service::where('category_id', $this->lab_cat_id)->get();
        $doctors = User::doctors()->where('department_id', $this->department_id)->get();
        $products = Product::where('department_id', $this->department_id)->get();
        $marketers = Marketer::get();

        return view('livewire.invoices.edit-invoice', compact('doctors', 'departments', 'products', 'lab_categories', 'lab_services', 'marketers'));
    }

    protected function calculateMethods()
    {
        $total = (((float) $this->card) + ((float) $this->cash) + ((float) $this->mastercard) + ((float) $this->bank) + ((float) $this->tamara) + ((float) $this->tabby) + ((float) $this->visa));

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
        $total = (((float) $this->card) + ((float) $this->cash) + ((float) $this->mastercard) + ((float) $this->bank) + ((float) $this->tamara) + ((float) $this->tabby) + ((float) $this->visa));

        //$this->rest = ((float) $this->total) - (float) $total;

        $tax = 0;
        if (setting()->tax_enabled and $this->patient->country_id != 1) {
            $tax = $this->amount_after_offers_discount  * (setting()->tax_rate / 100);
        }
        $this->paid_tax = $this->patient->country_id != 1 ? round($total - ($total * 100) / (100 + setting()->tax_rate), 2) : 0;
        $this->paid_without_tax = round($total - $this->paid_tax, 2);
        $discount = (float) $this->discount;
        $this->tax = $tax;
        $this->total =  $this->amount + $tax - $discount - $this->offers_discount;
        $this->rest = round($this->total - $total, 2);
        $this->need_to_pay = round($total, 2);
    }

    public function manualCalculate()
    {
        $this->calculateMethods();
    }
}
