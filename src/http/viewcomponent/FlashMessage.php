<?php

declare(strict_types=1);

namespace Core\Http\ViewComponent;

/**
 * FlashMessage
 * -----------
 * FlashMessage
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Http\ViewComponent
 */
class FlashMessage
{
    const ERROR = 'danger';
    const WARNING = 'warning';
    const INFO = 'info';
    const SUCCESS = 'success';

    private string $type;
    private array $messages;
    
    /**
     * __construct
     *
     * @param  mixed $type
     * @param  mixed $message
     * @return void
     */
    public function __construct(string $type = self::INFO, array $message = [])
    {
        $this->type = in_array($type, [self::ERROR, self::WARNING, self::INFO, self::SUCCESS]) ? $type: self::INFO;
        $this->messages = $message;        
    }

    /**
     * getMessage
     *
     * @return array
     */
    public function getMessage(): array
    {
        return $this->messages;
    }
    
    /**
     * addMessage
     *
     * @param  string $message
     * @return void
     */
    public function addMessage(string $message): void
    {
        $this->messages[] = $message;
    }
    
    /**
     * firstMessage
     *
     * @return string
     */
    public function firstMessage(): string
    {
        return $this->messages[0] ?? '';
    }

    /**
     * getType
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * __toString
     *
     * @return void
     */
    public function __toString()
    {
        return implode(PHP_EOL, $this->messages);
    }
}
