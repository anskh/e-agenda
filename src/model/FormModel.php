<?php

declare(strict_types=1);

namespace Core\Model;

use DateTime;
use Exception;
use Psr\Http\Message\ServerRequestInterface;

/**
 * FormModel
 * -----------
 * FormModel
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Model
 */
abstract class FormModel extends Model
{
    const REQUIRED = 'required';
    const EMAIL = 'email';
    const LENGTH = 'length';
    const MIN_LENGTH = 'min_length';
    const MAX_LENGTH = 'max_length';
    const MATCH_FIELD = 'match_field';
    const NOT_MATCH_FIELD = 'not_match_field';
    const MATCH = 'match';
    const NOT_MATCH = 'not_match';
    const CONTAINS = 'contains';
    const NOT_CONTAINS = 'not_contains';
    const STARTS_WITH = 'starts_with';
    const ENDS_WITH = 'ends_with';
    const NUMERIC = 'numeric';
    const IN_LIST = 'in_list';
    const IN_RANGE = 'in_range';
    const MAX = 'max';
    const MIN = 'min';
    const DATE = 'date';

    protected array $rules = [];
    protected array $messages = [
        'required' => 'Atribut {attribute} harus diisi',
        'email' => 'Atribut {attribute} harus berisi alamat surel yang valid',
        'length' => 'Atribut {attribute} harus berisi karakter dengan panjang {length}',
        'min_length' => 'Atribut {attribute} harus berisi karakter dengan panjang minimal {min_length}',
        'max_length' => 'Atribut {attribute} harus berisi karakter dengan panjang maksimal {max_length}',
        'match_field' => 'Atribut {attribute} harus berisi sama dengan isian pada atribute {match_field}',
        'not_match_field' => 'Atribut {attribute} harus berisi berbeda dengan isian pada atribute {not_match_field}',
        'match' => 'Atribut {attribute} harus berisi sama dengan isian pada {match}',
        'not_match' => 'Atribut {attribute} harus berbeda dengan isian pada {not_match}',
        'contains' => 'Atribut {attribute} harus mengandung isian {contains}',
        'not_contains' => 'Atribut {attribute} harus tidak mengandung isian {not_contains}',
        'starts_with' => 'Atribut {attribute} harus dimulai dengan isian {starts_with}',
        'ends_with' => 'Atribut {attribute} harus diakhiri dengan isian {ends_with}',
        'numeric' => 'Atribut {attribute} harus berisi angka',
        'in_list' => 'Atribut {attribute} harus berisi salah satu dari {in_list}',
        'in_range' => 'Atribut {attribute} harus berisi angka pada rentang {in_range}',
        'min' => 'Atribut {attribute} harus berisi angka minimal {min}',
        'max' => 'Atribut {attribute} harus berisi angka maksimal {max}',
        'date' => 'Atribute {attribute} harus berisi tanggal dengan format {date}'
    ];
    protected bool $skipValidation = false;
    protected array $errors = [];
    protected array $labels = [];
    protected bool $has_csrf = false;
    protected bool $is_edit;

    public ?string $__csrf_token = null; // see Session::CSRF_TOKEN or csrfName() in Session
        
    /**
     * __construct
     *
     * @param  mixed $is_edit
     * @return void
     */
    public function __construct(bool $is_edit = false)
    {
        $this->is_edit = $is_edit;
    }    
    /**
     * isEdit
     *
     * @return bool
     */
    public function isEdit():bool
    {
        return $this->is_edit;
    }    
    /**
     * hasCsrf
     *
     * @return bool
     */
    public function hasCsrf(): bool
    {
        return $this->has_csrf;
    }
    /**
     * enableCsrf
     *
     * @return void
     */
    public function enableCsrf()
    {
        $this->has_csrf = true;
    }
    
    /**
     * disableCsrf
     *
     * @return void
     */
    public function disableCsrf()
    {
        $this->__csrf_token = null;
        $this->has_csrf = false;
    }
    
    /**
     * setRule
     *
     * @param  mixed $attribute
     * @param  mixed $rule
     * @return void
     */
    public function setRule(string $attribute, $rule): void
    {
        if (property_exists($this, $attribute)) {
            $this->rules[$attribute] = $rule;
        }
    }
    
