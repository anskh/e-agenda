<?php

declare(strict_types=1);

namespace Core\Http\Handler;

/**
 * RequestHandlerRunnerInterface
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Http\Handler
 */
interface RequestHandlerRunnerInterface
{
    /**
     * Run the application
     */
    public function run(): void;
}