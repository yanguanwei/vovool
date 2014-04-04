<?php

namespace Youngx\Bundle\ArchiveBundle\Module\AdminArchiveModule\ListView;

use Youngx\MVC\ListView\OperationsCell;

class AdminSubChannelListView extends AdminChannelListView
{
    protected function setup()
    {
        parent::setup();

        $operations = $this->getColumn('operations');
        if ($operations instanceof OperationsCell) {
            $operations->remove('sub');
        }
    }
}