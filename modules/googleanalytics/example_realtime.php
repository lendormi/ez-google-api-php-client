<?php
/**
 * @author Dany RALANTONISAINANA <lendormi1984@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2 (or any later version)
 * @version 1.0.0
 */
use eZGoogleApi\Kernel\eZGoogleApi;
use eZGoogleApi\ServiceGoogle\eZGoogleAnalytics;
use eZGoogleApi\Common\CoreReporting;

$http               = \eZHTTPTool::instance();
$profileID          = $Params['profile_id'];
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
$service->setRessource('reportingcorerealtime');
$service->setProfileID($profileID);
$service->setMetrics('rt:activeUsers');
$service->setParameter('dimensions', 'rt:medium');
$result = $service->getResults();
var_dump($result);
die();
echo json_encode(array( 'result' => $result ));
\eZExecution::cleanExit();
