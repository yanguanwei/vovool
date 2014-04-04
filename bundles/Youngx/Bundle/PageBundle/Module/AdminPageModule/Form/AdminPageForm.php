<?php

namespace Youngx\Bundle\PageBundle\Module\AdminPageModule\Form;

use Youngx\Bundle\PageBundle\Entity\Page;
use Youngx\Bundle\PageBundle\Entity\PageGroup;
use Youngx\MVC\EntityForm;

class AdminPageForm extends EntityForm
{
    protected $pageGroup;

    public function __construct(PageGroup $pageGroup, Page $page)
    {
        $this->pageGroup = $pageGroup;
        parent::__construct($page);
        $this->bindValue('group_id', $pageGroup->getId());
    }

    protected function setup()
    {
        $this->add('name', '路由名')
            ->addValidator('required')
            ->addValidator('route');

        $this->add('label', '名称')
            ->addValidator('required');

        $this->add('path', '路径')
            ->addValidator('required');

        $this->add('title', '页面标题');

        $this->add('group_id', '导航');

        $this->add('template', '模板');

        $this->add('parent', '父级页面');

        $this->add('menu_class', '菜单类名');


        $this->add('controller', '控制器');

        $this->add('defaults', '默认变量');
    }
}