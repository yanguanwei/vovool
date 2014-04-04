<?php

namespace Youngx\Bundle\LocaleBundle\Module\AdminLocaleModule\Form;

use Youngx\MVC\AppContext;
use Youngx\MVC\EntityForm;

class AdminLocaleForm extends EntityForm
{
    protected function setup()
    {
        $this->add('name', AppContext::translate('Locale Name'))
            ->addValidator('required');

        $this->add('label', AppContext::translate('Locale Label'))
            ->addValidator('required');

        $this->add('code', AppContext::translate('Locale Code'))
            ->addValidator('required');
    }

    protected function validateInternal()
    {
        if (AppContext::repository()->exist('locale', 'code=:code', array(':code'=>$this->value('code')), $this->getEntity())) {
            return array(
                'code' => 'Locale Code already exists.'
            );
        }
    }
}