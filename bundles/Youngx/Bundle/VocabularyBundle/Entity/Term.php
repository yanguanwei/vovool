<?php

namespace Youngx\Bundle\VocabularyBundle\Entity;

use Youngx\MVC\Entity;
use Youngx\MVC\Query;

class Term extends Entity
{
    protected $id;
    protected $vocabulary_id;
    protected $label;
    protected $icon;
    protected $priority = 0;

    /**
     * @param null $alias
     * @param Query $parent
     * @return TermQuery
     */
    public static function query($alias = null, Query $parent = null)
    {
        return new TermQuery(self::type(), $alias, $parent);
    }

    public static function type()
    {
        return 'term';
    }

    public static function table()
    {
        return 'y_terms';
    }

    public static function primaryKey()
    {
        return 'id';
    }

    public static function fields()
    {
        return array(
            'id', 'vocabulary_id', 'label', 'icon', 'priority'
        );
    }

    /**
     * @return Vocabulary
     */
    public function getVocabulary()
    {
        return $this->parseExtraFieldValue('vocabulary');
    }

    /**
     * @param mixed $icon
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    /**
     * @return mixed
     */
    public function getIcon()
    {
        return $this->icon;
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
     * @param int $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

    /**
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param mixed $vocabulary_id
     */
    public function setVocabularyId($vocabulary_id)
    {
        $this->vocabulary_id = $vocabulary_id;
    }

    /**
     * @return mixed
     */
    public function getVocabularyId()
    {
        return $this->vocabulary_id;
    }

    public function __toString()
    {
        return $this->getLabel();
    }
}