<?php

declare(strict_types=1);

namespace Core\Model;

/**
 * Model
 * -----------
 * Model
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Model
 */
abstract class Model
{
    /**
     * fill
     *
     * @param  mixed $data
     * @return void
     */
    public function fill(array $data): void
    {
        foreach ($data as $property => $value) {
            if (property_exists(static::class, $property)) {
                $type = gettype($this->{$property});
                switch ($type) {
                    case "boolean":
                        $this->{$property} = boolval($value);
                        break;
                    case "integer":
                        $this->{$property} = intval($value);
                        break;
                    case "float":
                    case "double":
                        $this->{$property} = floatval($value);
                        break;
                    case "string":
                        $this->{$property} = strval($value);
                        break;
                    case "array":
                        $this->{$property} = (array)$value;
                        break;
                    case "object":
                        $this->{$property} = (object)$value;
                        break;
                    default:
                        $this->{$property} = $value;
                }
            }
        }
    }
}
