<?php

namespace Youngx\Bundle\ArchiveBundle;

use Youngx\Bundle\ArchiveBundle\Entity\Archive;
use Youngx\Bundle\ArchiveBundle\Entity\Channel;
use Youngx\Bundle\ArchiveBundle\Module\AdminArchiveModule\Form\AdminArchiveForm;
use Youngx\Bundle\ArchiveBundle\Module\AdminArchiveModule\ListView\AdminArchiveListView;
use Youngx\MVC\AppContext;
use Youngx\MVC\ClassTypeExtension;

abstract class ArchiveContent implements ClassTypeExtension
{
    abstract public function icon();

    /**
     * @param Channel $channel
     * @return AdminArchiveListView
     */
    abstract public function adminListView(Channel $channel);

    /**
     * @param Channel $channel
     * @param Archive $archive
     * @return AdminArchiveForm
     */
    abstract public function adminForm(Channel $channel, Archive $archive);

    public static function label()
    {
        return AppContext::schema()->getEntityCodeLabel(static::name());
    }
}