<?php
/**
 * For security reasons, delete, insert, update, and patch are disabled
 * in this abstraction layer
 * @copyright Copyright (C) 2014 Ralantonisainana Dany All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */

namespace eZGoogleApi\ServiceGoogle;

use eZGoogleApi\InterfaceGoogle\eZGoogleServiceInterface;

class eZGoogleAnalytics extends eZGoogleService implements eZGoogleServiceInterface
{
    const REPORTINGCOREGA = 'reportingcorega';
    const REPORTINGCOREMCF = 'reportingcoremcf';
    const REPORTINGCOREREALTIME = 'reportingcorerealtime';
    const MANAGEMENTACCOUNTSUMMARIES = 'accountsummaries';
    const MANAGEMENTACCOUNTUSERLINKS = 'accountuserlinks';
    const MANAGEMENTACCOUNTS = 'accounts';
    const MANAGEMENTCUSTOMDATASOURCES = 'customdatasources';
    // @deprecated
    const MANAGEMENTDAILYUPLOADS = 'dailyuploads';
    const MANAGEMENTEXPERIMENTS = 'experiments';
    const MANAGEMENTFILTERS = 'filters';
    const MANAGEMENTGOALS = 'goals';
    const MANAGEMENTPROFILEFILTERLINKS = 'profilefilterlinks';
    const MANAGEMENTPROFILEUSERLINKS = 'profileuserlinks';
    const MANAGEMENTPROFILES = 'profiles';
    const MANAGEMENTSEGMENTS = 'segments';
    const MANAGEMENTUNSAMPLEDREPORTS = 'unsampledreports';
    const MANAGEMENTUPLOADS = 'uploads';
    const MANAGEMENTWEBPROPERTYADWORDSLINKS = 'webpropertyadwordslinks';
    const MANAGEMENTWEBPROPERTIES = 'webproperties';
    const MANAGEMENTWEBPROPERTYUSERLINKS = 'webpropertyuserlinks';
    const METADATACOLUMNS = 'metadata_columns';
    //@state disabled for security reasons
    const PROVISIONING = 'provisioning';

    public function __construct(\Google_Client $client)
    {
        $this->service    = new \Google_Service_Analytics($client);
    }

