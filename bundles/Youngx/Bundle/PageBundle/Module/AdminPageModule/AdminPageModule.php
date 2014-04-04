<?php

namespace Youngx\Bundle\PageBundle\Module\AdminPageModule;

use Youngx\Bundle\PageBundle\Entity\PageGroup;
use Youngx\Bundle\PageBundle\Entity\Template;
use Youngx\MVC\AppContext;
use Youngx\MVC\Html\SelectHtml;
use Youngx\MVC\ListenerRegistry;
use Youngx\MVC\MenuCollection;
use Youngx\MVC\Module;
use Youngx\Util\Directory;

class AdminPageModule extends Module implements ListenerRegistry
{
    public function getModule()
    {
        return 'Admin';
    }

    public function onTemplateSelectInput(array $attributes)
    {
        $select = new SelectHtml($attributes);

        $theme = AppContext::module('Front')->getTheme();
        $options = array_merge(
            Directory::toRecursiveArray($theme->parseAppTemplatePath('')),
            Directory::toRecursiveArray($theme->parseSiteTemplatePath(''))
        );
        ksort($options);
        $select->setOptions($options);

        return $select;
    }

    public function onPageVariableSelectInput(array $attributes)
    {
        $select = new SelectHtml($attributes);
        $select->setOptions(AppContext::service('pageVariableTypeCollection')->getLabels());

        return $select;
    }

    public function onPageGroupSelectInput(array $attributes)
    {
        $options = $hierarchy = array();
        if (isset($attributes['topId'])) {
            $topId = $attributes['topId'];
            unset($attributes['topId']);
        } else {
            $topId = null;
        }
        foreach (PageGroup::findForPageGroupParentSelectOptions($topId) as $row) {
            $options[$row['id']] = $row['label'];
            $hierarchy[$row['id']] = $row['parent_id'];
        }
        $attributes['hierarchy'] = $hierarchy;
        $attributes['options'] = $options;
        return new SelectHtml($attributes);
    }

    public static function registerListeners()
    {
        return array(
            'kernel.input#template-select' => 'onTemplateSelectInput',
            'kernel.input#page-variable-select' => 'onPageVariableSelectInput',
            'kernel.input#page-group-select' => 'onPageGroupSelectInput'
        );
    }
}