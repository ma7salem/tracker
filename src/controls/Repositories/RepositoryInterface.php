<?php

namespace Salem\Tracker\Controls\Repositories;

interface RepositoryInterface
{

    /**
     * Get all data.
     *
     * @param integer                $paginate  The pagination number of data with default.
     * @param boolean                $full get full data not in a pretty way it will be by default (false).
     */
    public function all($paginate, $full);

    /**
     * Store the data.
     *
     * @param array                  $data  The data that will be saved into the database.
     * @param boolean                $full get full data not in a pretty way it will be by default (false).
     */
    public function store($data, $full);

    /**
     * Show the data by the given id.
     *
     * @param interger                $id  The id of the data .
     * @param boolean                 $full get full data not in a pretty way it will be by default (false).
     */
    public function show($id, $full);

    /**
     * Custom select from the model.
     *
     */
    public function select();
}