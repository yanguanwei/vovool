<?php
$this->extend('layouts/main.html.php@Ace');

$content = $this->block('content')->start();

echo $this->wizard_widget($this->wizard, array(
        'skin' => 'ace',
        'content' => $this->result
    ));

$content->end();