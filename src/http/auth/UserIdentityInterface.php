<?php

declare(strict_types=1);

namespace Core\Http\Auth;

/**
 * UserIdentityInterface
 * -----------
 * Identity contract
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Http\Auth
 */
interface UserIdentityInterface
{
    /**
     * getId
     *
     * @return string|int|null
     */
    public function getId();
    /**
     * getName
     *
     * @return string|null
     */
    public function getName();
    /**
     * getRoles
     *
     * @return array
     */
    public function getRoles(): array;
    /**
     * getPermissions
     *
     * @return array
     */
    public function getPermissions(): array;
    /**
     * isAuthenticated
     *
     * @return bool
     */
    public function isAuthenticated(): bool;
}
