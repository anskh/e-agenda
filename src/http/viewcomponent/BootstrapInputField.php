<?php

declare(strict_types=1);

namespace Core\Http\ViewComponent;

use Core\Model\FormModel;

/**
 * BootstrapInputField
 * -----------
 * BootstrapInputField
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Http\ViewComponent
 */
class BootstrapInputField
{
    const TYPE_TEXT = 'text';
    const TYPE_EMAIL = 'email';
    const TYPE_PASSWORD = 'password';
    const TYPE_NUMBER = 'number';
    const TYPE_DATE = 'date';
    const TYPE_FILE= 'file';
    const TYPE_TIME = 'time';
    const TYPE_TEL = 'tel';
    const TYPE_HIDDEN = 'hidden';

    public string $type;
    public FormModel $model;
    public string $attribute;
    public array $options;
    
    /**
     * __construct
     *
     * @param  mixed $model
     * @param  mixed $attribute
     * @param  mixed $options
     * @return void
     */
    public function __construct(FormModel $model, string $attribute, array $options = [])
    {
        $this->model = $model;
        $this->type = self::TYPE_TEXT;
        $this->attribute = $attribute;
        $this->options = $options;
    }
    
    /**
     * __toString
     *
     * @return string
     */
    public function __toString(): string
    {
        if($this->model->hasError($this->attribute)){
            $this->options['class'] = isset($this->options['class']) ? $this->options['class'] .' is-invalid' : 'is-invalid';
        }

        return sprintf(
            '<input id="%s" type="%s" name="%s" value="%s" %s>
            <div class="invalid-feedback">%s</div>',
            'id_' . $this->attribute,
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute} ?? '',
            attr_to_string($this->options),
            $this->model->firstError($this->attribute)
        ) . PHP_EOL;
    }
    
    /**
     * textField
     *
     * @return self
     */
    public function textField(): self
    {
        $this->type = self::TYPE_TEXT;
        return $this;
    }
    
    /**
     * hiddenField
     *
     * @return self
     */
    public function hiddenField(): self
    {
        $this->type = self::TYPE_HIDDEN;
        return $this;
    }
    
    /**
     * emailField
     *
     * @return self
     */
    public function emailField(): self
    {
        $this->type = self::TYPE_EMAIL;
        return $this;
    }
    
    /**
     * passField
     *
     * @return self
     */
    public function passField(): self
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }
    
    /**
     * numField
     *
     * @return self
     */
    public function numField(): self
    {
        $this->type = self::TYPE_NUMBER;
        return $this;
    }
    
    /**
     * dateField
     *
     * @return self
     */
    public function dateField(): self
    {
        $this->type = self::TYPE_DATE;
        return $this;
    }
    
    /**
     * fileField
     *
     * @return self
     */
    public function fileField(): self
    {
        $this->type = self::TYPE_FILE;
        return $this;
    }
    
    /**
     * timeField
     *
     * @return self
     */
    public function timeField(): self
    {
        $this->type = self::TYPE_TIME;
        return $this;
    }
    
    /**
     * telField
     *
     * @return self
     */
    public function telField(): self
    {
        $this->type = self::TYPE_TEL;
        return $this;
    }
}