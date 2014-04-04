<?php

namespace Youngx\Bundle\UMEditorBundle;

use Youngx\MVC\AppContext;
use Youngx\MVC\Bundle;
use Youngx\MVC\Html\TextareaHtml;
use Youngx\MVC\ListenerRegistry;

class UMEditorBundle extends Bundle implements ListenerRegistry
{
    public function onAssetsPackageOfUMEditor()
    {
        AppContext::registerJavascripts(array(
                '//UMEditor/umeditor.config.js',
                '//UMEditor/umeditor.js'
            ));
        AppContext::registerStylesheets('//UMEditor/themes/default/css/umeditor.min.css');
    }

    public function onUMEditorInput(array $attributes)
    {
        $textarea = new TextareaHtml($attributes);

        $code = <<<code
var ue = UM.getEditor('{$textarea->getId()}');
code;

        AppContext::registerAssetsPackage('umeditor');
        AppContext::registerJavascriptCode($code);

        return $textarea;
    }

    public static function registerListeners()
    {
        return array(
            'kernel.input#umeditor' => 'onUMEditorInput',
            'kernel.assets.package#umeditor' => 'onAssetsPackageOfUMEditor'
        );
    }
}