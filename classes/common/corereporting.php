<?php
/**
 * @copyright Copyright (C) 2014 Ralantonisainana Dany All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 * @see https://developers.google.com/analytics/devguides/reporting/core/v3/common-queries
 */

namespace eZGoogleApi\Common;

use eZGoogleApi\ServiceGoogle\eZGoogleAnalytics;

class CoreReporting
{
    /**
     * This query returns the total users and pageviews for the specified time period.
     * Note that this query doesn't require any dimensions.
     */
    public static function userAndPageViewsOverTime(eZGoogleAnalytics $service)
    {
        $service->setMetrics('ga:users,ga:pageviews');
        return $service->getResults();
    }

    /**
     * This query returns some information about sessions which occurred from mobile devices.
     * Note that "Mobile Traffic" is defined using the default segment ID -14.
     */
    public static function mobileTraffic(eZGoogleAnalytics $service)
    {
        $service->setMetrics('ga:sessions,ga:pageviews,ga:sessionDuration');
        $service->setParameter('dimensions', 'ga:mobileDeviceInfo,ga:source');
        $service->setParameter('segment', 'gaid::-14');
        return $service->getResults();
    }
    /**
     * This query returns campaign and site usage data for campaigns that led to more than one purchase through your site.
     */
    public static function revenueGeneratingCampaigns(eZGoogleAnalytics $service)
    {
        $service->setMetrics('ga:sessions,ga:pageviews,ga:sessionDuration,ga:bounces');
        $service->setParameter('dimensions', 'ga:source,ga:medium');
        $service->setParameter('segment', 'dynamic::ga:transactions>1');
        return $service->getResults();
    }
    /**
     * This query returns the number of new sessions vs returning sessions.
     */
    public static function newsVsReturningSessions(eZGoogleAnalytics $service)
    {
        $service->setMetrics('ga:sessions');
        $service->setParameter('dimensions', 'ga:userType');
        return $service->getResults();
    }
    /**
     * This query returns a breakdown of your sessions by country, sorted by number of sessions.
     */
    public static function sessionByCountry(eZGoogleAnalytics $service)
    {
        $service->setMetrics('ga:sessions');
        $service->setParameter('dimensions', 'ga:country');
        $service->setParameter('sort', '-ga:sessions');
        return $service->getResults();
    }
    /**
     * This query returns a breakdown of sessions by the Operating System, web browser, and browser version used.
     */
    public static function browserAndOperatingSystem(eZGoogleAnalytics $service)
    {
        $service->setMetrics('ga:sessions');
        $service->setParameter('dimensions', 'ga:operatingSystem,ga:operatingSystemVersion,ga:browser,ga:browserVersion');
        return $service->getResults();
    }
    /**
     * This query returns the number of sessions and total time on site, which can be used to calculate average time on site.
     */
    public static function timeOnSite(eZGoogleAnalytics $service)
    {
        $service->setMetrics('ga:sessions,ga:sessionDuration');
        return $service->getResults();
    }
    /**
     * This query returns the site usage data broken down by source and medium, sorted by sessions in descending order.
     */
    public static function allTrafficSourceUsage(eZGoogleAnalytics $service)
    {
        $service->setMetrics('ga:sessions,ga:pageviews,ga:sessionDuration,ga:exits');
        $service->setParameter('dimensions', 'ga:source,ga:medium');
        $service->setParameter('sort', '-ga:sessions');
        return $service->getResults();
    }
    /**
     * This query returns data for the first and all goals defined, sorted by total goal completions in descending order.
     */
    public static function allTrafficSourceGoals(eZGoogleAnalytics $service)
    {
        $service->setMetrics('ga:sessions,ga:goal1Starts,ga:goal1Completions,ga:goal1Value,ga:goalStartsAll,ga:goalCompletionsAll,ga:goalValueAll');
        $service->setParameter('dimensions', 'ga:source,ga:medium');
        $service->setParameter('sort', '-ga:goalCompletionsAll');
        return $service->getResults();
    }
    /**
     * This query returns information on revenue generated through the site for the given time span, sorted by sessions in descending order.
     */
    public static function allTrafficSourceEcommerce(eZGoogleAnalytics $service)
    {
        $service->setMetrics('ga:sessions,ga:transactionRevenue,ga:transactions,ga:uniquePurchases');
        $service->setParameter('dimensions', 'ga:source,ga:medium');
        $service->setParameter('sort', '-ga:sessions');
        return $service->getResults();
    }
    /**
     * This query returns a list of domains and how many sessions each referred to your site, sorted by pageviews in descending order.
     */
    public static function referringSite(eZGoogleAnalytics $service)
    {
        $service->setMetrics('ga:pageviews,ga:sessionDuration,ga:exits');
        $service->setParameter('dimensions', 'ga:source');
        $service->setParameter('filters', 'ga:medium==referral');
        $service->setParameter('sort', '-ga:pageviews');
        return $service->getResults();
    }
    /**
     * This query returns site usage data for all traffic by search engine, sorted by pageviews in descending order.
     */
    public static function searchEngines(eZGoogleAnalytics $service)
    {
        $service->setMetrics('ga:pageviews,ga:sessionDuration,ga:exits');
        $service->setParameter('dimensions', 'ga:source');
        $service->setParameter('filters', 'ga:medium==cpa,ga:medium==cpc,ga:medium==cpm,ga:medium==cpp,ga:medium==cpv,ga:medium==organic,ga:medium==ppc');
        $service->setParameter('sort', '-ga:pageviews');
        return $service->getResults();
    }
    /**
     * This query returns site usage data for organic traffic by search engine, sorted by pageviews in descending order.
     */
    public static function searchEnginesOrganicSearch(eZGoogleAnalytics $service)
    {
        $service->setMetrics('ga:pageviews,ga:sessionDuration,ga:exits');
        $service->setParameter('dimensions', 'ga:source');
        $service->setParameter('filters', 'ga:medium==organic');
        $service->setParameter('sort', '-ga:pageviews');
        return $service->getResults();
    }
    /**
     * This query returns site usage data for paid traffic by search engine, sorted by pageviews in descending order.
     */
    public static function searchEnginesPaidSearch(eZGoogleAnalytics $service)
    {
        $service->setMetrics('ga:pageviews,ga:sessionDuration,ga:exits');
        $service->setParameter('dimensions', 'ga:source');
        $service->setParameter('filters', 'ga:medium==cpa,ga:medium==cpc,ga:medium==cpm,ga:medium==cpp,ga:medium==cpv,ga:medium==ppc');
        $service->setParameter('sort', '-ga:pageviews');
        return $service->getResults();
    }
    /**
     * This query returns sessions broken down by search engine keywords used, sorted by sessions in descending order.
     */
    public static function keywords(eZGoogleAnalytics $service)
    {
        $service->setMetrics('ga:sessions');
        $service->setParameter('dimensions', 'ga:keyword');
        $service->setParameter('sort', '-ga:sessions');
        return $service->getResults();
    }
    /**
     * This query returns your most popular content, sorted by most pageviews.
     */
    public static function topContent(eZGoogleAnalytics $service)
    {
        $service->setMetrics('ga:pageviews,ga:uniquePageviews,ga:timeOnPage,ga:bounces,ga:entrances,ga:exits');
        $service->setParameter('dimensions', 'ga:pagePath');
        $service->setParameter('sort', '-ga:pageviews');
        return $service->getResults();
    }
    /**
     * This query returns your most popular landing pages, sorted by entrances in descending order.
     */
    public static function topLandingPage(eZGoogleAnalytics $service)
    {
        $service->setMetrics('ga:entrances,ga:bounces');
        $service->setParameter('dimensions', 'ga:landingPagePath');
        $service->setParameter('sort', '-ga:entrances');
        return $service->getResults();
    }
    /**
     * This query returns your most common exit pages, sorted by exits in descending order.
     */
    public static function topExitPage(eZGoogleAnalytics $service)
    {
        $service->setMetrics('ga:exits,ga:pageviews');
        $service->setParameter('dimensions', 'ga:exitPagePath');
        $service->setParameter('sort', '-ga:exits');
        return $service->getResults();
    }
    /**
     * This query returns the number of sessions broken down by internal site search,
     * sorted by number of unique searches for a keyword in descending order.
     */
    public static function searchTerms(eZGoogleAnalytics $service)
    {
        $service->setMetrics('ga:searchUniques');
        $service->setParameter('dimensions', 'ga:searchKeyword');
        $service->setParameter('sort', '-ga:searchUniques');
        return $service->getResults();
    }
    /**
     * This query returns data on battles fought between Ken and Ryu,
     * sorted by number of fireballs thrown in descending order.
     */
    public static function kenVsRyu(eZGoogleAnalytics $service)
    {
        $service->setMetrics('ga:roundsWon,ga:punches,ga:kicks');
        $service->setParameter('dimensions', 'ga:fighterName1,ga:fighterName2');
        $service->setParameter('filters', 'ga:fighterName1==Ken,ga:fighterName2==Ken;ga:fighterName1==Ryu,ga:fighterName2==Ryu');
        $service->setParameter('sort', '-ga:fireballs');
        return $service->getResults();
    }
}
