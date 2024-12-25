<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Doctor;
use App\Models\Invoice;
use App\Models\Product;
use Livewire\Component;
use App\Models\Diagnose;
use App\Models\ScanName;
use App\Models\Department;
use App\Models\LabRequest;
use App\Models\VisionTest;
use App\Models\Appointment;
use App\Models\Orthodontic;
use App\Models\PatientFile;
use App\Models\ScanRequest;
use Illuminate\Support\Str;
use App\Models\Prescription;
use Livewire\WithPagination;
use App\Models\TreatmentPlan;
use App\Services\Taqnyat\SMS;
use Livewire\WithFileUploads;
use App\Models\PatientPregnancy;
use App\Models\PregnancyCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\DiagnosePrescription;
use Illuminate\Support\Facades\Http;
use App\Models\OrthodonticPrescription;
use Barryvdh\Debugbar\Facades\Debugbar;

class DoctorInterface extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public $patient, $body_points = [];
    public $patients_screen = 'transfers';
    public $screen = 'current';
    public $departments;
    public $department_id;
    public $appointment_id;
    public $selectedProduct;
    public $selectedProducts = [];
    public $new_appointment;
    public $items = [];
    public $TreatmentPlanProducts;
    public $items_ids = [];
    public $product_id;
    public $notes;
    public $describeItems = [], $describe;

    public $lab_product_id;
    public $invoice_id;
    public $amount;
    public $total;
    public $cash;
    public $card;
    public $rest;
    public $discount = 0;
    public $tax;
    public $split;
    public $split_number;
    public $total_after_split;
    public $offers_discount;
    public $amount_after_offers_discount;
    public $scan_product_id;
    public $labs;
    public $categories;
    public $category_id;
    public $lab_id;
    public $dr_content;
    public $lab_cat_id;
    public $lab_serv_id;
    public $selected_department_id;
    public $scan_products = [];
    public $lab_products = [];

    public $review_duration;
    public $review_date;
    public $review_time;
    public $selected_appointment;
    public $date;

    public $name;
    public $price;

    public $appointment_date;
    public $last_invoice;

    public $treatment_plan_note, $plan_name, $current_tooth, $treatment_plan_id, $is_treated = false;
    public $scan_name_id, $file;
    private const CALENDAR_DEPARTMENT_ID = 4;

    public $diagnosis = [
        'taken' => null,
        'treatment' => null,
        'tooth' => [],
        'body' => [],
        'complaint' => null,
        'clinical_examination' => null,
        'period' => 'morning',
        'chief_complain' => null,
        'sign_and_symptom' => null,
        'other' => null,
        'vital' => null
    ];
    public $drugs = [];
    public $selected_drugs = [];
    public $drug_id;
    public $last_diagnose;
    public $visit_notes;
    public $treatment_done;
    public $treatment_plan;
    public $diagnoses;
    public $signs_and_symptoms;
    public $main_complaint;
    public $prescriptions = [];
    public $prescription_id;
    public $orthodontic_id;
    public $diagnose_id;
    public $right_eye_near_axis;
    public $right_eye_near_cylinder;
    public $right_eye_near_sphere;
    public $right_eye_distance_axis;
    public $right_eye_distance_cylinder;
    public $right_eye_distance_sphere;
    public $left_eye_near_axis;
    public $left_eye_near_cylinder;
    public $left_eye_near_sphere;
    public $left_eye_distance_axis;
    public $left_eye_distance_cylinder;
    public $left_eye_distance_sphere;

    public $children, $last_childbirth, $diabetes, $pressure, $other_diseases, $week, $month, $last_menstrual_period, $date_of_birth, $child_gender, $patientPregnancy, $pregnancyCategory, $pregnanciesNote;
    public function resetInputs()
    {
        $this->reset(['selected_drugs', 'patient', 'appointment_id', 'selectedProduct', 'selectedProducts', 'new_appointment', 'items', 'product_id', 'notes', 'invoice_id', 'amount', 'total', 'cash', 'card', 'rest', 'discount', 'tax', 'split', 'split_number', 'total_after_split', 'offers_discount', 'amount_after_offers_discount', 'scan_product_id', 'dr_content']);
    }

    protected $paginationTheme = 'bootstrap';

    protected function rules()
    {
        return [
            'diagnosis.taken' => 'nullable', //doctor()->department_id == self::CALENDAR_DEPARTMENT_ID ? 'nullable' : 'required',
            'diagnosis.chief_complain' => 'nullable',
            'diagnosis.sign_and_symptom' => 'nullable',
            'diagnosis.other' => 'nullable',
            'diagnosis.treatment' => 'nullable', //doctor()->department_id == self::CALENDAR_DEPARTMENT_ID ? 'nullable' : 'required',
            'diagnosis.tooth' => 'nullable',
            'diagnosis.body' => doctor()->is_dermatologist ? 'required' : 'nullable',
            'diagnosis.period' => 'nullable',
            'diagnosis.vital' => doctor()->is_pregnancy ? 'required' : 'nullable',
            'department_id' => 'required',
            'amount' => 'nullable',
            'total' => 'nullable',
            'cash' => 'nullable',
            'card' => 'nullable',
            'rest' => 'nullable',
            'discount' => 'nullable',
            'notes' => 'nullable',
            'tax' => 'nullable',
            'date' => 'nullable|date',
        ];
    }

    public function selectPatient($id)
    {
        $this->selected_appointment = Appointment::with('child')->findOrFail($id);
        $this->department_id = $this->selected_appointment->clinic_id;
        $this->patient = $this->selected_appointment->patient;
        $this->appointment_id = $id;
        $this->last_invoice = Invoice::where('patient_id', $this->patient->id)->where(function ($q) {
            $q->where('date', $this->selected_appointment->appointment_date)->orWhere('date', date('Y-m-d'));
        })->first();

        $this->last_diagnose = Diagnose::where('patient_id', $this->patient->id)->where('appointment_id', $this->selected_appointment->id)->first();

        if ($this->last_diagnose) {
            $this->diagnosis = [
                'taken' => $this->last_diagnose->taken,
                'treatment' => $this->last_diagnose->treatment,
                'tooth' => $this->last_diagnose->tooth,
                'body' => $this->last_diagnose->body,
                'complaint' => $this->last_diagnose->complaint,
                'clinical_examination' => $this->last_diagnose->clinical_examination,
                'period' => 'morning',
                'chief_complain' => $this->last_diagnose->chief_complain,
                'sign_and_symptom' => $this->last_diagnose->sign_and_symptom,
                'other' => $this->last_diagnose->other
            ];
        }
        if (setting()->pregnancy_follow) {
            $this->pregnancyCategory = PregnancyCategory::where('patient_id', $this->selected_appointment?->patient?->id)->where('is_compeleted', 0)->first();
            if ($this->pregnancyCategory) {
                $this->children = $this->pregnancyCategory->children;
                $this->last_childbirth = $this->pregnancyCategory->last_childbirth;
                $this->diabetes = $this->pregnancyCategory->diabetes;
                $this->pressure = $this->pregnancyCategory->pressure;
                $this->other_diseases = $this->pregnancyCategory->other_diseases;
                $this->last_menstrual_period = $this->pregnancyCategory->last_menstrual_period;
                $this->date_of_birth = $this->pregnancyCategory->date_of_birth;
                $this->child_gender = $this->pregnancyCategory->child_gender;
                if ($pp = $this->pregnancyCategory->pregnancies()->where('appointment_id', $this->selected_appointment->id)->first()) {
                    $this->month = $pp->month;
                    $this->week = $pp->week;
                    $this->patientPregnancy = $pp;
                }
            }
        }
        $this->describeItems = $this->selected_appointment->describes()->select(
            'id',
            'drug_name',
            'dosage',
            'rate',
            'duration',
            'diagnose_id'
        )->get()->toArray();
        $this->describe = $this->selected_appointment->describe;
    }

    //addDiagnosis

    public function add_product()
    {
        if ($this->patient) {
            if ($this->product_id) {
                $product = Product::with('department')->find($this->product_id);
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


    public function setTooth($tooth)
    {
        $this->current_tooth = $tooth;
    }

    public function addTreatmentPlanProduct()
    {
        if ($this->patient) {
            if ($this->product_id) {
                $product = Product::with('department')->find($this->product_id);
                if ($product) {
                    if (array_search($product->id, $this->items_ids)) {
                        $this->product_id = null;
                        return;
                    }
                    $this->items_ids[] = $product->id;
                    $this->TreatmentPlanProducts = Product::with('department')->whereIn('id', $this->items_ids)->get();
                }
                $this->product_id = null;
            }
        }
    }

    public function deleteTreatmentPlanProduct($product_id)
    {
        unset($this->items_ids[array_search($product_id, $this->items_ids)]);
        $this->TreatmentPlanProducts = Product::with('department')->whereIn('id', $this->items_ids)->get();
    }

    public function editTooth($id)
    {
        $tp = TreatmentPlan::find($id);
        $this->treatment_plan_id = $tp->id;
        $this->treatment_plan_note = $tp->note;
        $this->is_treated = $tp->is_treated;
        $this->items_ids = $tp->products()->pluck('products.id')->toArray();
        $this->TreatmentPlanProducts = $tp->products;
    }

    public function deleteTooth($id)
    {
        $tp = TreatmentPlan::find($id);
        $tp->delete();
        $this->emit('refreshComponent');

        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Deleted.')]);
    }

    public function addVisionTest()
    {
        $this->validate([
            'right_eye_distance_sphere' => "required",
        ]);

        $this->patient->vision_tests()->create([
            'dr_id' => auth()->id(),
            "appointment_id" => $this->appointment_id  ?? 0,
            'right_eye_near_axis' => $this->right_eye_near_axis   ?? 0,
            'right_eye_near_cylinder' => $this->right_eye_near_cylinder ?? 0,
            'right_eye_near_sphere' => $this->right_eye_near_sphere ?? 0,
            'right_eye_distance_axis' => $this->right_eye_distance_axis ?? 0,
            'right_eye_distance_cylinder' => $this->right_eye_distance_cylinder ?? 0,
            'right_eye_distance_sphere' => $this->right_eye_distance_sphere ?? 0,
            'left_eye_near_axis' => $this->left_eye_near_axis ?? 0,
            'left_eye_near_cylinder' => $this->left_eye_near_cylinder  ?? 0,
            'left_eye_near_sphere' => $this->left_eye_near_sphere  ?? 0,
            'left_eye_distance_axis' => $this->left_eye_distance_axis ?? 0,
            'left_eye_distance_cylinder' => $this->left_eye_distance_cylinder  ?? 0,
            'left_eye_distance_sphere' => $this->left_eye_distance_sphere  ?? 0,
        ]);
        $this->reset([
            'right_eye_near_axis',
            'right_eye_near_cylinder',
            'right_eye_near_sphere',
            'right_eye_distance_axis',
            'right_eye_distance_cylinder',
            'right_eye_distance_sphere',
            'left_eye_near_axis',
            'left_eye_near_cylinder',
            'left_eye_near_sphere',
            'left_eye_distance_axis',
            'left_eye_distance_cylinder',
            'left_eye_distance_sphere',
        ]);
        $this->screen = 'prev';
    }

    public function addTreatmentPlan()
    {
        $this->validate([
            'is_treated' => 'boolean',
            'TreatmentPlanProducts' => 'required',
            'items_ids' => 'required',
            'treatment_plan_note' => 'required',
            'plan_name' => 'required'

        ]);

        $amount = 0;
        $tax = 0;
        $total = 0;
        $total_tax = 0;
        $items = [];
        foreach ($this->TreatmentPlanProducts as $item) {
            $amount += $item->price;
            if (setting()->tax_enabled and $this->patient->country_id != 1) {
                $tax = $item->price * (setting()->tax_rate / 100);
            }
            $total += $tax + $item->price;
            $total_tax += $tax;
            $items[] =
                [
                    'product_id' => $item->id,
                    'product_name' => $item->name,
                    'price' => $item->price,
                    'quantity' => 1,
                    'tax' => $tax,
                    'sub_total' => $tax + $item->price,
                    'department' => $item->department->name,
                    'department_id' => $item->department_id
                ];
        }
        if (is_null($this->treatment_plan_id)) {
            $tp = $this->patient->treatment_plans()->create([
                'note' => $this->treatment_plan_note,
                'plan_name' => $this->plan_name,
                'appointment_id' => $this->selected_appointment?->id,
                'tooth' => $this->current_tooth,
                'dr_id' => auth()->user()->id,
                'amount' => $amount,
                'is_treated' => $this->is_treated
            ]);
        } else {
            $tp = TreatmentPlan::find($this->treatment_plan_id);
            $tp->update([
                'note' => $this->treatment_plan_note,
                'plan_name' => $this->plan_name,
                'is_treated' => $this->is_treated,
                'amount' => $amount,
            ]);
        }

        $tp->products()->sync($this->items_ids);
        $last_invoice = Invoice::latest()->first();
        $invoice_id = $last_invoice ? $last_invoice->id + 1 : 1;
        $data = [
            'invoice_number' => $invoice_id,
            'patient_id' => $this->patient->id,
            'dr_id' => auth()->user()->id,
            'employee_id' => auth()->user()->id,
            'total' => $total,
            'tax' => $total_tax,
            'status' => 'Unpaid',
            'type' => 'plan',
            'amount' => $amount,
            'notes' => $this->treatment_plan_note,
            'date' => date('Y-m-d'),
        ];
        $invoice = Invoice::create($data);
        $invoice->products()->createMany($items);

        $this->reset(['treatment_plan_note', 'current_tooth', 'treatment_plan_id', 'items', 'items_ids']);
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Saved.')]);
        $this->emit('refreshComponent');
    }

    public function saveProduct()
    {
        $data = $this->validate([
            'name' => 'required',
            'price' => 'required',
            'department_id' => 'required',
        ]);

        Product::create($data);

        $this->reset();

        return redirect()->route('doctor.interface')->with('success', __('Saved successfully'));
    }

    public function delete_item($key)
    {
        unset($this->items[$key]);
        $this->computeForAll();
    }

    public function computeForAll()
    {
        $this->amount = array_reduce($this->items, function ($carry, $item) {
            $price = $item['price'] ? $item['price'] : 0;
            $carry += $price;
            return $carry;
        });

        /* $this->tax = array_reduce($this->items, function ($carry, $item) {
        $carry += $item['tax'];
        return $carry;
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

        if (setting()->tax_enabled and $this->patient->country_id != 1) {
            $this->tax = $sub_total * (setting()->tax_rate / 100);
        }

        $this->total = $this->amount + $this->tax - $this->discount - $this->offers_discount;

        $this->amount_after_offers_discount = $this->amount - $this->offers_discount - $this->discount;
        if ($this->split_number == "" or $this->split_number == 0) {
            $this->split_number = 1;
        }
        /* $this->total = $this->amount + $this->tax - $this->discount; */
        $this->total_after_split = $this->total / $this->split_number;
        $this->rest = $this->total;
        $this->cash = 0;
        $this->card = 0;
    }

    public function changeItemTotal($key)
    {
        $price = $this->items[$key]['price'] ? $this->items[$key]['price'] : 0;
        $this->items[$key]['price'] = $price;
        if (setting()->tax_enabled and $this->patient->country_id != 1) {
            $this->items[$key]['tax'] = $price * (setting()->tax_rate / 100);
        }
        $this->items[$key]['sub_total'] = $price + $this->items[$key]['tax'];
        $this->computeForAll();
    }

    public function updatedDiscount()
    {
        $this->computeForAll();
    }

    public function addInvoice()
    {

        $data = $this->validate();
        $data['patient_id'] = $this->patient->id;
        $data['dr_id'] = doctor()->id;
        $data['status'] = 'Unpaid';
        $data['employee_id'] = auth()->id();
        $data['appoint_id'] = $this->appointment_id;
        $data['department_id'] = $this->department_id;
        if (!$this->patient->group) {
            $data['discount'] = $this->offers_discount;
        }
        if (!isset($data['tax'])) {
            $data['tax'] = 0;
        }
        $data['total'] = $this->total_after_split - $this->offers_discount;
        $data['rest'] = $this->total_after_split - $this->offers_discount;
        if ($this->last_invoice) {
            $this->last_invoice->update($data);
            $this->last_invoice->products()->delete();
            $this->last_invoice->products()->createMany($this->items);
            session()->flash('success', 'تم تحديث الفاتورة بنجاح');
        } else {
            $invoice = Invoice::latest()->first();
            $this->invoice_id = $invoice ? $invoice->id + 1 : 1;
            $data['invoice_number'] = $this->invoice_id;
            // if ($this->selected_appointment) {
            //     $this->selected_appointment->update(['invoice_id', $this->invoice_id]);
            // }
            for ($i = 1; $i <= $this->split_number; $i++) {
                $invoice = Invoice::create($data);
                $invoice->products()->createMany($this->items);
            }
            $appointment = $this->selected_appointment;
            $appointment->update(['appointment_status' => 'examined']);
            // $this->reset();
            session()->flash('success', 'تم اضافة الفاتورة بنجاح');
            $this->endSession();
        }
    }

    public function saveAll()
    {
        // DB::beginTransaction();
        // try {
        $this->addInvoice();
        //$this->savePrescription();
        // DB::commit();
        $this->endSession();
        return redirect('/doctor/interface');
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     return redirect('/doctor/interface')->with('error', $e->getMessage());
        // }
    }


    //suspendSessionSession
    public function suspendSession()
    {
        $old_appointment = doctor()->appointments()->find($this->appointment_id);
        $old_appointment->update(['appointment_status' => 'suspend']);
        $this->resetInputs();
        session()->flash('success', 'تم تعليق الكشف بنجاح');
    }

    public function saveScan()
    {
        $data = $this->validate([
            'file' => 'required|mimes:pdf,jpg,png',
            'dr_content' => 'required',
        ]);
        $data['type'] = 'scan';
        $data['patient_id'] = $this->patient->id;
        PatientFile::create($data);
        $this->reset(['file', 'dr_content']);
        session()->flash('success', ' تم حفظ الأشعة بنجاح');
    }

    public function saveLab()
    {
        $data = $this->validate([
            'file' => 'required|mimes:pdf,jpg,png',
            'dr_content' => 'required',
            'lab_product_id' => 'required'
        ]);
        // $data['type'] = 'lab';
        $data['patient_id'] = $this->patient->id;
        $data['doctor_id'] = auth()->user()->id;
        $data['appointment_id'] = auth()->user()->id;
        $data['clinic_id'] = $this->selected_appointment->clinic_id;
        $data['product_id'] = $data['lab_product_id'];
        unset($data['lab_product_id']);
        if (isset($data['file'])) {
            $data['file'] = store_file($data['file'], 'labRequests');
        } else {
            unset($data['file']);
        }
        LabRequest::create($data);
        $this->reset(['file', 'dr_content']);
        session()->flash('success', ' تم حفظ التحليل بنجاح');
    }


    public function saveDiagnose()
    {
        $data = $this->validate([
            'department_id' => 'required',
            'diagnosis.taken' => 'required',
            'diagnosis.other' => 'nullable',
            'diagnosis.chief_complain' => 'nullable',
            'diagnosis.sign_and_symptom' => 'nullable',
            'diagnosis.treatment' => 'required',
            'diagnosis.tooth' => 'nullable',
            'diagnosis.body' => doctor()->is_dermatologist ? 'required' : 'nullable',
            'diagnosis.period' => 'nullable',
        ]);

        if ($this->last_diagnose) {
            $this->last_diagnose->update(array_merge([
                'appointment_id' => $this->appointment_id,
                'patient_id' => $this->patient->id,
                'dr_id' => doctor()->id,
                'department_id' => $this->department_id,
                'time' => date('H:i'),
                'day' => date('Y-m-d'),
            ], $this->diagnosis));
            $this->last_diagnose->appoint->update(['attended_at' => Carbon::now()]);
            $diagnose = $this->last_diagnose;
        } else {
            $diagnose = Diagnose::create(array_merge([
                'appointment_id' => $this->appointment_id,
                'patient_id' => $this->patient->id,
                'dr_id' => doctor()->id,
                'department_id' => $this->department_id,
                'time' => date('H:i'),
                'day' => date('Y-m-d'),
            ], $this->diagnosis));
            $diagnose->appoint->update(['attended_at' => Carbon::now()]);
        }

        $this->diagnose_id = $diagnose->id;
        $this->last_diagnose = $diagnose;
        $this->screen = 'invoice';
        session()->flash('success', 'تم اضافة التشخيص بنجاح');
    }

    public function savePregnancy()
    {
        $data = $this->validate([
            // 'patient_id' => 'nullable',
            // 'diagnose_id' => 'nullable',
            // 'appointment_id' => 'nullable',
            'children' => 'nullable',
            'last_childbirth' => 'nullable',
            'diabetes' => 'nullable',
            'pressure' => 'nullable',
            'other_diseases' => 'nullable',
            'last_menstrual_period' => 'nullable',
            'date_of_birth' => 'nullable',
            'child_gender' => 'nullable',
        ]);
        $subData = $this->validate([
            'week' => 'nullable',
            'month' => 'nullable',
        ]);

        $subData['appointment_id'] = $this->selected_appointment->id;
        $category = PregnancyCategory::where('patient_id', $this->selected_appointment->patient_id)->where('is_compeleted', 0)->first();
        if (!$category) {
            $data['patient_id'] = $this->selected_appointment?->patient?->id;
            $category = PregnancyCategory::create($data);
        } else {
            $category->update($data);
        }
        if ($this->patientPregnancy) {
            $this->patientPregnancy->update($subData);
        } else {
            $subData['pregnancy_category_id'] = $category->id;
            $this->patientPregnancy = PatientPregnancy::create($subData);
        }
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'تم اضافة متابعة الحمل بنجاح']);
    }

    public function endPregnancySession()
    {
        $patient = $this->selected_appointment?->patient;
        $session = $patient->pregnancySession()->where('is_compeleted', 0)->first();
        if (!$session) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'لا يوجد مراجعة مفتوحة حتي الان']);
        } else {

            // dd($session->pregnancies()->get());
            $session->update(['is_compeleted' => 1]);
            $session->pregnancies()->update(['is_compeleted' => 1]);
            $this->reset([
                'children',
                'last_childbirth',
                'diabetes',
                'pressure',
                'other_diseases',
                'week',
                'month',
                'last_menstrual_period',
                'date_of_birth',
                'child_gender',
            ]);
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'تم انهاء المتابعة بنجاح']);
        }
    }
    public function savePregnanciesNote($id)
    {
        $pp = PatientPregnancy::find($id);
        if ($pp) {
            $pp->update(['notes' => $this->pregnanciesNote]);
            $this->reset('pregnanciesNote');
        }
    }
    public function saveOrthodontic()
    {
        $data = $this->validate([
            'main_complaint' => 'required',
            'signs_and_symptoms' => 'nullable',
            'diagnoses' => 'nullable',
            'treatment_plan' => 'nullable',
            'treatment_done' => 'nullable',
            'visit_notes' => 'nullable',
        ]);

        $data['appointment_id'] = $this->appointment_id;
        $data['patient_id'] = $this->patient->id;
        $data['doctor_id'] = doctor()->id;
        $orthodontic = Orthodontic::create($data);
        $this->orthodontic_id = $orthodontic->id;
        $orthodontic->appoint->update(['orthodontic_id' => $orthodontic->id]);
        $this->screen = 'prescription';
    }


    //transferPatient
    public function transferPatient()
    {
        $data = array_merge([
            'appointment_status' => 'transferred',
        ], $this->new_appointment);
        $old_appointment = doctor()->appointments()->find($this->appointment_id);
        $old_appointment->update($data);
        /* Appointment::query()->create($data); */
        $this->resetInputs();
        session()->flash('success', 'تم تحويل المريض وانهاء الكشف بنجاح');
    }

    //endSession
    public function endSession()
    {

        // $old_appointment = doctor()->appointments()->find($this->selected_appointment);

        $this->selected_appointment->update(['appointment_status' => 'examined']);

        $this->resetInputs();

        session()->flash('success', 'تم إنهاء الكشف بنجاح');
    }

    public function scan_request()
    {
        $data = $this->validate([
            'scan_name_id' => 'required',
            'dr_content' => 'required',
        ]);
        $data['dr_id'] = doctor()->id;
        $data['patient_id'] = $this->patient->id;
        $data['clinic_id'] = $this->department_id;
        $data['appointment_id'] = $this->appointment_id;
        $data['status'] = 'pending';
        $data['scan_name_id'] = $this->scan_name_id;
        ScanRequest::create($data);
        $this->reset(['dr_content', 'scan_name_id']);
        session()->flash('success', ' تم إرسال طلب الأشعة بنجاح');
        $this->emit('refreshComponent');
    }


    public function delete_file(ScanRequest $file)
    {
        $file->delete();
        delete_file($file->file);
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Successfully deleted')]);
        $this->emit('refreshComponent');
    }

    public function mount()
    {
        //$this->drugs = Http::get(env('PHARMACY_API_URL') . '/drugs')->json()['data'] ?? [];
        //Debugbar::info($this->drugs);
        //$this->department_id = doctor()->department_id;

        $arr = doctor()->show_department_products;
        $this->departments = Department::whereIn('id', doctor()->department()->pluck('departments.id')->toArray())
            ->orWhereIn('id', $arr ?? [])->get();

        $department_scan_id = Department::where('is_scan', 1)->first()?->id;
        $department_lab_id = Department::where('is_lab', 1)->first()?->id;
        if ($department_scan_id) {
            $this->scan_products = Product::where('department_id', $department_scan_id)->get();
        }
        if ($department_lab_id) {
            $this->lab_products = Product::where('department_id', $department_lab_id)->get();
        }
        $this->new_appointment = [
            'appointment_date' => null,
            'appointment_time' => null,
            'doctor_id' => Doctor::query()->first()->id,
            'clinic_id' => Department::query()->first()->id,
        ];

        $this->date = date('Y-m-d');
    }

    //updatedServiceId
    public function updatedDrugId($id)
    {
        if ($id) {
            foreach ($this->drugs as $drug) {
                if ($drug['id'] == $id) {
                    $this->selected_drugs[] = $drug;
                    break;
                }
            }
        }
    }

    public function render()
    {
        $today_appointments = doctor()->appointments()->today()->where('appointment_status', 'confirmed')->orderBy('appointment_time')->get();
        // dd($today_appointments);
        $times = [];
        // get only hour from time type
        $from_morning = Carbon::parse(setting()->from_morning)->format('H');
        $to_morning = Carbon::parse(setting()->to_morning)->format('H');
        $from_evening = Carbon::parse(setting()->from_evening)->format('H');
        $to_evening = Carbon::parse(setting()->to_evening)->format('H');
        $reservedTimes = [];
        if ($this->review_duration == 'morning') {
            $times = [];
            for ($i = $from_morning; $i < $to_morning; $i++) {
                $times[] = $i . ':00';
                $times[] = $i . ':30';
            }
            $reservedTimes = Appointment::where('appointment_date', $this->review_date)
                ->where('appointment_time', '>=', $from_morning)
                ->where('appointment_time', '<=', $to_morning)
                ->pluck('appointment_time')->toArray();
        } elseif ($this->review_duration == 'evening') {
            $times = [];

            for ($i = $from_evening; $i < $to_evening; $i++) {
                $times[] = $i . ':00';
                $times[] = $i . ':30';
            }
            $reservedTimes = Appointment::where('appointment_date', $this->appointment_date)
                ->where('appointment_time', '>=', $from_evening)
                ->where('appointment_time', '<=', $to_evening)
                ->pluck('appointment_time')->toArray();
        }
        $scan_names = ScanName::get(['id', 'name']);
        $all_prescriptions = Prescription::all();

        $this->dispatchBrowserEvent('pharaonic.select2.init');
        return view('livewire.doctor-interface', compact('today_appointments', 'times', 'reservedTimes', 'scan_names', 'all_prescriptions'));
    }

    // drug_request
    public function drug_request()
    {
        $drugsIds = collect($this->drugs)->pluck('id')->toArray();
        $qq = [];
        for ($i = 0; $i < count($drugsIds); $i++) {
            $qq[] = 1;
        }
        $data = [
            'doctor_name' => doctor()->name,
            'doctor_phone' => doctor()->email,
            'patient_name' => $this->patient->name,
            'patient_phone' => $this->patient->phone,
            'patient_national_id' => $this->patient->civil,
            'clinic_name' => doctor()->department->name,
            'drugs' => $drugsIds,
            'drugs_quantity' => $qq,
            'notes' => $this->dr_content,
        ];
        Debugbar::info($data);
        $res = Http::post(env('PHARMACY_API_URL') . '/drug-request', $data);
        Debugbar::info($res->body());
        $this->resetInputs();
        session()->flash('success', ' تم إرسال طلب الأدوية بنجاح');
    }
    public function addDescribeItem()
    {
        if (!$this->last_diagnose) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('Please add Diagnose First')]);
        } else {
            $this->describeItems[] = [
                'id' => null,
                'drug_name' => '',
                'dosage' => '',
                'rate' => '',
                'duration' => '',
                'diagnose_id' => $this->last_diagnose->id
            ];
        }
    }

    public function removeDescribeItem($key)
    {
        if (isset($this->describeItems[$key])) {
            unset($this->describeItems[$key]);
        }
    }
    public function saveDescribeItems()
    {
        if (!$this->last_diagnose) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('Please add Diagnose First')]);
        } else {
            foreach ($this->describeItems as $item) {
                $id = isset($item['id']) ? $item['id'] : null;
                unset($item['id']);
                if ($id) {
                    $this->selected_appointment->describes()->find($id)->update($item);
                } else {
                    $this->selected_appointment->describes()->create($item);
                }
            }
            $this->selected_appointment->update(['describe' => $this->describe]);
            // $this->reset('describeItems', 'describe');
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Saved.')]);
        }
    }

    public function printWithSave()
    {
        $this->saveDescribeItems();
        $this->dispatchBrowserEvent('print');
    }

    public function review()
    {
        $data = $this->validate([
            'review_duration' => 'required',
            'review_date' => 'required',
            'review_time' => 'required',
            'clinic_id' => 'required',
        ]);
        $data['appointment_time'] = $data['review_time'];
        $data['appointment_date'] = $data['review_date'];
        $data['appointment_duration'] = $data['review_duration'];
        $data['patient_id'] = $this->patient->id;
        $data['doctor_id'] = auth()->id();
        $data['clinic_id'] = $this->department_id;
        $data['appointment_number'] = Str::random(10);
        $data['appointment_status'] = 'confirmed';
        $data['review'] = true;
        $data['appointment_id'] = $this->appointment_id;
        $appointment = Appointment::create($data);
        $statusObject = json_decode(setting()->taqnyat_modules_status, true);
        $smsStatus = isset($statusObject['review_appointment']) ? $statusObject['review_appointment'] : null;
        if (setting()->taqnyat_status && $smsStatus == '1') {
            $phone = substr($this->patient->phone, 1);
            $response = SMS::send(['966' . $phone], 'مرحبا بك  ' . $this->patient->name . ' تم حجز موعد للمراجعة بتاريخ ' . $data['review_date'] . ' الساعة ' . date('h:i A', strtotime($data['review_time'])) . ' مع الطبيب ' . $appointment->doctor?->name  . ' عيادة :' . $appointment->clinic?->name);
            if ($response?->statusCode != 200) {
                Log::info(json_encode($response));
            }
        }
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'تم إضافة الموعد بنجاح']);
    }


    public function updatedPrescriptionId()
    {
        $prescription = Prescription::find($this->prescription_id);
        if ($prescription) {
            $this->prescriptions[] = [
                'id' => $prescription->id,
                'name' => $prescription->name,
                'strength' => $prescription->strength,
                'notes' => '',
            ];
        }
    }

    public function removePrescription($key)
    {
        unset($this->prescriptions[$key]);
    }

    public function savePrescription()
    {
        if (doctor()->is_orthodontics) {
            if (count($this->prescriptions) > 0) {
                foreach ($this->prescriptions as $key => $item) {
                    OrthodonticPrescription::create([
                        'orthodontic_id' => $this->orthodontic_id,
                        'prescription_id' => $item['id'],
                        'name' => $item['name'],
                        'strength' => $item['strength'],
                        'notes' => $item['notes'],
                    ]);
                }
            }
        } else {
            if (count($this->prescriptions) > 0) {
                foreach ($this->prescriptions as $key => $item) {
                    DiagnosePrescription::create([
                        'diagnose_id' => $this->diagnose_id,
                        'prescription_id' => $item['id'],
                        'name' => $item['name'],
                        'strength' => $item['strength'],
                        'notes' => $item['notes'],
                    ]);
                }
            }
        }
        $this->reset('prescriptions');
        $this->reset('prescription_id');
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'تم إضافة الوصفة الطبية بنجاح']);
        $this->screen = "current";
    }

    public function addBodyPoint($key)
    {
        if (isset($this->body_points[$key])) {
            unset($this->body_points[$key]);
        } else {
            $this->body_points[$key] = $key;
        }
    }
    // public function body_pointsUpdated()
    // {
    //     // @foreach($this->body_points as)
    // }
}
