<?php

namespace Youngx\Bundle\FeedbackBundle\Entity;

use Youngx\Bundle\VocabularyBundle\Entity\Term;
use Youngx\MVC\AppContext;
use Youngx\MVC\Entity;
use Youngx\Util\DataTypeConversion;

class Feedback extends Entity
{
    const STATUS_UNREAD = 0;
    const STATUS_READ = 1;
    const STATUS_PROCESSED = 2;

    protected $id;
    protected $name;
    protected $email;
    protected $phone;
    protected $qq;
    protected $intention_id;
    protected $content;
    protected $status;
    protected $is_star;
    protected $remarks;
    protected $created_at;

    /**
     * @return null|Term
     */
    public function getIntention()
    {
        return $this->intention_id ? Term::load($this->intention_id) : null;
    }

    public function isUnread()
    {
        return intval($this->status) === self::STATUS_UNREAD;
    }

    public function isRead()
    {
        return intval($this->status) === self::STATUS_READ;
    }

    public function isProcessed()
    {
        return intval($this->status) === self::STATUS_PROCESSED;
    }

    public function isStar()
    {
        return $this->is_star ? true : false;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = DataTypeConversion::convertToDateTimeAsText($createdAt);;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $intentionId
     */
    public function setIntentionId($intentionId)
    {
        $this->intention_id = $intentionId;
    }

    /**
     * @return mixed
     */
    public function getIntentionId()
    {
        return $this->intention_id;
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
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $qq
     */
    public function setQq($qq)
    {
        $this->qq = $qq;
    }

    /**
     * @return mixed
     */
    public function getQq()
    {
        return $this->qq;
    }

    /**
     * @param mixed $remarks
     */
    public function setRemarks($remarks)
    {
        $this->remarks = $remarks;
    }

    /**
     * @return mixed
     */
    public function getRemarks()
    {
        return $this->remarks;
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

    /**
     * @param mixed $is_star
     */
    public function setIsStar($is_star)
    {
        $this->is_star = $is_star;
    }

    /**
     * @return mixed
     */
    public function getIsStar()
    {
        return $this->is_star;
    }

    public function __toString()
    {
        return "{$this->name}";
    }

    public static function unreadCount()
    {
        return AppContext::repository()->count(self::type(), 'status=:status', array(
                ':status' => self::STATUS_UNREAD
            ));
    }

    public static function type()
    {
        return 'feedback';
    }

    public static function table()
    {
        return 'y_feedbacks';
    }

    public static function primaryKey()
    {
        return 'id';
    }

    public static function fields()
    {
        return array(
            'id', 'name', 'email', 'phone', 'qq', 'intention_id', 'content', 'is_star', 'status', 'remarks', 'created_at'
        );
    }
}