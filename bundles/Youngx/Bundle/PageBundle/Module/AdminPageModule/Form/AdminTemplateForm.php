<?php

namespace Youngx\Bundle\PageBundle\Module\AdminPageModule\Form;

use Youngx\Bundle\PageBundle\Entity\Template;
use Youngx\Bundle\PageBundle\Entity\Theme;
use Youngx\MVC\Form;
use Youngx\MVC\Theme as MVCTheme;

class AdminTemplateForm extends Form
{
    /**
     * @var Template
     */
    protected $template;
    /**
     * @var Theme
     */
    private $theme;

    public function __construct(Template $template, Theme $theme = null)
    {
        $this->template = $template;
        $this->theme = $theme;

        parent::__construct('adminTemplateForm');

        if ($theme) {
            $this->bindData(array('theme_id' => $theme->getId()));
        }

        if (!$template->isNew()) {
            if ($this->theme) {
                $templateFile = MVCTheme::parseAppThemeTemplatePath('Front', $this->theme->getName(), $template->getPath());
                $this->getField('name')->disable();
                $this->getField('path')->disable();
            } else {
                $templateFile = MVCTheme::parseAppTemplatePath('Front', $template->getPath());
            }

            $this->bindData(array(
                    'name' => $template->getName(),
                    'path' => $template->getPath(),
                    'code' => is_file($templateFile) ? file_get_contents($templateFile) : ''
                ));
        }
    }

    protected function setup()
    {
        $this->add('name', '名称')
            ->addValidator('required')
            ->addFilter('trim');

        $this->add('path', '路径')
            ->addValidator('required')
            ->addFilter('trim', array('/'));

        $this->add('theme_id', '主题', 'integer');

        $this->add('code', '代码');
    }

    public function submit()
    {
        $this->template->set($this->toArray());

        if ($this->theme) {
            if ($this->template->isNew()) {
                $this->template->save();
            }
            $this->template->saveThemeTemplate($this->theme);
            $templateFile = MVCTheme::parseAppThemeTemplatePath('Front', $this->theme->getName(), $this->template->getPath());
        } else {
            $this->template->save();
            $templateFile = MVCTheme::parseAppTemplatePath('Front', $this->template->getPath());
        }

        $dir = dirname($templateFile);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        file_put_contents($templateFile, $this->value('code'));
    }
}