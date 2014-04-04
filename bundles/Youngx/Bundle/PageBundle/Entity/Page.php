<?php

namespace Youngx\Bundle\PageBundle\Entity;

use Youngx\MVC\Entity;

class Page extends Entity
{
    protected $id;
    protected $name;
    protected $label;
    protected $group_id;
    protected $template;
    protected $menu_class;
    protected $parent;
    protected $controller;
    protected $path;
    protected $title;
    protected $is_display;
    protected $options;
    protected $defaults;

    protected $defaultsArray;

    protected $group;

    /**
     * @return PageGroup
     */
    public function getGroup()
    {
        return $this->group ?: ($this->group = PageGroup::load($this->group_id));
    }

    public function setGroup(PageGroup $group)
    {
        $this->group = $group;
    }

    /**
     * @return PageVariable[]
     */
    public function getVariables()
    {
        return $this->parseExtraFieldValue('variables');
    }

    public function getPageVariables()
    {
        $variables = array(
            'title' => $this->getTitle()
        );

        foreach ($this->getVariables() as $variable) {
            $variables[$variable->getName()] = $variable->getValue();
        }

        return $variables;
    }

    /**
     * @param mixed $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    /**
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }

    public function setDefaults($defaults)
    {
        if (is_array($defaults)) {
            foreach ($defaults as $key => $value) {
                $defaults[$key] = "{$key}={$value}";
            }
            $defaults = implode("\n", $defaults);
        }
        $this->defaults = $defaults;
    }

    /**
     * @param mixed $menu_class
     */
    public function setMenuClass($menu_class)
    {
        $this->menu_class = $menu_class;
    }

    /**
     * @return mixed
     */
    public function getMenuClass()
    {
        return $this->menu_class;
    }

    public function getDefaults()
    {
        return $this->defaults;
    }

    public function getDefaultsToArray()
    {
        if (!is_array($this->defaultsArray)) {
            $defaults = array();
            if ($this->defaults) {
                foreach (explode("\n", $this->defaults) as $item) {
                    list($key, $value) = explode('=', $item, 2);
                    $defaults[trim($key)] = trim($value);
                }
            }
            $this->defaultsArray = $defaults;
        }
        return $this->defaultsArray;
    }

    public function getTemplate()
    {
        return $this->template;
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
     * @param mixed $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param mixed $is_display
     */
    public function setIsDisplay($is_display)
    {
        $this->is_display = $is_display;
    }

    /**
     * @return mixed
     */
    public function getIsDisplay()
    {
        return $this->is_display;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $group_id
     */
    public function setGroupId($group_id)
    {
        $this->group_id = $group_id;
    }

    /**
     * @return mixed
     */
    public function getGroupId()
    {
        return $this->group_id;
    }

    public function setTemplate($template)
    {
        $this->template = $template;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $controller
     */
    public function setController($controller)
    {
        $this->controller = $controller;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    public function __toString()
    {
        return $this->getLabel();
    }

    public static function type()
    {
        return 'page';
    }

    public static function table()
    {
        return 'y_pages';
    }

    public static function primaryKey()
    {
        return 'id';
    }

    public static function fields()
    {
        return array(
            'id', 'group_id', 'template', 'controller', 'parent', 'menu_class', 'name', 'label', 'path', 'title', 'is_display', 'options', 'defaults'
        );
    }

    protected function onBeforeDelete()
    {
        foreach ($this->getVariables() as $variable) {
            $variable->delete();
        }
    }
}