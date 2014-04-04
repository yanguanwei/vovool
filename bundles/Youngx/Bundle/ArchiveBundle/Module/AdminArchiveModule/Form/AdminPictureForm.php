<?php

namespace Youngx\Bundle\ArchiveBundle\Module\AdminArchiveModule\Form;

use Youngx\Bundle\ArchiveBundle\Entity\Archive;
use Youngx\Bundle\ArchiveBundle\Entity\Channel;
use Youngx\MVC\AppContext;

class AdminPictureForm extends AdminArchiveForm
{
    protected function setup()
    {
        $this->add('title', '标题')
            ->addValidator('required');

        $this->add('channel_id', '栏目')
            ->addValidator('required');

        $this->add('description', '描述');
        $this->add('keywords', '关键字');

        $this->add('user_id', '用户');
        $this->add('locale_id', '语言');
        $this->add('cover', '图片');
        $this->add('link', '链接');
        $this->add('status', '状态');
        $this->add('priority', '排序');
        $this->add('is_recommend', '推荐');
    }

    public function render()
    {
        return AppContext::render('picture/form.html.php@AdminArchive', array(
                'form' => $this,
                'channel' => $this->channel
            ));
    }
}