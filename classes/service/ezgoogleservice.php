<?php
/**
 * @copyright Copyright (C) Dany Ralantonisainana All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 * @package ezgoogleapi
 */
namespace eZGoogleApi\ServiceGoogle;

abstract class eZGoogleService
{
    protected static $_instance = null;
    protected $parameters          = array();

    public static function getService(\Google_Client $client)
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new static($client);
        }
         
        return self::$_instance;
    }

    public function setParameter($key, $value)
    {
        if (empty($key) || empty($value)) {
            return false;
        }
        $this->parameters[$key] = $value;
    }

    public function setParameters($params = array())
    {
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                $this->setParameter($key, $value);
            }
        }
    }

    public function getOthersParameters()
    {
    }
}
