<?php
/**
 * @copyright Copyright (C) Dany Ralantonisainana All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 * @package ezgoogleapi
 */
$googleIni = eZINI::instance('google.ini');
$clientId = $googleIni->variable('ClientSettings', 'ClientID');
$clientSecret = $googleIni->variable('ClientSettings', 'ClientID');

/************************************************
  Before instancing Google Client, we need to adapt
  the new base path. Because Google Trends have not
  API
 ************************************************/
$config = new Google_Config();
$config->setBasePath("http://www.google.fr");

$client = new Google_Client($config);
$client->setClientId($clientId);
$client->setClientSecret($clientSecret);

/************************************************
  When we create the service here, we pass the
  client to it. The client then queries the service
  for the required scopes, and uses that when
  generating the authentication URL later.
 ************************************************/

$service = new Google_Service_Trends($client);
/************************************************
  We make a call to our service, which will
  normally map to the structure of the API.
  In this case $service is Books API, the
  resource is volumes, and the method is
  listVolumes. We pass it a required parameters
  (the query), and an array of named optional
  parameters.
 ************************************************/
$countryDefault = eZCountryType::fetchCountry("France", "Name");
$optParams = array(
    'geo'  => $countryDefault['Alpha2'],
    'date'   => '2013',
    'cat'  => '',
    // there are 15 items
    'tn' => 15
);

$results = $service->topcharts->category($optParams);
var_dump($results);
foreach ($results->getChartList() as $key => $value) {
    if ($value->getTopChart()) {
        echo "<pre>";
        var_dump($value->getTopChart());
        echo "</pre>";
    } else {
        echo "<pre>";
        var_dump($value->getTrendingChart());
        echo "</pre>";
    }
    
//   # code...
}
