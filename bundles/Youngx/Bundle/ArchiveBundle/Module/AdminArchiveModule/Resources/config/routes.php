<?php
return array(
    'admin-channel' => array(
        'label' => '栏目',
        'path' => '/settings/channels',
        'controller' => 'AdminChannel',
        'options' => array('is_menu' => true, 'submenu' => true, 'icon' => 'folder-close')
    ),
    'admin-channel-edit' => array(
        'label' => '编辑栏目',
        'path' => '/settings/channels/{%channel%}/edit',
        'controller' => 'AdminChannel::edit',
    ),
    'admin-channel-add' => array(
        'label' => '添加栏目',
        'path' => '/settings/channels/add/{%channel?%}',
        'controller' => 'AdminChannel::add',
        'options' => array('is_submenu' => true)
    ),
    'admin-channel-delete' => array(
        'label' => '删除栏目',
        'path' => '/settings/channels/delete',
        'controller' => 'AdminChannel::delete',
    ),
    'admin-archive' => array(
        'label' => '内容',
        'path' => '/archives',
        'controller' => 'MenuMap',
        'module' => 'Admin',
        'priority' => -9,
        'options' => array('icon' => 'archive', 'is_menu' => true)
    ),
    'admin-channel-view' => array(
        'label' => '栏目内容',
        'path' => '/archives/{%channel%}',
        'controller' => 'AdminChannel::view',
        'options' => array('is_menu' => true)
    ),
    'admin-archive-content' => array(
        'label' => '栏目内容',
        'path' => '/archives/{%channel%}/{entityCode}',
        'requirements' => array('entityCode' => '\w+'),
        'controller' => 'AdminArchive',
        'options' => array('submenu' => true)
    ),
    'admin-archive-delete' => array(
        'label' => '删除内容',
        'path' => '/archives/{%channel%}/{entityCode}/delete',
        'controller' => 'AdminArchive::delete',
    ),
    'admin-archive-add' => array(
        'label' => '添加内容',
        'path' => '/archives/{%channel%}/{entityCode}/add',
        'controller' => 'AdminArchive::add',
        'options' => array('is_submenu' => true)
    ),
    'admin-archive-edit' => array(
        'label' => '编辑内容',
        'path' => '/archives/{%channel%}/{entityCode}/{%archive%}/edit',
        'controller' => 'AdminArchive::edit',
    ),
);