<?php

namespace Salem\Tracker\Controls\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Tracker extends Model
{
    protected $fillable = ['ip_address', 'country_name', 'country_code', 'city', 'lat', 'lng', 'currency'];

    public function trackerDetails()
    {
    	return $this->hasMany(TrackerDetail::class);
    }

    public function trackNew($data)
    {
        $detail = $this->trackerDetails()->whereDate('created_at', Carbon::today())->first();
        if(!$detail){
            $data['tracker_id'] = $this->id;
            return TrackerDetail::create($data);
        }
        return $detail;
    }
}
