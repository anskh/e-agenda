<?php

declare(strict_types=1);

namespace Core\Http\Auth;

/**
 * AnonymousIdentity
 * -----------
 * Identitiy for guest or not athenticated user
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Http\Auth
 */
class UserIdentity implements UserIdentityInterface
{
    protected $id;
    protected ?string $name;
    protected array $roles;
    protected array $permissions;

    /**
     * __construct
     *
     * @param  mixed $id
     * @param  mixed $name
     * @param  mixed $roles
     * @param  mixed $permissions
     * @return void
     */
    public function __construct($id = null, ?string $name = null, array $roles = [], array $permissions = [])
    {
        $this->id = $id;
        $this->name = $name;
        $this->roles = $roles;
        $this->permissions = $permissions;
    }

    /**
     * getId
     *
     * @return string|int|null
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * getName
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * getRoles
     *
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }
    /**
     * getPermissions
     *
     * @return array
     */
    public function getPermissions(): array
    {
        return $this->permissions;
    }
    /**
     * isAuthenticated
     *
     * @return bool
     */
    public function isAuthenticated(): bool
    {
        return (empty($this->id) || empty($this->name)) === false;
    }
}
