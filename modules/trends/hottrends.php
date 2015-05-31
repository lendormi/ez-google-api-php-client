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
if (count($namedParameters) > 0) {
    foreach ($namedParameters as $parameter => $httpParamaterValue) {
        if ($parameter == $httpParamaterValue) {
            $method = $parameter;
            break;
        }
    }
}
if (!$method) {
    echo "No method Google Trends";
    eZExecution::cleanExit();
}
$htd = '';
$pn = 'p16';
$htv = 'l';
switch ($method) {
    case 'hotItems':
        if ($http->hasGetVariable("htd")) {
            $htd = $http->getVariable("htd");
        }
        if ($http->hasGetVariable("pn")) {
            $pn = $http->getVariable("pn");
        }
        break;
}
$optParams = array(
    'htd'  => $htd,
    'pn'   => $pn,
    'htv'  => $htv,
);
if (method_exists($service->hottrends, $method)) {
    $results = $service->hottrends->$method($optParams);
} else {
    echo "In HotTrends this method did'nt exist Google Trends";
    eZExecution::cleanExit();
}
switch ($method) {
    case 'hotItems':
        $summaryMessage = $results->getSummaryMessage();
        $trendsByDateList = $results->getTrendsByDateList();
        // sort hot items by date
        // foreach ($trendsByDateList as $trendsList) {
        // 	# code...
        // }
        echo "<pre>";
        var_dump($trendsByDateList);
        echo "</pre>";
        break;
    default:
        # code...
        break;
}
