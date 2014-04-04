<?php

namespace Youngx\Bundle\AdminBundle\Module\AceModule\Listener;

use Youngx\MVC\AppContext;
use Youngx\MVC\Block;
use Youngx\MVC\Html;
use Youngx\MVC\Html\ULHtml;
use Youngx\MVC\ListenerRegistry;
use Youngx\MVC\Menu;
use Youngx\MVC\Widget\ButtonGroupWidget;
use Youngx\MVC\Widget\FieldWidget;
use Youngx\MVC\Widget\FormWidget;
use Youngx\MVC\Widget\PagingWidget;
use Youngx\MVC\Widget\TableWidget;
use Youngx\MVC\Widget\TabWidget;
use Youngx\MVC\Widget\WizardWidget;

class TemplateListener implements ListenerRegistry
{
    public function onFormatFieldWidgetForHorizontal(FieldWidget $widget)
    {
        $widget->getWrapperHtml()->addClass('form-group');
        $widget->getLabelHtml()->addClass('col-md-2 col-sm-3 control-label no-padding-right');


        $errorHtml = $widget->getErrorHtml();
        if ($errorHtml) {
            $errorHtml->addClass('help-block col-xs-12 col-sm-reset inline');
            $widget->getWrapperHtml()->addClass('has-error');
        }

        $hintHtml = $widget->getHintHtml();
        if ($hintHtml) {
            $hintHtml->addClass('help-block');
        }

        $widget->getWrapperHtml()
            ->append($widget->getLabelHtml())
            ->append(
                $widget->getInputWrapperHtml()
                    ->append($widget->getHintHtml())
            );

        $input = $widget->getInput();
        if (is_object($input) && $input instanceof Html) {
            if (in_array($input->getFormatter(), array('text', 'textarea'))) {
                $input->addClass('form-control');
            }

            if ($input->getFormatter() == 'textarea') {
                $widget->getInputWrapperHtml()->addClass('col-md-10 col-sm-9 col-xs-12');
                $widget->getInputWrapperHtml()->append($widget->getErrorHtml());
            } else {
                $widget->getInputWrapperHtml()->addClass('col-xs-12 col-sm-5');
                $widget->getWrapperHtml()->append($widget->getErrorHtml());
            }
        } else {
            $widget->getInputWrapperHtml()->addClass('col-xs-12 col-sm-5');
            $widget->getWrapperHtml()->append($widget->getErrorHtml());
        }
    }

    public function onFormatFormWidgetForHorizontal(FormWidget $widget)
    {
        $widget->getFormHtml()->addClass('form-horizontal');
        $widget->getButtonsWrapper()->wrap(new Html('div', array(
                'class' => 'clearfix form-actions'
            )))->addClass('col-md-offset-3 col-md-9');
        $widget->getSubmitHtml()->addClass('btn btn-info');

        $cancelHtml = $widget->getCancelHtml();
        if ($cancelHtml) {
            $cancelHtml->addClass('btn');
        }
    }

    public function onFormatTableWidget(TableWidget $widget)
    {
        $widget->getTableHtml()->addClass('table table-striped table-bordered table-hover');
        $widget->getActionsWrapHtml()->addClass('row');

        $pagingWidget = $widget->getPagingWidget();
        if ($pagingWidget) {
            $pagingWidget->getWrapHtml()->addClass('col-sm-6');
        }

        $buttonGroupWidget = $widget->getButtonGroupWidget();
        if ($buttonGroupWidget) {
            $buttonGroupWidget->getWrapHtml()->addClass('col-sm-6');
        }
    }

    public function onFormatPagingWidget(PagingWidget $widget)
    {
        $widget->getUlHtml()->addClass('pagination');
    }

    public function onFormatButtonGroupWidget(ButtonGroupWidget $widget)
    {
        $widget->getWrapHtml()->addClass('btn-group');
        foreach ($widget->all() as $name => $button) {
            $this->parseButtonGroup($widget->getWrapHtml(), $name, $button);
        }
    }

