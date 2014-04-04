<?php

namespace Youngx\Bundle\ArchiveBundle\Module\AdminArchiveModule\Menu;

use Youngx\MVC\AppContext;
use Youngx\MVC\Menu;

class AdminArchiveContentMenu extends Menu
{
    public function getLabel()
    {
        $entityCode = AppContext::request()->attributes->get('entityCode');
        if ($entityCode) {
            return AppContext::service('archiveContentCollection')->getLabel($entityCode);
        }

        return $this->label;
    }
}