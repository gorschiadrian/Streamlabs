<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Streams;
use Carbon\Carbon;

class StartHour extends Component
{
    public $hours;

    public function render()
    {
        $this->hours = $this->getData();
        return view('livewire.start-hour');
    }

    public function mount()
    {
        $this->hours = $this->getData();
    }

    public function getData()
    {
        $streams = Streams::select('start_at')->get();
        foreach ($streams as $stream) {
            $started_at = Carbon::parse($stream->start_at);
            $hour = $started_at->copy();

            if ($hour->minute > 30) {
                $hour->add('hour', 1);
            }
            $hour->minute(0);
            $stream->hour = $hour->format('H:i');
        }
        return $streams->groupBy('hour')->all();
    }
}
