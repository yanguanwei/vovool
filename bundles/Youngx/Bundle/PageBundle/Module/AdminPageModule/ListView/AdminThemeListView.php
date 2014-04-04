<?php

namespace Youngx\Bundle\PageBundle\Module\AdminPageModule\ListView;

use Youngx\Bundle\PageBundle\Entity\Theme;
use Youngx\MVC\AppContext;
use Youngx\MVC\Html;
use Youngx\MVC\ListView;
use Youngx\MVC\PagingQuery;

class AdminThemeListView extends ListView implements ListView\Column
{
    public function __construct()
    {
        $query = AppContext::repository()->query('theme');
        $pagingQuery = new PagingQuery($query);
        $pagingQuery->query();
        parent::__construct($pagingQuery);
    }

    protected function setup()
    {
        $this->addColumn($this);
    }

    /**
     * @param Theme $theme
     * @param Html $li
     */
    public function format($theme, Html $li)
    {
        $edit = new Html('a', array(
            'content' => $theme->getName(),
            'href' => AppContext::generateUrl('admin-theme-view', array('theme' => $theme->getId()))
        ));

        $templates = new Html('a', array(
            'content' => '模板',
            'href' => AppContext::generateUrl('admin-theme-templates', array('theme' => $theme->getId()))
        ));

        $assets = new Html('a', array(
            'content' => '资源',
            'href' => AppContext::generateUrl('admin-theme-assets', array('theme' => $theme->getId()))
         ));

        $delete = new Html('a', array(
            'content' => '删除',
            'href' => AppContext::value('admin-confirm-delete', 'theme', $theme->getId(), 'admin-theme-delete')
        ));

        $li->setContent("{$edit} | {$templates} | {$assets} | {$delete}");
    }

    public function getName()
    {
        return 'theme';
    }
}