<?php
/**
 * @author Dany RALANTONISAINANA <lendormi1984@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2 (or any later version)
 * @version 1.0.0
 */
use eZGoogleApi\Kernel\eZGoogleApi;
use eZGoogleApi\ServiceGoogle\eZGoogleCustomSearch;
use eZGoogleApi\Common\CoreReporting;

$http = \eZHTTPTool::instance();
$googleApiIni = \eZINI::instance('googleapi.ini');

$googleapi = new eZGoogleApi(
    'public',
    array()
);

// create service and get data
$service = eZGoogleCustomSearch::getService($googleapi->client);
$service->setParameter('q', 'grazia');
$result = $service->getResults();
var_dump($result);
die();
echo json_encode(array( 'result' => $result ));
\eZExecution::cleanExit();
