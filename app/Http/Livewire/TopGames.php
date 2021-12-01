<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Streams;
use Illuminate\Support\Facades\DB;

class TopGames extends Component
{
    protected $allStreams;

    public function render()
    {
        $allStreams = $this->getStreams();
        return view('livewire.top-games', [
            'allStreams' =>  $allStreams
        ]);
    }

    public function getStreams()
    {
        return  Streams::select(['game_name', DB::raw('SUM(viewers) as game_viewers')])->groupBy('game_name')->orderBy('game_viewers', 'DESC')->paginate(10);
    }
}
