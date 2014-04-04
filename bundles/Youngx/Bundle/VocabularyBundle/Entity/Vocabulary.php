<?php

namespace Youngx\Bundle\VocabularyBundle\Entity;

use Youngx\MVC\Entity;

class Vocabulary extends Entity
{
    protected $id;
    protected $name;
    protected $label;

    public static function type()
    {
        return 'vocabulary';
    }

    public static function table()
    {
        return 'y_vocabularies';
    }

    public static function primaryKey()
    {
        return 'id';
    }

    public static function fields()
    {
        return array(
            'id', 'name', 'label'
        );
    }

    /**
     * @param $id
     * @return null|Vocabulary
     */
    public static function load($id)
    {
        if (is_numeric($id)) {
            return parent::load($id);
        } else {
            return self::find('name=:name', array(':name' => $id));
        }
    }

    /**
     * @return Term[]
     */
    public function getTerms()
    {
        return $this->parseExtraFieldValue('terms');
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

    public function __toString()
    {
        return $this->getLabel();
    }

    protected function onBeforeDelete()
    {
        foreach ($this->getTerms() as $term) {
            $term->delete();
        }
    }
}