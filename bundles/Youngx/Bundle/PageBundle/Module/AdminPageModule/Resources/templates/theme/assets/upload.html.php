<?php
$this->extend('layouts/main.html.php@Ace');

$content = $this->block('content')->start();

$form = $this->form_widget($this->form, array(
        'skin' =>  'ace-horizontal',
        'submit' => '上传',
        'uploading' => true
    ))->start();

echo $form->render_field('uploadedFiles', 'ace-files');
echo $form->render_buttons();

echo $form->end();

$content->end();