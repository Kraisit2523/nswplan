<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PlanHome extends Component
{
    public $name = 'Kraisit';
    public $a, $b;
    
    public function render()
    {
        return view('livewire.plan-home');
    }
}
