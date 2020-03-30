<?php

namespace Salem\Tracker\Controls\Models;

use Illuminate\Database\Eloquent\Model;

class TrackerDetail extends Model
{
    protected $fillable = ['tracker_id', 'browser', 'browser_version', 'platform'];

    public function tracker()
    {
    	return $this->belongsTo(Tracker::class);
    }
}
