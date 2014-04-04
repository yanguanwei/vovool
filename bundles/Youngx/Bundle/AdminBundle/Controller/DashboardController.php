<?php

namespace Youngx\Bundle\AdminBundle\Controller;

use Youngx\MVC\AppContext;
use Youngx\Util\Directory;

class DashboardController
{
    public function indexAction()
    {
        return AppContext::render('dashboard.html.php');
    }

    public function clearCacheAction()
    {
        AppContext::cache()->deleteAll();
        Directory::delDirAndFile(AppContext::locate('cache://'), false);

        AppContext::flash()->add('success', '成功清除所有缓存！');

        return AppContext::redirectResponse(AppContext::generateUrl('admin'));
    }
}