<?php

namespace Youngx\Bundle\PageBundle\Form;

use Youngx\MVC\Widget\FormWidget;

class AdminGroupPageListForm extends PageVariableSettingsForm
{
    protected function setup()
    {
        $this->add('page_group', '分组')
            ->addValidator('required');
    }

    protected function renderFieldForFormWidget(FormWidget $formWidget)
    {
        $formWidget->addFieldInput('page_group', 'page-group-select');
    }
}