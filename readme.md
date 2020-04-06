# Laravel Visitors Tracker
[![GitHub forks](https://img.shields.io/github/forks/ma7moudsalem1/tracker)](https://github.com/ma7moudsalem1/tracker/network) [![GitHub stars](https://img.shields.io/github/stars/ma7moudsalem1/tracker)](https://github.com/ma7moudsalem1/tracker/stargazers)

## About

`Salem\Tracker` is a Laravel package makes it easy to track your Laravel project by gathering a lot of information from your visitor request and **IP Address**.


## Features

* You can get this data about your visitor without each day like:

   * **The Country**.
   * **The City**.
   * **The currency of the visitor country**.
   * **Latitude and Longitude**.
   * **Browser and the version of this browser**.
   * **Platform**.

* After collecting the data from your visitors you can show them through an API in the package.

   * (GET) `/tracker/all` To get all the tracker records from your database.
   * (GET) `/tracker/show/{id}` To get the tracker data by ID form your database.
   * (GET) `/tracker/ip/{ip}` To get the IP data from your database.

* The package also make it easy for you to get the data that you want like:

   * **Check if this IP Tracked before**
   * **Last visit of this IP**
   * **Most visitors from `` Country``,``City``,``Browser``,``Platform``**

## Installation

   ```
  composer require salem/tracker
  ```
   Run the migration, You have two ways to do it:
   * Run `php artisan migrate` directly.
   * Publish the migration `php artisan vendor:publish --
     *provider="Salem\Tracker\TrackerServiceProvider" --tag=migration` Then `php artisan migrate`.

   Publish the config file (optional)

   * Run  `php artisan vendor:publish --provider="Salem\Tracker\TrackerServiceProvider" --   tag=config`.

   * You can publish all files by run `php artisan vendor:publish --provider="Salem\Tracker\TrackerServiceProvider"`

   Put `Provicer` & `Aliases` in `app.php` (optional)
   ```
   Salem\Tracker\TrackerServiceProvider::class,
   ```
   ```
   'Tracker' => Salem\Tracker\Facades\Tracker::class,
   ```

## How To Use It.

   The package provide many ways to use :

   * You Can put the package middleware `\Salem\Tracker\Controls\Http\middleware\VisitorTrack::class,` in  `App\Http\Kernel` inside `$middleware` array.

   * Or You can put this script in your view before `</body>` to send Ajax request to save visitor's data ```{!! Tracker::script() !!}``` or ```{!! getTrack()->script() !!}```.

   Also the package provide many fuctions to get your data:

   * ``` Tracker::trackedBefore($ip) ``` To check if the given IP tracked before and its data exists in the database or not.
   * ``` Tracker::getBest($compare, $number) ``` To give you the top `$number` of given `compare`, Compare could be `ip_address`, `country_name`, `city`, `currency`, `country_code`, `browser`, `browser_version`, `platform` and for example if you put the number with 10 it gives you top 10 of the given compare.
   * ``` Tracker::getPaginatedTracking($paginate = 20, $full = false) ``` To get paginated records from your database, `$full` boolean that make sure if you want full data or formated data.
   * ``` Tracker::getTrackingPaginatedByIp($ip, $paginate = 20, $full = false) ``` To get paginated records from your database of the given IP, `$full` boolean that make sure if you want full data or formated data.
   * ``` Tracker::getTracking($id, $full = false) ``` To get the tracking record from your database by ID with formated or not formated way.
   * ``` Tracker::getTrackingByIp($ip, $full = false) ``` To get the tracking record from your database by IP with formated or not formated way.
   * ``` Tracker::getLastIpVisit($ip, $full = false) ``` To get formated or not formated data of last visit of the given IP.

   All functions are avalible with package helper `getTrack()` for example `getTrack()->getTrackingByIp($ip, $full = false)`.

## Credits
   http://ip-api.com.
