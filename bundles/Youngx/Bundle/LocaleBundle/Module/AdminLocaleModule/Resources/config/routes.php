<?php
return array(
    'admin-locale' => array(
        'label' => '语言',
        'path' => '/settings/locales',
        'controller' => 'AdminLocale',
        'options' => array('is_menu' => true, 'submenu' => true)
    ),
    'admin-locale-add' => array(
        'label' => '添加语言',
        'path' => '/settings/locales/add',
        'controller' => 'AdminLocale::add',
        'options' => array('is_submenu' => true)
    ),
    'admin-locale-edit' => array(
        'label' => '编辑语言',
        'path' => '/settings/locales/{%locale%}/edit',
        'controller' => 'AdminLocale::edit',
    ),
    'admin-locale-delete' => array(
        'label' => '删除语言',
        'path' => '/settings/locales/delete',
        'controller' => 'AdminLocale::delete'
    ),
    'admin-translation' => array(
        'label' => '译文',
        'path' => '/settings/locales/{%locale%}/translations',
        'controller' => 'AdminTranslation',
        'options' => array('submenu' => true)
    ),
    'admin-translate' => array(
        'label' => '翻译',
        'path' => '/settings/locales/translate/{%translation%}',
        'controller' => 'AdminTranslation::translate',
        'defaults' => array('translation' => 0),
    ),
    'admin-translation-translate' => array(
        'label' => '翻译',
        'path' => '/settings/locales/{%locale%}/translations/translate/{%translation%}',
        'requirements' => array('locale' => '\d+', 'translation' => '\d+'),
        'controller' => 'AdminTranslation::translate',
        'defaults' => array('translation' => 0),
        'options' => array('is_submenu' => true)
    ),
    'admin-translation-delete' => array(
        'label' => 'Delete Translation',
        'path' => '/settings/locales/{%locale%}/translations/delete',
        'controller' => 'AdminTranslation::delete',
    ),
);