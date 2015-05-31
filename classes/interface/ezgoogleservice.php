<?php
/**
 * @copyright Copyright (C) 2014 Ralantonisainana Dany All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */

/**
 * Interface for GoogleService
 *
 * This interface describes the methods that a import backend should
 * implement.
 * @author Dany Ralantonisainana <lendormi1984@gmail.com>
 */
namespace eZGoogleApi\InterfaceGoogle;

interface eZGoogleServiceInterface
{
    public static function getService(\Google_Client $client);
    public function getResults();
}
