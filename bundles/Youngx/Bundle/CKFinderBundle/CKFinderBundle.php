<?php

namespace Youngx\Bundle\CKFinderBundle;

use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Youngx\Bundle\UserBundle\Entity\Role;
use Youngx\MVC\AppContext;
use Youngx\MVC\Bundle;
use Youngx\MVC\Event\FilterResponseEvent;
use Youngx\MVC\Html\TextHtml;
use Youngx\MVC\Html;
use Youngx\MVC\ListenerRegistry;
use Youngx\MVC\UserIdentity;

class CKFinderBundle extends Bundle implements ListenerRegistry
{
    public function onFormatCKEditorInput(Html $textarea)
    {
        AppContext::registerAssetsPackage('ckfinder');
        $basePath = AppContext::assetUrl('//CKFinder/');
        AppContext::registerJavascriptCode("CKFinder.setupCKEditor(ckeditor_{$textarea->getId()}, '{$basePath}')");
    }

    public function onAssetsPackageOfCKFinder()
    {
        AppContext::registerJavascripts('//CKFinder/ckfinder.js');
    }

    public function onCKFinderInput(array $attributes)
    {
        if (!isset($attributes['placeholder']))  {
            $attributes['placeholder'] = '请点击选择';
        }
        $text = new TextHtml($attributes);
        AppContext::registerAssetsPackage('ckfinder');
        $basePath = AppContext::assetUrl('//CKFinder/');
        $code = <<<code
$('#{$text->getId()}').click(function() {
    var finder = new CKFinder();
	finder.basePath = '{$basePath}';
    finder.startupPath = 'Images:/';
	finder.selectActionFunction = function(fileUrl) {
        $('#{$text->getId()}').val(fileUrl);
	};
	finder.popup();
});
code;
        AppContext::registerJavascriptCode($code);

        return $text;
    }

    public function onUserLogin(UserIdentity $identity)
    {
        if ($identity->getId() == 1 || $identity->hasRole(Role::ADMIN)) {
            AppContext::filterResponse(function(FilterResponseEvent $event) {
                    $response = $event->getResponse();
                    $response->headers->setCookie(new Cookie('CKFinder_identity', 1, Y_TIME + 3153600));
                });
        }
    }

    public function onUserLogout(UserIdentity $identity)
    {
        if ($identity->getId() == 1 || $identity->hasRole(Role::ADMIN)) {
            AppContext::filterResponse(function(FilterResponseEvent $event) {
                    $response = $event->getResponse();
                    $response->headers->clearCookie('CKFinder_identity');
                });
        }
    }

    public static function registerListeners()
    {
        return array(
            'kernel.assets.package#ckfinder' => 'onAssetsPackageOfCKFinder',
            'kernel.input.format#ckeditor' => 'onFormatCKEditorInput',
            'kernel.input.format#ckeditor-full' => 'onFormatCKEditorInput',
            'kernel.input#ckfinder' => 'onCKFinderInput',
            'user.login' => 'onUserLogin',
            'user.logout' => 'onUserLogout',
        );
    }
}