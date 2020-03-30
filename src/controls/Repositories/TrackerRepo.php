<?php

namespace Salem\Tracker\Controls\Repositories;

use Salem\Tracker\Controls\Models\Tracker;
use Salem\Tracker\Controls\Repositories\Resources\Tracker\TrackersResource;
use Salem\Tracker\Controls\Repositories\Resources\Tracker\TrackersConllection;
use Salem\Tracker\Helpers\Location;

class TrackerRepo implements RepositoryInterface 
{
    protected $data;

    public function __construct()
    {
        $this->data = getTrack();
    }

     /**
     * Get all data.
     *
     * @param integer                $paginate  The pagination number of data with default 20.
     * @param boolean                $full get full data not in a pretty way it will be by default (false).
     * @return data                  return paginated data by the given number
     */
    public function all($paginate = 20, $full = false){
        return $this->data->getPaginatedTracking($paginate, $full);
    }

    /**
     * Store the data.
     *
     * @param array                $data  The data that will be saved into the database.
     * @param boolean              $full get full data not in a pretty way it will be by default (false).
     */
    public function store($ip, $full = false){
        return $this->data->track($ip, $full);
    }

    /**
     * Show the data by the given id.
     *
     * @param interger             $id  The id of the data.
     * @param boolean              $full get full data not in a pretty way it will be by default (false).
     * @return array               return the array of resource of the tracker by the given id.
     */
    public function show($id, $full = false){
        return $this->data->getTracking($id, $full);
    }

    /**
     * Custom select from the model.
     *
     * @return instance             return instance of the tracker model.
     */
    public function select(){
        return new Tracker;
    }
}