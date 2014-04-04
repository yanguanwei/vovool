<?php

namespace Youngx\Bundle\ArchiveBundle\Entity;

use Youngx\MVC\AppContext;
use Youngx\MVC\Entity;
use Youngx\MVC\EntityCode;
use Youngx\MVC\Query;
use Youngx\Util\DataTypeConversion;
use Youngx\Bundle\VocabularyBundle\Entity\Term;

class Archive extends Entity
{
    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 1;

    protected $id;
    protected $channel_id;
    protected $user_id;
    protected $locale_id;
    protected $entity_code;
    protected $title;
    protected $link;
    protected $cover;
    protected $status;
    protected $priority;
    protected $is_recommend;
    protected $updated_at;
    protected $created_at;
    protected $keywords;
    protected $description;
    protected $updated_time;

    protected $content;
    protected $terms;

    protected $prevArchive = false;
    protected $nextArchive = false;

    /**
     * @return Term[]
     */
    public function getTerms()
    {
        if (null === $this->terms) {
            $termIds = AppContext::db()->fetchValues('y_archive_terms', 'term_id', 'archive_id=:archive_id', array(':archive_id' => $this->getId()));
            $this->terms = AppContext::repository()->loadMultiple('y_terms', $termIds);
        }

        return $this->terms;
    }

    public function getContent()
    {
        if ($this->content === null && !$this->isNew()) {
            $sql = "SELECT yc.content FROM y_archive_content yac LEFT JOIN y_contents yc ON yc.id=yac.content_id WHERE yac.archive_id=:archive_id";
            $this->content = AppContext::db()->query($sql, array(':archive_id' => $this->getId()))->fetchColumn();
        }
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    protected function onAfterSave()
    {
        if ($this->content !== null) {
            $db = AppContext::db();
            $contentId = $db->fetchValue('y_archive_content', 'content_id', 'archive_id=:archive_id', array(':archive_id' => $this->getId()));
            if ($contentId) {
                $db->update('y_contents', array('content' => $this->content), 'id=:id', array(':id' => $contentId));
            } else {
                $contentId = $db->insert('y_contents', array('content' => $this->content));
                $db->insert('y_archive_content', array(
                        'archive_id' => $this->getId(),
                        'content_id' => $contentId
                    ));
            }
        }
    }

    public static function type()
    {
        return 'archive';
    }

    public static function table()
    {
        return 'y_archives';
    }

    public static function primaryKey()
    {
        return 'id';
    }

    public static function fields()
    {
        return array(
            'id', 'channel_id', 'user_id', 'locale_id', 'entity_code', 'title', 'link', 'cover', 'status', 'priority', 'is_recommend',
            'created_at', 'updated_at', 'keywords', 'description'
        );
    }

    /**
     * @return null|Entity
     */
    public function getPrevArchive()
    {
        if (false === $this->prevArchive) {
            $this->prevArchive = self::query()->inChannel($this->channel_id)->filterEntityCode($this->entity_code)->where('id<?', $this->id)->orderBy('id DESC')->one();
        }
        return $this->prevArchive;
    }

    /**
     * @return null|Entity
     */
    public function getNextArchive()
    {
        if (false === $this->nextArchive) {
            $this->nextArchive = self::query()->inChannel($this->channel_id)->filterEntityCode($this->entity_code)->where('id>?', $this->id)->orderBy('id ASC')->one();
        }
        return $this->nextArchive;
    }

    /**
     * @return Channel
     */
    public function getChannel()
    {
        return AppContext::repository()->load('channel', $this->getChannelId());
    }

    /**
     * @param mixed $channel_id
     */
    public function setChannelId($channel_id)
    {
        $this->channel_id = $channel_id;
    }

    /**
     * @return mixed
     */
    public function getChannelId()
    {
        return $this->channel_id;
    }

    /**
     * @param mixed $is_recommend
     */
    public function setIsRecommend($is_recommend)
    {
        $this->is_recommend = $is_recommend;
    }

    /**
     * @return mixed
     */
    public function getIsRecommend()
    {
        return $this->is_recommend;
    }

    /**
     * @param mixed $cover
     */
    public function setCover($cover)
    {
        $this->cover = $cover;
    }

    /**
     * @return mixed
     */
    public function getCover()
    {
        return $this->cover;
    }

    public function setCreatedAt($createdAt)
    {
        $this->created_at = DataTypeConversion::convertToDateTimeAsText($createdAt);
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $keywords
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
    }

    /**
     * @return mixed
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @param mixed $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    public function getStatusLabel()
    {
        $status = self::statusLabels();
        return $status[$this->status];
    }
    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = DataTypeConversion::convertToDateTimeAsText($updatedAt);
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function getUpdatedTime()
    {
        return $this->updated_time ?: $this->updated_time = strtotime($this->updated_at);
    }

    public function formatUpdatedTime($format)
    {
        return date($format, $this->getUpdatedTime());
    }

    /**
     * @param mixed $entity_code
     */
    public function setEntityCode($entity_code)
    {
        $this->entity_code = $entity_code;
    }

    /**
     * @return mixed
     */
    public function getEntityCode()
    {
        return $this->entity_code;
    }

    /**
     * @param mixed $locale_id
     */
    public function setLocaleId($locale_id)
    {
        $this->locale_id = $locale_id;
    }

    /**
     * @return mixed
     */
    public function getLocaleId()
    {
        return $this->locale_id;
    }

    /**
     * @param mixed $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

    /**
     * @return mixed
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    public function __toString()
    {
        return $this->getTitle();
    }

    /**
     * @param null $alias
     * @param Query $parent
     * @return ArchiveQuery
     */
    public static function query($alias = null, Query $parent = null)
    {
        return new ArchiveQuery(self::type(), $alias, $parent);
    }

    protected function onBeforeDelete()
    {
        $db = AppContext::db();
        $contentId = $db->fetchValue('y_archive_content', 'content_id', 'archive_id=:archive_id', array(':archive_id' => $this->getId()));
        if ($contentId) {
            $db->delete('y_archive_content', 'archive_id=:archive_id AND content_id=:content_id', array(
                    ':archive_id' => $this->getId(),
                    ':content_id' => $contentId
                ));
            $db->delete('y_contents', 'id=:id', array(':id' => $contentId));
        }
    }

    public static function statusLabels()
    {
        return array(
            self::STATUS_DRAFT => '未发布',
            self::STATUS_PUBLISHED => '已发布'
        );
    }
}