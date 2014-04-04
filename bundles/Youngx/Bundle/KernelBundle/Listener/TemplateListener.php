<?php

namespace Youngx\Bundle\KernelBundle\Listener;

use Symfony\Component\Routing\Generator\UrlGenerator;
use Youngx\MVC\AppContext;
use Youngx\MVC\Form;
use Youngx\MVC\ListenerRegistry;
use Youngx\MVC\ListView;
use Youngx\MVC\Pagingable;
use Youngx\MVC\Table;
use Youngx\MVC\Template;
use Youngx\MVC\Widget\FormWidget;
use Youngx\MVC\Widget\ListViewWidget;
use Youngx\MVC\Widget\PagingWidget;
use Youngx\MVC\Widget\TableWidget;
use Youngx\MVC\Widget\TabWidget;
use Youngx\MVC\Widget\WizardWidget;
use Youngx\MVC\Wizard;
use Youngx\Util\Image\Resize;

class TemplateListener implements ListenerRegistry
{
    public function asset(Template $template, $path)
    {
        if (!preg_match('/^http[s]*:\/\//', $path)) {
            $path = AppContext::module($template->getModule()->getName())->getTheme()->parseAssetUrl($path);
        }

        return $path;
    }
    
    public function cache()
    {
        $cache = AppContext::cache();
        $args = func_get_args();
        if (!$args) {
            return $cache;
        }

        switch (count($args)) {
            case 1:
                return $cache->fetch($args[0]);
            case 2:
                $cache->save($args[0], $args[1]);
                return $cache;
            case 3:
                $cache->save($args[0], $args[1], $args[2]);
                return $cache;
        }

    }

    public function html(Template $template, $html, array $attributes = array())
    {
        return AppContext::html($html, $attributes);
    }

    public function query(Template $template, $key = null, $default = null)
    {
        if (null === $key) {
            return AppContext::request()->query->all();
        }
        return AppContext::request()->query->get($key, $default);
    }

    public function post(Template $template, $key = null, $default = null)
    {
        if (null === $key) {
            return AppContext::request()->request->all();
        }
        return AppContext::request()->request->get($key, $default);
    }

    public function request()
    {
        return AppContext::request();
    }

    public function cookie(Template $template, $key, $default = null)
    {
        return AppContext::request()->cookies->get($key, $default);
    }

    public function session(Template $template, $key, $default = null)
    {
        return AppContext::session()->get($key, $default);
    }

    public function server(Template $template, $key, $default = null)
    {
        return AppContext::request()->server->get($key, $default);
    }

    public function url(Template $template, $name, array $parameters = array(), $referenceType = UrlGenerator::ABSOLUTE_PATH)
    {
        return AppContext::generateUrl($name, $parameters, $referenceType);
    }

    public function replace_url(Template $template, $name, array $parameters = array(), $referenceType = UrlGenerator::ABSOLUTE_PATH)
    {
        return AppContext::replaceUrl($name, $parameters, $referenceType);
    }

    public function router()
    {
        return AppContext::router();
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface
     */
    protected function flash()
    {
        return AppContext::flash();
    }

    public function flash_messages()
    {
        return $this->flash()->all();
    }

    public function user()
    {
        return AppContext::user();
    }

    public function repository()
    {
        return AppContext::repository();
    }

    public function translate(Template $template, $message, $params = array(), $type = 'messages')
    {
        return AppContext::translate($message, $params, $type);
    }

    public function form_widget(Template $template, Form $form, $config = array())
    {
        return new FormWidget($form, $config);
    }

    public function table_widget(Template $template, Table $table, $config = array())
    {
        return new TableWidget($table, $config);
    }

    public function listview_widget(Template $template, ListView $listView, $config = array())
    {
        return new ListViewWidget($listView, $config);
    }

    public function menu()
    {
        return AppContext::router()->getMenu(AppContext::request()->attributes->get('_route'));
    }

    public function wizard_widget(Template $template, Wizard $wizard, $config = array())
    {
        return new WizardWidget($wizard, $config);
    }

    public function value()
    {
        $arguments = func_get_args();
        unset($arguments[0]);
        return call_user_func_array(array('Youngx\MVC\AppContext', 'value'), $arguments);
    }

    public function paging_widget($template, $pagingable, $config = array())
    {
        return new PagingWidget($pagingable, $config);
    }

    public function tab_widget($template, array $tabs, $skin, $activeId = null)
    {
        return new TabWidget(array(
            'tabs' => $tabs,
            'skin' => $skin,
            'active' => $activeId
        ));
    }

    public function uploaded_asset($template, $path, $width = 0, $height = 0)
    {
        if ($width || $height) {
            $file = AppContext::locate("web://{$path}");
            $info = pathinfo($file);
            $filename = substr($info['basename'], 0, strlen($info['basename']) - strlen($info['extension']) - 1) . ".{$width}-{$height}.{$info['extension']}";
            $resizeFile = $info['dirname'] . "/{$filename}";
            if (is_file($file) && !is_file($resizeFile)) {
                if ($width && $height) {
                    Resize::fixedResize($file, $resizeFile, $width, $height);
                } else if ($width) {
                    Resize::maxResize($file, $resizeFile, $width, 'width');
                } else if ($height) {
                    Resize::maxResize($file, $resizeFile, $height, 'height');
                }
            }
            $path = dirname($path) . "/{$filename}";
        }
        return $path;
    }

    public function entity_load($template, $entityType, $entityId)
    {
        return AppContext::repository()->load($entityType, $entityId);
    }

    public function entity_query($template, $entityType, $alias = null)
    {
        return AppContext::repository()->query($entityType, $alias);
    }

    public static function registerListeners()
    {
        return array(
            'kernel.template.call#menu' => 'menu',
            'kernel.template.call#asset' => 'asset',
            'kernel.template.call#translate' => 'translate',
            'kernel.template.call#cache' => 'cache',
            'kernel.template.call#form' => 'form',
            'kernel.template.call#html' => 'html',
            'kernel.template.call#table' => 'table',
            'kernel.template.call#tab' => 'tab',
            'kernel.template.call#widget' => 'widget',
            'kernel.template.call#query' => 'query',
            'kernel.template.call#request' => 'request',
            'kernel.template.call#router' => 'router',
            'kernel.template.call#cookie' => 'cookie',
            'kernel.template.call#session' => 'session',
            'kernel.template.call#server' => 'server',
            'kernel.template.call#url' => 'url',
            'kernel.template.call#replace_url' => 'replace_url',
            'kernel.template.call#flash_messages' => 'flash_messages',
            'kernel.template.call#user' => 'user',
            'kernel.template.call#repository' => 'repository',
            'kernel.template.call#form_widget' => 'form_widget',
            'kernel.template.call#table_widget' => 'table_widget',
            'kernel.template.call#listview_widget' => 'listview_widget',
            'kernel.template.call#wizard_widget' => 'wizard_widget',
            'kernel.template.call#value' => 'value',
            'kernel.template.call#paging_widget' => 'paging_widget',
            'kernel.template.call#tab_widget' => 'tab_widget',
            'kernel.template.call#uploaded_asset' => 'uploaded_asset',
            'kernel.template.call#entity_load' => 'entity_load',
            'kernel.template.call#entity_query' => 'entity_query',
        );
    }
}