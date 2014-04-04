<?php

namespace Youngx\Bundle\CKEditorBundle;

use Youngx\MVC\AppContext;
use Youngx\MVC\Bundle;
use Youngx\MVC\Html\TextareaHtml;
use Youngx\MVC\ListenerRegistry;

class CKEditorBundle extends Bundle implements ListenerRegistry
{
    public function onAssetsPackageOfCKEditor()
    {
        AppContext::registerJavascripts('//CKEditor/ckeditor.js');
    }

    public function onAssetsPackageOfCKEditorFull()
    {
        AppContext::registerJavascripts('//CKEditor_full/ckeditor.js');
    }

    public function onCKEditorInput(array $attributes)
    {
        $textarea = new TextareaHtml($attributes);
        AppContext::registerAssetsPackage('ckeditor');
        AppContext::registerJavascriptCode("var ckeditor_{$textarea->getId()} = CKEDITOR.replace('{$textarea->getId()}');");

        return $textarea;
    }

    public function onCKEditorFullInput(array $attributes)
    {
        $textarea = new TextareaHtml($attributes);
        AppContext::registerAssetsPackage('ckeditor-full');
        AppContext::registerJavascriptCode("var ckeditor_{$textarea->getId()} = CKEDITOR.replace('{$textarea->getId()}');");

        return $textarea;
    }

    public static function registerListeners()
    {
        return array(
            'kernel.input#ckeditor' => 'onCKEditorInput',
            'kernel.input#ckeditor-full' => 'onCKEditorFullInput',
            'kernel.assets.package#ckeditor' => 'onAssetsPackageOfCKEditor',
            'kernel.assets.package#ckeditor-full' => 'onAssetsPackageOfCKEditorFull'
        );
    }
}