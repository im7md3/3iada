<?php

namespace App\Http\Livewire\Admin;

use App\Models\Setting;
use Livewire\Component;

class ConstSettings extends Component
{
    public $settings, $emergency_active = false, $active_water_mark = false, $water_mark_string, $account_tree_active = false, $message_active = false, $pregnancy_follow = false, $beautification = false, $scan_active = false, $lab_active = false, $branches_active = false, $branches_active_count;
    public function save()
    {
        $this->settings->update([
            'emergency_active' => $this->emergency_active ? 1 : 0,
            'account_tree_active' => $this->account_tree_active ? 1 : 0,
            'message_active' => $this->message_active ? 1 : 0,
            'pregnancy_follow' => $this->pregnancy_follow,
            'beautification' => $this->beautification,
            'scan_active' => $this->scan_active,
            'lab_active' => $this->lab_active,
            'branches_active' => $this->branches_active ? 1 : 0,
            'branches_active_count' => $this->branches_active_count,
            'active_water_mark' => $this->active_water_mark,
            'water_mark_string' => $this->water_mark_string,
        ]);

        session()->flash('success', 'تم التعديل بنجاح');
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'تم التعديل بنجاح']);
    }

    public function mount()
    {
        $this->settings = Setting::first();
        $this->emergency_active = $this->settings->emergency_active;
        $this->account_tree_active = $this->settings->account_tree_active;
        $this->message_active = $this->settings->message_active;
        $this->pregnancy_follow = $this->settings->pregnancy_follow;
        $this->beautification = $this->settings->beautification;
        $this->lab_active = $this->settings->lab_active;
        $this->scan_active = $this->settings->scan_active;
        $this->branches_active = $this->settings->branches_active;
        $this->branches_active_count = $this->settings->branches_active_count;
        $this->active_water_mark = $this->settings->active_water_mark;
        $this->water_mark_string = $this->settings->water_mark_string;
    }
    public function render()
    {
        return view('livewire.admin.const')->extends('admin.layouts.admin')->section('content');
    }
}
