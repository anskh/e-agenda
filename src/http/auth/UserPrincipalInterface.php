<?php

declare(strict_types=1);

namespace Core\Http\Auth;

/**
 * UserPrincipalInterface
 * -----------
 * UserPrincipalInterface
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Http\Auth
 */
interface UserPrincipalInterface
{
    /**
     * getIdentity
     *
     * @return UserIdentityInterface
     */
    public function getIdentity(): UserIdentityInterface;
    /**
     * hasRole
     *
     * @param  mixed $role
     * @return bool
     */
    public function hasRole(string $role): bool;
    /**
     * hasPermission
     *
     * @param  mixed $permission
     * @return bool
     */
    public function hasPermission(string $permission): bool;
}
