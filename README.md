[![Build Status](https://travis-ci.org/google/google-api-php-client.svg)](https://travis-ci.org/google/google-api-php-client)

# Google APIs Client Library for PHP and eZPublish 4.x#

## Description ##
The Google API Client Library enables you to work with Google APIs such as Google+, Drive, or YouTube on your server with eZPublish4.x

## Beta ##
eZPublish integration is still in beta and is in parallel development with [[Google API](https://github.com/google/google-api-php-client)](https://github.com/google/google-api-php-client)

## Requirements ##
* [PHP 5.2.1 or higher](http://www.php.net/)
* [PHP JSON extension](http://php.net/manual/en/book.json.php)

## Developer Documentation for Google Api##
http://developers.google.com/api-client-library/php

## Installation ##
Enabled the extension in your site.ini

## Basic Example ##
See the examples/ directory for examples of the key client features.
```PHP
<?php
$googleApiIni       = \eZINI::instance('googleapi.ini');
$googleAnalyticsIni = \eZINI::instance('googleanalytics.ini');
$googleapi = new eZGoogleApi(
    'oauth2',
    array(
        'application_name' => $googleAnalyticsIni->variable('GoogleAnalyticsSettings', 'ApplicationName'),
        'scopes' => \Google_Service_Analytics::ANALYTICS_READONLY
    )
);

// create service and get data
$service = eZGoogleAnalytics::getService($googleapi->client);
$service->setRessource('reportingcorega');
$service->setProfileID(PROFILEID);
$service->setPeriod(PERIODAFTERBEFORE, PERIODBEFORE);
$service->setParameter("max-results", 1000);
$service->getResults();
```
