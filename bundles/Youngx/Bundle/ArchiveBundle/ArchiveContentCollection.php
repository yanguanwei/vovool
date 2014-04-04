<?php

namespace Youngx\Bundle\ArchiveBundle;

use Youngx\MVC\ClassTypeExtensionCollection;

class ArchiveContentCollection extends ClassTypeExtensionCollection
{
    /**
     * @var ArchiveContent[]
     */
    protected $classes;

    public function __construct()
    {
        parent::__construct('archive.content.collect');
    }

    /**
     * @param $type
     * @return ArchiveContent
     */
    public function getInstance($type)
    {
        return parent::getInstance($type);
    }

    /**
     * @return ArchiveContent[]
     */
    public function all()
    {
        return parent::all();
    }
}