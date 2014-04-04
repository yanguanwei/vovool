<?php
$this->extend('layouts/main.html.php@Ace');

$content = $this->block('content')->start();

echo $this->table_widget($this->listView, array(
        'skin' => 'ace',
        'batch' => 'id',
        'buttons' => array(
            '批量删除' => $this->value('admin-confirm-delete', 'archive', 0, 'admin-archive-delete', array(
                        'channel' => $this->channel->getName(),
                        'entityCode' => $this->entityCode
                    ))
        )
    ));

$content->end();