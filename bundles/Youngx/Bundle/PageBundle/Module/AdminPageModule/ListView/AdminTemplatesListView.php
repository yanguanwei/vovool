<?php

namespace Youngx\Bundle\PageBundle\Module\AdminPageModule\ListView;

use Youngx\Bundle\PageBundle\Entity\Template;
use Youngx\Bundle\PageBundle\Entity\Theme;
use Youngx\MVC\AppContext;
use Youngx\MVC\Html;
use Youngx\MVC\ListView;
use Youngx\MVC\PagingQuery;

class AdminTemplatesListView extends ListView implements ListView\Column
{
    /**
     * @var Theme
     */
    protected $theme;

    public function __construct(Theme $theme = null)
    {
        $this->theme = $theme;

        $query = AppContext::repository()->query('template');
        $query->orderBy('path ASC');
        $pagingQuery = new PagingQuery($query);
        $pagingQuery->query();

        parent::__construct($pagingQuery);
    }

    protected function setup()
    {
        $this->addColumn($this);
    }

    /**
     * @param Template $template
     * @param Html $li
     */
    public function format($template, Html $li)
    {
        $buttons = array();

        $templateName = $template->getName();
        if ($this->theme) {
            $themeTemplate = $template->getThemeTemplate($this->theme);
            if ($themeTemplate) {
                $editUrl = AppContext::generateUrl('admin-theme-template-edit', array(
                        'theme' => $this->theme->getId(),
                        'template' => $template->getId()
                    ));
                $buttons[] = new Html('a', array(
                    'content' => $templateName,
                    'href' => $editUrl
                ));

                $deleteUrl = AppContext::value('admin-confirm-delete', 'theme_template', $themeTemplate->getId(), 'admin-theme-template-delete', array('theme' => $this->theme->getId()));
                $buttons[] = new Html('a', array(
                    'href' => $deleteUrl,
                    'content' => '删除'
                ));
            } else {
                $buttons[] = new Html('a', array(
                    'content' => $templateName,
                    'href' => AppContext::generateUrl('admin-template-edit', array('template' => $template->getId()))
                ));

                $overrideUrl = AppContext::generateUrl('admin-theme-template-override', array(
                        'theme' => $this->theme->getId(),
                        'template' => $template->getId()
                    ));
                $buttons[] = new Html('a', array(
                    'href' => $overrideUrl,
                    'content' => '覆盖'
                ));
            }
        } else {
            $buttons[] = new Html('a', array(
                'content' => $templateName,
                'href' => AppContext::generateUrl('admin-template-edit', array('template' => $template->getId()))
            ));
            $buttons[] = new Html('a', array(
                'href' => AppContext::value('admin-confirm-delete', 'template', $template->getId(), 'admin-template-delete'),
                'content' => '删除'
            ));
        }

        $li->setContent(implode(" | ", $buttons));
    }

    public function getName()
    {
        return 'template';
    }
}