<?php

declare(strict_types=1);

namespace Core\Http\ViewComponent;

use Core\Helper\Service;
use Core\Model\FormModel;

/**
 * BootstrapForm
 * -----------
 * BootstrapForm
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Http\ViewComponent
 */
class BootstrapForm
{
    private ?FormModel $model = null;
    
    /**
     * __construct
     *
     * @param  mixed $model
     * @return void
     */
    public function __construct(?FormModel $model = null)
    {
        $this->model = $model;
    }    
    /**
     * begin
     *
     * @param  mixed $action
     * @param  mixed $method
     * @param  mixed $options
     * @return string
     */
    public function begin(string $action, string $method = 'POST', array $options = []): string
    {
        return "<form action=\"$action\" method=\"$method\"" . attr_to_string($options) . ">" . PHP_EOL;
    }
    
    /**
     * end
     *
     * @return string
     */
    public function end(): string
    {
        return '</form>' . PHP_EOL;
    }
    
    /**
     * field
     *
     * @param  mixed $attribute
     * @param  mixed $options
     * @return BootstrapInputField
     */
    public function field(string $attribute, array $options = []): BootstrapInputField
    {
        return new BootstrapInputField($this->model, $attribute, $options);
    }
    
    /**
     * csrfField
     *
     * @return string
     */
    public function csrfField(): string
    {
        $this->model->enableCsrf();
        $html = '<input name="' . csrf_name() . '" type="hidden" value="' . csrf_token() . '" />' . PHP_EOL;
        return $html;
    }
    
    /**
     * input
     *
     * @param  mixed $attribute
     * @param  mixed $type
     * @param  mixed $options
     * @return string
     */
    public function input(string $attribute, string $type = 'text', array $options = []): string
    {
        $html = '<input id="id_' . $attribute . '" name="' . $attribute . '" type="' . $type . '" value="' .  ($this->model->{$attribute} ?? '') . '" ' . attr_to_string($options) .'>' . PHP_EOL;
        if($this->model->hasError($attribute)){
            $html .= '<div class="invalid-feedback">' . $this->model->firstError($attribute) . '</div>' . PHP_EOL;
        }
        return $html;
    }
    /**
     * file
     *
     * @param  mixed $attribute
     * @param  mixed $type
     * @param  mixed $options
     * @return string
     */
    public function file(string $attribute, array $options = []): string
    {
        $html = '<input id="id_' . $attribute . '" name="' . $attribute . '" type="file" ' . attr_to_string($options) .'>' . PHP_EOL;
        if($this->model->hasError($attribute)){
            $html .= '<div class="invalid-feedback">' . $this->model->firstError($attribute) . '</div>' . PHP_EOL;
        }
        return $html;
    }    
        
    /**
     * select
     *
     * @param  mixed $attribute
     * @param  mixed $data
     * @param  mixed $options
     * @param  mixed $selectedValue
     * @param  mixed $keyValue
     * @param  mixed $keyLabel
     * @return string
     */
    public function select(string $attribute, array $data, array $options = [], null|int|string $selectedValue = null, null|string|int $keyValue = null, null|string|int $keyLabel = null): string
    {
        $html = '<select id="id_' . $attribute . '" name="'. $attribute . '" ' . attr_to_string($options) .'>' . PHP_EOL;
        foreach($data as $d){
            
            if(is_array($d)){
                $keyValue = $keyValue ?? 0;
                $keyLabel = $keyLabel ?? 1;
                $val = $d[$keyValue];
                $lbl = $d[$keyLabel];
            }else{
                $lbl = $d;
                $val = $d;
            }
            if ($selectedValue === $val) {
                $html .= '<option value="' . $val . '" selected>' . $lbl .'</option>' . PHP_EOL;
            } else {
                $html .= '<option value="' . $val . '">' . $lbl  .'</option>' . PHP_EOL;
            }
        }
        $html .= '</select>' . PHP_EOL;
        if($this->model->hasError($attribute)){
            $html .= '<div class="invalid-feedback">' . $this->model->firstError($attribute) . '</div>' . PHP_EOL;
        }
        return $html;
    }
    
    /**
     * textArea
     *
     * @param  mixed $attribute
     * @param  mixed $options
     * @return string
     */
    public function textArea(string $attribute, array $options = []): string
    {
        $html = '<textarea id="id_' . $attribute . '" name="' . $attribute . '" ' . attr_to_string($options) .'>' . ($this->model->{$attribute} ?? '') . '</textarea>' . PHP_EOL;
        if($this->model->hasError($attribute)){
            $html .= '<div class="invalid-feedback">' . $this->model->firstError($attribute) . '</div>' . PHP_EOL;
        }
        return $html;
    }   
        
    /**
     * list
     *
     * @param  mixed $attribute
     * @param  mixed $data
     * @param  mixed $options
     * @return string
     */
    public function list(string $attribute, array $data, array $options = []): string
    {
        $html = '<input id="id_' . $attribute . '"  list="datalistOptions_' . $attribute . '" name="' . $attribute . '" value="' . ($this->model->{$attribute} ?? '') . '" ' . attr_to_string($options) .'>' . PHP_EOL;
        $html .= '<datalist id="datalistOptions_' . $attribute . '">' . PHP_EOL;
        foreach($data as $d){
            $html .= '<option value="' . $d . '">' . PHP_EOL;
        }
        $html .= '</datalist>' . PHP_EOL;
        if($this->model->hasError($attribute)){
            $html .= '<div class="invalid-feedback">' . $this->model->firstError($attribute) . '</div>' . PHP_EOL;
        }
        return $html;
    }
}