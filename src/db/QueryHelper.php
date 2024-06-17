<?php

declare(strict_types=1);

namespace Core\Db;

use InvalidArgumentException;

/**
 * QueryHelper
 * -----------
 * Class to help query
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Corephp\Db
 */
final class QueryHelper
{
    /**
     * parseWhere
     *
     * @param  ?array $where
     * @return string
     */
    public static  function parseWhere(?array $where = null): string
    {
        $string_where = '';
        if ($where) {
            $op = '';
            $size = count($where);
            if ($size > 1) {
                $op = ' ' . strtoupper(trim(array_pop($where))) . ' ';
                if (!($op === ' AND ' || $op === ' OR ')) {
                    throw new InvalidArgumentException('There is syntax error in WHere Clause');
                }
            }
            $whereParams = [];
            foreach ($where as $key => $val) {
                if (is_string($key)) {
                    $whereParams[] = trim($key) . ' ?';
                } elseif (is_int($key) && is_array($val)) {
                    $whereParams[] = self::parseWhere($val);
                } else {
                    throw new InvalidArgumentException('There is syntax error in WHere Clause');
                }
            }
            $string_where .= '(' . implode($op, $whereParams) . ')';
        }
        return $string_where;
    }

    /**
     * parseParams
     *
     * @param  mixed $where
     * @return array
     */
    public static function parseParams(array $where): array
    {
        $params = [];
        foreach ($where as $key => $value) {
            if (is_string($value) && (strtoupper(trim(strval($value))) == 'AND' || strtoupper(trim(strval($value))) == 'OR')) {
                // skip
            } else {
                if (is_string($key)) {
                    $params[] = $value;
                } elseif (is_int($key) && is_array($value)) {
                    $params[] = self::parseParams($value);
                } else {
                    throw new InvalidArgumentException('There is syntax error in WHere Clause');
                }
            }
        }
        return $params;
    }
}
