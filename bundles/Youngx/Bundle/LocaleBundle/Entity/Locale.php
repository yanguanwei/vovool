<?php

namespace Youngx\Bundle\LocaleBundle\Entity;

use Youngx\MVC\Entity;

class Locale extends Entity
{
    protected $id;
    protected $name;
    protected $label;
    protected $code;

    /**
     * @return Translation[]
     */
    public function getTranslations()
    {
        return $this->parseExtraFieldValue('translations');
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    public static function type()
    {
        return 'locale';
    }

    public static function table()
    {
        return 'y_locales';
    }

    public static function primaryKey()
    {
        return 'id';
    }

    public static function fields()
    {
        return array(
            'id', 'name', 'label', 'code'
        );
    }

    public function __toString()
    {
        return $this->getLabel();
    }

    protected function onBeforeDelete()
    {
        foreach ($this->getTranslations() as $translation) {
            $translation->delete();
        }
    }
}