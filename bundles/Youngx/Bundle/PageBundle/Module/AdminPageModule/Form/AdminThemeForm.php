<?php

namespace Youngx\Bundle\PageBundle\Module\AdminPageModule\Form;

use Youngx\MVC\AppContext;
use Youngx\MVC\EntityForm;

class AdminThemeForm extends EntityForm
{
    protected function setup()
    {
        $this->add('name', '机器名')
            ->addFilter('trim')
            ->addValidator('required');

        $this->add('label', '名称')
            ->addFilter('trim')
            ->addValidator('required');
    }
}