<?php declare(strict_types=1);

namespace Core\Http\Session;

use Core\Http\ViewComponent\FlashMessage;

/**
 * Session
 * -----------
 * Session
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Http\Session
 */
class Session implements SessionInterface
{
    const FLASH = '__FLASH_SESSION';
    const CSRF = '__CSRF_SESSION';
    const CSRF_TOKEN = '__csrf_token';
    private string $userIdAttribute;
    private string $userHashAttribute;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->userIdAttribute = '__userid';
        $this->userHashAttribute = '__userhash';
    }
    
    /**
     * set
     *
     * @param  mixed $property
     * @param  mixed $value
     * @return void
     */
    public function set(string $property, $value): void
    {
        $_SESSION[$property] = $value;
    }
    /**
     * csrfName
     *
     * @return string
     */
    public function csrfName(): string
    {
        return self::CSRF_TOKEN;
    }
    /**
     * csrfToken
     *
     * @param  mixed $generate
     * @return string
     */
    public function csrfToken(bool $generate = true): string
    {
        if($generate){
            $_SESSION[self::CSRF][self::CSRF_TOKEN] = bin2hex(random_bytes(32));
        }
        
        return $_SESSION[self::CSRF][self::CSRF_TOKEN];
    }
    
    /**
     * validateCsrfToken
     *
     * @param  mixed $name
     * @param  mixed $token
     * @return bool
     */
    public function validateCsrfToken(string $token): bool
    {
        $result = ($token === $this->csrfToken(false));
        unset($_SESSION[self::CSRF][self::CSRF_TOKEN]);
        return $result;
    }
    
    /**
     * setUserId
     *
     * @param  mixed $userId
     * @return void
     */
    public function setUserId(string $userId):void
    {
        $this->set($this->userIdAttribute, $userId);
    }
    /**
     * setUserHash
     *
     * @param  mixed $userHash
     * @return void
     */
    public function setUserHash(string $userHash):void
    {
        $this->set($this->userHashAttribute, $userHash);
    }
    /**
     * get
     *
     * @param  mixed $property
     * @param  mixed $defaultValue
     * @return mixed
     */
    public function get(?string $property = null, $defaultValue = null)
    {
        if($property === null){
            return $_SESSION ?? $defaultValue;
        }else{
            return $this->has($property) ? $_SESSION[$property] : $defaultValue;
        }
    }
    /**
     * getUserId
     *
     * @return mixed
     */
    public function getUserId()
    {
        return $this->get($this->userIdAttribute);
    }
    /**
     * getUserHash
     *
     * @return mixed
     */
    public function getUserHash()
    {
        return $this->get($this->userHashAttribute);
    }
    /**
     * has
     *
     * @param  mixed $property
     * @return bool
     */
    public function has(?string $property = null): bool
    {
        return $property === null ? isset($_SESSION) : isset($_SESSION[$property]);
    }
    
    /**
     * unset
     *
     * @param  mixed $property
     * @return mixed
     */
    public function unset(?string $property = null)
    {
        $value = $this->get($property);
        if($property){
            unset($_SESSION[$property]);
        }else{
            $_SESSION = [];
        }
        return $value;
    }
    /**
     * unsetUserId
     *
     * @return void
     */
    public function unsetUserId() : void
    {
        unset($_SESSION[$this->userIdAttribute]);
    }
    /**
     * unsetUserHash
     *
     * @return void
     */
    public function unsetUserHash() : void
    {
        unset($_SESSION[$this->userHashAttribute]);
    }

    /**
     * addFlashInfo
     *
     * @param  mixed $message
     * @return void
     */
    public function addFlashInfo(string $message):void
    {
        $this->addFlash(FlashMessage::INFO, $message);
    }
    
    /**
     * flashInfo
     *
     * @return FlashMessage
     */
    public function flashInfo(): FlashMessage
    {
        return $this->flash(FlashMessage::INFO);
    }
    /**
     * addFlashError
     *
     * @param  mixed $message
     * @return void
     */
    public function addFlashError(string $message):void 
    {
        $this->addFlash(FlashMessage::ERROR, $message);
    }
     /**
     * flashError
     *
     * @return FlashMessage
     */
    public function flashError():FlashMessage 
    {
        return $this->flash(FlashMessage::ERROR);
    }
    /**
     * addFlashWarning
     *
     * @param  mixed $message
     * @return void
     */
    public function addFlashWarning(string $message):void 
    {
        $this->addFlash(FlashMessage::WARNING, $message);
    }
    /**
     * flashWarning
     *
     * @return FlashMessage
     */
    public function flashWarning() :FlashMessage
    {
        return $this->flash(FlashMessage::WARNING);
    }
    /**
     * addFlashSuccess
     *
     * @param  mixed $message
     * @return void
     */
    public function addFlashSuccess(string $message) :void
    {
        $this->addFlash(FlashMessage::SUCCESS, $message);
    }
    /**
     * flashSuccess
     *
     * @return FlashMessage
     */
    public function flashSuccess() :FlashMessage
    {
        return $this->flash(FlashMessage::SUCCESS);
    }
    
    /**
     * addFlash
     *
     * @param  mixed $type
     * @param  mixed $message
     * @return void
     */
    public function addFlash(string $type , string $message):void
    {
        $flash = new FlashMessage($type);
        if(!isset($_SESSION[self::FLASH][$type])){
            $_SESSION[self::FLASH][$type] = $flash;
        }else{
            $flash = $_SESSION[self::FLASH][$type];
        }
        $flash->addMessage($message);
    }
    
    /**
     * flash
     *
     * @param  mixed $type
     * @return FlashMessage|array
     */
    public function flash(?string $type = null)
    {
        if($type === null){
            $flash = $this->unset(self::FLASH);
        }else{
            $flash = $_SESSION[self::FLASH][$type];
            unset($_SESSION[self::FLASH][$type]);
        }
        return $flash;
    }
    
    /**
     * hasFlash
     *
     * @param  string $type
     * @return bool
     */
    public function hasFlash(?string $type=null): bool
    {
       return $type === null ? isset($_SESSION[self::FLASH]) : isset($_SESSION[self::FLASH][$type]);
    }
        
    /**
     * hasFlashSuccess
     *
     * @return bool
     */
    public function hasFlashSuccess(): bool
    {
        return $this->hasFlash(FlashMessage::SUCCESS);
    }
    /**
     * hasFlashError
     *
     * @return bool
     */
    public function hasFlashError(): bool
    {
        return $this->hasFlash(FlashMessage::ERROR);
    }
    /**
     * hasFlashWarning
     *
     * @return bool
     */
    public function hasFlashWarning(): bool
    {
        return $this->hasFlash(FlashMessage::WARNING);
    }
    /**
     * hasFlashInfo
     *
     * @return bool
     */
    public function hasFlashInfo(): bool
    {
        return $this->hasFlash(FlashMessage::INFO);
    }
}