    private function parseButtonGroup(Html $div, $name, $button)
    {
        if ($button instanceof ButtonGroupWidget\Button) {
            $div->append(
                new Html\ButtonHtml(array(
                        'value' => $button->getLabel(),
                        'data-url' => $button->getUrl(),
                        'class' => 'btn btn-primary'
                    ))
            );
        } else if ($button instanceof ButtonGroupWidget\ButtonGroup) {
            $div->append($wrap = new Html('div'));
            $wrap->addClass('btn-group')->append(
                new Html\ButtonHtml(array(
                        'value' => $button->getLabel(),
                        'class' => 'btn btn-primary dropdown-toggle',
                        'data-toggle' => 'dropdown',
                        'append' => '<span class="icon-angle-down icon-on-right"></span>'
                    ))
            )->append( $ul = new Html('ul', array('class' => 'dropdown-menu')));
            foreach ($button->all() as $btn) {
                $li = new Html('li');
                $li->setContent(new Html('a', array(
                            'href' => $btn->getUrl(),
                            'content' => $btn->getLabel(),
                            'data-url' => $btn->getUrl(),
                            'class' => ''
                    ))
                );
                $ul->append($li);
            }
        } else {
            $div->append($button, $name);
        }
    }
    public function onRenderAceSidebarBlock(Block $block)
    {
        $current = AppContext::request()->attributes->get('_route');
        if ($current) {
            $ul = new ULHtml(array(
                'class' => 'nav nav-list'
            ));
            $router = AppContext::router();
            $routePaths = array();
            $menuName = $current;
            while ($menuName) {
                $routePaths[] = $menuName;
                $menuName = $router->getMenu($menuName)->getParent();
            }
            $this->parseNestedMenuList($router->getMenu('admin'), $routePaths, 0, $ul);
            $block->add($ul);
        }
    }

    /**
     * @param \Youngx\MVC\Menu $parent
     * @param array $routePaths
     * @param int $layer
     * @param ULHtml $ul
     * @return bool
     */
    private function parseNestedMenuList(Menu $parent, array $routePaths, $layer, ULHtml $ul = null)
    {
        foreach ($parent->getSubMenus() as $name => $menu) {
            $isActive = in_array($name, $routePaths);

            if ($ul && $menu->getOption('is_menu', false) && $menu->isAccessible()) {

                foreach ($menu->getNavigation() as $label => $url) {
                    $li = $ul->addItem();
                    if ($isActive && $menu->isNavigationActive($label)) {
                        $li->addClass('active');
                    }

                    $a = new Html('a', array(
                        'href' => $url
                    ));

                    $li->append($a);

                    if ($layer == 0) {
                        if ($menu->getOption('icon')) {
                            $a->append('<i class="icon-'.$menu->getOption('icon').'"></i>');
                        }
                        $a->append('<span class="menu-text"> '.$label.' </span>');
                    } else {
                        $a->append('<i class="icon-double-angle-right"></i> ')->append($label);
                    }

                    if ($menu->getChildren()) {
                        $subUL = new ULHtml(array('class' => 'submenu'));
                        $this->parseNestedMenuList($menu, $routePaths, $layer + 1, $subUL);
                        if ($subUL->itemCount() > 0) {
                            $a->append('<b class="arrow icon-angle-down"></b>')->addClass('dropdown-toggle');
                            $li->append($subUL);
                        }
                    }
                }
            }
        }
    }

    public function onRenderBreadcrumbsBlock(Block $block)
    {
        $current = AppContext::request()->attributes->get('_route');
        if ($current) {
            $ul = new Html\ULHtml(array('class' => 'breadcrumb'));
            foreach (AppContext::router()->getMenu($current)->getBreadcrumbs() as $item) {
                $ul->addItem(new Html\AHtml($item));
            }
            $ul->firstItem()->prepend('<i class="icon-home home-icon"></i>');
            $block->add($ul);
        }
    }