    /**
     * setLabel
     *
     * @param  mixed $attribute
     * @param  mixed $label
     * @return void
     */
    public function setLabel(string $attribute, string $label): void
    {
        if (property_exists($this, $attribute)) {
            $this->labels[$attribute] = $label;
        }
    }
    
    /**
     * getLabel
     *
     * @param  mixed $attribute
     * @return string
     */
    public function getLabel(string $attribute): string
    {
        return $this->labels[$attribute] ?? $attribute;
    }

    
    /**
     * setMessage
     *
     * @param  mixed $rule
     * @param  mixed $message
     * @return void
     */
    public function setMessage(string $rule, string $message): void
    {
        $this->messages[$rule] = $message;
    }
    
    /**
     * skipValidation
     *
     * @param  mixed $skip
     * @return void
     */
    public function skipValidation(bool $skip = true): void
    {
        $this->skipValidation = $skip;
    }
    
        
    /**
     * validateWith form with security csrf_token
     *
     * @param  mixed $request
     * @return bool
     */
    public function validateWith(ServerRequestInterface $request): bool
    {
        if($request->getMethod() == 'POST') {
            $this->fill($request->getParsedBody());
        }
        return $this->validate();
    }
    
    /**
     * validate form without security csrf_token
     *
     * @return bool
     */
    public function validate(): bool
    {      
        if($this->has_csrf){
            $csrf_name = csrf_name();
            if(!validate_csrf_token($this->{$csrf_name})){
                $this->addError('form', 'csrf token invalid.');
                return false;
            }
        } 

        if ($this->skipValidation) {
            return true;
        }

        foreach ($this->rules as $attr => $rule) {

            $val = strval($this->{$attr} ?? '');
            if (!is_array($rule)) {
                $rule = [$rule];
            }

            foreach ($rule as $innerRule) {

                if (is_array($innerRule)) {
                    $ruleName = array_shift($innerRule);
                    $ruleParam = $innerRule;
                } else {
                    $ruleName = $innerRule;
                    $ruleParam = '';
                }

                switch ($ruleName) {
                    case self::REQUIRED:
                        if (!$val) {
                            $this->addErrorForRule($attr, $ruleName);
                            return false;
                        }
                        break;
                    case self::EMAIL:
                        if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
                            $this->addErrorForRule($attr, $ruleName);
                            return false;
                        }
                        break;
                    case self::LENGTH:
                        $param = $ruleParam[0];
                        if (strlen($val) !== intval($param)) {
                            $this->addErrorForRule($attr, $ruleName, $param);
                            return false;
                        }
                        break;
                    case self::MIN_LENGTH:
                        $param = $ruleParam[0];
                        if (strlen($val) < intval($param)) {
                            $this->addErrorForRule($attr, $ruleName, $param);
                            return false;
                        }
                        break;
                    case self::MAX_LENGTH:
                        $param = $ruleParam[0];
                        if (strlen($val) > intval($param)) {
                            $this->addErrorForRule($attr, $ruleName, $param);
                            return false;
                        }
                        break;
                    case self::MATCH_FIELD:
                        $param = $ruleParam[0];
                        if ($val !== $this->{$param}) {
                            $this->addErrorForRule($attr, $ruleName, $this->getLabel($param));
                            return false;
                        }
                        break;
                    case self::NOT_MATCH_FIELD:
                        $param = $ruleParam[0];
                        if ($val === $this->{$param}) {
                            $this->addErrorForRule($attr, $ruleName, $this->getLabel($param));
                            return false;
                        }
                        break;
                    case self::MATCH:
                        $param = $ruleParam[0];
                        if ($val !== $param) {
                            $this->addErrorForRule($attr, $ruleName, $param);
                            return false;
                        }
                        break;
                    case self::NOT_MATCH:
                        $param = $ruleParam[0];
                        if ($val === $param) {
                            $this->addErrorForRule($attr, $ruleName, $param);
                            return false;
                        }
                        break;
                    case self::CONTAINS:
                        $param = $ruleParam[0];
                        if (!str_contains($val, $param)) {
                            $this->addErrorForRule($attr, $ruleName, $param);
                            return false;
                        }
                        break;
                    case self::NOT_CONTAINS:
                        $param = $ruleParam[0];
                        if (str_contains($val, $param)) {
                            $this->addErrorForRule($attr, $ruleName, $param);
                            return false;
                        }
                        break;
                    case self::STARTS_WITH:
                        $param = $ruleParam[0];
                        if (!str_starts_with($val, $param)) {
                            $this->addErrorForRule($attr, $ruleName, $param);
                            return false;
                        }
                        break;
                    case self::ENDS_WITH:
                        $param = $ruleParam[0];
                        if (!str_ends_with($val, $param)) {
                            $this->addErrorForRule($attr, $ruleName, $param);
                            return false;
                        }
                        break;
                    case self::NUMERIC:
                        if (!is_numeric($val)) {
                            $this->addErrorForRule($attr, $ruleName);
                            return false;
                        }
                        break;
                    case self::IN_LIST:
                        $param = $ruleParam[0];
                        if (!in_array($val, $param)) {
                            $this->addErrorForRule($attr, $ruleName, '[' . implode(' atau ', $param) . ']');
                            return false;
                        }
                        break;
                    case self::IN_RANGE:
                        $min = floatval($ruleParam[0]);
                        $max = floatval($ruleParam[1]);
                        $v = floatval($val);
                        if ($v > $max || $v < $min) {
                            $this->addErrorForRule($attr, $ruleName, '[' . strval($min) . ',' . strval($max) . ']');
                            return false;
                        }
                        break;
                    case self::MAX:
                        $max = $ruleParam[0];
                        if (floatval($val) > floatval($max)) {
                            $this->addErrorForRule($attr, $ruleName, $max);
                            return false;
                        }
                        break;
                    case self::MIN:
                        $min = $ruleParam[0];
                        if (floatval($val) < floatval($min)) {
                            $this->addErrorForRule($attr, $ruleName, $min);
                            return false;
                        }
                        break;
                    case self::DATE:
                        $param = $ruleParam[0];
                        if (DateTime::createFromFormat($param, $val) === false) {
                            $this->addErrorForRule($attr, $ruleName, $param);
                            return false;
                        }
                        break;
                    default:
                        throw new Exception("Rule {$ruleName} for attribute {$attr} not found or configured properly.");
                }
            }
        }

