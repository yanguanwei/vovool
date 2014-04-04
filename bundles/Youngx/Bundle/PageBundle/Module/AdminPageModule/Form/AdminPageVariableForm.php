<?php

namespace Youngx\Bundle\PageBundle\Module\AdminPageModule\Form;

use Youngx\Bundle\PageBundle\Entity\Page;
use Youngx\Bundle\PageBundle\Entity\PageVariable;
use Youngx\MVC\EntityForm;
use Youngx\MVC\Form;
use Youngx\MVC\Widget\FormWidget;

class AdminPageVariableForm extends EntityForm
{
    protected $page;

    public function __construct(Page $page, PageVariable $pageVariable)
    {
        $this->page = $page;
        parent::__construct($pageVariable);
    }

    protected function setup()
    {
        $this->add('name', '变量名')
            ->addValidator('required');

        $this->add('type', '变量类型')
            ->addValidator('required');
    }

    public function render()
    {
        $formWidget = new FormWidget($this, array(
            'skin' =>  'ace-horizontal',
            'submit' => '保存'
        ));

        $formWidget->addFieldInput('type', 'page-variable-select');
        $formWidget->addFieldInput('name', 'text');

        return $formWidget;
    }

    /**
     * @param PageVariable $entity
     */
    protected function onBeforeEntitySave($entity)
    {
        $entity->setPageId($this->page->getId());
    }
}