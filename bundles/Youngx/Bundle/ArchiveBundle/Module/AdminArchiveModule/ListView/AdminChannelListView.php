<?php

namespace Youngx\Bundle\ArchiveBundle\Module\AdminArchiveModule\ListView;

use Youngx\Bundle\ArchiveBundle\Entity\Channel;
use Youngx\MVC\AppContext;
use Youngx\MVC\Html;
use Youngx\MVC\ListView\OperationsCell;
use Youngx\MVC\PagingQuery;
use Youngx\MVC\TreeTable;

class AdminChannelListView extends TreeTable
{
    public function __construct($parentId = 0)
    {
        $request = AppContext::request();
        $parentId = $request->request->get('parent_id', $request->query->get('parent_id', $parentId));
        $query = AppContext::repository()->query('channel')
            ->where('parent_id=:parent_id');
        $pagingQuery = new PagingQuery($query, array(
            ':parent_id' => $parentId
        ));
        $pagingQuery->query();

        parent::__construct($pagingQuery);
        $this->setJsonForPost('{parent_id: entity.id}');
    }

    protected function setup()
    {
        $this->add('label', '栏目', array(
                'style' => 'width: 40%'
            ));

        $this->addColumn(new OperationsCell(array('edit', 'sub', 'delete')));
    }

    public function formatLabelColumnHtml(Html $td, Channel $channel)
    {/*
        $td->setContent(new Html('a', array(
                'content' => $channel->getLabel(),
                'href' => ''//AppContext::generateUrl('admin-channel-view', array('channel' => $channel->getId()))
            )));*/
    }

    public function formatOperationsColumnForEdit(Channel $channel)
    {
        return array(
            'href' => AppContext::generateUrl('admin-channel-edit', array('channel' => $channel->getId())),
            'content' => '编辑'
        );
    }

    public function formatOperationsColumnForSub(Channel $channel)
    {
        return array(
            'href' => AppContext::generateUrl('admin-channel-add', array('channel' => $channel->getId()), true),
            'content' => '添加子栏目'
        );
    }

    public function formatOperationsColumnForDelete(Channel $channel)
    {
        return array(
            'href' => AppContext::value('admin-confirm-delete', 'channel', $channel->getId(), 'admin-channel-delete'),
            'content' => '删除'
        );
    }
} 