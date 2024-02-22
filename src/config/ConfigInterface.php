<?php

declare(strict_types=1);

namespace Core\Config;

use ArrayAccess;

/**
 * ConfigInterface
 * -----------
 * ConfigInterface define contract for accessing 
 * app config folder with support dot notation
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Config
 */
interface ConfigInterface extends ArrayAccess
{
}