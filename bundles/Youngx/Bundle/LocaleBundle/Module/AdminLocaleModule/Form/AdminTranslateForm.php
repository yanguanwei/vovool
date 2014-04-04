<?php

namespace Youngx\Bundle\LocaleBundle\Module\AdminLocaleModule\Form;

use Youngx\MVC\EntityForm;

class AdminTranslateForm extends EntityForm
{
    protected function setup()
    {
        $this->add('locale_id', '语言', 'integer')
            ->addValidator('required');

        $this->add('message', '原文')
            ->addValidator('required');

        $this->add('translation', '译文')
            ->addValidator('required');

        $this->add('type', '类型')
            ->addValidator('required');
    }
}