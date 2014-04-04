<?php

namespace Youngx\Bundle\PageBundle\Module\AdminPageModule\ListView;

use Youngx\Bundle\PageBundle\Entity\Theme;
use Youngx\MVC\AppContext;
use Youngx\MVC\ListView;

class AdminThemeTemplatesListView extends ListView
{
    public function __construct(Theme $theme = null)
    {
    }
}