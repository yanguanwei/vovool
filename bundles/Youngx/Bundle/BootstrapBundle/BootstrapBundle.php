<?php

namespace Youngx\Bundle\BootstrapBundle;

use Youngx\MVC\AppContext;
use Youngx\MVC\Bundle;
use Youngx\MVC\ListenerRegistry;
use Youngx\MVC\Widget\PagingWidget;

class BootstrapBundle extends Bundle implements ListenerRegistry
{
    public function onAssetsPackageOfBootstrap()
    {
        AppContext::registerJavascripts('//Bootstrap/js/bootstrap.min.js');
        AppContext::registerStylesheets('//Bootstrap/css/bootstrap.min.css');
    }

    public function onAssetsPackageOfBootstrap2()
    {
        AppContext::registerJavascripts('//Bootstrap/2.0/js/bootstrap.js');
        AppContext::registerStylesheets('//Bootstrap/2.0/css/bootstrap.css');
        AppContext::registerStylesheets('//Bootstrap/2.0/css/bootstrap-responsive.css');
    }

    public function onFormatPagingWidget(PagingWidget $paging)
    {
        $paging->getWrapHtml()->addClass('pagination');
    }

    public static function registerListeners()
    {
        return array(
            'kernel.assets.package#boostrap' => 'onAssetsPackageOfBootstrap',
            'kernel.assets.package#boostrap-2' => 'onAssetsPackageOfBootstrap2',
            'kernel.widget#paging@skin:bootstrap' => 'onFormatPagingWidget'
        );
    }
}