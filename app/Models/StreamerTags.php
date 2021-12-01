<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StreamerTags extends Model
{
    use HasFactory;
    protected $table = 'streamer_tags';

    protected $fillable = [
        'streamer_id',
        'tag_id',
        'tag_name',
    ];
}
