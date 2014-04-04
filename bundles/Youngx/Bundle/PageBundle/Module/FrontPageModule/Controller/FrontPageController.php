<?php

namespace Youngx\Bundle\PageBundle\Module\FrontPageModule\Controller;

use Youngx\Bundle\PageBundle\Entity\Page;
use Youngx\MVC\AppContext;

class FrontPageController
{
    public function indexAction(Page $page)
    {
        return AppContext::render($page->getTemplate(), $page->getPageVariables());
    }
}