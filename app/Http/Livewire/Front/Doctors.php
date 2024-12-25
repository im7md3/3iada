<?php

namespace App\Http\Livewire\Front;

use App\Models\User;
use Livewire\Component;

class Doctors extends Component
{
    public $from,$to;
    public function render()
    {
        $users = User::doctors()->get();
        return view('livewire.front.doctors',compact('users'));
    }
}
