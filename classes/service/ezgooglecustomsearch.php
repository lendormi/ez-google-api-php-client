<?php
/**
 * @copyright Copyright (C) 2014 Ralantonisainana Dany All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace eZGoogleApi\ServiceGoogle;

use eZGoogleApi\InterfaceGoogle\eZGoogleServiceInterface;

class eZGoogleCustomSearch extends eZGoogleService implements eZGoogleServiceInterface
{
    public function __construct(\Google_Client $client)
    {
        $this->service    = new \Google_Service_Customsearch($client);
    }

    public function getResults()
    {
        $search = $this->service->cse->listCse(
            $this->parameters['q'],
            $this->getOthersParameters()
        );
        return $search;
    }
}
