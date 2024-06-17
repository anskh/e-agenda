<?php

declare(strict_types=1);

namespace Core\Config;

use ArrayAccess;

/**
 * Configuration container
 * -----------
 * Configuration container for accessing 
 * app config folder with support dot notation
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Config
 */
class Config implements ArrayAccess
{
    private array $container = [];
    private string $configPath;
    private string $environment;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct(
        string $configPath,
        string $environment
    ) {
        $this->configPath = $configPath;
        $this->environment = $environment;
    }

    /**
     * @inheritdoc
     */
    public function offsetExists($offset): bool
    {
        if (isset($this->container[$offset])) {
            return true;
        }

        $name = strtok($offset, '.');
        if (isset($this->container[$name])) {
            $p = $this->container[$name];
            while (false !== ($name = strtok('.'))) {
                if (!isset($p[$name])) {
                    return false;
                }

                $p = $p[$name];
            }
            $this->container[$offset] = $p;

            return true;
        } else {
            $file = "{$this->configPath}/{$name}.php";
            if (is_file($file) && is_readable($file)) {
                $this->container[$name] = include $file;
                if ($this->environment) {
                    $file = "{$this->configPath}/{$this->environment}/{$name}.php";
                    if (is_file($file) && is_readable($file)) {
                        $this->container[$name] = array_replace_recursive($this->container[$name], include $file);
                    }
                }
                return $this->offsetExists($offset);
            } else {
                $file = "{$this->configPath}/{$this->environment}/{$name}.php";
                if (is_file($file) && is_readable($file)) {
                    $this->container[$name] = include $file;
                    return $this->offsetExists($offset);
                }
            }

            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function offsetGet($offset)
    {
        return $this->offsetExists($offset) ? $this->container[$offset] : null;
    }

    /**
     * @inheritdoc
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * @inheritdoc
     */
    public function offsetUnset($offset): void
    {
        unset($this->container[$offset]);
    }
}
