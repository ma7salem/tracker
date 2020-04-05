<?php

/**
 *  Get Instance of Location Class
 *  
 *  @param string       $ip The ip of the location.
 *  @return Salem\Tracker\Helpers\Location
 */
if(! function_exists('locationIp')){
    function locationIp($ip)
    {
        return new \Salem\Tracker\Helpers\Location($ip);
    }
}

/**
 *  Get Instance of Browser Class
 *  
 *  @return Salem\Tracker\Helpers\Browser
 */
if(! function_exists('getBrowser')){
    function getBrowser()
    {
        return new \Salem\Tracker\Helpers\Browser;
    }
}

/**
 *  Get Instance of Track Class
 *  
 *  @return Salem\Tracker\Helpers\Track
 */
if(! function_exists('getTrack')){
    function getTrack()
    {
        return new \Salem\Tracker\Track;
    }
}


