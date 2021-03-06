<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    const HACKNIGHT = 'hacknight';
    const MEETUP = 'meetup';

    protected $dates = ['created_at', 'updated_at', 'starts_at', 'ends_at'];

    protected $fillable = ['slug'];

    public function url()
    {
        return route('event', $this->id);
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'events_posts');
    }

    public function sponsors()
    {
        return $this->belongsToMany(Sponsor::class, 'events_sponsors');
    }

    // TODO: use this in the generator
    public function eventNumber()
    {
        return 90 + (($this->starts_at->year - 2016) * 11) + ($this->starts_at->month - 1);
    }

    public function getFormattedTimeAttribute()
    {
        $tz = new \DateTimeZone('Australia/Melbourne');

        $sa = $this->starts_at->copy()->setTimeZone($tz);
        $ea = $this->ends_at->copy()->setTimeZone($tz);

        return $sa->format('D jS \\of M Y \\@ g:i') . ' - '. $ea->format('g:i A');
    }

    /**
     * Returns next scheduled event after this one
     */
    public function followingEvent()
    {
        return Event::where('starts_at', '>=', $this->ends_at)
            ->where('type', '=', Event::MEETUP)
            ->first();
    }

    /**
     * Next HackNight after this one
     */
    public function followingHacknight()
    {
        return Event::where('starts_at', '>=', $this->ends_at)
            ->where('type', '=', Event::HACKNIGHT)
            ->first();
    }

    public function scopeNextEvent($query)
    {
        return $query->where('type', '=', Event::MEETUP)
            ->where('ends_at', '>=', Carbon::now(new \DateTimeZone('UTC')))
            ->orderBy('starts_at')
            ->limit(1);
    }

    public function scopeNextHacknight($query)
    {
        return $query->where('type', '=', Event::HACKNIGHT)
            ->where('ends_at', '>=', Carbon::now(new \DateTimeZone('UTC')))
            ->orderBy('starts_at')
            ->limit(1);
    }

    public function scopeUpcomingEvents($query)
    {
        return $query->where('ends_at', '>=', Carbon::now())
            ->orderBy('starts_at');
    }

    public function formattedSponsorNames()
    {
        return implode(' and ', array_map(function ($s) {
            return $s->name;
        }, $this->sponsors->all()));
    }
}
