<?php
return array(
    'admin' => array(
        'path' => '/',
        'label' => '管理首页',
        'controller' => 'Dashboard',
    ),
    'admin-settings' => array(
        'label' => '设置',
        'path' => '/settings',
        'controller' => 'MenuMap',
        'module' => 'Admin',
        'options' => array('icon' => 'gear', 'is_menu' => true),
        'priority' => 9
    ),
    'admin-confirm' => array(
        'path' => '/confirm',
        'label' => '确认',
        'controller' => 'Confirm',
    ),
    'admin-confirm-delete' => array(
        'path' => '/confirm/delete',
        'label' => '删除确认',
        'controller' => 'DeleteConfirm',
    ),
    'admin-cache-clear' => array(
        'label' => '清除缓存',
        'path' => '/settings/cache/clear',
        'controller' => 'Dashboard::clearCache',
        'options' => array('is_menu' => true),
        'priority' => 10
    )
);