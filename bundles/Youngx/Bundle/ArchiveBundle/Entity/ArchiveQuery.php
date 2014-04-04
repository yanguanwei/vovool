<?php

namespace Youngx\Bundle\ArchiveBundle\Entity;

use Youngx\MVC\EntityCodeQueryFilter;
use Youngx\MVC\Query;

class ArchiveQuery extends Query implements EntityCodeQueryFilter
{
    public function recommended()
    {
        $this->where("{$this->getAlias()}.is_recommend=1");
        return $this;
    }

    public function published()
    {
        $this->where("{$this->getAlias()}.status=?", Archive::STATUS_PUBLISHED);
        return $this;
    }

    public function orderly()
    {
        $this->orderBy("{$this->getAlias()}.updated_at DESC");

        return $this;
    }

    public function recently($limit = 0)
    {
        $this->orderly();

        if ($limit > 0) {
            $this->limit($limit);
        }

        return $this;
    }

    public function inChannels(array $channelIds)
    {
        $this->where("{$this->getAlias()}.channel_id IN (?)", $channelIds);
        return $this;
    }

    public function inChannel($channelId)
    {
        if (is_object($channelId) && $channelId instanceof Channel) {
            $channelId = $channelId->getId();
        }
        $this->where("{$this->getAlias()}.channel_id=?", $channelId);
        return $this;
    }

    public function inTopChannel($channel)
    {
        if (!is_object($channel)) {
            $channel = Channel::load($channel);
        }
        $ids = $channel->getTop()->getDescendantIds();
        $this->inChannels($ids);
        return $this;
    }

    public function inDescendantChannel(Channel $channel)
    {
        $ids = $channel->getDescendantIds();
        $this->inChannels($ids);
        return $this;
    }

    public function filterEntityCode($entityCode)
    {
        $this->where('entity_code=?', $entityCode);
        return $this;
    }
}