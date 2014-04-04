<?php

namespace Youngx\Bundle\PageBundle\Form;

use Youngx\MVC\Widget\FormWidget;

class AdminArchiveContentListForm extends PageVariableSettingsForm
{
    protected function setup()
    {
        $this->add('channel_id', '栏目')
            ->addValidator('required');

        $this->add('entity_code', '内容类型')
            ->addValidator('required');

        $this->add('is_recommend', '是否推荐');

        $this->add('page_size', '数量')
            ->setHint('0：不限制')
            ->setValue(0);

        $this->alternativeFieldFromUrlAttribute('channel_id');

    }

    protected function renderFieldForFormWidget(FormWidget $formWidget)
    {
        $formWidget->addFieldInput('channel_id', array('channel-select'));
        $formWidget->addFieldInput('entity_code', 'archive-content-select');
        $formWidget->addFieldInput('is_recommend', 'checkbox');
        $formWidget->addFieldInput('page_size', 'text');
    }
}