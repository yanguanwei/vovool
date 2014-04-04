<?php
$this->extend('layouts/main.html.php@Ace');

$content = $this->block('content')->start();

echo $this->table_widget($this->table, array(
        'skin' => 'ace',
        'paging' => 'ace',
        'batch' => 'id',
        'buttonGroup' => array(
            'buttons' => array(
                '操作' => array(
                    '批量删除' => $this->url('admin-confirm-delete', array('menu' => 'admin-locale-delete', 'entityType' => 'locale')),
                )
            ),
            'skin' => 'ace'
        )
    ));

$content->end();