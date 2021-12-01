<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Streams;
use Illuminate\Support\Facades\DB;

class Top100 extends Component
{
    public $top100;
    public $order = 'DESC';
    
    public function render()
    {
        $this->top100 = $this->getData();
        return view('livewire.top100');
    }

    public function mount()
    {
        $this->top100 = $this->getData();
    }

    public function getData()
    {
        return Streams::orderBy('viewers', $this->order)->take(100)->get();
    }

    public function sort($order)
    {
        $this->order = $order;
    }
}
