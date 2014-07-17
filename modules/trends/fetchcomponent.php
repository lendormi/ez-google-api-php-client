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

$methodSetting = 'FetchComponentSettings';
$countryDefault = eZCountryType::fetchCountry("France", "Name");
$geo = array( 'geo' => $countryDefault['Alpha2']);
$cid = false;
$hl = array( 'hl' => 'en-US');
$query = array( 'q' => '');
$export = false;
$width = array( 'w' => '500');
$heigth = array( 'h' => '300');
$optParams = array();

if ($http->hasGetVariable("q")) {
    $query = array( 'q' => $http->getVariable("q"));
}
$optParams = array_merge($optParams, $query);


if ($http->hasGetVariable("geo")) {
    $geo = array( 'geo' => $http->getVariable("geo"));
}
$optParams = array_merge($optParams, $geo);

if ($http->hasGetVariable("cid")) {
    $cid = array( 'cid' => $http->getVariable("cid"));
}
if ($cid) {
    $optParams = array_merge($optParams, $cid);
}

if ($http->hasGetVariable("hl")) {
    $hl = array( 'hl' => $http->getVariable("hl"));
}
$optParams = array_merge($optParams, $hl);

if ($http->hasGetVariable("export")) {
    $export = array( 'export' => $http->getVariable("export"));
} elseif ($trendsIni->hasVariable($methodSetting, 'ExportDefault')) {
    $export = array( 'export' => $trendsIni->variable($methodSetting, 'ExportDefault'));
}
if ($export) {
    $optParams = array_merge($optParams, $export);
}

if ($http->hasGetVariable("w")) {
    $width = array( 'w' => $http->getVariable("w"));
}
$optParams = array_merge($optParams, $width);

if ($http->hasGetVariable("h")) {
    $heigth = array( 'h' => $http->getVariable("h"));
}
$optParams = array_merge($optParams, $heigth);

if ($http->hasGetVariable("cid")) {
    $cid = array( 'cid' => $http->getVariable("cid"));
} elseif ($trendsIni->hasVariable($methodSetting, 'CidDefault')) {
    $cid = array( 'cid' => $trendsIni->variable($methodSetting, 'CidDefault'));
}
if ($cid) {
    $optParams = array_merge($optParams, $cid);
}
// echo '<script type="text/javascript" src="//www.google.com/trends/embed.js?hl=en-US&q=mode&geo=FR&cmpt=q&content=1&cid=TOP_QUERIES_0_0&export=5&w=300&h=420"></script>';
$results = $service->fetchcomponent->displayHtml($optParams);
// var_dump($results);
