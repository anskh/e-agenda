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
                $this->{$property} = $value;
            }
        }
    }
}
