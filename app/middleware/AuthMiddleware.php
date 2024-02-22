<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Model\PermissionModel;
use App\Model\UserModel;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Core\Http\Auth\UserIdentity;
use Core\Http\Auth\UserPrincipal;
use Core\Http\Auth\UserPrincipalInterface;
use Core\Http\Session\Session;

/**
 * AuthMiddleware
 * -----------
 * AuthMiddleware
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package App\Middleware
 */
class AuthMiddleware implements MiddlewareInterface
{
    private Session $session;
    private string $sessionAttribute;
    private string $userAttribute;

    public function __construct()
    {
        $this->sessionAttribute = '__session';
        $this->userAttribute = '__user';
    }
    
    /**
     * process
     *
     * @param  mixed $request
     * @param  mixed $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $this->session = $request->getAttribute($this->sessionAttribute);
        $userId = $this->session->getUserId();
        $userHash = $this->session->getUserHash();
        $userAgent = $request->getServerParams()['HTTP_USER_AGENT'];
        $user = $this->validateUser($userAgent, $userId, $userHash);
        $request = $request->withAttribute($this->userAttribute, $user);

        return $handler->handle($request);
    }
    
    /**
     * validateUser
     *
     * @param  mixed $userAgent
     * @param  mixed $userId
     * @param  mixed $userHash
     * @return UserPrincipalInterface
     */
    public function validateUser(string $userAgent, string $userId = null, ?string $userHash = null): UserPrincipalInterface
    {
        if ($userId !== null && $userHash !== null) {
            $user = UserModel::row('*',['id='=> $userId]);
            if ($user) {
                $hash = sha1($user['password'] . $userAgent);
                if ($hash === $userHash) {
                    $roles = explode(',', $user['role']);
                    if ($roles) {     
                        $whereParams = array_map(fn ($attr) => "$attr=1", $roles);
                        $where = implode(' OR ', $whereParams);        
                        $permissions = PermissionModel::findColumn($where, 'nama');
                        return new UserPrincipal(new UserIdentity($userId, ucfirst($user['username']), $roles, $permissions));
                    }
                }
            }
            $this->session->unsetUserId();
            $this->session->unsetUserHash();
        }

        return new UserPrincipal();
    }
}
