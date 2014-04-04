<?php

namespace Youngx\Bundle\ArchiveBundle\Module\AdminArchiveModule\ListView;

use Youngx\Bundle\ArchiveBundle\Entity\Archive;
use Youngx\Bundle\ArchiveBundle\Entity\Channel;
use Youngx\MVC\AppContext;
use Youngx\MVC\Html;
use Youngx\MVC\ListView\OperationsCell;
use Youngx\MVC\PagingQuery;
use Youngx\MVC\Table;

abstract class AdminArchiveListView extends Table
{
    protected $entityCode;

    public function __construct(Channel $channel, $entityCode)
    {
        $this->entityCode = $entityCode;
        parent::__construct($this->query($channel, $entityCode));
    }

    protected function query(Channel $channel, $entityCode)
    {
        $query = Archive::query()->filterEntityCode($entityCode)->inTopChannel($channel)->recently();
        $pagingQuery = new PagingQuery($query);
        $pagingQuery->query();
        return $pagingQuery;
    }

    protected function setup()
    {
        $this->add('title', '标题');
        $this->add('channel', '栏目');
        $this->add('status_label', '状态');
        $this->addColumn(new OperationsCell(array('edit', 'delete')));
    }

    public function formatTitleColumnHtml(Html $td, Archive $archive)
    {
        if ($archive->getIsRecommend()) {
            $td->append('<span class="is-recommend">[荐]</span>');
        }
    }

    public function formatOperationsColumnForEdit(Archive $archive)
    {
        return array(
            'content' => '编辑',
            'href' => AppContext::generateUrl('admin-archive-edit', array(
                        'archive' => $archive->getId(),
                        'channel' => $archive->getChannel()->getTop()->getName(),
                        'entityCode' => $this->entityCode
                    ))
        );
    }

    public function formatOperationsColumnForDelete(Archive $archive)
    {
        return array(
            'content' => '删除',
            'href' => AppContext::value('admin-confirm-delete', 'archive', $archive->getId(), 'admin-archive-delete', array(
                        'channel' => $archive->getChannel()->getTop()->getName(),
                        'entityCode' => $archive->getEntityCode(),
                    ))
        );
    }
}