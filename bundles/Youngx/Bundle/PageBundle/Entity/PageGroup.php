<?php

namespace Youngx\Bundle\PageBundle\Entity;

use Youngx\MVC\AppContext;
use Youngx\MVC\Entity;

class PageGroup extends Entity
{
    protected $id;
    protected $name;
    protected $label;
    protected $prefix;

    protected $parent = false;

    /**
     * @return Page[]
     */
    public function getPages()
    {
        return $this->parseExtraFieldValue('pages');
    }

    public static function type()
    {
        return 'page_group';
    }

    public static function table()
    {
        return 'y_page_groups';
    }

    public static function primaryKey()
    {
        return 'id';
    }

    public static function fields()
    {
        return array(
            'id', 'name', 'label', 'prefix'
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
     * @param mixed $prefix
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }

    /**
     * @return mixed
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    public static function findForPageGroupParentSelectOptions()
    {
        $sql = 'SELECT id, label, parent_id FROM '.self::table() . ' ORDER BY id ASC';
        return AppContext::db()->query($sql)->fetchAll();
    }

    public function __toString()
    {
        return $this->getLabel();
    }

    /**
     * @param $id
     * @return PageGroup|null
     */
    public static function load($id)
    {
        if (is_numeric($id)) {
            return AppContext::repository()->load(self::type(), $id);
        } else {
            return self::find('name=:name', array(':name' => $id));
        }
    }

    protected function onBeforeDelete()
    {
        foreach ($this->getPages() as $page) {
            $page->delete();
        }
    }
}