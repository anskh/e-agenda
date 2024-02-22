<?php

declare(strict_types=1);

namespace Core\Http\Auth;

/**
 * UserPrincipal
 * -----------
 * UserPrincipal
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Http\Auth
 */
class UserPrincipal implements UserPrincipalInterface
{
    private UserIdentityInterface $identity;
    
    /**
     * __construct
     *
     * @param  mixed $identity
     * @return void
     */
    public function __construct(?UserIdentityInterface $identity = null)
    {
        $this->identity = $identity ?? new AnonymousIdentity();
    }
    
    /**
     * getIdentity
     *
     * @return UserIdentityInterface
     */
    public function getIdentity(): UserIdentityInterface
    {
        return $this->identity;
    }    
    /**
     * hasRole
     *
     * @param  mixed $role
     * @return bool
     */
    public function hasRole(string $role): bool
    {
        return in_array($role, $this->identity->getRoles());
    }    
    /**
     * hasPermission
     *
     * @param  mixed $permission
     * @return bool
     */
    public function hasPermission(string $permission): bool
    {
        return in_array($permission, $this->identity->getPermissions());
    }
}
