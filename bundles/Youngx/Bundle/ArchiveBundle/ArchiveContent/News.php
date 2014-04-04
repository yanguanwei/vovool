<?php

namespace Youngx\Bundle\ArchiveBundle\ArchiveContent;

use Youngx\Bundle\ArchiveBundle\ArchiveContent;
use Youngx\Bundle\ArchiveBundle\Entity\Archive;
use Youngx\Bundle\ArchiveBundle\Entity\Channel;
use Youngx\Bundle\ArchiveBundle\Module\AdminArchiveModule\Form\AdminNewsForm;
use Youngx\Bundle\ArchiveBundle\Module\AdminArchiveModule\ListView\AdminNewsListView;

class News extends ArchiveContent
{
    public static function name()
    {
        return 'news';
    }

    public function adminListView(Channel $channel)
    {
        $listView = new AdminNewsListView($channel, 'news');

        return $listView;
    }

    public function icon()
    {
        return 'book';
    }

    public function adminForm(Channel $channel, Archive $archive)
    {
        return new AdminNewsForm($channel, $archive);
    }
}