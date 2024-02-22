<?php

declare(strict_types=1);

namespace Core\Helper;

/**
 * Token
 * -----------
 * Class for working with token
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Helper
 */
class Token
{    
    /**
     * generateToken
     *
     * @param  mixed $length
     * @return string
     */
    public static function generateToken(int $length = 16): string
    {
        return bin2hex(random_bytes($length));
    }
}
