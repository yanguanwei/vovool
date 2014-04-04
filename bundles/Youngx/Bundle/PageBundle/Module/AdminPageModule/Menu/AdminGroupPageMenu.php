<?php

namespace Youngx\Bundle\PageBundle\Module\AdminPageModule\Menu;

use Youngx\Bundle\PageBundle\Entity\PageGroup;
use Youngx\MVC\AppContext;
use Youngx\MVC\Menu;

class AdminGroupPageMenu extends Menu
{
    private $navigation;

    public function getNavigation()
    {
        if (null === $this->navigation) {
            $navigation = array();
            foreach (PageGroup::findAll() as $pageGroup) {
                if ($pageGroup instanceof PageGroup) {
                    $navigation[$pageGroup->getLabel()] = AppContext::generateUrl('admin-group-page', array(
                            'page_group' => $pageGroup->getName()
                        ));
                }
            }
            $this->navigation = $navigation;
        }

        return $this->navigation;
    }

    public function isNavigationActive($label)
    {
        $pageGroup = AppContext::request()->attributes->get('page_group');
        if ($pageGroup && $pageGroup instanceof PageGroup) {
            return $label == $pageGroup->getLabel();
        }

        return false;
    }

    public function getLabel()
    {
        $pageGroup = AppContext::request()->attributes->get('page_group');
        if ($pageGroup && $pageGroup instanceof PageGroup) {
            return $pageGroup->getLabel();
        }

        return $this->label;
    }
}