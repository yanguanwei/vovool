<?php

namespace Youngx\Bundle\ArchiveBundle\ArchiveContent;

use Youngx\Bundle\ArchiveBundle\ArchiveContent;
use Youngx\Bundle\ArchiveBundle\Entity\Archive;
use Youngx\Bundle\ArchiveBundle\Entity\Channel;
use Youngx\Bundle\ArchiveBundle\Module\AdminArchiveModule\Form\AdminArchiveForm;
use Youngx\Bundle\ArchiveBundle\Module\AdminArchiveModule\Form\AdminDownloadForm;
use Youngx\Bundle\ArchiveBundle\Module\AdminArchiveModule\ListView\AdminArchiveListView;
use Youngx\Bundle\ArchiveBundle\Module\AdminArchiveModule\ListView\AdminDownloadListView;

class Download extends ArchiveContent
{
    public function icon()
    {
        return 'download';
    }

    /**
     * @param Channel $channel
     * @return AdminArchiveListView
     */
    public function adminListView(Channel $channel)
    {
        return new AdminDownloadListView($channel, 'download');
    }

    /**
     * @param Channel $channel
     * @param Archive $archive
     * @return AdminArchiveForm
     */
    public function adminForm(Channel $channel, Archive $archive)
    {
        return new AdminDownloadForm($channel, $archive);
    }

    public static function name()
    {
        return 'download';
    }
}