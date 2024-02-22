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
class AnonymousIdentity extends UserIdentity
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
}
