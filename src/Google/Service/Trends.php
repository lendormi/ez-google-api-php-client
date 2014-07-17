<?php
/*
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

/**
 * Service trends for Trends (v1).
 *
 * <p>
 * View and manage Google ATrends
 * </p>
 *
 * @author Dany Ralantonisainana <lendormi1984@gmail.com>
 */
class Google_Service_Trends extends Google_Service
{
    /** View and manage Google Trends. */
    const TRENDS = "http://www.google.fr/trends/";
    /**
     * Constructs the internal representation of the Pagespeedonline service.
     *
     * @param Google_Client $client
     */
    public function __construct(Google_Client $client)
    {
        parent::__construct($client);
        $this->servicePath = self::TRENDS;
        $this->version = '0.1';
        $this->serviceName = 'trends';

        $this->hottrends = new Google_Service_Trends_Hottrends_Resource(
            $this,
            $this->serviceName,
            'hottrends',
            array(
                'methods' => array(
                    'get' => array(
                        'path' => 'hottrends/hotItems',
                        'httpMethod' => 'GET',
                        'parameters' => array(
                            'ajax' => array(
                                'location' => 'query',
                                'type' => 'integer',
                                'required' => true,
                            ),
                            'htd' => array(
                                'location' => 'query',
                                'type' => 'string',
                            ),
                            'pn' => array(
                                'location' => 'query',
                                'type' => 'string',
                            ),
                            'htv' => array(
                                'location' => 'query',
                                'type' => 'integer',
                            )
                        ),
                    ),
                )
            )
        );
        $this->topcategorycharts = new Google_Service_Trends_Topcharts_Category_Resource(
            $this,
            $this->serviceName,
            'topcategorycharts',
            array(
                'methods' => array(
                    'get' => array(
                        'path' => 'topcharts/category',
                        'httpMethod' => 'GET',
                        'parameters' => array(
                            'ajax' => array(
                                'location' => 'query',
                                'type' => 'integer',
                                'required' => true,
                            ),
                            'geo' => array(
                                'location' => 'query',
                                'type' => 'string',
                            ),
                            'date' => array(
                                'location' => 'query',
                                'type' => 'string',
                            ),
                            'cat' => array(
                                'location' => 'query',
                                'type' => 'integer',
                            ),
                            'tn' => array(
                                'location' => 'query',
                                'type' => 'integer',
                            )
                        ),
                    ),
                )
            )
        );
        $this->toptrendingchart = new Google_Service_Trends_Topcharts_TrendingChart_Resource(
            $this,
            $this->serviceName,
            'toptrendingchart',
            array(
                'methods' => array(
                    'get' => array(
                        'path' => 'topcharts/trendingchart',
                        'httpMethod' => 'GET',
                        'parameters' => array(
                            'ajax' => array(
                                'location' => 'query',
                                'type' => 'integer',
                                'required' => true,
                            ),
                            'cid' => array(
                                'location' => 'query',
                                'type' => 'string',
                            ),
                            'geo' => array(
                                'location' => 'query',
                                'type' => 'string',
                            ),
                            'date' => array(
                                'location' => 'query',
                                'type' => 'string',
                            ),
                            'cat' => array(
                                'location' => 'query',
                                'type' => 'integer',
                            ),
                            'tn' => array(
                                'location' => 'query',
                                'type' => 'integer',
                            )
                        ),
                    ),
                )
            )
        );
        $this->fetchcomponent = new Google_Service_Trends_FetchComponent_Resource(
            $this,
            $this->serviceName,
            'fetchcomponent',
            array(
                'methods' => array(
                    'get' => array(
                        'path' => 'fetchComponent',
                        'httpMethod' => 'GET',
                        'parameters' => array(
                            'q' => array(
                                'location' => 'query',
                                'type' => 'string',
                                'required' => true,
                            ),
                            'cid' => array(
                                'location' => 'query',
                                'type' => 'string',
                            ),
                            'geo' => array(
                                'location' => 'query',
                                'type' => 'string',
                            ),
                            'hl' => array(
                                'location' => 'query',
                                'type' => 'string',
                            ),
                            'export' => array(
                                'location' => 'query',
                                'type' => 'integer',
                            ),
                            'w' => array(
                                'location' => 'query',
                                'type' => 'integer',
                            ),
                            'h' => array(
                                'location' => 'query',
                                'type' => 'integer',
                            )
                        ),
                    ),
                )
            )
        );
    }
}

