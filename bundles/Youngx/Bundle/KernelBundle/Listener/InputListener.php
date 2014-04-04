<?php

namespace Youngx\Bundle\KernelBundle\Listener;

use Youngx\MVC\AppContext;
use Youngx\MVC\Html\CheckboxHtml;
use Youngx\MVC\Html\RadioHtml;
use Youngx\MVC\Html\SelectHtml;
use Youngx\MVC\Html\TextareaHtml;
use Youngx\MVC\Html\TextHtml;
use Youngx\MVC\ListenerRegistry;

class InputListener implements ListenerRegistry
{
    public function file(array $attributes = array())
    {
        $attributes['type'] = 'file';
        return new TextHtml($attributes, 'file');
    }

    public function text(array $attributes = array())
    {
        return new TextHtml($attributes);
    }

    public function password(array $attributes = array())
    {
        $attributes['type'] = 'password';
        return new TextHtml($attributes);
    }

    public function hidden(array $attributes = array())
    {
        $attributes['type'] = 'hidden';
        return new TextHtml($attributes, 'hidden');
    }

    public function textarea(array $attributes = array())
    {
        return new TextareaHtml($attributes);
    }

    public function checkbox(array $attributes = array())
    {
        return new CheckboxHtml($attributes);
    }

    public function radio(array $attributes = array())
    {
        return new RadioHtml($attributes);
    }

    public function select(array $attributes = array())
    {
        return new SelectHtml($attributes);
    }

    public function captcha(array $attributes)
    {
        if (isset($attributes['#captcha_id'])) {
            $captcha_id = $attributes['#captcha_id'];
            unset($attributes['#captcha_id']);
        } else {
            $captcha_id = null;
        }

        $text = $this->text($attributes);
        $img = $this->context->html('img', array(
                'src' => $url = $this->context->generateUrl('captcha', array('id' => $captcha_id)),
                'title' => '点击换一个'
            ), true);
        $text->after($img, 'img');

        $code = <<<code
$('#{$img->getId()}').click(function() {
    var url = '{$url}';
    $(this).attr('src', url + (url.indexOf('?') > 0 ? '&' : '?') + '_t=' + new Date().getTime());
});
code;
        $this->context->assets()->registerScriptCode($img->getId(), $code);

        return $text;
    }

    public function entityCodeSelect(array $attributes)
    {
        $select = new SelectHtml($attributes);
        $select->setOptions(AppContext::schema()->getEntityCodeLabels());

        return $select;
    }

    public static function registerListeners()
    {
        return array(
            'kernel.input#text' => 'text',
            'kernel.input#textarea' => 'textarea',
            'kernel.input#password' => 'password',
            'kernel.input#hidden' => 'hidden',
            'kernel.input#checkbox' => 'checkbox',
            'kernel.input#radio' => 'radio',
            'kernel.input#select' => 'select',
            'kernel.input#file' => 'file',
            'kernel.input#captcha' => 'captcha',
            'kernel.input#entity-code-select' => 'entityCodeSelect'
        );
    }
}