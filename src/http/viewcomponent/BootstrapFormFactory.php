<?php

declare(strict_types=1);

namespace Core\Http\ViewComponent;

use Core\Model\FormModel;

/**
 * BootstrapFormFactory
 * -----------
 * BootstrapFormFactory
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Http\ViewComponent
 */
class BootstrapFormFactory
{    
    /**
     * create
     *
     * @param  mixed $model
     * @return BootstrapForm
     */
    public static function create(FormModel $model): BootstrapForm
    {
        return new BootstrapForm($model);
    }
}
