<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Streams;
use Illuminate\Support\Facades\Http;
use Auth;

class AllTheWayUp extends Component
{
    public $upComing;
    public $barrierToEntry;

    public function render()
    {
        $this->upComing = $this->getData();
        return view('livewire.all-the-way-up');
    }

    public function mount()
    {
        $this->upComing = $this->getData();
    }

    public function getData()
    {
        $last =  Streams::orderBy('viewers', 'ASC')->first();
        $this->barrierToEntry = $last->viewers + 1;

        $response = Http::withHeaders([
            'Client-Id' => env('TWITCH_ID')
            ])->withToken(Auth::user()->twitch_token)->get('https://api.twitch.tv/helix/streams/followed', [
                'user_id' => Auth::user()->twitch_id
            ]);
        $body = $response->json();
        $userNames = [];
        $follow = collect($body['data']);
        $lastFollow = $follow->sortBy('viewer_count')->first();
        return $lastFollow;
    }
}
