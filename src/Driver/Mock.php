<?php
/*
 * This file is part of the Shieldon Simple Cache package.
 *
 * (c) Terry L. <contact@terryl.in>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Neko\Cache\Driver;

use Neko\Cache\CacheProvider;
use Neko\Cache\CacheWarmingTrait;

/**
 * A mock driver for testing Cache Provider.
 */
class Mock extends CacheProvider
{
    use CacheWarmingTrait;

    /**
     * Fetch a cache by an extended Cache Driver.
     *
     * @param string $key The key of a cache.
     *
     * @return array
     */
    protected function doGet(string $key): array
    {
        if ($this->doHas($key)) {
            return $this->pool[$key];
        }

        return [];
    }

    /**
     * Set a cache by an extended Cache Driver.
     *
     * @param string $key       The key of a cache.
     * @param mixed  $value     The value of a cache. (serialized)
     * @param int    $ttl       The time to live for a cache.
     * @param int    $timestamp The time to store a cache.
     *
     * @return bool
     */
    protected function doSet(string $key, $value, int $ttl, int $timestamp): bool
    {
        $this->pool[$key] = [
            'value'     =>  $value,
            'ttl'       => $ttl,
            'timestamp' => $timestamp,
        ];

        return true;
    }

    /**
     * Delete a cache by an extended Cache Driver.
     *
     * @param string $key The key of a cache.
     * 
     * @return bool
     */
    protected function doDelete(string $key): bool
    {
        unset($this->pool[$key]);

        return true;
    }

    /**
     * Delete all caches by an extended Cache Driver.
     * 
     * @return bool
     */
    protected function doClear(): bool
    {
        $this->pool = [];

        return true;
    }

    /**
     * Undocumented function
     *
     * @param string $key The key of a cache.
     *
     * @return bool
     */
    protected function doHas(string $key): bool
    {
        return isset($this->pool[$key]);
    }
}