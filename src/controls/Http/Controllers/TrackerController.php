<?php

namespace Salem\Tracker\Controls\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Salem\Tracker\Controls\Repositories\TrackerRepo;

class TrackerController extends Controller
{
    public $repo;

    public function __construct(TrackerRepo $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginate = is_int($request->paginate) ? $request->paginate : null;
        return $this->repo->all($paginate);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->repo->store($request->ip());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->repo->show($id);
    }

    /**
     * Display the data of th IP address.
     *
     * @param  int  $ip
     * @return \Illuminate\Http\Response
     */
    public function getIp($ip)
    {
        return getTrack()->getTrackingPaginatedByIp($ip);
    }
}
