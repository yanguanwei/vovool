<?php

namespace Youngx\Bundle\PageBundle;

use Youngx\MVC\AppContext;

class PageVariableSettings implements \ArrayAccess
{
    /**
     * @var array
     */
    private $settings;

    private $fieldFromUrlAttributeNames = array();

    public function __construct(array $settings = array(), array $fieldFromUrlAttributeNames = array())
    {
        $this->settings = $settings;
        $this->fieldFromUrlAttributeNames = $fieldFromUrlAttributeNames;
    }

    public function get($key, $defaults = null)
    {
        if (isset($this->fieldFromUrlAttributeNames[$key])) {
            return AppContext::request()->attributes->get($this->fieldFromUrlAttributeNames[$key]);
        }

        return isset($this->settings[$key]) ? $this->settings[$key] : $defaults;
    }

    public function getFieldFromUrlAttributeName($name)
    {
        return isset($this->fieldFromUrlAttributeNames[$name]) ? $this->fieldFromUrlAttributeNames[$name] : null;
    }

    public function toArray()
    {
        return $this->settings;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     */
    public function offsetExists($offset)
    {
        return isset($this->settings[$offset]);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     */
    public function offsetSet($offset, $value)
    {
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     */
    public function offsetUnset($offset)
    {
    }
}