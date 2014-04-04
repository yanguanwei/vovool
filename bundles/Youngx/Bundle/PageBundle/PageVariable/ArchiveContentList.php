<?php

namespace Youngx\Bundle\PageBundle\PageVariable;

use Youngx\Bundle\ArchiveBundle\Entity\ArchiveQuery;
use Youngx\Bundle\ArchiveBundle\Entity\Channel;
use Youngx\Bundle\PageBundle\Form\AdminArchiveContentListForm;
use Youngx\Bundle\PageBundle\PageVariableSettings;
use Youngx\Bundle\PageBundle\PageVariableType;
use Youngx\MVC\AppContext;
use Youngx\MVC\PagingQuery;

class ArchiveContentList implements PageVariableType
{

    public static function name()
    {
        return 'archive-content-list';
    }

    public static function label()
    {
        return '内容列表';
    }

    public function value(PageVariableSettings $settings)
    {
        $entityType = AppContext::schema()->getEntityTypeByCode($settings['entity_code']);
        $channel = $settings['channel_id'];
        if (!$channel instanceof Channel) {
            $channel = Channel::load($channel);
        }
        $query = AppContext::repository()->query($entityType);
        if ($query instanceof ArchiveQuery) {
            if ($channel->getTopId() == $channel->getId()) {
                $query->inDescendantChannel($channel);
            } else {
                $query->inChannel($channel);
            }
            $query->filterEntityCode($settings['entity_code'])->published()->recently();

            if ($settings->get('is_recommend', 0)) {
                $query->recommended();
            }

            $pagingQuery = new PagingQuery($query);
            $pagingQuery->setPageSize($settings->get('page_size', 0));

            $pagingQuery->query();
            return $pagingQuery;
        } else {
            throw new \RuntimeException(sprintf('Invalid EntityCode[%s] for Archive Content.', $settings['entity_code']));
        }
    }

    public function settingsForm()
    {
        return new AdminArchiveContentListForm();
    }
}