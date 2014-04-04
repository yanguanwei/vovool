<?php

namespace Youngx\Bundle\FileBundle\Entity;

use Youngx\MVC\Entity;
use Youngx\MVC\Query;

class File extends Entity
{
    protected $id;
    protected $user_id;
    protected $entity_code;
    protected $entity_id;
    protected $uri;
    protected $filename;
    protected $created_at;
    protected $priority = 0;

    public static function type()
    {
        return 'file';
    }

    public static function table()
    {
        return 'y_files';
    }

    public static function primaryKey()
    {
        return 'id';
    }

    public static function fields()
    {
        return array(
            'id', 'entity_code', 'entity_id', 'user_id', 'uri', 'filename', 'created_at', 'priority'
        );
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $entity_id
     */
    public function setEntityId($entity_id)
    {
        $this->entity_id = $entity_id;
    }

    /**
     * @return mixed
     */
    public function getEntityId()
    {
        return $this->entity_id;
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
     * @param mixed $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    /**
     * @return mixed
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->user_id = $userId;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $uri
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
    }

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param int $priority
     */
    public function setPriority($priority)
    {
        $this->priority = intval($priority);
    }

    /**
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    public static function withEntity(Query $query, Entity $entity)
    {
        $query->where("entity_code='{$entity->type()}' AND entity_id='{$entity->identifier()}'");
        return $query;
    }

    public static function orderly(Query $query)
    {
        $query->orderBy('sort_num ASC, id ASC');
        return $query;
    }

    public function __toString()
    {
        return $this->getFilename();
    }
}