    public function onAceFilesInput(array $attributes, $multiple = true)
    {
        $attributes['type'] = 'file';
        $file = new Html\TextHtml($attributes, 'file');

        if ($multiple) {
            $file->set('name', $file->get('name') . '[]');
            $file->set('multiple', $multiple);
        }

        $options = array(
            'no_file' => '请选择文件',
            'btn_choose' => '选择',
            'btn_change' => '更改',
        );

        if ($multiple) {
            $options['thumbnail'] = 'small';
            $options = array_merge($options, array(
                    'thumbnail' => 'small',
                    'style' => 'well',
                    'no_icon' => 'icon-cloud-upload',
                    'droppable' => true
                ));
        }

        $options = json_encode($options);

        $code = <<<code
$('#{$file->getId()}').ace_file_input({$options});
code;
        AppContext::registerJquery($code);

        return $file;
    }

    public function onFormatWizardWidget(WizardWidget $widget)
    {
        $widget->getStepsWrapperHtml()->addClass('wizard-steps')
            ->wrap(new Html('div', array('class' => 'row-fluid')))
            ->wrap(new Html\HRHtml());

        if ($widget->getStep() > 0) {
            foreach ($widget->getStepsWrapperHtml()->items() as $i => $li) {
                if ($i < $widget->getStep()) {
                    $li->addClass('complete');
                } else {
                    break;
                }
            }
        }

        $widget->getActiveStepHtml()->addClass('active');

        $widget->getContentWrapperHtml()
            ->addClass('step-pane active')
            ->wrap(new Html('div', array(
                'class' => 'step-content row-fluid'
            )));

        $widget->getButtonsWrapperHtml()->addClass('row-fluid wizard-actions')->wrap(new Html\HRHtml(true));

        $widget->getPrevHtml()->addClass('btn btn-prev')->prepend('<i class="icon-arrow-left"></i>');
        $widget->getNextHtml()->addClass('btn btn-success btn-next')->append('<i class="icon-arrow-right icon-on-right"></i>');
    }

    public function onFormatTabWidget(TabWidget $widget)
    {
        $ul = $widget->getTabHtml();
        $ul->addClass('nav nav-tabs');
        foreach ($widget->getTabs() as $id => $config) {
            $a = new Html('a', $config);
            if (is_string($config)) {
                $a->set('href', "#{$id}");
            }

            if ($a->get('href') && substr($a->get('href'), 0, 1) == '#') {
                $a->set('data-toggle', 'tab');
            }

            $li = $ul->addItem($a);
            if ($id == $widget->getActive()) {
                $li->addClass($widget->getActiveClass());
            }
        }

        $widget->getContentWrapHtml()->addClass('tab-content');
        foreach ($widget->getContentPanes() as $id => $html) {
            $html->addClass('tab-pane');
            if ($id == $widget->getActive()) {
                $html->addClass($widget->getActiveClass());
            }
        }

        if (!$widget->getActive()) {
            $ul->firstItem()->addClass($widget->getActiveClass());
            $contentPane = $widget->getFirstContentPane();
            if ($contentPane) {
                $contentPane->addClass($widget->getActiveClass());
            }
        }
    }

    public static function registerListeners()
    {
        return array(
            'kernel.widget#form@skin:ace-horizontal' => 'onFormatFormWidgetForHorizontal',
            'kernel.widget#field@skin:ace-horizontal' => 'onFormatFieldWidgetForHorizontal',
            'kernel.widget#table@skin:ace' => 'onFormatTableWidget',
            'kernel.widget#paging@skin:ace' => 'onFormatPagingWidget',
            'kernel.widget#button-group@skin:ace' => 'onFormatButtonGroupWidget',
            'kernel.block#ace-sidebar' => 'onRenderAceSidebarBlock',
            'kernel.block#ace-breadcrumbs' => 'onRenderBreadcrumbsBlock',
            'kernel.input#ace-files' => 'onAceFilesInput',
            'kernel.widget#wizard@skin:ace' => 'onFormatWizardWidget',
            'kernel.widget#tab@skin:ace' => 'onFormatTabWidget'
        );
    }
}