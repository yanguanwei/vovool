<?php

namespace Youngx\Bundle\PageBundle\PageVariable;

use Youngx\Bundle\PageBundle\Entity\PageGroup;
use Youngx\Bundle\PageBundle\Form\AdminGroupPageListForm;
use Youngx\Bundle\PageBundle\PageVariableSettings;
use Youngx\Bundle\PageBundle\PageVariableType;

class GroupPageList implements PageVariableType
{
    public static function name()
    {
        return 'group-page-list';
    }

    public static function label()
    {
        return '页面列表';
    }

    public function value(PageVariableSettings $settings)
    {
        $pageGroup = PageGroup::load($settings['page_group']);
        return $pageGroup->getPages();
    }

    public function settingsForm()
    {
        return new AdminGroupPageListForm();
    }
}