        return !$this->hasError();
    }
    
    /**
     * addErrorForRule
     *
     * @param  mixed $attribute
     * @param  mixed $rule
     * @param  mixed $param
     * @return void
     */
    protected function addErrorForRule(string $attribute, string $rule, $param = null): void
    {
        $message = $this->messages[$rule] ?? '';
        if (!empty($message)) {
            $message = str_replace("{attribute}", $this->getLabel($attribute), $message);
            $message = str_replace("{{$rule}}", strval($param ?? ''), $message);
        }
        $this->addError($attribute, $message);
    }
    
    /**
     * addError
     *
     * @param  mixed $attribute
     * @param  mixed $message
     * @return void
     */
    public function addError(string $attribute, string $message): void
    {
        $this->errors[$attribute][] = $message;
    }
    
    /**
     * hasError
     *
     * @param  mixed $attribute
     * @return bool
     */
    public function hasError(?string $attribute = null): bool
    {
        if (is_null($attribute)) {
            return !empty($this->errors);
        }

        return !empty($this->errors[$attribute]);
    }
    
    /**
     * firstError
     *
     * @param  mixed $attribute
     * @return string|array
     */
    public function firstError(?string $attribute = null)
    {
        if ($attribute === null) {
            $message = [];
            foreach ($this->errors as $attr => $msg) {
                $message[] = $msg[0];
            }
            return $message;
        }
        return $this->errors[$attribute][0] ?? '';
    }
    
    /**
     * getError
     *
     * @param  mixed $attribute
     * @return array
     */
    public function getError(?string $attribute = null): array
    {
        if ($attribute === null) {
            $message = [];
            foreach ($this->errors as $attr => $msg) {
                $message[] = $msg;
            }
            return $message;
        }

        return $this->errors[$attribute] ?? [];
    }
}
