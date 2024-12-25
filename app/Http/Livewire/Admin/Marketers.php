<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Marketer;
use App\Traits\livewireResource;

class Marketers extends Component
{
    use livewireResource;

    public $name;

    public function mount()
    {
        if (!setting()->marketers_status) {
            abort(404);
        }
    }
    public function rules()
    {
        return [
            'name' => 'required'
        ];
    }
    public function render()
    {
        $marketers = Marketer::latest()->paginate(10);
        return view('livewire.admin.marketers', compact('marketers'))->extends('admin.layouts.admin')->section('content');
    }
}
