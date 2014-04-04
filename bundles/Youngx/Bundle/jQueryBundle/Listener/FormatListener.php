<?php

namespace Youngx\Bundle\jQueryBundle\Listener;

use Youngx\MVC\AppContext;
use Youngx\MVC\Html;
use Youngx\MVC\ListenerRegistry;
use Youngx\MVC\Widget\TreeTableWidget;

class FormatListener implements ListenerRegistry
{
    public function formatSelectForChosen(Html $html, $chosen)
    {
        $id = $html->getId();
        $config = is_array($chosen) ? json_encode($chosen) : '';
        $this->context->assets()->registerPackage('jquery.chosen');
        $this->context->assets()->registerScriptCode($id, sprintf('$("#%s").chosen(%s);', $id, $config));
    }

    public static function registerListeners()
    {
        return array(
            'kernel.html#select@config:chosen' => 'formatSelectForChosen',
        );
    }
}