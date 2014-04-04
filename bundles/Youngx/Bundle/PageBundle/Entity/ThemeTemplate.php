<?php

namespace Youngx\Bundle\PageBundle\Entity;

use Youngx\MVC\Entity;
use Youngx\MVC\Theme as MVCTheme;

class ThemeTemplate extends Entity
{
    protected $id;
    protected $theme_id;
    protected $template_id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $template_id
     */
    public function setTemplateId($template_id)
    {
        $this->template_id = $template_id;
    }

    /**
     * @return mixed
     */
    public function getTemplateId()
    {
        return $this->template_id;
    }

    /**
     * @param mixed $theme_id
     */
    public function setThemeId($theme_id)
    {
        $this->theme_id = $theme_id;
    }

    /**
     * @return mixed
     */
    public function getThemeId()
    {
        return $this->theme_id;
    }

    /**
     * @return Template
     */
    public function getTemplate()
    {
        return $this->parseExtraFieldValue('template');
    }

    /**
     * @return Theme
     */
    public function getTheme()
    {
        return $this->parseExtraFieldValue('theme');
    }

    public function setTheme(Theme $theme)
    {
        $this->holdExtraFieldValue('theme', $theme);

        return $this;
    }

    public function setTemplate(Template $template)
    {
        $this->holdExtraFieldValue('template', $template);

        return $this;
    }

    public function __toString()
    {
        return $this->getTemplate()->getName();
    }

    public static function type()
    {
        return 'theme_template';
    }

    public static function table()
    {
        return 'y_theme_templates';
    }

    public static function primaryKey()
    {
        return 'id';
    }

    public static function fields()
    {
        return array(
            'id', 'theme_id', 'template_id'
        );
    }

    protected function onBeforeDelete()
    {
        $template = $this->getTemplate();
        $theme = $this->getTheme();

        $templateFile = MVCTheme::parseAppThemeTemplatePath('Front', $theme->getName(), $template->getPath());
        if (is_file($templateFile)) {
            unlink($templateFile);
        }
    }
}