<?php
return array(
    'admin-structure' => array(
        'label' => '结构',
        'path' => '/structure',
        'options' => array('icon' => 'desktop', 'is_menu' => true),
        'controller' => 'MenuMap::index',
        'module' => 'Admin',
        'accessible' => array('role' => 'super'),
        'priority' => 10
    ),
    'admin-page-group' => array(
        'label' => '分组',
        'path' => '/structure/pages/groups',
        'controller' => 'AdminPageGroup',
        'options' => array('submenu' => true, 'is_menu' => true),
        'accessible' => array('role' => 'super')
    ),
    'admin-page-group-add' => array(
        'label' => '添加分组',
        'path' => '/structure/pages/groups/add',
        'controller' => 'AdminPageGroup::add',
        'options' => array('is_submenu' => true),
        'accessible' => array('role' => 'super')
    ),
    'admin-page-group-delete' => array(
        'label' => '删除分组',
        'path' => '/structure/pages/groups/delete',
        'controller' => 'AdminPageGroup::delete',
        'options' => array('is_menu' => false),
        'accessible' => array('role' => 'super'),
    ),
    'admin-page-group-edit' => array(
        'label' => '编辑分组',
        'path' => '/structure/pages/groups/{%page_group%}',
        'controller' => 'AdminPageGroup::edit',
        'accessible' => array('role' => 'super'),
    ),
    'admin-page' => array(
        'label' => '页面',
        'path' => '/structure/pages',
        'controller' => 'MenuMap',
        'module' => 'Admin',
        'options' => array('is_menu' => true),
        'accessible' => array('role' => 'super')
    ),
    'admin-group-page' => array(
        'label' => '页面',
        'path' => '/structure/pages/{%page_group%}',
        'controller' => 'AdminPage',
        'options' => array('is_menu' => true, 'submenu' => true),
        'accessible' => array('role' => 'super')
    ),
    'admin-page-add' => array(
        'label' => '添加页面',
        'path' => '/structure/pages/{%page_group%}/add',
        'controller' => 'AdminPage::add',
        'options' => array('is_submenu' => true),
        'accessible' => array('role' => 'super'),
    ),
    'admin-page-delete' => array(
        'label' => '删除页面',
        'path' => '/structure/pages/{%page_group%}/delete',
        'controller' => 'AdminPage::delete',
        'accessible' => array('role' => 'super'),
    ),
    'admin-page-edit' => array(
        'label' => '编辑页面',
        'path' => '/structure/pages/{%page_group%}/{%page%}',
        'controller' => 'AdminPage::edit',
        'accessible' => array('role' => 'super')
    ),
    'admin-page-variable' => array(
        'label' => '页面变量',
        'path' => '/structure/pages/{%page_group%}/{%page%}/variables/add',
        'controller' => 'AdminPageVariable::add',
        'accessible' => array('role' => 'super')
    ),
    'admin-page-variable-add' => array(
        'label' => '添加页面变量',
        'path' => '/structure/pages/{%page_group%}/{%page%}/variables/add',
        'options' => array('is_submenu' => true),
        'controller' => 'AdminPageVariable::add',
        'accessible' => array('role' => 'super')
    ),
    'admin-page-variable-delete' => array(
        'label' => '删除页面变量',
        'path' => '/structure/pages/{%page_group%}/{%page%}/variables/delete',
        'controller' => 'AdminPageVariable::delete',
        'accessible' => array('role' => 'super')
    ),
    'admin-page-variable-edit' => array(
        'label' => '编辑页面变量',
        'path' => '/structure/pages/{%page_group%}/{%page%}/variables/{%page_variable%}',
        'controller' => 'AdminPageVariable::edit',
        'accessible' => array('role' => 'super')
    ),/*
    'admin-theme' => array(
        'label' => '主题',
        'path' => '/structure/themes',
        'controller' => 'AdminTheme',
        'options' => array('is_menu' => true, 'submenu' => true),
    ),
    'admin-theme-view' => array(
        'label' => '编辑主题',
        'path' => '/structure/themes/{theme}',
        'requirements' => array('theme'=>'\d+'),
        'loaders' => array('theme'),
        'options' => array('submenu' => true),
        'controller' => 'AdminTheme::edit'
    ),
    'admin-theme-edit' => array(
        'label' => '编辑主题',
        'path' => '/structure/themes/{theme}/edit',
        'requirements' => array('theme'=>'\d+'),
        'loaders' => array('theme'),
        'controller' => 'AdminTheme::edit'
    ),
    'admin-theme-delete' => array(
        'label' => '删除主题',
        'path' => 'structure/themes/delete',
        'controller' => 'AdminTheme::delete'
    ),
    'admin-theme-templates' => array(
        'label' => '主题模板',
        'path' => '/structure/themes/{theme}/templates',
        'requirements' => array('theme'=>'\d+'),
        'loaders' => array('theme'),
        'options' => array('submenu' => true),
        'controller' => 'AdminTemplate::index'
    ),
    'admin-theme-template-edit' => array(
        'label' => '编辑主题模板',
        'path' => '/structure/themes/{theme}/templates/{template}',
        'requirements' => array('theme'=>'\d+', 'template' => '\d+'),
        'loaders' => array('theme', 'template'),
        'controller' => 'AdminTemplate::edit'
    ),
    'admin-theme-template-add' => array(
        'label' => '添加主题模板',
        'path' => '/structure/themes/{theme}/templates/add',
        'requirements' => array('theme'=>'\d+'),
        'loaders' => array('theme'),
        'controller' => 'AdminTemplate::add',
        'options' => array('is_submenu' => true)
    ),
    'admin-theme-template-override' => array(
        'label' => '覆盖主题模板',
        'path' => '/structure/themes/{theme}/templates/override/{template}',
        'requirements' => array('theme'=>'\d+', 'template' => '\d+'),
        'loaders' => array('theme', 'template'),
        'controller' => 'AdminTemplate::edit'
    ),
    'admin-theme-template-delete' => array(
        'label' => '删除主题模板',
        'path' => '/structure/themes/{theme}/templates/delete',
        'requirements' => array('theme'=>'\d+'),
        'loaders' => array('theme'),
        'controller' => 'AdminTemplate::deleteThemeTemplate'
    ),
    'admin-theme-add' => array(
        'label' => '添加主题',
        'path' => '/structure/themes/add',
        'controller' => 'AdminTheme::add',
        'options' => array('is_submenu' => true)
    ),
    'admin-theme-assets' => array(
        'label' => '主题资源',
        'path' => '/structure/themes/{theme}/assets',
        'controller' => 'AdminThemeAssets::index',
        'requirements' => array('theme'=>'\d+'),
        'loaders' => array('theme'),
        'options' => array('submenu' => true)
    ),
    'admin-theme-assets-upload' => array(
        'label' => '上传资源',
        'path' => '/structure/themes/{theme}/assets/upload',
        'controller' => 'AdminThemeAssets::upload',
        'requirements' => array('theme'=>'\d+'),
        'loaders' => array('theme'),
        'options' => array('is_submenu' => true)
    ),
    'admin-theme-assets-create-dir' => array(
        'label' => '创建目录',
        'path' => '/structure/themes/{theme}/assets/create-dir',
        'controller' => 'AdminThemeAssets::createDir',
        'requirements' => array('theme'=>'\d+'),
        'loaders' => array('theme'),
        'options' => array('is_submenu' => true)
    ),
    'admin-theme-assets-create-file' => array(
        'label' => '创建文件',
        'path' => '/structure/themes/{theme}/assets/create-file',
        'controller' => 'AdminThemeAssets::createFile',
        'requirements' => array('theme'=>'\d+'),
        'loaders' => array('theme'),
        'options' => array('is_submenu' => true)
    ),
    'admin-theme-assets-edit-file' => array(
        'label' => '编辑资源',
        'path' => '/structure/themes/{theme}/assets/edit-file',
        'controller' => 'AdminThemeAssets::createFile',
        'requirements' => array('theme'=>'\d+'),
        'loaders' => array('theme'),
    ),
    'admin-theme-assets-delete' => array(
        'label' => '删除资源',
        'path' => '/structure/themes/{theme}/assets/delete',
        'controller' => 'AdminThemeAssets::delete',
        'requirements' => array('theme'=>'\d+'),
        'loaders' => array('theme'),
    ),
    'admin-template' => array(
        'label' => '模板',
        'path' => '/structure/templates',
        'controller' => 'AdminTemplate',
        'options' => array('is_menu' => true, 'submenu' => true),
    ),
    'admin-template-add' => array(
        'label' => '添加模板',
        'path' => '/structure/templates/add',
        'controller' => 'AdminTemplate::add',
        'options' => array('is_submenu' => true),
    ),
    'admin-template-edit' => array(
        'label' => '编辑模板',
        'path' => '/structure/templates/{template}/edit',
        'requirements' => array('template'=>'\d+'),
        'loaders' => array('template'),
        'controller' => 'AdminTemplate::edit'
    ),
    'admin-template-delete' => array(
        'label' => '删除模板',
        'path' => '/structure/templates/delete',
        'controller' => 'AdminTemplate::delete'
    )*/
);