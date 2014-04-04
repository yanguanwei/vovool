<?php

namespace Youngx\Bundle\ArchiveBundle\Menu;

use Youngx\Bundle\ArchiveBundle\Entity\Archive;
use Youngx\MVC\AppContext;
use Youngx\MVC\Menu;

class ArchiveViewMenu extends Menu
{
    protected function onGetBreadcrumbs()
    {
        $archive = AppContext::request()->attributes->get('archive');
        if ($archive && $archive instanceof Archive) {
            $channel = $archive->getChannel();
            $breadcrumbs = array();
            if (!$channel->isTop()) {
                $breadcrumbs[] = array(
                    'label' => $channel->getLabel(),
                    'url' => AppContext::generateUrl($this->parent, array('channel' => $channel->getName()))
                );
            }
            $breadcrumbs[] = array(
                'url' => AppContext::request()->getUri(),
                'label' => $archive->getTitle()
            );

            return $breadcrumbs;
        } else {
            return parent::onGetBreadcrumbs();
        }
    }
}