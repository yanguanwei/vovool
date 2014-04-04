<?php
$this->extend('layouts/main.html.php@Ace');

$content = $this->block('content')->start();

echo $this->listview_widget($this->listView);

$content->end();