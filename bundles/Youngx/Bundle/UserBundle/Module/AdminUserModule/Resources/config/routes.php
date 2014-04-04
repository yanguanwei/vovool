<?php
return array(
    'admin-login' => array(
        'label' => '登录',
        'path' => '/login',
        'controller' => 'Login',
        'accessible' => 'user-login',
    ),
    'admin-logout' => array(
        'label' => '退出',
        'path' => '/logout',
        'controller' => 'Login::logout',
        'accessible' => 'user-logout',
    ),
    'admin-user' => array(
        'path' => '/users',
        'label' => '用户',
        'controller' => 'AdminUser',
        'options' => array('icon' => 'user', 'is_menu' => true, 'submenu' => true),
        'accessible' => array('role' => 'super')
    ),
    'admin-user-add' => array(
        'path' => '/users/add',
        'label' => '添加用户',
        'controller' => 'AdminUser::add',
        'options' => array('is_submenu' => true),
        'accessible' => array('role' => 'super')
    ),
    'admin-user-edit' => array(
        'path' => '/users/{%user%}/edit',
        'label' => '编辑用户',
        'controller' => 'AdminUser::edit',
        'accessible' => array('role' => 'super')
    ),
    'admin-user-password' => array(
        'path' => '/users/password',
        'label' => '修改密码',
        'controller' => 'AdminUser::password',
    ),
    'admin-user-delete' => array(
        'path' => 'users/delete',
        'label' => '删除用户',
        'controller' => 'AdminUser::delete',
        'accessible' => array('role' => 'super'),
    ),
    'admin-user-account' => array(
        'path' => '/users/account',
        'label' => '用户账号',
        'controller' => 'Admin::account',
    ),
);