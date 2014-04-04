<?php

namespace Youngx\Bundle\PageBundle\Entity;

use Youngx\MVC\AppContext;
use Youngx\MVC\Entity;
use Youngx\MVC\Theme as MVCTheme;

class Template extends Entity
{
    protected $id;
    protected $name;
    protected $path;

    protected $themeTemplate = false;
    protected $hasThemeTemplate;

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

    public function __toString()
    {
        return $this->getName();
    }

    public function hasThemeTemplate(Theme $theme)
    {
        return $this->hasThemeTemplate === null ? $this->hasThemeTemplate = AppContext::db()->exist('y_theme_templates', 'theme_id=:theme_id AND template_id=:template_id', array(
                ':theme_id' => $theme->getId(),
                ':template_id' => $this->getId()
            )) : $this->hasThemeTemplate;
    }

    /**
     * @param Theme $theme
     * @return ThemeTemplate|null
     */
    public function getThemeTemplate(Theme $theme)
    {
        return $this->themeTemplate === false ? $this->themeTemplate = ThemeTemplate::find('theme_id=:theme_id AND template_id=:template_id', array(
                ':theme_id' => $theme->getId(),
                ':template_id' => $this->getId()
            )) : $this->themeTemplate;
    }

    public static function type()
    {
        return 'template';
    }

    public static function table()
    {
        return 'y_templates';
    }

    public static function primaryKey()
    {
        return 'id';
    }

    public static function fields()
    {
        return array(
            'id', 'name', 'path'
        );
    }

    public function saveThemeTemplate(Theme $theme)
    {
        $db = AppContext::db();
        $params = array(
            ':theme_id' => $theme->getId(),
            ':template_id' => $this->getId()
        );

        if (!$db->exist('y_theme_templates', 'theme_id=:theme_id AND template_id=:template_id', $params)) {
            $db->insert('y_theme_templates', array(
                    'theme_id' => $theme->getId(),
                    'template_id' => $this->getId()
                ));
        }
    }

    protected function onBeforeDelete()
    {
        $templateFile = MVCTheme::parseAppTemplatePath('Front', $this->getPath());
        if (is_file($templateFile)) {
            unlink($templateFile);
        }
    }
}