<?php

namespace Youngx\Bundle\PageBundle\Entity;

use Youngx\MVC\Entity;

class Theme extends Entity
{
    protected $id;
    protected $name;
    protected $label;

    /**
     * @return ThemeTemplate[]
     */
    public function getThemeTemplates()
    {
        return $this->parseExtraFieldValue('theme_templates');
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
        return $this->getName();
    }

    public static function type()
    {
        return 'theme';
    }

    public static function table()
    {
        return 'y_themes';
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

    protected function onBeforeDelete()
    {
        foreach ($this->getThemeTemplates() as $themeTemplate) {
            $themeTemplate->delete();
        }
    }
}