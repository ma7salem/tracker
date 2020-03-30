<?php
namespace Salem\Tracker\Helpers;
use GuzzleHttp\Client;
class Location
{
    public $ip;

    public function __construct($ip)
    {
        $this->ip;
    }

     /**
     * Get Location by the IP address.
     * 
     * @param  string           $ip the Ip address.
     * @return array            return array of the location.
    */
    public function getLocation()
    {
        return $this->sendRequest();
    }


    /**
     * The wanted field to bring.
     * 
     * @return array            return array of the fields.
    */
    private function getFields()
    {
        return [
            'status',
            'message',
            'country',
            'countryCode',
            'city',
            'lat',
            'lon',
            'currency',
            'query'
        ];
    }

    /**
     * The API provider.
     * 
     * @return string            return string of the API provider.
    */
    private function getApiProvider()
    {
        return 'http://ip-api.com';
    }

    /**
     * The API type of data.
     * 
     * @return string            return string of the API type of data.
    */
    private function getApiType()
    {
        return 'json';
    }

    /**
     * Full API Url.
     * 
     * @param  string            $ip the Ip address.
     * @return string            return string of full API url.
    */
    private function getFullApiUrl()
    {
        return $this->getApiProvider() . '/' . $this->getApiType() . '/' . $this->ip . '?fields=' . implode(",", $this->getFields());
    }

    /**
     * Send Request to the provider.
     * 
     * @param  string           $ip the Ip address.
     * @return array            return array of the API data.
    */
    private function sendRequest()
    {
        try {
            $client = new Client();
            $request = $client->get($this->getFullApiUrl());
            return $this->formatData(json_decode($request->getBody(), true));
        } catch (Exception $e) {
            return [];
        }
        
    }

    /**
     * Send Request to the provider.
     * 
     * @param  array            $data the data that will be formated.
     * @return array            return array of the API data.
    */
    private function formatData($data)
    {
        return [
            'status'        => $data['status'],
            'country_name'  => $data['country'],
            'country_code'  => $data['countryCode'],
            'city'          => $data['city'],
            'lat'           => $data['lat'],
            'lng'           => $data['lon'],
            'currency'      => $data['currency'],
            'ip_address'    => $data['query']
        ];
    }
    



}