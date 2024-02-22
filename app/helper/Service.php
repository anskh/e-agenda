<?php declare(strict_types=1);

namespace App\Helper;

use Core\Helper\Service as BaseService;
use Core\Http\Auth\UserPrincipalInterface;

class Service extends BaseService
{
    /**
     * auth
     *
     * @return UserPrincipalInterface
     */
    public static function auth(): ?UserPrincipalInterface
    {
        return static::$request->getAttribute('__user');
    }
}