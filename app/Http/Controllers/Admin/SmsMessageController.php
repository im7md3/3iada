<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SmsMessage;
use Illuminate\Http\Request;

class SmsMessageController extends Controller
{

    public function index()
    {
        $messages = SmsMessage::paginate();
        return view('admin.sms-library.index', compact('messages'));
    }

    public function create()
    {
        return view('admin.sms-library.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        SmsMessage::create($data);
        return redirect()->route('admin.sms_messages.index')->with('success', __('Successfully added'));
    }

    public function edit(SmsMessage $sms_message)
    {
        return view('admin.sms-library.edit', compact('sms_message'));
    }

    public function update(Request $request , SmsMessage $sms_message)
    {
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        $sms_message->update($data);
        $sms_message->save();
        return redirect()->route('admin.sms_messages.index')->with('success', __('Successfully added'));

    }

    public function destroy(SmsMessage $sms_message)
    {
        $sms_message->delete();
        return back()->with('success', __('Successfully deleted'));

    }
}
