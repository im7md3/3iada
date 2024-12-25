<?php

namespace App\Http\Livewire\Admin\Messages;

use App\Models\Client;
use App\Models\Message;
use App\Models\MessageLibrary;
use App\Models\Patient;
use App\Models\Program;
use App\Models\WhatsappMessage;
use App\Services\Whatsapp;
use Livewire\Component;

class SendMessage extends Component
{
    public $msg_type, $message_id, $count, $prev, $patient_id;
    public function rules()
    {
        return [
            'message_id' => 'required',
            'patient_id' => 'required',
        ];
    }
    public function submit()
    {
        $data = $this->validate();
        $msg = MessageLibrary::findOrFail($this->message_id);

        if ($this->patient_id == 'all') {
            $receivers = Patient::all();
            if ($msg->attach == 1) {
                foreach ($receivers  as $patient) {
                    $message = WhatsappMessage::create([
                        'message' => $msg->content,
                        'patient_id' => $patient->id,
                        'user_id' => auth()->user()->id,
                    ]);
                    if ($patient->phone) {
                        Whatsapp::send($patient->phone, $msg->content);
                    }
                }
            } else {
                foreach ($receivers  as $patient) {
                    $message = WhatsappMessage::create([
                        'message' => $msg->content,
                        'image' => $msg->file,
                        'patient_id' => $patient->id,
                        'user_id' => auth()->user()->id,
                    ]);
                    if ($patient->phone) {
                        Whatsapp::sendWithImage($patient->phone, $msg->content, display_file($msg->file));
                    }
                }
            }
        } else {
            $patient = Patient::find($this->patient_id);

            if ($msg->attach == 1) {
                $message = WhatsappMessage::create([
                    'message' => $msg->content,
                    'patient_id' => $patient->id,
                    'user_id' => auth()->user()->id,
                ]);
                if ($patient->phone) {
                    Whatsapp::send($patient->phone, $msg->content);
                }
            } else {
                $message = WhatsappMessage::create([
                    'message' => $msg->content,
                    'image' => $msg->file,
                    'patient_id' => $patient->id,
                    'user_id' => auth()->user()->id,
                ]);
                if ($patient->phone) {
                    Whatsapp::sendWithImage($patient->phone, $msg->content, display_file($msg->file));
                }
            }
        }

        $this->reset('message_id', 'patient_id', 'msg_type');
        session()->flash('success', 'تم الارسال بنجاح');
    }

    public function render()
    {
        $msgs = MessageLibrary::where(function ($q) {
            if ($this->msg_type) {
                $q->where('attach', $this->msg_type);
            }
        })->get();

        $all_patients = Patient::all();
        return view('livewire.admin.messages.send-message', compact('msgs', 'all_patients'))->extends('admin.layouts.admin')->section('content');
    }
}
