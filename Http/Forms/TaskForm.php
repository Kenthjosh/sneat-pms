<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class TaskForm
{
    protected $errors = [];

    public function __construct(public array $attributes)
    {
        if(!Validator::string($attributes['task_name'])) {
            $this->errors['task_name'] = 'Please provide a valid task name.';
        }

        if(!Validator::string($attributes['task_desc'])) {
            $this->errors['task_desc'] = 'Please provide a valid description.';
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
