<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Streams;
use App\Models\StreamerTags;
use Illuminate\Support\Facades\Auth;

class GetTopStreams extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getTopStreams';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets the streams';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $i = 0;
        $nextPage = null;

        $getToken = Http::withOptions(['verify' => false])->post('https://id.twitch.tv/oauth2/token', [
            'client_id' => env('TWITCH_ID'),
            'client_secret' => env('TWITCH_SECRET'),
            'grant_type' => 'client_credentials'
        ]);

        $accessToken = $getToken->json()['access_token'];
        Streams::truncate();
        StreamerTags::truncate();
        do {
            $params = [
                'first'=>100,
            ];

            if ($nextPage !== null) {
                $params['after'] = $nextPage;
            }

            $response = Http::withHeaders([
            'Client-Id' => env('TWITCH_ID')
            ])->withToken($accessToken)->get('https://api.twitch.tv/helix/streams', $params);
            $body = $response->json();
            $nextPage = $body['pagination']['cursor'];
            foreach ($body['data'] as $stream) {
                $newStreams = new Streams();
                $newStreams->channel_name = $stream['user_name'];
                $newStreams->stream_title = $stream['title'];
                $newStreams->game_name = $stream['game_name'];
                $newStreams->viewers = $stream['viewer_count'];
                $newStreams->start_at = $stream['started_at'];
                $newStreams->twitch_id = $stream['id'];
                $newStreams->save();

                $tags = Http::withHeaders([
                    'Client-Id' => env('TWITCH_ID')
                    ])->withToken($accessToken)->get('https://api.twitch.tv/helix/tags/streams', ['tag_id'=>$stream['tag_ids']]);
                
                $tags = $tags->json()['data'];
                foreach ($stream['tag_ids'] as $tag) {
                    $foundTag = null;
                    foreach ($tags as $searchTag) {
                        if ($searchTag['tag_id'] === $tag) {
                            $foundTag = $searchTag['localization_names']['en-us'];
                            break;
                        }
                    }
                    if ($foundTag) {
                        $newStreams->tags()->create([
                            'tag_id' => $tag,
                            'tag_name' =>  $foundTag,
                        ]);
                    }
                }
            }

            $i++;
        } while ($i < 10);

        return Command::SUCCESS;
    }
}
