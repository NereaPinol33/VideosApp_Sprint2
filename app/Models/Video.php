<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'url',
        'published_at',
        'previous',
        'next',
        'series_id',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function getFormattedPublishedAtAttribute()
    {
        return $this->published_at ? Carbon::parse($this->published_at)->translatedFormat('d \d\e F \d\e Y') : 'No publicado';
    }

    public function getFormattedForHumansPublishedAtAttribute()
    {
        return $this->published_at ? Carbon::parse($this->published_at)->diffForHumans() : 'No publicado';
    }

    public function getPublishedAtTimestampAttribute()
    {
        return $this->published_at ? Carbon::parse($this->published_at)->timestamp : 'No publicado';
    }
}
