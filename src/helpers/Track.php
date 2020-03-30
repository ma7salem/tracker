<?php
namespace Salem\Tracker\Helpers;
use Salem\Tracker\Controls\Models\Tracker as TrackerModel;
use Salem\Tracker\Controls\Repositories\Resources\Tracker\TrackersResource;
use Salem\Tracker\Controls\Repositories\Resources\Tracker\TrackerDetailsResource;

use Illuminate\Support\Facades\DB;

class Track {

    private $model;

    public function __construct()
    {
        $this->model = new TrackerModel;
    }

    /** 
     *  Track data by saving into the database.
     *  
     *  @param string          $ip IP addess.
     *  @param boolean         $full get full data not in a pretty way it will be by default (false).
     *  @return data           retern collection.
    */
    public function track($ip, $full = false) {

        if(in_array($ip, config('tracker.not_ips'))){
            return null;
        }
        
        $tracker = $this->model->where('ip_address', $ip)->first();
        if(!$tracker){
            $data = locationIp($ip)->getLocation();
            $data['ip_address'] = $ip;
            $tracker = $this->model->create($data);
        }
        
        $detail = $tracker->trackNew(getBrowser()->getBrowserData());

        return $full ? $tracker : new TrackersResource($tracker);
    }

    /** 
     * Check if the IP address exist or nit by get count of the IP. 
     * 
     * @param string            $ip IP address.
     * @return integer          return number of IPs in the table.
    */
    public function trackedBefore($ip)
    {
        return $this->model->where('ip_address', $ip)->count();
    }

    /** 
     * Get Bast of master data. 
     * 
     * @param integer        $numbers Numbers of the best master data (default 10).
     * @return data          return collection.
    */
    private function getBestMaster($compare = 'country_name', $numbers = 10)
    {
        if($compare == 'ip_address'){
            return $this->getBestDetails($compare, $numbers);
        }
        return $this->model->select($compare, DB::raw("COUNT('trackers.". $compare ."') AS counts"))
                           ->orderBy('counts', 'desc')
                           ->groupBy($compare)
                           ->take($numbers)
                           ->get();
    }

    /** 
     * Get Bast of details data. 
     * 
     * @param integer        $numbers Numbers of the best details data (default 10).
     * @return data          return collection.
    */
    private function getBestDetails($compare = 'browser', $numbers = 10)
    {
        $compare = $compare == 'ip_address' ? $compare : 'tracker_details.' . $compare;
        return $this->model->select($compare, DB::raw("COUNT('tracker_details.id') AS counts"))
                           ->join('tracker_details', 'tracker_details.tracker_id', '=', 'trackers.id')
                           ->orderBy('counts', 'desc')
                           ->groupBy($compare)
                           ->take($numbers)
                           ->get();
    }

    /** 
     * Get type of master & details compare.
     * 
     * @return string            return string.
    */
    private function compare($compare)
    {
        $data = [
            'master'  => ['ip_address', 'country_name', 'city', 'currency', 'country_code'],
            'details' => ['browser', 'browser_version', 'platform']
        ];
        return in_array($compare, $data['master']) ? 'master' : (in_array($compare, $data['details']) ? 'details' : 'master');
    }

    /** 
     * Get Bast. 
     * 
     * @param integer        $numbers Numbers of the best country that will be returned (default 10).
     * @return data          return collection of best countries.
    */
    public function getBest($compare = 'country_name', $numbers = 10)
    {
        return $this->compare($compare) == 'master' ? $this->getBestMaster($compare, $numbers) : $this->getBestDetails($compare, $numbers);
    }

    /** 
     * Get data of tracking paginated. 
     * 
     * @param integer        $paginate Numbers of paginate (default 20).
     * @param boolean        $full get full data not in a pretty way it will be by default (false).
     * @return data          return collection.
    */
    public function getPaginatedTracking($paginate = 20, $full = false)
    {
        $query = $this->model->orderBy('id', 'desc')->paginate($paginate);
        return $full ? $query : TrackersResource::collection($query);
    }

    /** 
     * Get Track by id. 
     * 
     * @param integer        $id id of tracking.
     * @param boolean        $full get full data not in a pretty way it will be by default (false).
     * @return data          return collection.
    */
    public function getTracking($id, $full = false)
    {
        $query = $this->model->find($id);
        return $query ? ($full ? $query : new TrackersResource($query)) : null;
    }

    /** 
     * Get Track by ip. 
     * 
     * @param string         $ip IP address of tracking.
     * @param boolean        $full get full data not in a pretty way it will be by default (false).
     * @return data          return collection.
    */
    public function getTrackingByIp($ip, $full = false)
    {
        $query = $this->model->where('ip_address', $ip)->first();
        return $query ? ($full ? $query : new TrackersResource($query)) : null;
    }

    /** 
     * Get paginated IP address visits. 
     * 
     * @param string         $ip IP address of tracking.
     * @param integer        $paginate Numbers of paginate (default 20).
     * @param boolean        $full get full data not in a pretty way it will be by default (false).
     * @return data          return collection.
    */
    public function getTrackingPaginatedByIp($ip, $paginate = 20, $full = false)
    {
        $query = $this->getTrackingByIp($ip, $full);
        $query = $query ? $query->trackerDetails()->paginate($paginate) : null;
        return $query ? ($full ? $query : TrackerDetailsResource::collection($query)) : null;
    }

    /** 
     * Get last vist of the IP address. 
     * 
     * @param string         $ip IP address of tracking.
     * @param boolean        $full get full data not in a pretty way it will be by default (false).
     * @return data          return collection.
    */
    public function getLastIpVisit($ip, $full = false)
    {
        $query = $this->getTrackingByIp($ip, $full);
        $query = $query ? $query->trackerDetails()->orderBy('created_at', 'desc')->first() : null;
        return $query ? ($full ? $query : new TrackerDetailsResource($query)) : null;
    }

    /** 
     * Send Ajax Request. 
     *
     * @return string          return string of ajax request.
    */
    public function script()
    {
        $url  = route('tracker.post.save');
        $out  = "<script>";
        $out .= "window.onload = function(){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {};
            xhttp.open('POST', '".$url."', true);
            xhttp.send();
        };";
        $out .= "</script>";
        return $out;
    }




}