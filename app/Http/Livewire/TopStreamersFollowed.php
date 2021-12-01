<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Streams;
use Illuminate\Support\Facades\Http;
use Auth;

class TopStreamersFollowed extends Component
{
    public $followed;
    public function render()
    {
        $this->followed = $this->getData();
        return view('livewire.top-streamers-followed');
    }

    public function mount()
    {
        $this->followed = $this->getData();
    }

    public function getData()
    {
        $response = Http::withHeaders([
            'Client-Id' => env('TWITCH_ID')
            ])->withToken(Auth::user()->twitch_token)->get('https://api.twitch.tv/helix/streams/followed', [
                'user_id' => Auth::user()->twitch_id
            ]);
        $body = $response->json();
        $userNames = [];
        foreach ($body['data'] as $streamNames) {
            array_push($userNames, $streamNames['user_name']);
        }
        return Streams::whereIn('channel_name', $userNames)->orderBy('viewers', 'DESC')->get();
    }
}
