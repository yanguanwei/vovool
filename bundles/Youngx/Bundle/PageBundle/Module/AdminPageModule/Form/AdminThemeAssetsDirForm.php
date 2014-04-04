<?php

namespace Youngx\Bundle\PageBundle\Module\AdminPageModule\Form;

use Youngx\Bundle\PageBundle\Entity\Theme;
use Youngx\MVC\AppContext;
use Youngx\MVC\Form;

class AdminThemeAssetsDirForm extends Form
{
    protected $theme;
    protected $path;
    protected $folder;

    public function __construct(Theme $theme)
    {
        $this->theme = $theme;
        parent::__construct();
    }

    protected function setup()
    {
        $this->add('path', '路径')
            ->addFilter('trim', array('/'));

        $this->add('folder', '目录名');
    }

    /**
     * @param mixed $folder
     */
    public function setFolder($folder)
    {
        $this->folder = $folder;
    }

    /**
     * @return mixed
     */
    public function getFolder()
    {
        return $this->folder;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    public function submit()
    {
        $dir = AppContext::themeAssetPath($this->theme, trim("{$this->getPath()}/{$this->getFolder()}", '/'), 'Front');
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
    }
}