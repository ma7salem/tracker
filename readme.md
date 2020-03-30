# Laravel Visitors Tracker
[![GitHub forks](https://img.shields.io/github/forks/ma7moudsalem1/tracker)](https://github.com/ma7moudsalem1/tracker/network) [![GitHub stars](https://img.shields.io/github/stars/ma7moudsalem1/tracker)](https://github.com/ma7moudsalem1/tracker/stargazers)

## About

`Salem\Tracker` is a Laravel package makes it easy to track your Laravel project by gathering a lot of information from your the visitor request and **IP Address**.


## Features

 * You can get this data about your visitor without each day like:

     * **The Country**.
     * **The City**.
      * **The currency of the visitor country**.
      * **Latitude and Longitude**.
      * **Browser and the version of this browser**.
       * **Platform**.

  * After collecting the data from your visitors you can show them through an API in the package.

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

## Credits
   http://ip-api.com.
