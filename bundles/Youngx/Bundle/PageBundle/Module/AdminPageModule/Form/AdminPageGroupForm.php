<?php

namespace Youngx\Bundle\PageBundle\Module\AdminPageModule\Form;

use Youngx\MVC\AppContext;
use Youngx\MVC\EntityForm;

class AdminPageGroupForm extends EntityForm
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

        $this->add('prefix', '前缀');
    }

    protected function validateInternal()
    {
        $entity = $this->getEntity();
        if (AppContext::repository()->exist('page_group', 'name=:name', array(':name' => $this->value('name')), $entity)) {
            return array(
                'name' => '已经存在的导航机器名'
            );
        }
    }
}