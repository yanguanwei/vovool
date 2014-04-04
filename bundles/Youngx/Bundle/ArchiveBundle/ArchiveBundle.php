<?php

namespace Youngx\Bundle\ArchiveBundle;

use Youngx\Bundle\ArchiveBundle\Entity\Archive;
use Youngx\Bundle\ArchiveBundle\Entity\Channel;
use Youngx\MVC\AppContext;
use Youngx\MVC\Bundle;
use Youngx\MVC\Html\SelectHtml;
use Youngx\MVC\ListenerRegistry;
use Youngx\MVC\PagingQuery;
use Youngx\MVC\ServiceRegistry;
use Youngx\MVC\Template;

class ArchiveBundle extends Bundle implements ServiceRegistry, ListenerRegistry
{
    public static function registerServices()
    {
        return array(
            'archiveContentCollection' => __NAMESPACE__.'\ArchiveContentCollection'
        );
    }

    public function onArchiveContentCollect()
    {
        return array(
            __NAMESPACE__.'\ArchiveContent\News',
            __NAMESPACE__.'\ArchiveContent\Picture',
            __NAMESPACE__.'\ArchiveContent\Download'
        );
    }

    public static function registerListeners()
    {
        return array(
            'archive.content.collect' => 'onArchiveContentCollect',
        );
    }
}