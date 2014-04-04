<?php
return array(
    'admin-vocabulary' => array(
        'label' => '词汇表',
        'path' => '/settings/vocabularies',
        'controller' => 'AdminVocabulary',
        'options' => array('is_menu' => true, 'submenu' => true)
    ),
    'admin-vocabulary-add' => array(
        'label' => '添加词汇',
        'path' => '/settings/vocabularies/add',
        'controller' => 'AdminVocabulary::add',
        'options' => array('is_submenu' => true)
    ),
    'admin-vocabulary-edit' => array(
        'label' => '编辑词汇',
        'path' => '/settings/vocabularies/{%vocabulary%}/edit',
        'controller' => 'AdminVocabulary::edit',
    ),
    'admin-vocabulary-delete' => array(
        'label' => '删除词汇',
        'path' => '/settings/vocabularies/delete',
        'controller' => 'AdminVocabulary::delete'
    ),
    'admin-term' => array(
        'label' => '术语',
        'path' => '/settings/vocabularies/{%vocabulary%}/terms',
        'options' => array('submenu' => true),
        'controller' => 'AdminTerm'
    ),
    'admin-term-add' => array(
        'label' => '添加术语',
        'path' => '/settings/vocabularies/{%vocabulary%}/terms/add',
        'options' => array('is_submenu' => true),
        'controller' => 'AdminTerm::add'
    ),
    'admin-term-edit' => array(
        'label' => '编辑术语',
        'path' => '/settings/vocabularies/{%vocabulary%}/terms/{%term%}/edit',
        'controller' => 'AdminTerm::edit'
    ),
    'admin-term-delete' => array(
        'label' => '删除术语',
        'path' => '/settings/vocabularies/{%vocabulary%}/terms/delete',
        'controller' => 'AdminTerm::delete'
    )
);