<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Streams;
use Illuminate\Support\Facades\DB;

class AvarageViews extends Component
{
    public $avarageNumber = 0;

    public function render()
    {
        $this->avarageNumber = $this->calculateAvarage();
        return view('livewire.avarage-views');
    }

    public function mount()
    {
        $this->avarageNumber = $this->calculateAvarage();
    }

    public function calculateAvarage()
    {
        return Streams::select([DB::raw('avg(viewers) as avarage_views')])->first()->avarage_views;
    }
}
