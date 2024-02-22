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
     * @return string
     */
    public function getId(): string|int|null;
    /**
     * getName
     *
     * @return string
     */
    public function getName(): string|null;
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
