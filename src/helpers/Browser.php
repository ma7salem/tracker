<?php
namespace Salem\Tracker\Helpers;

class Browser {

    protected $agent;
    public function __construct()
    {
        $this->agent = request()->header('User-Agent');
    }

    /** 
     * Get All Browser data.
     * 
     * @return array        return array of browser data.
    */
    public function getBrowserData()
    {
        return [
            'userAgent'         => $this->agent,
            'browser'           => $this->getBrowserName(),
            'browser_version'   => $this->getBrowserVersion(),
            'platform'          => $this->getPlatform()
        ];
    }

    /**
     * Get Platform.
     * 
     * @return string       return the plateform.
    */
    public function getPlatform()
    {
        if (preg_match('/linux/i', $this->agent)) {
            $platform = 'linux';
        }
        elseif (preg_match('/macintosh|mac os x/i', $this->agent)) {
            $platform = 'mac';
        }
        elseif (preg_match('/windows|win32/i', $this->agent)) {
            $platform = 'windows';
        }else{
            $platform = null;
        }
        return $platform;
    }

    /**
     * Get Browser.
     * 
     * @return array       return the browser.
    */
    public function getBrowser()
    {
        $agent = $this->agent;
        if(preg_match('/MSIE/i', $agent) && !preg_match('/Opera/i', $agent))
        {
            $name = 'Internet Explorer';
            $brand = "MSIE";
        }
        elseif(preg_match('/Firefox/i', $agent))
        {
            $name = 'Mozilla Firefox';
            $brand = "Firefox";
        }
        elseif(preg_match('/Chrome/i', $agent))
        {
            $name = 'Google Chrome';
            $brand = "Chrome";
        }
        elseif(preg_match('/Safari/i', $agent))
        {
            $name = 'Apple Safari';
            $brand = "Safari";
        }
        elseif(preg_match('/Opera/i', $agent))
        {
            $name = 'Opera';
            $brand = "Opera";
        }
        elseif(preg_match('/Netscape/i', $agent))
        {
            $name  = 'Netscape';
            $brand = "Netscape";
        }
        else{
            $name  = null;
            $brand = null;
        }
        return ['name' => $name, 'brand' => $brand];     
    }
    

    /**
     * Get Browser Name.
     * 
     * @return string       return the browser name.
    */
    public function getBrowserName()
    {
        return $this->getBrowser()['name'];     
    }

    /**
     * Get Browser Brand.
     * 
     * @return string       return the browser Brand.
    */
    public function getBrowserBrand()
    {
        return $this->getBrowser()['brand'];     
    }

    /** 
     * Get the browser version.
     * 
     * @return string       return browser version.
    */
    public function getBrowserVersion()
    {
        $brand   = $this->getBrowserBrand();
        $version = null;

        $known = array('Version', $brand, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
        ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';

        if (!preg_match_all($pattern, $this->agent, $matches)) {}
       
        $i = count($matches['browser']);
        if ($i != 1) {
           
            if (strripos($this->agent, 'Version') < strripos($this->agent, $brand)){
                $version= $matches['version'][0];
            }
            else {
                $version= $matches['version'][1];
            }
        }
        else {
            $version= $matches['version'][0];
        }

        if ($version==null || $version=="") {$version="?";}
        return $version;
    }

   
}