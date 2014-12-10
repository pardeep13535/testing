<?php

/**
 * Configuration
 *
 * For more info about constants please @see http://php.net/manual/en/function.define.php
 */

/**
 * Configuration for: Error reporting
 * Useful to show every little problem during development, but only show hard errors in production
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

class Config {
    public static $browseConfigUrls = array(
        "cars" => 'http://todo',
        "bikes" => 'http://todo',
        "religious" => 'http://todo'
    );

    public static $browseConfigValues = array(
        "cars" => array(
            "lambho" => array(
                "thumb" => 'https://s.yimg.com/os/publish-images/autos/2014-10-02/1bb19190-4a18-11e4-a6e8-e52abde8a31d_Lamborghini-Asterion-Concept-top2.jpg',
                "url" => 'http://www.wired.com/wp-content/uploads/2014/10/Lamborghini-Asterion-04.jpg'),
            "santro zip+" => array(
                "thumb" => 'http://www.adpost.com/classifieds/upload/in/vehicles/in_vehicles.1371.1.jpg',
                "url" => 'http://www.adpost.com/classifieds/upload/in/vehicles/in_vehicles.1371.1.jpg')),
        "bikes" => array(
            "lambho" => array(
                "thumb" => 'https://s.yimg.com/os/publish-images/autos/2014-10-02/1bb19190-4a18-11e4-a6e8-e52abde8a31d_Lamborghini-Asterion-Concept-top2.jpg',
                "url" => 'http://www.wired.com/wp-content/uploads/2014/10/Lamborghini-Asterion-04.jpg'),
            "santro zip+" => array(
                "thumb" => 'http://www.adpost.com/classifieds/upload/in/vehicles/in_vehicles.1371.1.jpg',
                "url" => 'http://www.adpost.com/classifieds/upload/in/vehicles/in_vehicles.1371.1.jpg')
        ),
        "religious" => 'http://todo'
    );

}

define('URL_PUBLIC_FOLDER', 'public');
define('URL_PROTOCOL', 'http://');
define('URL_DOMAIN', $_SERVER['HTTP_HOST']);
define('URL_SUB_FOLDER', str_replace(URL_PUBLIC_FOLDER, '', dirname($_SERVER['SCRIPT_NAME'])));
define('URL', URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER);

/**
 * Configuration for: Database
 * This is the place where you define your database credentials, database type etc.
 */
define('DB_TYPE', 'mysql');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'mini');
define('DB_USER', 'root');
define('DB_PASS', '');