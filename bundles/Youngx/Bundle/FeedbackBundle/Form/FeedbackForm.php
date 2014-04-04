<?php

namespace Youngx\Bundle\FeedbackBundle\Form;

use Youngx\Bundle\FeedbackBundle\Entity\Feedback;
use Youngx\MVC\EntityForm;

class FeedbackForm extends EntityForm
{
    protected function setup()
    {
        $this->add('name', '姓名')
            ->addValidator('required')
            ->addValidator('rangelength', array(3, 32))
            ->addFilter('htmlentities');

        $this->add('email', '邮箱')
            ->addValidator('rangelength', array(0, 32))
            ->addFilter('htmlentities');

        $this->add('phone', '电话')
            ->addValidator('rangelength', array(0, 32))
            ->addFilter('htmlentities');

        $this->add('qq', '在线联系')
            ->addValidator('rangelength', array(0, 32))
            ->addFilter('htmlentities');

        $this->add('intention_id', '目的')
            ->addValidator('required')
            ->addFilter('htmlentities');

        $this->add('content', '需求说明')
            ->addValidator('rangelength', array(0, 255))
            ->addFilter('htmlentities');
    }

    /**
     * @param Feedback $entity
     */
    protected function onBeforeEntitySave($entity)
    {
        if ($entity->isNew()) {
            $entity->setCreatedAt(Y_TIME);
        }
    }
}