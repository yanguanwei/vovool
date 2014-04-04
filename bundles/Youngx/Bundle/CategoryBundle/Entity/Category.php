<?php

namespace Youngx\Bundle\CategoryBundle\Entity;

use Youngx\MVC\AppContext;
use Youngx\MVC\Entity;
use Youngx\MVC\Query;

class Category extends Entity
{
    protected $id;
    protected $name;
    protected $label;
    protected $top_id = 0;
    protected $parent_id = 0;
    protected $priority = 0;

    protected $top;
    protected $parent = false;
    protected $descendantIds;
    protected $vocabularies;

    public static function inParent(Query $query, $parentId)
    {
        $query->where("{$query->getAlias()}.parent_id IN (?)", $parentId);
    }

    /**
     * @return Category
     */
    public function getTop()
    {
        if ($this->top === null) {
            $this->top = $this->top_id == $this->id ? $this : self::load($this->top_id);
        }

        return $this->top;
    }

    /**
     * @return Category|null
     */
    public function getParent()
    {
        if (false === $this->parent) {
            $this->parent = $this->parent_id ? self::load($this->parent_id) : null;
        }

        return  $this->parent;
    }

    public function hasParent()
    {
        return $this->parent_id != 0;
    }

    public function hasChildren()
    {
        return AppContext::repository()->exist('category', 'parent_id=:parent_id', array(':parent_id' => $this->id));
    }

    public function hasDescendant()
    {
        return AppContext::repository()->exist('category', 'top_id=:top_id', array(':top_id' => $this->id));
    }

    /**
     * @return Category[]
     */
    public function getPaths()
    {
        $current = $this;
        $paths = array();
        while ($current) {
            array_unshift($paths, $current);
            $current = $current->getParent();
        }
        return $paths;
    }

    /**
     * @return Category[]
     */
    public function getChildren()
    {
        return AppContext::repository()
            ->query('category')
            ->where('parent_id=:parent_id')
            ->orderBy('priority ASC, id ASC')
            ->all(array(':parent_id' => $this->id));
    }

    /**
     * @return Category[]
     */
    public function getDescendant()
    {
        return AppContext::repository()
            ->query('category')
            ->where('top_id=:top_id')
            ->orderBy('priority ASC, id ASC')
            ->all(array(':top_id' => $this->top_id));
    }

    public static function type()
    {
        return 'category';
    }

    public static function table()
    {
        return 'y_categories';
    }

    public static function primaryKey()
    {
        return 'id';
    }

    public static function fields()
    {
        return array(
            'id', 'name', 'label', 'top_id', 'parent_id', 'priority'
        );
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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
     * @param int $top_id
     */
    public function setTopId($top_id)
    {
        $this->top_id = $top_id;
    }

    /**
     * @return int
     */
    public function getTopId()
    {
        return $this->top_id;
    }

    /**
     * @param int $parent_id
     */
    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;
    }

    /**
     * @return int
     */
    public function getParentId()
    {
        return $this->parent_id;
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

    public function getDescendantIds()
    {
        if ($this->descendantIds === null) {
            $this->descendantIds = AppContext::db()->fetchValues(self::table(), 'id', 'top_id=:top_id', array(':top_id' => $this->getId()));
        }

        return $this->descendantIds;
    }

    public static function findForCategoryParentSelectOptions($topId = null)
    {
        $sql = 'SELECT id, label, parent_id FROM '.self::table();
        if (null !== $topId) {
            $sql .= " WHERE top_id={$topId}";
        }
        $sql .= ' ORDER BY priority ASC, id ASC';
        return AppContext::db()->query($sql)->fetchAll();
    }

    public function __toString()
    {
        return $this->getLabel();
    }

    /**
     * @param string|null $orderBy
     * @return Category[]
     */
    public static function findAllTopCategories($orderBy = null)
    {
        return self::findAll('parent_id=:parent_id', array(':parent_id' => 0), $orderBy);
    }
}