<?php

namespace Youngx\Bundle\ArchiveBundle\Module\AdminArchiveModule\Menu;

use Youngx\Bundle\ArchiveBundle\Entity\Channel;
use Youngx\MVC\AppContext;
use Youngx\MVC\Menu;

class AdminChannelViewMenu extends Menu
{
    private $navigation;

    public function getNavigation()
    {
        if (null === $this->navigation) {
            $navigation = array();
            foreach (Channel::findAllTopChannels() as $channel) {
                $archiveContents = $channel->getArchiveContents();
                if (count($archiveContents) == 1 && $archiveContents[0]) {
                    $navigation[$channel->getLabel()] = AppContext::generateUrl('admin-archive-content', array(
                            'channel' => $channel->getName(),
                            'entityCode' => $archiveContents[0]
                        ));
                } else if (count($archiveContents) > 1) {
                    $navigation[$channel->getLabel()] = $this->generateUrl(array('channel' => $channel->getName()));
                }
            }
            $this->navigation = $navigation;
        }

        return $this->navigation;
    }

    public function isNavigationActive($label)
    {
        $channel = AppContext::request()->attributes->get('channel');
        if ($channel && $channel instanceof Channel) {
            return $label == $channel->getLabel();
        }

        return false;
    }

    public function getLabel()
    {
        $channel = AppContext::request()->attributes->get('channel');
        if ($channel && $channel instanceof Channel) {
            return $channel->getLabel();
        }

        return $this->label;
    }
} 