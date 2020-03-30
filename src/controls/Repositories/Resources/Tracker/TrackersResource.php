<?php

namespace Salem\Tracker\Controls\Repositories\Resources\Tracker;

use Illuminate\Http\Resources\Json\JsonResource;

class TrackersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'ip'  => $this->ip_address,
            'location' => [
                'country'   => [
                        'name' => $this->country_name,
                        'code' => $this->country_code
                ],
                'city'      => $this->city,
                'map'       => [
                            'lat' => $this->lat,
                            'lag' => $this->lng,
                ],
            ]
        ];
    }
}
