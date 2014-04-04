<?php
return array(
    'admin-feedback' => array(
        'label' => '反馈',
        'path' => '/feedbacks',
        'controller' => 'AdminFeedback',
        'options' => array('is_menu' => true, 'icon' => 'inbox')
    ),
    'admin-feedback-read' => array(
        'label' => '查看反馈',
        'path' => '/feedbacks/{%feedback%}/read.{_format}',
        'defaults' => array('_format' => 'json'),
        'requirements' => array('_format' => 'json'),
        'controller' => 'AdminFeedback::read'
    ),
    'admin-feedback-flag' => array(
        'label' => '标记',
        'path' => '/feedbacks/flag',
        'controller' => 'AdminFeedback::flag'
    ),
    'admin-feedback-star' => array(
        'label' => '标星',
        'path' => '/feedbacks/star',
        'controller' => 'AdminFeedback::star'
    ),
    'admin-feedback-process' => array(
        'label' => '处理',
        'path' => '/feedbacks}/process',
        'controller' => 'AdminFeedback::process'
    ),
    'admin-feedback-delete' => array(
        'label' => '删除',
        'path' => '/feedbacks/delete',
        'controller' => 'AdminFeedback::delete'
    )
);