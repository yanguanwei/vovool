<?php
return array(
    'Channel' => array(
        'CNL' => '栏目'
    ),
    'Archive' => array(
        'channel' => array(
            'entityType' => 'channel',
            'condition' => array('channel_id' => 'id'),
            'relation' => 'many_one',
            'reverse' => 'archives'
        ),
        'news' => '新闻',
        'download' => '下载',
        'picture' => '图片'
    )
);