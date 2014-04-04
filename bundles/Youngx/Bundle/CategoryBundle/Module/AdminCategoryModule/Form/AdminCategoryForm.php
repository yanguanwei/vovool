<?php

namespace Youngx\Bundle\CategoryBundle\Module\AdminCategoryModule\Form;

use Youngx\Bundle\CategoryBundle\Entity\Category;
use Youngx\MVC\AppContext;
use Youngx\MVC\EntityForm;
use Youngx\MVC\Form;

class AdminCategoryForm extends EntityForm
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

        $this->add('parent_id', '父分类', 'integer');
    }

    protected function validateInternal()
    {
        $entity = $this->getEntity();
        $parentId = $this->value('parent_id');

        if ($parentId && $entity instanceof Category && $entity->isNew()) {
            if ($parentId == $entity->getId()) {
                return array(
                    'parent_id' => '不能选择自己作为父分类'
                );
            } else {
                $parent = AppContext::repository()->load('category', $this->parent_id);
                if ($parent && $parent instanceof Category) {
                    foreach ($parent->getPaths() as $category) {
                        if ($category->getId() == $entity->getId()) {
                            return array(
                                'parent_id' => '不能选择该分类的子分类作为其父分类'
                            );
                            break;
                        }
                    }
                } else {
                    return array(
                        'parent_id' => '不存在的父分类'
                    );
                }
            }
        }
    }

    /**
     * @param Category $entity
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
     * @param Category $entity
     */
    protected function onAfterEntitySave($entity)
    {
        $unchangedEntity = $entity->unchangedEntity();
        if ($unchangedEntity instanceof Category) {
            if ($unchangedEntity->isNew()) {
                if (!$unchangedEntity->getParentId()) {
                    $entity->updateFields(array('top_id' => $entity->getId()));
                }
            }
        }
    }
}