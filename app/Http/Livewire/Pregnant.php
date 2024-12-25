<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PregnancyCategory;

class Pregnant extends Component
{
    public function render()
    {
        $categories = PregnancyCategory::latest()->paginate(10);
        return view('livewire.pregnant', compact('categories'));
    }
}
