<?php
/**
 * @copyright Copyright (C) 2014 Ralantonisainana Dany All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */

namespace eZGoogleApi\ServiceGoogle;

use eZGoogleApi\InterfaceGoogle\eZGoogleServiceInterface;

class eZGoogleAnalytics extends eZGoogleService implements eZGoogleServiceInterface
{
    public function __construct(\Google_Client $client)
    {
        $this->service    = new \Google_Service_Analytics($client);
    }

    public function setScope($constant)
    {
        $this->scopes = $constant;
    }

    /**
     * Unique table ID for retrieving Analytics data. Table ID is
     * of the form ga:XXXX, where XXXX is the Analytics view (profile) ID.
     * @author Dany Ralantonisainana <lendormi1984@gmail.com>
     * @date   2014-12-31T12:44:15+0100
     */
    public function setProfileID($id)
    {
        $this->parameters['profile_id'] = 'ga:'.$id;
    }

    /**
     * @param string $startDate Start date for fetching Analytics data. Requests can
     * specify a start date formatted as YYYY-MM-DD, or as a relative date (e.g.,
     * today, yesterday, or 7daysAgo). The default value is 7daysAgo.
     * @param string $endDate End date for fetching Analytics data. Request can
     * should specify an end date formatted as YYYY-MM-DD, or as a relative date
     * (e.g., today, yesterday, or 7daysAgo). The default value is yesterday.
     * @param  [type]                   $startDate [description]
     * @param  [type]                   $endDate   [description]
     * @author Dany Ralantonisainana <lendormi1984@gmail.com>
     * @date   2014-12-31T12:52:54+0100
     */
    public function setPeriod($startDate, $endDate = "")
    {
        $this->parameters['start-date'] = $startDate;
        $this->parameters['end-date'] = $endDate;
    }
    /**
     * A comma-separated list of Analytics metrics. E.g.,
     * 'ga:sessions,ga:pageviews'. At least one metric must be specified.
     * @param  [type]                   $metrics [description]
     * @author Dany Ralantonisainana <lendormi1984@gmail.com>
     * @date   2014-12-31T13:40:28+0100
     * @see {@link https://developers.google.com/analytics/devguides/reporting/core/dimsmets}
     */
    public function setMetrics($metrics)
    {
        $this->parameters['metrics'] = $metrics;
    }
    /**
     * @opt_param int max-results The maximum number of entries to include in this
     * feed.
     * @opt_param string sort A comma-separated list of dimensions or metrics that
     * determine the sort order for Analytics data.
     * @opt_param string dimensions A comma-separated list of Analytics dimensions.
     * E.g., 'ga:browser,ga:city'.
     * @opt_param int start-index An index of the first entity to retrieve. Use this
     * parameter as a pagination mechanism along with the max-results parameter.
     * @opt_param string segment An Analytics segment to be applied to data.
     * @opt_param string samplingLevel The desired sampling level.
     * @opt_param string filters A comma-separated list of dimension or metric
     * filters to be applied to Analytics data.
     * @opt_param string output The selected format for the response. Default format
     * is JSON.
     * @author Dany Ralantonisainana <lendormi1984@gmail.com>
     * @date   2014-12-31T13:42:56+0100
     */
    public function setParameter($key, $value)
    {
        parent::setParameter($key, $value);
    }

    public function getOthersParameters()
    {
        $othersParams = array();
        if (isset($this->parameters['dimensions'])) {
            $othersParams['dimensions'] = $this->parameters['dimensions'];
        }
        if (isset($this->parameters['sort'])) {
            $othersParams['sort'] = $this->parameters['sort'];
        }
        if (isset($this->parameters['max-results'])) {
            $othersParams['max-results'] = $this->parameters['max-results'];
        }
        return $othersParams;
    }

    /**
     * @author Dany Ralantonisainana <lendormi1984@gmail.com>
     * @date   2014-12-31T13:43:24+0100
     */
    public function getResults()
    {
        switch ($this->scopes) {
            case \Google_Service_Analytics::ANALYTICS_READONLY:
                /**
                 * @return object {@see Google_Service_Analytics_GaData}
                 */
                return $this->service->data_ga->get(
                    $this->parameters['profile_id'],
                    $this->parameters['start-date'],
                    $this->parameters['end-date'],
                    $this->parameters['metrics'],
                    $this->getOthersParameters()
                )->getRows();
                break;
            
            default:
                # code...
                break;
        }
    }
}
