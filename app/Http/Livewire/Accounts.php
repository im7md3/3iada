<?php

namespace App\Http\Livewire;

use App\Models\Account;
use App\Traits\livewireResource;
use Livewire\Component;

class Accounts extends Component
{
    use livewireResource;
    public $name, $parent_id, $cost, $depreciable = 0, $filter_id;
    public function rules()
    {
        return [
            'name' => 'required',
            'parent_id' => 'nullable',
            'cost' => 'nullable',
            'depreciable' => 'nullable',
        ];
    }
    public function render()
    {
        $accounts = Account::withCount(['kids'])->where(function ($q) {
            if ($this->filter_id) {
                $q->where('parent_id', $this->filter_id);
            } else {
                $q->whereNull('parent_id');
            }
        })->get();
        $parentAccounts = Account::with(['kids'])->get();
        $parents = Account::whereNull('parent_id')->with(['kids'])->get();
        return view('livewire.accounts', compact('accounts', 'parentAccounts', 'parents'))->extends('front.layouts.front')->section('content');
    }
}