class Google_Service_Trends_Hottrends_Resource extends Google_Service_Resource
{
    /**
     * [hotItems description]
     * @param  array  $optParams [description]
     * htd => yyyymmdd
     * pn => 'p16' correspond to France
     * htv => 'l'
     * @return [type]            [description]
     */
    public function hotItems($optParams = array())
    {
        $params = array(
            'ajax' => 1
        );
        $params = array_merge($params, $optParams);
        return $this->call('get', array($params), "Google_Service_Trends_Hottrends_Result");
    }
}

class Google_Service_Trends_Hottrends_Result extends Google_Model
{
    protected $trendsByDateListType = 'Google_Service_Trends_Hottrends_Data';
    protected $trendsByDateListDataType = 'array';

    public function getSummaryMessage()
    {
        return $this->summaryMessage;
    }

    public function getDateUpdate()
    {
        return date("Y-m-d h:i:s", $this->dataUpdateTime);
    }

    public function getTrendsByDateList()
    {
        return $this->trendsByDateList;
    }

    public function setTrendsByDate(Google_Service_Trends_Hottrends_Data $trendsByDateList)
    {
        $this->trendsByDateList = $trendsByDateList;
    }
}

class Google_Service_Trends_Hottrends_Data extends Google_Collection
{
    protected $trendsListType = "Google_Service_Trends_Hottrends_Data_TrendsList";
    protected $trendsListDataType = "array";

    public function getDate()
    {
        return $this->date;
    }

    public function getFormattedDate()
    {
        return $this->formattedDate;
    }

    public function getTrendsList()
    {
        return $this->trendsList;
    }

    public function setTrends(Google_Service_Trends_Hottrends_Data_TrendsList $trendsList)
    {
        $this->trendsList = $trendsList;
    }
}

class Google_Service_Trends_Hottrends_Data_TrendsList extends Google_Model
{
    public function getTitle()
    {
        return $this->title;
    }

    public function getTitleLinkUrl()
    {
        return $this->titleLinkUrl;
    }

    public function getRelatedSearchesList()
    {
        return $this->relatedSearchesList;
    }

    public function getFormattedTraffic()
    {
        return $this->formattedTraffic;
    }

    public function getTrafficBucketLowerBound()
    {
        return $this->trafficBucketLowerBound;
    }

    public function getHotnessLevel()
    {
        return $this->hotnessLevel;
    }

    public function getHotnessColor()
    {
        return $this->hotnessColor;
    }

    public function getImgUrl()
    {
        return $this->imgUrl;
    }

    public function getImgSource()
    {
        return $this->imgSource;
    }

    public function getImgLinkUrl()
    {
        return $this->imgLinkUrl;
    }

    public function getNewsArticlesList()
    {
        return $this->newsArticlesList;
    }

    public function getStartTime()
    {
        return $this->startTime;
    }

    public function getShareUrl()
    {
        return $this->shareUrl;
    }

    public function getDate()
    {
        return $this->date;
    }
}

class Google_Service_Trends_Topcharts_Category_Resource extends Google_Service_Resource
{
    public function category($optParams = array())
    {
        $params = array(
            'ajax' => 1
        );
        $params = array_merge($params, $optParams);
        return $this->call('get', array($params), "Google_Service_Trends_Topcharts_Category_Result");
    }
}

class Google_Service_Trends_Topcharts_Category_Result extends Google_Model
{
    protected $dataType = 'Google_Service_Trends_Topcharts_Data';
    protected $dataDataType = 'array';
    // protected $chartListType = 'Google_Service_Trends_Topcharts_Data_ChartList';
    // protected $chartListDataType = 'array';

    public function getID()
    {
        return $this->id;
    }

    public function setID($id)
    {
        $this->id = $id;
    }

    public function getVisibleName()
    {
        return $this->visibleName;
    }

    public function setVisibleName($visibleName)
    {
        $this->visibleName = $visibleName;
    }

    public function getLastPage()
    {
        return $this->lastPage;
    }

