<?php

namespace App\Http\Controllers\Front;

use App\Models\Patient;
use App\Models\Department;
use App\Models\SmsMessage;
use Illuminate\Http\Request;
use App\Services\Taqnyat\SMS;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function index()
    {
        $smsLibrary = SmsMessage::latest()->get();
        $patients = Patient::latest()->get();
        $departments = Department::latest()->get();
        return view('front.message.index', compact('patients','smsLibrary','departments'));
    }

    public function send(Request $request)
    {

        $data = $request->validate([
            'department_id' => 'required',
            'phone' => 'required_if:patient_id,custom',
            'patient_id' => 'required_if:department_id,custom',
            'message' => 'required',
            'gender' => 'required_unless:department_id,custom'
        ]);
        if (!setting()->taqnyat_status) {
            return redirect()->back()->with('error', 'برجاء تفعيل منصة الرسائل قبل الارسال');
        }
        if($data['department_id'] != 'custom' && $data['department_id'] != ''){
            $gender = $data['gender'];
            $errors = [];
            $phones = [];
            $department = Department::find($data['department_id']);
            if($department){
                $patientIds = array_unique($department->invoices()->pluck('patient_id')->toArray());
                foreach($patientIds as $id){
                    $patient = Patient::find($id);
                    if($patient){
                        $phone = substr($patient->phone, 1);
                        if($phone){
                            if($gender != 'all'){
                                if($patient->gender == $gender){
                                    $phones[] = '966' . $phone;
                                }
                            }else{
                                $phones[] = '966' . $phone;
                            }

                        }
                    }
                }
                // dd($phones);
                if(count($phones) > 0){
                    $response = SMS::send($phones, $data['message']);
                    // dd($response);
                    if (!in_array($response?->statusCode, [200, 201])) {
                        return redirect()->back()->with('error', 'خطأ في ارسال الرسالة ' . $response?->message);
                    } else {
                        return redirect()->back()->with('success', 'تم إرسال الرسالة بنجاح');
                    }
                }else{
                    return redirect()->back()->with('success', 'لم يتم ارسال الرسائل لا يوجد ارقام');

                }
            }
        }else{

            if ($data['patient_id'] == 'custom') {
                $phone = $data['phone'];
                if (setting()->taqnyat_status) {
                    // $phone = substr($this->patient->phone, 1);
                    $response = SMS::send(['966' . $phone], $data['message']);
                    if (!in_array($response?->statusCode, [200, 201])) {
                        return redirect()->back()->with('error', 'خطأ في ارسال الرسالة ' . $response?->message);
                    } else {
                        return redirect()->back()->with('success', 'تم إرسال الرسالة بنجاح');
                    }
                } else {
                    return redirect()->back()->with('error', 'برجاء تفعيل منصة الرسائل قبل الارسال');
                }
            } else {
                $phone = $data['patient_id'];
                // if ($patient) {
                    if (setting()->taqnyat_status) {
                        $phone = substr($phone, 1);
                        $response = SMS::send(['966' . $phone], $data['message']);
                        if (!in_array($response?->statusCode, [200, 201])) {
                            return redirect()->back()->with('error', 'خطأ في ارسال الرسالة ' . $response?->message);
                        } else {
                            return redirect()->back()->with('success', 'تم إرسال الرسالة بنجاح');
                        }
                    } else {
                        return redirect()->back()->with('error', 'برجاء تفعيل منصة الرسائل قبل الارسال');
                    }
                // }
            }
        }
    }


}
