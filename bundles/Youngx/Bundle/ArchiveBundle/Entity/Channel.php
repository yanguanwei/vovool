<?php

namespace Youngx\Bundle\ArchiveBundle\Entity;

use Youngx\MVC\AppContext;
use Youngx\MVC\Entity;
use Youngx\MVC\Query;

class Channel extends Entity
{
    protected $id;
    protected $name;
    protected $label;
    protected $top_id = 0;
    protected $parent_id = 0;
    protected $priority = 0;
    protected $archive_contents;

    protected $top;
    protected $parent = false;
    protected $descendantIds;
    protected $vocabularyIds;

    /**
     * @return Archive[]
     */
    public function getArchives()
    {
        return $this->parseExtraFieldValue('archives');
    }

    public function setVocabularyIds(array $vocabularyIds)
    {
        $this->vocabularyIds = $vocabularyIds;

        return $this;
    }

    public function getVocabularyIds()
    {
        if (null === $this->vocabularyIds) {
            $this->vocabularyIds = $this->fetchVocabularyId();
        }

        return $this->vocabularyIds;
    }

    protected function fetchVocabularyId()
    {
        $sql = "SELECT vocabulary_id FROM y_channel_vocabularies WHERE channel_id=:channel_id";
        return AppContext::db()->queryValues($sql, array(
                ':channel_id' => $this->getId()
            ));
    }

    protected function onAfterSave()
    {
        if ($this->vocabularyIds !== null) {
            $db = AppContext::db();
            $db->delete('y_channel_vocabularies', 'channel_id=:channel_id', array(':channel_id' => $this->getId()));

            $data = array();
            foreach ($this->vocabularyIds as $vocabularyId) {
                $data[] = array(
                    'channel_id' => $this->getId(),
                    'vocabulary_id' => $vocabularyId
                );
            }
            if ($data) {
                $db->insertMultiple('y_channel_vocabularies', $data);
            }
        }
    }

    /**
     * @return Channel
     */
    public function getTop()
    {
        if ($this->top === null) {
            $this->top = $this->top_id == $this->id ? $this : self::load($this->top_id);
        }

        return $this->top;
    }

    public function isTop()
    {
        return $this->top_id === $this->id;
    }

    /**
     * @return Channel|null
     */
    public function getParent()
    {
        if (false === $this->parent) {
            $this->parent = $this->parent_id ? self::load($this->parent_id) : null;
        }

        return  $this->parent;
    }

    public function hasParent()
    {
        return $this->parent_id != 0;
    }

    public function hasChildren()
    {
        return AppContext::repository()->exist('channel', 'parent_id=:parent_id', array(':parent_id' => $this->id));
    }

    public function hasDescendant()
    {
        return AppContext::repository()->exist('channel', 'top_id=:top_id', array(':top_id' => $this->id));
    }

    /**
     * @return Channel[]
     */
    public function getPaths()
    {
        $current = $this;
        $paths = array();
        while ($current) {
            array_unshift($paths, $current);
            $current = $current->getParent();
        }
        return $paths;
    }

    /**
     * @return Channel[]
     */
    public function getChildren()
    {
        return self::query()
            ->where('parent_id=:parent_id')
            ->orderly()
            ->all(array(':parent_id' => $this->id));
    }

    /**
     * @return Channel[]
     */
    public function getDescendant()
    {
        return self::query()
            ->where('top_id=:top_id')
            ->orderly()
            ->all(array(':top_id' => $this->top_id));
    }

    /**
     * @param mixed $archive_contents
     */
    public function setArchiveContents($archive_contents)
    {
        $this->archive_contents = is_array($archive_contents) ? implode('|', $archive_contents) : $archive_contents;
    }

    /**
     * @return mixed
     */
    public function getArchiveContents()
    {
        return explode('|', $this->archive_contents);
    }

    /**
     * @param null $alias
     * @param Query $parent
     * @return ChannelQuery
     */
    public static function query($alias = null, Query $parent = null)
    {
        return new ChannelQuery(self::type(), $alias, $parent);
    }

    public static function type()
    {
        return 'channel';
    }

    public static function table()
    {
        return 'y_channels';
    }

    public static function primaryKey()
    {
        return 'id';
    }

    public static function fields()
    {
        return array(
            'id', 'name', 'label', 'top_id', 'archive_contents', 'parent_id', 'priority'
        );
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param int $top_id
     */
    public function setTopId($top_id)
    {
        $this->top_id = $top_id;
    }

    /**
     * @return int
     */
    public function getTopId()
    {
        return $this->top_id;
    }

    /**
     * @param int $parent_id
     */
    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;
    }

    /**
     * @return int
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * @param int $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

    /**
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    public function getDescendantIds()
    {
        if ($this->descendantIds === null) {
            $this->descendantIds = AppContext::db()->fetchValues(self::table(), 'id', 'top_id=:top_id', array(':top_id' => $this->getId()));
        }

        return $this->descendantIds;
    }

    public static function findForChannelParentSelectOptions($topId = null)
    {
        $sql = 'SELECT id, label, parent_id FROM '.self::table();
        if (null !== $topId) {
            $sql .= " WHERE top_id={$topId}";
        }
        $sql .= ' ORDER BY priority ASC, id ASC';
        return AppContext::db()->query($sql)->fetchAll();
    }

    public function __toString()
    {
        return $this->getLabel();
    }

    /**
     * @param $id
     * @return Channel|null
     */
    public static function load($id)
    {
        if (is_numeric($id)) {
            return AppContext::repository()->load(self::type(), $id);
        } else {
            return self::find('name=:name', array(':name' => $id));
        }
    }

    /**
     * @param string|null $orderBy
     * @return Channel[]
     */
    public static function findAllTopChannels($orderBy = null)
    {
        return self::findAll('parent_id=:parent_id', array(':parent_id' => 0), $orderBy);
    }

    protected function onBeforeDelete()
    {
        foreach ($this->getArchives() as $archive) {
            $archive->delete();
        }
    }
}