<?php
return array(
    'admin-district' => array(
        'group' => 'admin',
        'path' => '/settings/districts',
        'label' => '地区',
        'controller' => 'Admin::index',
        'accessible' => array('role' => 'admin'),
        'options' => array('is_menu' => true, 'submenu' => true)
    ),
    'admin-district-import' => array(
        'group' => 'admin',
        'path' => '/settings/districts/import',
        'label' => '地区导入',
        'controller' => 'Admin::import',
        'options' => array('is_submenu' => true)
    ),
);