<?php

namespace Youngx\Bundle\PageBundle\Entity;

use Youngx\Bundle\PageBundle\PageVariableSettings;
use Youngx\MVC\AppContext;
use Youngx\MVC\Entity;

class PageVariable extends Entity
{
    protected $id;
    protected $page_id;
    protected $type;
    protected $name;
    protected $settings;
    protected $settingsObject;

    protected $page;

    protected $value;

    public function getValue()
    {
        return AppContext::service('pageVariableTypeCollection')->getValue($this->getType(), $this->getSettings());
    }

    /**
     * @return Page
     */
    public function getPage()
    {
        return $this->page ?: ($this->page = Page::load($this->page_id));
    }

    public function setSettings(PageVariableSettings $settings)
    {
        $this->settings = serialize($settings);

        return $this;
    }

    /**
     * @return PageVariableSettings|null
     */
    public function getSettings()
    {
        if (null === $this->settingsObject) {
            if ($this->settings) {
                $this->settingsObject = unserialize($this->settings);
            }
        }
        return $this->settingsObject;
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
     * @param mixed $page_id
     */
    public function setPageId($page_id)
    {
        $this->page_id = $page_id;
    }

    /**
     * @return mixed
     */
    public function getPageId()
    {
        return $this->page_id;
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

    public function __toString()
    {
        return $this->getName();
    }

    public static function type()
    {
        return 'page_variable';
    }

    public static function table()
    {
        return 'y_page_variables';
    }

    public static function primaryKey()
    {
        return 'id';
    }

    public static function fields()
    {
        return array(
            'id', 'page_id', 'type', 'name', 'settings'
        );
    }
}