    public function setLastPage($lastPage)
    {
        $this->lastPage = $lastPage;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getChartList()
    {
        return $this->getData()->getChartList();
    }

    // public function setData(Google_Service_Trends_Topcharts_Data_ChartList $trendsByDateList)
    // public function setData(Google_Service_Trends_Topcharts_Data $chartList)
    // {
    //     $this->data['chartList'] = $chartList;
    // }
}

class Google_Service_Trends_Topcharts_Data extends Google_Model
{
    protected $chartListType = 'Google_Service_Trends_Topcharts_Data_ChartList';
    protected $chartListDataType = 'array';

    protected $entityListType = 'Google_Service_Trends_Topcharts_Data_ChartList_TrendingChart_EntityList';
    protected $entityListDataType = 'array';

    public function getEntityList()
    {
        return $this->entityList;
    }

    public function setEntityList(Google_Service_Trends_Topcharts_Data_ChartList_TrendingChart_EntityList $entityList)
    {
        $this->entityList = $entityList;
    }

    public function getChartList()
    {
        return $this->chartList;
    }

    public function setChartList(Google_Service_Trends_Topcharts_Data_ChartList $chartList)
    {
        $this->chartList = $chartList;
    }
}

class Google_Service_Trends_Topcharts_Data_ChartList extends Google_Model
{
    protected $trendingChartType = 'Google_Service_Trends_Topcharts_Data_ChartList_TrendingChart';
    protected $trendingChartDataType = 'array';
    protected $topChartType = 'Google_Service_Trends_Topcharts_Data_ChartList_TopChart';
    protected $topChartDataType = 'array';

    public function getChart()
    {
        return $this->getTrendingChart() ? $this->getTrendingChart() : $this->getTopChart();
    }

    public function getTrendingChart()
    {
        return isset($this->trendingChart) ? $this->trendingChart : false;
    }

    public function setTrendingChart(Google_Service_Trends_Topcharts_Data_ChartList_TrendingChart $trendingChart)
    {
        $this->trendingChart = $trendingChart;
    }

    public function getTopChart()
    {
        return isset($this->topChart) ? $this->topChart : false;
    }

    public function setTopChart(Google_Service_Trends_Topcharts_Data_ChartList_TopChart $topChart)
    {
        $this->topChart = $topChart;
    }

    public function getID()
    {
        return $this->id;
    }

    public function setID($id)
    {
        $this->id = $id;
    }

    public function getVisibleName()
    {
        return $this->visibleName;
    }

    public function setVisibleName($visibleName)
    {
        $this->visibleName = $visibleName;
    }

    public function getShareUrl()
    {
        return $this->shareUrl;
    }

    public function getTwitterShareUrlTitle()
    {
        return $this->twitterShareUrlTitle;
    }
}

class Google_Service_Trends_Topcharts_Data_ChartList_TrendingChart extends Google_Model
{
    protected $entityListType = 'Google_Service_Trends_Topcharts_Data_ChartList_TrendingChart_EntityList';
    protected $entityListDataType = 'array';
    
    public function getId()
    {
        return $this->id;
    }

    public function getEntityList()
    {
        return $this->entityList;
    }

    public function getName()
    {
        return $this->visibleName;
    }

    public function getShareUrl()
    {
        return $this->shareUrl;
    }

    public function getTwitterShareUrlTitle()
    {
        return $this->twitterShareUrlTitle;
    }

    public function getEntityWithImageInfoIndexList()
    {
        return $this->entityWithImageInfoIndexList;
    }

    public function getHasTopChart()
    {
        return $this->hasTopChart;
    }
}

class Google_Service_Trends_Topcharts_Data_ChartList_TopChart extends Google_Model
{
    protected $entityListType = 'Google_Service_Trends_Topcharts_Data_ChartList_TopChart_EntityList';
    protected $entityListDataType = 'array';

    public function getId()
    {
        return $this->id;
    }

    public function getEntityList()
    {
        return $this->entityList;
    }

    public function getName()
    {
        return $this->visibleName;
    }

    public function getShareUrl()
    {
        return $this->shareUrl;
    }

    public function getTwitterShareUrlTitle()
    {
        return $this->twitterShareUrlTitle;
    }

    public function getHasTrendingChart()
    {
        return $this->hasTrendingChart;
    }
}

class Google_Service_Trends_Topcharts_Data_ChartList_TrendingChart_EntityList extends Google_Model
{
    protected $entityListType = 'Google_Service_Trends_Topcharts_Data_ChartList_TrendingChart_EntityList_ImageInfo';
    protected $entityListDataType = 'array';

