<?php
return array(
    'Template','Theme', 'PageGroup',
    'Page' => array(
        'group' => array(
            'entityType' => 'page_group',
            'condition' => array('group_id' => 'id'),
            'relation' => 'many_one',
            'reverse' => 'pages'
        )
    ),
    'PageVariable' => array(
        'page' => array(
            'entityType' => 'page',
            'condition' => array('page_id' => 'id'),
            'relation' => 'many_one',
            'reverse' => 'variables'
        )
    ),
    'ThemeTemplate' => array(
        'template' => array(
            'entityType' => 'template',
            'condition' => array('template_id' => 'id'),
            'relation' => 'many_one'
        ),
        'theme' => array(
            'entityType' => 'theme',
            'condition' => array('theme_id' => 'id'),
            'relation' => 'many_one',
            'reverse' => 'theme_templates'
        )
    )
);