<?php

namespace Youngx\Bundle\ArchiveBundle\Module\AdminArchiveModule;

use Youngx\Bundle\ArchiveBundle\Entity\Channel;
use Youngx\MVC\AppContext;
use Youngx\MVC\Html\SelectHtml;
use Youngx\MVC\ListenerRegistry;
use Youngx\MVC\Module;

class AdminArchiveModule extends Module implements ListenerRegistry
{
    public function onChannelParentSelectInput(array $attributes)
    {
        $options = $hierarchy = array();
        if (isset($attributes['topId'])) {
            $topId = $attributes['topId'];
            unset($attributes['topId']);
        } else {
            $topId = null;
        }
        foreach (Channel::findForChannelParentSelectOptions($topId) as $row) {
            $options[$row['id']] = $row['label'];
            $hierarchy[$row['id']] = $row['parent_id'];
        }
        $attributes['hierarchy'] = $hierarchy;
        $attributes['options'] = $options;
        return new SelectHtml($attributes);
    }

    public function onArchiveStatusSelect(array $attributes)
    {
        $select = new SelectHtml($attributes);
        $select->setOptions(array(
                '未审核', '已发布'
            ));
        return $select;
    }

    public function onArchiveContentSelect(array $attributes)
    {
        $select = new SelectHtml($attributes);

        $select->setOptions(AppContext::service('archiveContentCollection')->getLabels());

        return $select;
    }

    public static function registerListeners()
    {
        return array(
            'kernel.input#channel-parent-select' => 'onChannelParentSelectInput',
            'kernel.input#channel-select' => 'onChannelParentSelectInput',
            'kernel.input#archive-status-select' => 'onArchiveStatusSelect',
            'kernel.input#archive-content-select' => 'onArchiveContentSelect'
        );
    }
}