    public function getTitle()
    {
        return $this->title;
    }

    public function getImageInfo()
    {
        return $this->imageInfo;
    }

    public function getShareUrl()
    {
        return $this->shareUrl;
    }

    public function getTwitterShareUrlTitle()
    {
        return $this->twitterShareUrlTitle;
    }

    public function getIdForTracking()
    {
        return $this->idForTracking;
    }

    public function getExploreUrl()
    {
        return $this->exploreUrl;
    }

    public function getJumpFactorSummary()
    {
        return $this->jumpFactorSummary;
    }

    public function getTitleLinkUrl()
    {
        return $this->titleLinkUrl;
    }
}

class Google_Service_Trends_Topcharts_Data_ChartList_TrendingChart_EntityList_ImageInfo extends Google_Model
{
    public function getUrl()
    {
        return $this->url;
    }

    public function getImageSource()
    {
        return $this->imageSource;
    }

    public function getImageSourceUrl()
    {
        return $this->imageSourceUrl;
    }
}

class Google_Service_Trends_Topcharts_Data_ChartList_TopChart_EntityList extends Google_Model
{
    public function getTitle()
    {
        return $this->title;
    }

    public function getDeltaSummary()
    {
        return $this->deltaSummary;
    }

    public function getHotnessLevel()
    {
        return $this->hotnessLevel;
    }

    public function getHotnessColor()
    {
        return $this->hotnessColor;
    }

    public function getShareUrl()
    {
        return $this->shareUrl;
    }

    public function getTwitterShareUrlTitle()
    {
        return $this->twitterShareUrlTitle;
    }

    public function getIdForTracking()
    {
        return $this->idForTracking;
    }

    public function getExploreUrl()
    {
        return $this->exploreUrl;
    }

    public function getTitleLinkUrl()
    {
        return $this->titleLinkUrl;
    }
}

class Google_Service_Trends_Topcharts_TrendingChart_Resource extends Google_Service_Resource
{
    /**
     * [hotItems description]
     * @param  array  $optParams [description]
     * htd => yyyymmdd
     * pn => 'p16' correspond to France
     * htv => 'l'
     * @return [type]            [description]
     */
    public function trendingchart($optParams = array())
    {
        $params = array(
            'ajax' => 1
        );
        $params = array_merge($params, $optParams);
        return $this->call('get', array($params), "Google_Service_Trends_Topcharts_TrendingChart_Result");
    }
}

class Google_Service_Trends_Topcharts_TrendingChart_Result extends Google_Model
{
    protected $dataType = 'Google_Service_Trends_Topcharts_Data';
    protected $dataDataType = 'array';

    public function getData()
    {
        return $this->data;
    }

    public function getEntityList()
    {
        return $this->getData()->getEntityList();
    }

    public function getSummaryMessage()
    {
        return $this->summaryMessage;
    }
    public function getPrevTimePeriod()
    {
        return $this->prevTimePeriod;
    }
    public function getNextTimePeriod()
    {
        return $this->nextTimePeriod;
    }
    public function getIsMonthlyTimePeriod()
    {
        return $this->isMonthlyTimePeriod;
    }
    public function getPageTitle()
    {
        return $this->pageTitle;
    }
    public function getShowEmbedButton()
    {
        return $this->showEmbedButton;
    }
    public function getGeo()
    {
        return $this->geo;
    }
    public function getDate()
    {
        return $this->date;
    }
    public function getShowSubscribeButton()
    {
        return $this->showSubscribeButton;
    }
    public function getMobileSubscribeIconSrc()
    {
        return $this->mobileSubscribeIconSrc;
    }
}

class Google_Service_Trends_FetchComponent_Resource extends Google_Service_Resource
{
    /**
     * [hotItems description]
     * @param  array  $optParams [description]
     * hl en-US
     * q keywords
     * geo FR
     * cid format display (optional)
     * export 5 (optional)
     * w width (optional)
     * h height (optional)
     * @return [type]            [description]
     */
    public function displayHtml($optParams)
    {
        return $this->callHtml('get', array($optParams), "Google_Service_Trends_FetchComponent_Result");
    }
}

class Google_Service_Trends_FetchComponent_Result extends Google_Model
{
}
