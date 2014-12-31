<?php
/**
 * For security reasons, delete, insert, update, and patch are disabled
 * in this abstraction layer
 * @copyright Copyright (C) 2014 Ralantonisainana Dany All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */

namespace eZGoogleApi\ServiceGoogle;

use eZGoogleApi\InterfaceGoogle\eZGoogleServiceInterface;

class eZGooglePageSpeed extends eZGoogleService implements eZGoogleServiceInterface
{
    public function __construct(\Google_Client $client)
    {
        $this->service    = new \Google_Service_Pagespeedonline($client);
    }

    /**
     * @author Dany Ralantonisainana <lendormi1984@gmail.com>
     * @date   2014-12-31T13:43:24+0100
     */
    public function getResults()
    {
        $pagespeed = $this->service->pagespeedapi->runpagespeed(
            $this->parameters['url'],
            $this->getOthersParameters()
        );
        return array(
            'title' => $pagespeed->getScore(),
            'score' => $pagespeed->getTitle(),
            'stats' => $pagespeed->getPageStats()
        );
    }
}
