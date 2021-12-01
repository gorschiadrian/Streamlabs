<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Streams;
use Illuminate\Support\Facades\Http;
use Auth;
use App\Models\StreamerTags;

class Tags extends Component
{
    public $tagList;
    
    public function render()
    {
        $this->tagList = $this->getData();

        return view('livewire.tags');
    }

    public function getData()
    {
        $response = Http::withHeaders([
            'Client-Id' => env('TWITCH_ID')
            ])->withToken(Auth::user()->twitch_token)->get('https://api.twitch.tv/helix/streams/followed', [
                'user_id' => Auth::user()->twitch_id
            ]);
        $body = $response->json();
        $followedTags = [];
        foreach ($body['data'] as $stream) {
            foreach ($stream['tag_ids'] as $tagId) {
                array_push($followedTags, $tagId);
            }
        }
        return  StreamerTags::whereIn('tag_id', $followedTags)->distinct('tag_name')->get();
    }
}
