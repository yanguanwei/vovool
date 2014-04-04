<?php

namespace Youngx\Bundle\ArchiveBundle\ArchiveContent;

use Youngx\Bundle\ArchiveBundle\ArchiveContent;
use Youngx\Bundle\ArchiveBundle\Entity\Archive;
use Youngx\Bundle\ArchiveBundle\Entity\Channel;
use Youngx\Bundle\ArchiveBundle\Module\AdminArchiveModule\Form\AdminPictureForm;
use Youngx\Bundle\ArchiveBundle\Module\AdminArchiveModule\ListView\AdminNewsListView;

class Picture extends ArchiveContent
{
    public static function name()
    {
        return 'picture';
    }

    public function adminListView(Channel $channel)
    {
        $listView = new AdminNewsListView($channel, 'picture');

        return $listView;
    }

    public function icon()
    {
        return 'picture';
    }

    public function adminForm(Channel $channel, Archive $archive)
    {
        return new AdminPictureForm($channel, $archive);
    }
}