<?php
$form = $this->form_widget($this->form, array(
        'skin' =>  'ace-horizontal',
        'submit' => '保存'
    ))->start();

$tab = $this->tab_widget(array(
        'base' => '基本信息',
    ), 'ace');

$tab->startContent('base');

$form->render_field('channel_id', array('channel-select', 'topId' => $this->channel->getTopId()));
$form->render_field('title', 'text');
$form->render_field('is_recommend', 'checkbox');
$form->render_field('link', 'text');
$form->render_field('cover', 'ckfinder');
$form->render_field('status', 'archive-status-select');
$form->render_field('description', 'textarea');

$tab->endContent();
/*
$tab->startContent('terms');

$tab->endContent();
*/
echo $tab;

$form->render_buttons();

echo $form->end();