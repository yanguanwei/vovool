<?php

namespace Youngx\Bundle\PageBundle\Module\AdminPageModule\ListView;

use Youngx\Bundle\PageBundle\Entity\Page;
use Youngx\Bundle\PageBundle\Entity\PageGroup;
use Youngx\MVC\AppContext;
use Youngx\MVC\Html;
use Youngx\MVC\ListView\OperationsCell;
use Youngx\MVC\PagingQuery;
use Youngx\MVC\Table;

class AdminPageListView extends Table
{
    protected $pageGroup;

    public function __construct(PageGroup $pageGroup)
    {
        $this->pageGroup = $pageGroup;

        $query = AppContext::repository()->query('page');
        $query->where('group_id=?', $pageGroup->getId());

        $pagingQuery = new PagingQuery($query);
        $pagingQuery->query();
        parent::__construct($pagingQuery);
    }

    protected function setup()
    {
        $this->add('label', '页面');
        $this->add('name', '路由名');
        $this->add('path', '路径');
        $this->add('variables', '变量');
        $this->addColumn(new OperationsCell(array('edit', 'variable', 'delete')));
    }

    public function formatVariablesColumnHtml(Html $td, Page $page)
    {
        $variables = array();
        foreach ($page->getVariables() as $variable) {
            $edit = new Html('a', array(
                'content' => $variable->getName(),
                'href' => AppContext::generateUrl('admin-page-variable-edit', array(
                            'page' => $page->getId(),
                            'page_group' => $page->getGroup()->getName(),
                            'page_variable' => $variable->getId()
                        ))
            ));

            $delete = new Html('a', array(
                'content' => '删除',
                'href' => AppContext::value('admin-confirm-delete', 'page_variable', $variable->getId(), 'admin-page-variable-delete', array(
                            'page_group' => $page->getGroup()->getName(), 'page' => $page->getId()
                        ))
            ));

            $variables[] = sprintf('%s [%s]', $edit, $delete);
        }
        $td->setContent(implode("<br />", $variables));
    }

    public function formatOperationsColumnForEdit(Page $page)
    {
        return array(
            'content' => '编辑',
            'href' => AppContext::generateUrl('admin-page-edit', array('page_group' => $page->getGroup()->getName(), 'page' => $page->getId()))
        );
    }

    public function formatOperationsColumnForVariable(Page $page)
    {
        return array(
            'content' => '添加变量',
            'href' => AppContext::generateUrl('admin-page-variable-add', array('page_group' => $page->getGroup()->getName(), 'page' => $page->getId()))
        );
    }

    public function formatOperationsColumnForDelete(Page $page)
    {
        return array(
            'content' => '删除',
            'href' => AppContext::value('admin-confirm-delete', 'page', $page->getId(), 'admin-page-delete', array ('page_group' => $page->getGroup()->getName()))
        );
    }
}