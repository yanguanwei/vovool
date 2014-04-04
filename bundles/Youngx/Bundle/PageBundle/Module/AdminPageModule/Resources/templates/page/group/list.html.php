<?php
$this->extend('layouts/main.html.php@Ace');

$content = $this->block('content')->start();
echo $this->table_widget($this->listView, 'ace');
$content->end();