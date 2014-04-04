<?php
$this->extend('layouts/main.html.php@Ace');

$content = $this->block('content')->start();

echo $this->table_widget($this->table, array(
        'skin' => 'ace',
        'batch' => 'id',
        'buttons' => array(
            '操作' => array(
                '批量删除' => $this->value('admin-confirm-delete', 'user', 0, 'admin-user-delete'),
            )
        ),
    ));

$content->end();