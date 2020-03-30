<?php

namespace Salem\Tracker\Controls\Repositories\Resources\Tracker;

use Illuminate\Http\Resources\Json\JsonResource;

class TrackerDetailsResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'ip'  => $this->tracker->ip_address,
            'browser' => [
                'name'     => $this->browser,
                'version'  => $this->browser_version,
                'platform' => $this->platform
            ],
            'date'  => $this->created_at->diffForHumans(),
        ];
    }
}
