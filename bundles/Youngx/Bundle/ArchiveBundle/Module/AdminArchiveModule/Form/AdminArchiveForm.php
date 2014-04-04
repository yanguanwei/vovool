<?php

namespace Youngx\Bundle\ArchiveBundle\Module\AdminArchiveModule\Form;

use Youngx\Bundle\ArchiveBundle\Entity\Archive;
use Youngx\Bundle\ArchiveBundle\Entity\Channel;
use Youngx\MVC\EntityForm;
use Youngx\MVC\Form;

abstract class AdminArchiveForm extends EntityForm
{
    /**
     * @var Channel
     */
    protected $channel;
    protected $entityCode;

    public function __construct(Channel $channel, Archive $archive)
    {
        $this->channel = $channel;
        if ($archive->isNew()) {
            $archive->setChannelId($channel->getId());
        }
        parent::__construct($archive);
    }

    /**
     * @param Archive $entity
     */
    protected function onBeforeEntitySave($entity)
    {
        if ($entity->isNew()) {
            $entity->setEntityCode($this->entityCode);
            $entity->setCreatedAt(Y_TIME);
        }
        $entity->setUpdatedAt(Y_TIME);
    }

    public function setEntityCode($entityCode)
    {
        $this->entityCode = $entityCode;
    }
}