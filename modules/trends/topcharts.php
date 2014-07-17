<?php
/**
 * @copyright Copyright (C) Dany Ralantonisainana All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 * @package ezgoogleapi
 */
$Module          = $Params['Module'];
$namedParameters = $Module->getNamedParameters();
$http            = eZHTTPTool::instance();
$googleIni       = eZINI::instance('google.ini');
$trendsIni       = eZINI::instance('googletrends.ini');
$clientId        = $googleIni->variable('ClientSettings', 'ClientID');
$clientSecret    = $googleIni->variable('ClientSettings', 'ClientID');

/************************************************
  Before instancing Google Client, we need to adapt
  the new base path. Because Google Trends have not
   private API
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
$method = false;
if (in_array($Module->OriginalParameters[0], array('category', 'trendingchart'))) {
    $method = $Module->OriginalParameters[0];
} else {
    echo "No method Google Trends";
    eZExecution::cleanExit();
}
$methodSetting = ucfirst($method).'Settings';
$countryDefault = eZCountryType::fetchCountry("France", "Name");
$geo = array( 'geo' => $countryDefault['Alpha2']);
$tn = false;
$cid = false;
$date = array( 'date' => '2013');
$cat = array( 'cat' => '');
$optParams = array();


if ($http->hasGetVariable("geo")) {
    $geo = array( 'geo' => $http->hasGetVariable("geo"));
}
$optParams = array_merge($optParams, $geo);

if ($http->hasGetVariable("date")) {
    $date = array( 'date' => $http->hasGetVariable("date"));
}
$optParams = array_merge($optParams, $date);

if ($http->hasGetVariable("tn")) {
    $tn = array( 'tn' => $http->hasGetVariable("tn"));
} elseif ($trendsIni->hasVariable($methodSetting, 'TnDefault')) {
    $tn = array( 'tn' => $trendsIni->variable($methodSetting, 'TnDefault'));
}
if ($tn) {
    $optParams = array_merge($optParams, $tn);
}

if ($http->hasGetVariable("cid")) {
    $cid = array( 'cid' => $http->hasGetVariable("cid"));
} elseif ($trendsIni->hasVariable($methodSetting, 'CidDefault')) {
    $cid = array( 'cid' => $trendsIni->variable($methodSetting, 'CidDefault'));
}
if ($cid) {
    $optParams = array_merge($optParams, $cid);
}
// echo '<script type="text/javascript" src="//www.google.com/trends/embed.js?hl=en-US&q=mode&geo=FR&cmpt=q&content=1&cid=TOP_QUERIES_0_0&export=5&w=300&h=420"></script>';
switch ($method) {
    case 'category':
        if (method_exists($service->topcategorycharts, $method)) {
            $results = $service->topcategorycharts->$method($optParams);
        } else {
            echo "In HotTrends this method did'nt exist Google Trends";
            eZExecution::cleanExit();
        }
        // sort hot items by date
        foreach ($results->getChartList() as $chartList) {
            echo "<pre>";
            var_dump($chartList->getChart()->getTwitterShareUrlTitle());
            foreach ($chartList->getChart()->getEntityList() as $entity) {
                var_dump($entity);
            }
            echo "</pre>";
        }
        die();
        break;
    case 'trendingchart':
        if (method_exists($service->toptrendingchart, $method)) {
            $results = $service->toptrendingchart->$method($optParams);
        } else {
            echo "In HotTrends this method did'nt exist Google Trends";
            eZExecution::cleanExit();
        }
        echo "<pre>";
        var_dump($results->getPageTitle());
        echo "</pre>";
        // sort hot items by date
        foreach ($results->getEntityList() as $entityList) {
            echo "<pre>";
            var_dump($entityList);
            echo "</pre>";
        }
        die();
        break;
        break;
    default:
        # code...
        break;
}
