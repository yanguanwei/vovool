<?php

namespace Youngx\Bundle\KernelBundle\Listener;

use Youngx\MVC\AppContext;
use Youngx\MVC\Field;
use Youngx\MVC\ListenerRegistry;

class ValidateListener implements ListenerRegistry
{
    public function onValidateField(Field $field, array $arguments, $validator)
    {
        return AppContext::validate($validator, $field->getValue(), $arguments);
    }

    public function required($value)
    {
        return !empty($value);
    }

    public function rangelength($value, $min, $max)
    {
        return ((($n = strlen($value)) >= $min) && $n <= $max);
    }

    public function range($value, $min, $max)
    {
        $value = floatval($value);
        return $min <= $value && $value <= $max;
    }

    public function email($value)
    {
        return (Boolean) strpos($value, '@');
    }

    public function equalTo(Field $field, array $arguments)
    {
        $form = $field->getForm();
        return $form->getField($arguments[0])->getValue() == $field->getValue();
    }

    public function username($value)
    {
        return preg_match('/^[a-z][a-z0-9_]{3,32}$/', $value);
    }

    public function name($value)
    {
        return preg_match('/^[a-z][a-z0-9\-]{3,32}$/', $value);
    }

    public static function registerListeners()
    {
        return array(
            'kernel.validate#required' => 'required',
            'kernel.validate#rangelength' => 'rangelength',
            'kernel.validate#range' => 'range',
            'kernel.validate#email' => 'email',
            'kernel.validate#username' => 'username',
            'kernel.validate#name' => 'name',
            'kernel.validate#route' => 'name',
            'kernel.validate.field' => 'onValidateField',
            'kernel.validate.field#equalTo' => 'equalTo',
        );
    }
}