<?php

namespace Youngx\Bundle\LocaleBundle\Entity;

use Youngx\MVC\Entity;

class Translation extends Entity
{
    protected $id;
    protected $type;
    protected $locale_id;
    protected $message;
    protected $translation;

    public function setLocale(Locale $locale)
    {
        $this->holdExtraFieldValue('locale', $locale);

        return $this;
    }

    /**
     * @return Locale
     */
    public function getLocale()
    {
        return $this->parseExtraFieldValue('locale');
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $locale_id
     */
    public function setLocaleId($locale_id)
    {
        $this->locale_id = $locale_id;
    }

    /**
     * @return mixed
     */
    public function getLocaleId()
    {
        return $this->locale_id;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $translation
     */
    public function setTranslation($translation)
    {
        $this->translation = $translation;
    }

    /**
     * @return mixed
     */
    public function getTranslation()
    {
        return $this->translation;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    public static function type()
    {
        return 'translation';
    }

    public static function table()
    {
        return 'y_translations';
    }

    public static function primaryKey()
    {
        return 'id';
    }

    public static function fields()
    {
        return array(
            'id', 'type', 'locale_id', 'message', 'translation'
        );
    }

    public function __toString()
    {
        return $this->getMessage();
    }
}