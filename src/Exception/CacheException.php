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

namespace Neko\Cache\Exception;

use Exception;


interface CacheExceptionInterface
{
    
}

class CacheException extends Exception implements CacheExceptionInterface
{

}