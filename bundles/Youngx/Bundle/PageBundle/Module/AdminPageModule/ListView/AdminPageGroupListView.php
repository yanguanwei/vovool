<?php

namespace Youngx\Bundle\PageBundle\Module\AdminPageModule\ListView;

use Youngx\Bundle\PageBundle\Entity\PageGroup;
use Youngx\MVC\AppContext;
use Youngx\MVC\Html;
use Youngx\MVC\ListView\OperationsCell;
use Youngx\MVC\PagingQuery;
use Youngx\MVC\Table;

class AdminPageGroupListView extends Table
{
    public function __construct()
    {
        $query = AppContext::repository()->query('page_group');
        $pagingQuery = new PagingQuery($query);
        $pagingQuery->query();
        parent::__construct($pagingQuery);
    }

    protected function setup()
    {
        $this->add('label', '分组');

        $this->add('name', '机器名');

        $this->addColumn(new OperationsCell(array('edit', 'delete')));
    }

    public function formatLabelColumnHtml(Html $td, PageGroup $entity)
    {
        $td->setContent(new Html\AHtml(array(
            'href' => AppContext::generateUrl('admin-group-page', array('page_group' => $entity->getName())),
            'content' => $entity->getLabel()
        )));
    }

    public function formatOperationsColumnForEdit(PageGroup $entity)
    {
        return array(
            'href' => AppContext::generateUrl('admin-page-group-edit', array('page_group' => $entity->getId())),
            'content' => '编辑'
        );
    }

    public function formatOperationsColumnForDelete(PageGroup $entity)
    {
        return array(
            'href' => AppContext::value('admin-confirm-delete', 'page_group', $entity->getId(), 'admin-page-group-delete'),
            'content' => '删除'
        );
    }
}