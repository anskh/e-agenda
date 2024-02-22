<?php

declare(strict_types=1);

namespace App\Handler;

use App\Helper\Service;
use Core\Http\Auth\UserPrincipalInterface;
use Core\Http\Session\SessionInterface;

abstract class ActionHandler
{
    protected UserPrincipalInterface $user;
    protected SessionInterface $session;
    protected ?string $tahun;

    public function __construct()
    {
        $this->user = Service::auth();
        $this->session = Service::session();
        $this->tahun = $this->session->get('tahun');
    }
}
