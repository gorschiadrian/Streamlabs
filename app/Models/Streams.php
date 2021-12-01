<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Streams extends Model
{
    use HasFactory;

    protected $table = 'streams';
    
    protected $fillable = [
        'channel_name',
        'stream_title',
        'game_name',
        'viewers',
        'start_at',
        'twitch_id'
    ];

    public function tags()
    {
        return $this->hasMany(StreamerTags::class, 'streamer_id', 'twitch_id');
    }
}
