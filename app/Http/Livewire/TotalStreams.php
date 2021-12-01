<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Streams;
use Illuminate\Support\Facades\DB;

class TotalStreams extends Component
{
    protected $allStreams;

    public function render()
    {
        $allStreams = $this->getTotalStreams();
        return view('livewire.total-streams', [
            'allStreams' =>  $allStreams
        ]);
    }

    public function getTotalStreams()
    {
        return Streams::select(['game_name', DB::raw('count(1) as game_streams')])->groupBy('game_name')->orderBy('game_streams', 'DESC')->paginate(10);
    }
}