    public function setRessource($constant)
    {
        $this->ressource = $constant;
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
     * return the profile view ID in the form ga:xxxxx
     * @date   2015-01-03T18:32:19+0100
     */
    public function getProfileID()
    {
        return $this->parameters['profile_id'];
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
        if (isset($this->parameters['start-index'])) {
            $othersParams['start-index'] = $this->parameters['start-index'];
        }
        if (isset($this->parameters['filters'])) {
            $othersParams['filters'] = $this->parameters['filters'];
        }
        return $othersParams;
    }

    /**
     * @author Dany Ralantonisainana <lendormi1984@gmail.com>
     * @date   2014-12-31T13:43:24+0100
     */
    public function getResults()
    {
        switch ($this->ressource) {
            case eZGoogleAnalytics::REPORTINGCOREGA:
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
            case eZGoogleAnalytics::REPORTINGCOREMCF:
                /**
                 * @return object {@see Google_Service_Analytics_McfData}
                 */
                return $this->service->data_mcf->get(
                    $this->parameters['profile_id'],
                    $this->parameters['start-date'],
                    $this->parameters['end-date'],
                    $this->parameters['metrics'],
                    $this->getOthersParameters()
                )->getRows();
                break;
            case eZGoogleAnalytics::REPORTINGCOREREALTIME:
                /**
                 * @return object {@see Google_Service_Analytics_RealtimeData}
                 */
                return $this->service->data_realtime->get(
                    $this->parameters['profile_id'],
                    $this->parameters['metrics'],
                    $this->getOthersParameters()
                )->getRows();
                break;
            case eZGoogleAnalytics::MANAGEMENTEXPERIMENTS:
                /**
                 * @return object {@see Google_Service_Analytics_Experiment}
                 */
                return $this->service->management_experiments->get(
                    $this->parameters['account_id'],
                    $this->parameters['webproperty_id'],
                    $this->parameters['profile_id'],
                    $this->parameters['experiment_id'],
                    $this->getOthersParameters()
                )->getVariations();
                break;
            case eZGoogleAnalytics::MANAGEMENTEXPERIMENTS:
                return $this->service->management_experiments->get(
                    $this->parameters['account_id'],
                    $this->parameters['webproperty_id'],
                    $this->parameters['profile_id'],
                    $this->parameters['experiment_id'],
                    $this->getOthersParameters()
                )->getVariations();
                break;
            case eZGoogleAnalytics::MANAGEMENTFILTERS:
                /**
                 * @return object {@see Google_Service_Analytics_Filter}
                 */
                return $this->service->management_filters->get(
                    $this->parameters['account_id'],
                    $this->parameters['filter_id'],
                    $this->getOthersParameters()
                );
                break;
            case eZGoogleAnalytics::MANAGEMENTGOALS:
                /**
                 * @return object {@see Google_Service_Analytics_Goal}
                 */
                return $this->service->management_goals->get(
                    $this->parameters['account_id'],
                    $this->parameters['webproperty_id'],
                    $this->parameters['profile_id'],
                    $this->parameters['goal_id'],
                    $this->getOthersParameters()
                )->getId();
                break;
            case eZGoogleAnalytics::MANAGEMENTPROFILEFILTERLINKS:
                /**
                 * @return object {@see Google_Service_Analytics_ProfileFilterLink}
                 */
                return $this->service->management_filters->get(
                    $this->parameters['account_id'],
                    $this->parameters['webproperty_id'],
                    $this->parameters['profile_id'],
                    $this->parameters['link_id'],
                    $this->getOthersParameters()
                )->getId();
                break;
            case eZGoogleAnalytics::MANAGEMENTPROFILES:
                /**
                 * @return object {@see Google_Service_Analytics_Profile}
                 */
                return $this->service->management_profiles->get(
                    $this->parameters['account_id'],
                    $this->parameters['webproperty_id'],
                    $this->parameters['profile_id'],
                    $this->getOthersParameters()
                )->getId();
                break;
            case eZGoogleAnalytics::MANAGEMENTUNSAMPLEDREPORTS:
                /**
                 * @return object {@see Google_Service_Analytics_UnsampledReport}
                 */
                return $this->service->management_unsampledReports->get(
                    $this->parameters['account_id'],
                    $this->parameters['webproperty_id'],
                    $this->parameters['profile_id'],
                    $this->parameters['unsamplereport_id'],
                    $this->getOthersParameters()
                )->getId();
                break;
            case eZGoogleAnalytics::MANAGEMENTUPLOADS:
                /**
                 * @return object {@see Google_Service_Analytics_Upload}
                 */
                return $this->service->management_uploads->get(
                    $this->parameters['account_id'],
                    $this->parameters['webproperty_id'],
                    $this->parameters['customdatasource_id'],
                    $this->parameters['upload_id'],
                    $this->getOthersParameters()
                )->getId();
                break;
            case eZGoogleAnalytics::MANAGEMENTWEBPROPERTYADWORDSLINKS:
                /**
                 * @return object {@see Google_Service_Analytics_EntityAdWordsLink}
                 */
                return $this->service->management_webPropertyAdWordsLinks->get(
                    $this->parameters['account_id'],
                    $this->parameters['webproperty_id'],
                    $this->parameters['webpropertyadwordslink_id'],
                    $this->getOthersParameters()
                )->getId();
                break;
            case eZGoogleAnalytics::MANAGEMENTWEBPROPERTIES:
                /**
                 * @return object {@see Google_Service_Analytics_Webproperty}
                 */
                return $this->service->management_webproperties->get(
                    $this->parameters['account_id'],
                    $this->parameters['webproperty_id'],
                    $this->getOthersParameters()
                )->getId();
                break;
            default:
                # code...
                break;
        }
    }

    public function listResults()
    {
        switch ($this->ressource) {
            case eZGoogleAnalytics::MANAGEMENTACCOUNTSUMMARIES:
                /**
                 * @return object {@see Google_Service_Analytics_AccountSummaries}
                 */
                return $this->service->management_accountSummaries->listManagementAccounts(
                    $this->getOthersParameters()
                )->getItems();
                break;
            case eZGoogleAnalytics::MANAGEMENTACCOUNTUSERLINKS:
                /**
                 * @return object {@see Google_Service_Analytics_EntityUserLinks}
                 */
                return $this->service->management_accountUserLinks->listManagementAccountUserLinks(
                    $this->parameters['account_id'],
                    $this->getOthersParameters()
                )->getItems();
                break;
            case eZGoogleAnalytics::MANAGEMENTACCOUNTS:
                /**
                 * @return object {@see Google_Service_Analytics_Accounts}
                 */
                return $this->service->management_accounts->listManagementAccounts(
                    $this->getOthersParameters()
                )->getItems();
                break;
            case eZGoogleAnalytics::MANAGEMENTCUSTOMDATASOURCES:
                /**
                 * @return object {@see Google_Service_Analytics_Accounts}
                 */
                return $this->service->management_customDataSources->listManagementCustomDataSources(
                    $this->parameters['account_id'],
                    $this->parameters['webproperty_id'],
                    $this->getOthersParameters()
                )->getItems();
                break;
            case eZGoogleAnalytics::MANAGEMENTDAILYUPLOADS:
                /**
                 * @return object {@see Google_Service_Analytics_DailyUploads}
                 */
                return $this->service->management_dailyUploads->listManagementDailyUploads(
                    $this->parameters['account_id'],
                    $this->parameters['webproperty_id'],
                    $this->parameters['custome_datasource_id'],
                    $this->parameters['start-date'],
                    $this->parameters['end-date'],
                    $this->getOthersParameters()
                )->getItems();
                break;
            case eZGoogleAnalytics::MANAGEMENTEXPERIMENTS:
                return $this->service->management_experiments->listManagementExperiments(
                    $this->parameters['account_id'],
                    $this->parameters['webproperty_id'],
                    $this->parameters['profile_id'],
                    $this->getOthersParameters()
                )->getItems();
                break;
            case eZGoogleAnalytics::MANAGEMENTFILTERS:
                /**
                 * @return object {@see Google_Service_Analytics_Filter}
                 */
                return $this->service->management_filters->listManagementFilters(
                    $this->parameters['account_id'],
                    $this->getOthersParameters()
                )->getItems();
                break;
            case eZGoogleAnalytics::MANAGEMENTGOALS:
                /**
                 * @return object {@see Google_Service_Analytics_Goals}
                 */
                return $this->service->management_goals->listManagementGoals(
                    $this->parameters['account_id'],
                    $this->parameters['webproperty_id'],
                    $this->parameters['profile_id'],
                    $this->getOthersParameters()
                )->getItems();
                break;
            case eZGoogleAnalytics::MANAGEMENTPROFILEFILTERLINKS:
                /**
                 * @return object {@see Google_Service_Analytics_ProfileFilterLinks}
                 */
                return $this->service->management_filters->listManagementProfileFilterLinks(
                    $this->parameters['account_id'],
                    $this->parameters['webproperty_id'],
                    $this->parameters['profile_id'],
                    $this->getOthersParameters()
                )->getItems();
                break;
            case eZGoogleAnalytics::MANAGEMENTPROFILEUSERLINKS:
                /**
                 * @return object {@see Google_Service_Analytics_EntityUserLinks}
                 */
                return $this->service->management_profileUserLinks->listManagementProfileUserLinks(
                    $this->parameters['account_id'],
                    $this->parameters['webproperty_id'],
                    $this->parameters['profile_id'],
                    $this->getOthersParameters()
                )->getItems();
                break;
            case eZGoogleAnalytics::MANAGEMENTPROFILES:
                /**
                 * @return object {@see Google_Service_Analytics_Profiles}
                 */
                return $this->service->management_profiles->listManagementProfiles(
                    $this->parameters['account_id'],
                    $this->parameters['webproperty_id'],
                    $this->getOthersParameters()
                )->getItems();
                break;
            case eZGoogleAnalytics::MANAGEMENTSEGMENTS:
                /**
                 * @return object {@see Google_Service_Analytics_Segments}
                 */
                return $this->service->management_segments->listManagementSegments(
                    $this->getOthersParameters()
                )->getItems();
                break;
            case eZGoogleAnalytics::MANAGEMENTUNSAMPLEDREPORTS:
                /**
                 * @return object {@see Google_Service_Analytics_UnsampledReports}
                 */
                return $this->service->management_unsampledReports->listManagementUnsampledReports(
                    $this->parameters['account_id'],
                    $this->parameters['webproperty_id'],
                    $this->parameters['profile_id'],
                    $this->getOthersParameters()
                )->getItems();
                break;
            case eZGoogleAnalytics::MANAGEMENTUPLOADS:
                /**
                 * @return object {@see Google_Service_Analytics_Uploads}
                 */
                return $this->service->management_uploads->listManagementUploads(
                    $this->parameters['account_id'],
                    $this->parameters['webproperty_id'],
                    $this->parameters['customdatasource_id'],
                    $this->getOthersParameters()
                )->getItems();
                break;
            case eZGoogleAnalytics::MANAGEMENTWEBPROPERTYADWORDSLINKS:
                /**
                 * @return object {@see Google_Service_Analytics_EntityAdWordsLink}
                 */
                return $this->service->management_webPropertyAdWordsLinks->listManagementWebPropertyAdWordsLinks(
                    $this->parameters['account_id'],
                    $this->parameters['webproperty_id'],
                    $this->getOthersParameters()
                )->getItems();
                break;
            case eZGoogleAnalytics::MANAGEMENTWEBPROPERTIES:
                /**
                 * @return object {@see Google_Service_Analytics_Webproperties}
                 */
                return $this->service->management_webproperties->listManagementWebproperties(
                    $this->parameters['account_id'],
                    $this->parameters['webproperty_id'],
                    $this->getOthersParameters()
                )->getItems();
                break;
            case eZGoogleAnalytics::MANAGEMENTWEBPROPERTYUSERLINKS:
                /**
                 * @return object {@see Google_Service_Analytics_EntityUserLinks}
                 */
                return $this->service->management_webpropertyUserLinks->listManagementWebpropertyUserLinks(
                    $this->parameters['account_id'],
                    $this->parameters['webproperty_id'],
                    $this->getOthersParameters()
                )->getItems();
                break;
            case eZGoogleAnalytics::METADATACOLUMNS:
                /**
                 * @return object {@see Google_Service_Analytics_Columns}
                 */
                return $this->service->metadata_columns->listMetadataColumns(
                    $this->parameters['report_type'],
                    $this->getOthersParameters()
                )->getItems();
                break;
            default:
                # code...
                break;
        }
    }
}
