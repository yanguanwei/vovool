<?php

namespace Youngx\Bundle\ArchiveBundle\Module\AdminArchiveModule\Form;

use Youngx\Bundle\ArchiveBundle\Entity\Channel;
use Youngx\MVC\AppContext;
use Youngx\MVC\EntityForm;

class AdminChannelForm extends EntityForm
{
    protected function setup()
    {
        $this->add('name', '机器名')
            ->addFilter('trim')
            ->addValidator('required')
            ->addValidator('name');

        $this->add('label', '名称')
            ->addFilter('trim')
            ->addValidator('required');

        $this->add('parent_id', '父栏目', 'integer');

        $this->add('archive_contents', '关联内容', 'array');

       // $this->add('vocabulary_ids', '词汇表');
    }

    protected function validateInternal()
    {
        $parentId = $this->value('parent_id');
        $entity = $this->getEntity();

        if (!$entity->isNew()) {
            $id = $entity->get('id');
            $isParentValid = ($id != $parentId);
            if ($isParentValid && $parentId) {
                while ($parentId) {
                    $channel = Channel::load($parentId);
                    $parentId = $channel ? $channel->get('parent_id') : 0;
                    if ($parentId == $id) {
                        $isParentValid = false;
                        break;
                    }
                }
            }

            if (!$isParentValid) {
                return array(
                    'parent_id' => '父栏目非法'
                );
            }
        }

        if (AppContext::repository()->exist('channel', 'name=:name', array(':name' => $this->value('name')), $entity)) {
            return array(
                'name' => '已经存在的栏目机器名'
            );
        }
    }

    /**
     * @param Channel $entity
     */
    protected function onBeforeEntitySave($entity)
    {
        if ($entity->isNew()) {
            if ($entity->getParentId()) {
                $entity->setTopId($entity->getParent()->getTopId());
            }
        } else {
            if ($entity->getParentId()) {
                $entity->setTopId($entity->getParent()->getTopId());
            } else {
                $entity->setTopId($entity->getId());
            }
        }
    }

    /**
     * @param Channel $entity
     */
    protected function onAfterEntitySave($entity)
    {
        $unchangedEntity = $entity->unchangedEntity();
        if ($unchangedEntity instanceof Channel) {
            if ($unchangedEntity->isNew()) {
                if (!$unchangedEntity->getParentId()) {
                    $entity->updateFields(array('top_id' => $entity->getId()));
                }
            }
        }
    }
}