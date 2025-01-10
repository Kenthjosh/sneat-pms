<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class ProfileForm
{
    protected $errors = [];

    public function __construct(public array $attributes)
    {
        if (!Validator::string($attributes['first_name'])) {
            $this->errors['first_name'] = 'Please provide your first name.';
        }

        if (!Validator::string($attributes['middle_name'], 0)) {
            $this->errors['middle_name'] = 'Please provide your middle name.';
        }

        if (!Validator::string($attributes['last_name'])) {
            $this->errors['last_name'] = 'Please provide your last name.';
        }
    }

    public static function validate($attributes)
    {
        $instance = new static($attributes);

        return $instance->failed() ? $instance->throw() : $instance;
    }

    public function throw()
    {
        ValidationException::throw($this->errors(), $this->attributes);
    }

    public function failed()
    {
        return count($this->errors);
    }

    public function errors()
    {
        return $this->errors;
    }

    public function error($key, $message)
    {
        $this->errors[$key] = $message;

        return $this;
    }

}
