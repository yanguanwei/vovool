<?php

namespace Youngx\Bundle\DistrictBundle\Entity;

use Youngx\MVC\AppContext;
use Youngx\MVC\Entity;

class District extends Entity
{
    protected $id;
    protected $name;
    protected $code;
    protected $layer;
    protected $parent_id = 0;
    protected $priority = 0;

    public static function type()
    {
        return 'district';
    }

    public static function table()
    {
        return 'y_districts';
    }

    public static function primaryKey()
    {
        return 'id';
    }

    public static function fields()
    {
        return array(
            'id', 'name', 'code', 'layer', 'parent_id', 'priority'
        );
    }

    /**
     * @return District[]
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
     * @return District | null
     */
    public function getParent()
    {
        return $this->parent_id ? AppContext::repository()->load('district', $this->parent_id) : null;
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
     * @param mixed $layer
     */
    public function setLayer($layer)
    {
        $this->layer = $layer;
    }

    /**
     * @return mixed
     */
    public function getLayer()
    {
        return $this->layer;
    }

    /**
     * @param mixed $parent_id
     */
    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;
    }

    /**
     * @return mixed
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

    public function hasChildren()
    {
        return AppContext::repository()->exist('district', 'parent_id=:parent_id', array(':parent_id' => $this->id));
    }

    public function __toString()
    {
        return $this->getName();
    }
}