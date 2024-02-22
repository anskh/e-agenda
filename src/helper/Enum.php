<?php declare(strict_types=1);

namespace Core\Helper;

/**
 * Enum
 * -----------
 * Class for working with enumareation
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Helper
 */
class Enum 
{    
    /**
     * range
     *
     * @param  mixed $begin
     * @param  mixed $end
     * @return array
     */
    public static function range(int $begin, int $end) : array
    {
        $arr =[];
        for($i = $begin; $i <= $end; $i++){
            $arr[] = $i;
        }
        return $arr;
    }
}