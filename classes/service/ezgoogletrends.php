<?php
/**
 * @copyright Copyright (C) 2014 Ralantonisainana Dany All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace eZGoogleApi\ServiceGoogle;

use eZGoogleApi\InterfaceGoogle\eZGoogleServiceInterface;

class eZGoogleTrends extends eZGoogleService implements eZGoogleServiceInterface
{
    public function __construct(\Google_Client $client)
    {
        $this->service    = new \Google_Service_Trends($client);
    }
}
